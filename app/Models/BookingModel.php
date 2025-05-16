<?php namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'hotel_id', 
        'room_type_id', 
        'payment_method_id',
        'check_in_date',
        'check_out_date',
        'adults',
        'children',
        'total_price',
        'status',
        'payment_status',
        'payment_proof',
        'special_requests'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get all bookings for a specific user
     */
    public function getUserBookings($userId)
    {
        return $this->select('bookings.*, hotels.name as hotel_name, room_types.name as room_type')
            ->join('hotels', 'hotels.id = bookings.hotel_id')
            ->join('room_types', 'room_types.id = bookings.room_type_id')
            ->where('bookings.user_id', $userId)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get all bookings for a specific hotel
     */
    public function getHotelBookings($hotel_id, $filters = [])
    {
        $builder = $this->select('bookings.*, 
                                users.full_name as guest_name, 
                                users.email as guest_email,
                                users.phone as guest_phone,
                                room_types.name as room_type,
                                room_types.base_price as room_price,
                                payment_methods.name as payment_method')
            ->join('users', 'users.id = bookings.user_id')
            ->join('room_types', 'room_types.id = bookings.room_type_id')
            ->join('payment_methods', 'payment_methods.id = bookings.payment_method_id', 'left')
            ->where('bookings.hotel_id', $hotel_id);

        // Apply filters if provided
        if (!empty($filters)) {
            if (isset($filters['status'])) {
                $builder->where('bookings.status', $filters['status']);
            }
            if (isset($filters['payment_status'])) {
                $builder->where('bookings.payment_status', $filters['payment_status']);
            }
            if (isset($filters['date_from']) && isset($filters['date_to'])) {
                $builder->groupStart()
                    ->where('bookings.check_in_date <=', $filters['date_to'])
                    ->where('bookings.check_out_date >=', $filters['date_from'])
                    ->groupEnd();
            }
        }

        return $builder->orderBy('bookings.created_at', 'DESC')
                      ->findAll();
    }

    /**
     * Create a new booking
     */
    public function createBooking(array $data)
    {
        // Basic validation
        if (empty($data['user_id'])) {
            throw new \RuntimeException('User ID is required');
        }
        if (empty($data['hotel_id'])) {
            throw new \RuntimeException('Hotel ID is required');
        }
        if (empty($data['room_type_id'])) {
            throw new \RuntimeException('Room type ID is required');
        }

        return $this->insert($data);
    }

    /**
     * Update booking status
     */
    public function updateBookingStatus($bookingId, $status)
    {
        $allowedStatuses = ['pending', 'confirmed', 'cancelled', 'completed', 'no_show'];
        
        if (!in_array($status, $allowedStatuses)) {
            throw new \InvalidArgumentException('Invalid booking status');
        }

        return $this->update($bookingId, ['status' => $status]);
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus($bookingId, $status)
    {
        $allowedStatuses = ['pending', 'paid', 'failed', 'refunded'];
        
        if (!in_array($status, $allowedStatuses)) {
            throw new \InvalidArgumentException('Invalid payment status');
        }

        return $this->update($bookingId, ['payment_status' => $status]);
    }

    /**
     * Get booking statistics for a hotel
     */
    public function getHotelBookingStats($hotel_id)
    {
        $stats = [
            'total' => $this->where('hotel_id', $hotel_id)->countAllResults(),
            'confirmed' => $this->where(['hotel_id' => $hotel_id, 'status' => 'confirmed'])->countAllResults(),
            'completed' => $this->where(['hotel_id' => $hotel_id, 'status' => 'completed'])->countAllResults(),
            'cancelled' => $this->where(['hotel_id' => $hotel_id, 'status' => 'cancelled'])->countAllResults(),
            'revenue' => $this->selectSum('total_price')
                            ->where(['hotel_id' => $hotel_id, 'payment_status' => 'paid'])
                            ->get()
                            ->getRow()->total_price ?? 0
        ];

        // Calculate occupancy rate (example)
        $roomModel = new \App\Models\RoomTypeModel();
        $totalRooms = $roomModel->where('hotel_id', $hotel_id)
                              ->selectSum('available_rooms')
                              ->get()
                              ->getRow()->available_rooms;

        if ($totalRooms > 0) {
            $bookedRooms = $this->where(['hotel_id' => $hotel_id, 'status !=' => 'cancelled'])
                              ->countAllResults();
            $stats['occupancy_rate'] = round(($bookedRooms / $totalRooms) * 100, 2);
        } else {
            $stats['occupancy_rate'] = 0;
        }

        return $stats;
    }

    /**
     * Check room availability
     */
    public function isRoomAvailable($roomTypeId, $checkIn, $checkOut, $excludeBookingId = null)
    {
        $builder = $this->where('room_type_id', $roomTypeId)
                      ->groupStart()
                        ->where('check_in_date <=', $checkOut)
                        ->where('check_out_date >=', $checkIn)
                      ->groupEnd()
                      ->where('status !=', 'cancelled');

        if ($excludeBookingId) {
            $builder->where('id !=', $excludeBookingId);
        }

        return $builder->countAllResults() === 0;
    }

    /**
     * Get upcoming check-ins for a hotel
     */
    public function getUpcomingCheckIns($hotel_id, $days = 7)
    {
        $today = date('Y-m-d');
        $futureDate = date('Y-m-d', strtotime("+$days days"));

        return $this->select('bookings.*, users.full_name as guest_name, room_types.name as room_type')
                  ->join('users', 'users.id = bookings.user_id')
                  ->join('room_types', 'room_types.id = bookings.room_type_id')
                  ->where('bookings.hotel_id', $hotel_id)
                  ->where('bookings.check_in_date >=', $today)
                  ->where('bookings.check_in_date <=', $futureDate)
                  ->where('bookings.status', 'confirmed')
                  ->orderBy('bookings.check_in_date', 'ASC')
                  ->findAll();
    }

    /**
     * Get current guests for a hotel
     */
    public function getCurrentGuests($hotel_id)
    {
        $today = date('Y-m-d');

        return $this->select('bookings.*, users.full_name as guest_name, room_types.name as room_type')
                  ->join('users', 'users.id = bookings.user_id')
                  ->join('room_types', 'room_types.id = bookings.room_type_id')
                  ->where('bookings.hotel_id', $hotel_id)
                  ->where('bookings.check_in_date <=', $today)
                  ->where('bookings.check_out_date >=', $today)
                  ->where('bookings.status', 'confirmed')
                  ->orderBy('bookings.check_out_date', 'ASC')
                  ->findAll();
    }
}