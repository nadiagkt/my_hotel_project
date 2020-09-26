<?php
require __DIR__.'/../boot/boot.php';

use Hotel\Room;
use Hotel\RoomType;

$room = new Room();
$cities = $room->getCities();

$type = new RoomType();
$allTypes = $type->getAllTypes();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Hotel</title>
        <!---CSS--->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/js/jquery/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
		<!---CONTAINER--->
		<div class="gallery-container">
			<div class="gallery">
				<div class="btns-container">
					<button type="button" id="prev" class="btn">
              ←
					</button>
					
					<button type="button" id="next" class="btn">
              →
					</button>
				</div>	
				<!---BOOK SEARCH FORM--->
				<section class="form">
                    <div class="welcome-message">Welcome to hotel</div> 
                    <div class="form-box">
                        <form name="searchForm" action="list.php" onsubmit="return validateForm()">
                            <h2>Book a room!</h2>
                            <select name="city" id="city" class="styling-fields select-city">    
                                <option value="" disabled selected hidden>City</option>                  
                                <?php 
                                    foreach($cities as $city) {
                                ?>
                                    <option style="color: #333;" value="<?php echo $city;?>"><?php echo $city;?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select name="room_type" id="room-type" class="styling-fields select-room">	
                                <option value="" disabled selected hidden>Room Type</option>
                                <?php 
                                    foreach($allTypes as $roomType) {
                                ?>
                                <option style="color: #333;" value="<?php echo $roomType['type_id'];?>"><?php echo $roomType['title'];?></option>
                                <?php
                                    }
                                ?>			
                            </select>
                            <input class="styling-fields check-in-date" type="text"  autocomplete="off" id="datepicker-start" name="check_in_date" value="" placeholder="Check-in Date">
                            <input class="styling-fields check-out-date" type="text"  autocomplete="off" id="datepicker-end" name="check_out_date" value="" placeholder="Check-out Date">
                            <div class="field-error error display-none">
                                All fields must be selected!
                            </div>
                            <div class="date-error error display-none">
                                You must enter a date!
                            </div>
                            <button class="search-button" type="submit">Search</button>
                        </form>
                    </div>
				</section>
			</div>
		</div>
		<!---FOOTER--->
        <?php include "partial/footer.php" ?> 

        <!---SCRIPTS--->
        <script src="assets/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/js/jquery/jquery-ui.js"></script> 
        <script src="assets/js/gallery.js"></script>
        <script src="assets/js/jquery/datepicker.js"></script>
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/book_index.js"></script>
        <script src="assets/js/anime.min.js"></script> 
        <script src="assets/js/welcome.js"></script>
        <script src="assets/js/mobile.js"></script>                           
    </body>
</html>