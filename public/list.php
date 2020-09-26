<?php

require __DIR__.'/../boot/boot.php';

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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Hotel</title>
        <script src="assets/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/js/jquery/jquery-ui.js"></script>
        <!---CSS-->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/js/jquery/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/list.css">
        <link rel="stylesheet" type="text/css" href="assets/css/drop.css">
        <link rel="stylesheet" type="text/css" href="assets/css/errors.css">
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
        <!---FAVICON--->
        <link rel="icon" href="assets/images/favicon.png" type="image/png" sizes="32x32">
    </head>
    <body>
		<!---HEADER--->
        <?php include "partial/header.php" ?>
        <!---MOBILE MENU--->
        <?php include "partial/mobile.php" ?>
        <section>
			<!---SEARCH RESULTS--->
            <div class="search-results">
                <!---SIDEBAR FILTERS--->
                <div class="sidebar-filters">
                    <form name="searchForm" class="searchForm" action="list.php" onsubmit="return validateForm()">
                        <h2>Find the perfect hotel</h2>
                        <select name="guest" id="guests" class="styling-fields register-fields select-guests">
                            <option value="" disabled selected hidden>Guests</option>
                            <?php 
                                foreach($allGuests as $guest) {
                            ?>
                                <option style="color: #333;" <?php echo $selectedGuests == $guest ? 'selected="selected"' : ''; ?> value="<?php echo $guest;?>"><?php echo $guest;?></option>
                            <?php   
                                }
                            ?>                 
                        </select>
                        <select name="room_type" id="room-type" class="styling-fields register-fields select-room">
                            <option value="" disabled selected hidden>Room Type</option>
                            <?php 
                                foreach($allTypes as $roomType) {
                            ?>
                                <option style="color: #333;" <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected="selected"' : ''; ?>  value="<?php echo $roomType['type_id'];?>"><?php echo $roomType['title'];?></option>
                            <?php
                                }
                            ?>                 
                        </select>
                        <select name="city" id="city" class="styling-fields register-fields select-city">   
                            <option value="" disabled selected hidden>City</option>                     
                            <?php 
                                foreach($cities as $city) {
                            ?>
                                <option style="color: #333;" <?php echo $selectedCity == $city ? 'selected="selected"' : ''; ?> value="<?php echo $city;?>"><?php echo $city;?></option>
                            <?php
                                }
                            ?>                          
                        </select> 
                        <div class="prices">
                            <input name="min_price" type="text" id="amount" class="price-range" readonly>
                            <input name="max_price" type="text" id="amount2" class="price-range" readonly>     
                        </div>
                        <div id="slider-range"></div>
                        <input class="styling-fields register-fields check-in-date" type="text"  autocomplete="off" id="datepicker-start" name="check_in_date" value="<?php echo $checkInDate;?>" placeholder="Check-in Date">
                        <input class="styling-fields register-fields check-out-date" type="text"  autocomplete="off" id="datepicker-end" name="check_out_date" value="<?php echo $checkOutDate;?>" placeholder="Check-out Date">
                        <div class="field-error error display-none">
                            All fields must be selected!
                        </div>  
                        <div class="date-error error display-none">
                            You must enter a date!
                        </div>
                        <button type="submit" class="button">Find hotel</button>
                    </form>    
                </div>
               <!---HOTEL RESULTS--->
                <div class="hotel-results" id="search-results-container">
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
            </div> 
            <div class="clear"></div>       
        </section>
        <!---FOOTER--->
        <?php include "partial/footer.php" ?>
        
        <!---JQUERY PRICE SLIDER--->
		<script>
            $( function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: <?php echo $maxPrice?>,
                    values: [ <?php echo empty($selectedMinPrice) ? 0 : $selectedMinPrice; ?>, <?php echo empty($selectedMaxPrice) ? $maxPrice : $selectedMaxPrice; ?> ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( ui.values[ 0 ] );
                        $( "#amount2" ).val( ui.values[ 1 ] );
                    }
	            });
	            $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) );
	            $( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ) );
	            });
        </script>

        <!---SCRIPTS--->
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/jquery/datepicker.js"></script>
        <script src="assets/js/book_list.js"></script>
        <script src="assets/js/mobile.js"></script>
        <script src="assets/pages/search.js"></script>
    </body>
</html>