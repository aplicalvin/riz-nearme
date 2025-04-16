<!-- ===== THIS CARD COMPONENT ===== -->
<!-- > This components is using for card detail -->

<div class="hotel-card" style="width: 217px; height: 230px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; font-family: 'Jost', sans-serif; cursor: pointer;" onclick="window.location.href='hotel/123'">
    <!-- Hotel Image -->
    <div style="height: 120px; background-color: #f5f5f5; overflow: hidden;">
        <img src="https://via.placeholder.com/217x120?text=NearMe+Hotel" alt="Hotel Image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    
    <!-- Card Content -->
    <div style="padding: 12px; position: relative; height: 110px; background: white;">
        <!-- Hotel Name -->
        <h3 style="font-family: 'Gothic', sans-serif; font-size: 16px; margin: 0 0 4px 0; color: #1F1F1F; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            Louise Kiene Pemuda
        </h3>
        
        <!-- Location -->
        <p style="font-size: 12px; color: #6D6D6D; margin: 0 0 8px 0; display: flex; align-items: center;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="#6D6D6D" style="margin-right: 4px;">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
            Semarang, Indonesia
        </p>
        
        <!-- Star Rating -->
        <div style="color: #FFD700; margin-bottom: 20px;">
            <span>★★★★★</span>
        </div>
        
        <!-- Review Rating -->
        <div style="position: absolute; bottom: 12px; right: 12px; display: flex; align-items: center;">
            <span style="background-color: #FFFF6F; color: #1F1F1F; border-radius: 4px; padding: 3px 6px; font-size: 12px; font-weight: bold;">
                4.3 / 5
            </span>
            <span style="font-size: 10px; color: #6D6D6D; margin-left: 4px;">
                (50 reviews)
            </span>
        </div>
    </div>
</div>


<!--  -->