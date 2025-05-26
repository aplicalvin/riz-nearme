<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CityModel;
use function PHPUnit\Framework\returnArgument;

class CityController extends BaseController
{
protected $cityModel;

public function __construct()
{
    $this->cityModel = new CityModel();
}

// Daftar Kota
public function index()
{
    $keyword = $this->request->getGet('keyword');
    
    $data = [
        'title' => 'Manajemen Kota',
        'cities' => $keyword ? $this->cityModel->searchCities($keyword) : $this->cityModel->getCitiesWithHotels(),
        'provinces' => $this->cityModel->getUniqueProvinces(),
        'keyword' => $keyword
    ];

    return view('super/cities/v_index', $data);
}

// Form Tambah Kota
public function create()
{
    $data = [
        'title' => 'Tambah Kota Baru'
    ];

    return view('super/cities/v_form', $data);
}

// Simpan Kota Baru
public function store()
{
$rules = $this->cityModel->validateCity($this->request->getPost());

if (!$this->validate($rules)) {
    return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
}

    if ($this->cityModel->save($this->request->getPost())) {
        return redirect()->to('/super/cities')->with('message', 'Kota berhasil ditambahkan');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->cityModel->errors());
    }
}

// Form Edit Kota
public function edit($id)
{
    $city = $this->cityModel->find($id);
    
    if (!$city) {
        return redirect()->to('/super/cities')->with('error', 'Kota tidak ditemukan');
    }

    $data = [
        'title' => 'Edit Kota',
        'city' => $city
    ];
    // dd($city);
    return view('super/cities/v_form', $data);
}

// Update Kota
public function update($id)
{
    // return 'hello';
    $rules = $this->cityModel->validateCity($this->request->getPost(), true);

    if (!$this->validate($rules)) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }

    if ($this->cityModel->update($id, $this->request->getPost())) {
        return redirect()->to('/super/cities')->with('message', 'Kota berhasil diperbarui');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->cityModel->errors());
    }
}

// Hapus Kota
public function delete($id)
{
    $city = $this->cityModel->find($id);
    
    if (!$city) {
        return redirect()->to('/super/cities')->with('error', 'Kota tidak ditemukan');
    }

    // Cek apakah kota memiliki hotel
    $hotelModel = new \App\Models\HotelModel();
    $hotelCount = $hotelModel->where('city_id', $id)->countAllResults();
    
    if ($hotelCount > 0) {
        return redirect()->to('/super/cities')->with('error', 'Tidak dapat menghapus kota karena masih memiliki hotel');
    }

    if ($this->cityModel->delete($id)) {
        return redirect()->to('/super/cities')->with('message', 'Kota berhasil dihapus');
    } else {
        return redirect()->to('/super/cities')->with('error', 'Gagal menghapus kota');
    }
}
}