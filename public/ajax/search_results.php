<?php

require __DIR__.'/../../boot/boot.php';

use Hotel\Room;
use Hotel\RoomType;

$room = new Room();
$cities = $room->getCities();
$maxPrice = $room->getMaxPrice();
$allGuests = $room->getGuests();

$type = new RoomType();
$allTypes = $type->getAllTypes();

$selectedCity = $_REQUEST['city'];
$selectedTypeId = $_REQUEST['room_type'];
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$selectedGuests = $_REQUEST['guest'];
$selectedMinPrice = $_REQUEST['min_price'];
$selectedMaxPrice = $_REQUEST['max_price'];

$allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedTypeId, $selectedGuests, $selectedMinPrice, $selectedMaxPrice);
?>

<div class="results-bar">
        <h2>Search Results</h2>
    </div>
    <?php 
        foreach($allAvailableRooms as $allAvailableRoom) {
    ?>
    <article class="room"> 
        <aside class="media">
            <img src="assets/images/rooms/<?php echo $allAvailableRoom['photo_url'];?>" />
        </aside>
        <div class="info">
            <h1> <?php echo $allAvailableRoom['name'];?></h1>
            <h2> <?php echo $allAvailableRoom['city'];?>, <?php echo $allAvailableRoom['area'];?> </h2>
            <p><?php echo $allAvailableRoom['description_short'];?></p>
            <button class="go-to-room-button"><a href="room.php?room_id=<?php echo $allAvailableRoom['room_id'];?>&check_in_date=<?php
            echo $checkInDate;?>&check_out_date=<?php echo $checkOutDate;?>"><i class="fas fa-bed"></i>  Go to Rooom Page</a></button>
        </div>
        <div class="room-details">
            <h3 class="room-price "><span class="per-night-price">Per Night:</span> <?php echo $allAvailableRoom['price'];?>€</h3>
            <div class="details">
                <p class="detail-text1">Count of Guests: <?php echo $allAvailableRoom['count_of_guests'];?></p>
                <p class="detail-text2">Type of Room: <?php echo $type->findValueFromArrayKey($allTypes,$allAvailableRoom['type_id']);?></p>
            </div>    
        </div>
    </article>
    <?php
        }
    ?>
    <?php
        if(count($allAvailableRooms) == 0){
    ?>
        <h2 class="check-search">There are no rooms!</h2>
        <hr class="hr">
    <?php
        }
    ?>                  
</div> 