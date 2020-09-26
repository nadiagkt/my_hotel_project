<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\Review;
use Hotel\User;
use Hotel\Booking;

$room = new Room();
$favorite = new Favorite();

$roomId = $_REQUEST['room_id'];
if(empty($roomId)){
    header('Location: index.php'); 
    return;
}

$roomInfo = $room->get($roomId);
if(empty($roomInfo)){
    header('Location: index.php'); 
    return;
}

$userId =  User::getCurrentUserId();

$isFavorite = $favorite->isFavorite($roomId, $userId);
session_start();
$_SESSION['is_favorite'] = $isFavorite;

$review = new Review();
$allReviews = $review->getReviewsByRoom($roomId);

$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$alreadyBooked = empty($checkInDate) || empty($checkOutDate);
if (!$alreadyBooked){
    $booking = new Booking();
    $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate); 
}

$googleIframeUrl = 'https://maps.google.com/maps?q='.$roomInfo['location_lat'].','.$roomInfo['location_long'].'&hl=el&z=16&amp;output=embed';

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
        <link rel="stylesheet" type="text/css" href="assets/css/list.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
        <link rel="stylesheet" type="text/css" href="assets/css/room.css">
        <link rel="stylesheet" type="text/css" href="assets/css/drop.css">
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
        <!---FAVICON--->
        <link rel="icon" href="assets/images/favicon.png" type="image/png" sizes="32x32">
    </head>
    <body style="background-image: linear-gradient(rgb(165 165 165 / 82%), rgba(165 165 165 / 82%)), url(assets/images/rooms/<?php echo $roomInfo['photo_url'];?>);">
		<!---HEADER--->
        <?php include "partial/header.php" ?>
        <!---MOBILE MENU--->
        <?php include "partial/mobile.php" ?>
		<!---ROOM INFORMATION--->
        <section class="room-information">
            <div class="room-container">
			    <!---TOP BAR--->
                <div class="results-bar top-room-bar">
                    <h2 class="border"><?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']) ?></h2>
                    <div class="reviews"> 
                        <span> Reviews:</span>
                        <?php 
                            $roomAvgReview = $roomInfo['avg_reviews'];
                            for ($i = 1; $i <= 5; $i++){
                                if($roomAvgReview > $i){
                                    ?>
                                    <i class="fas fa-star checked"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="fas fa-star"></i>
                                    <?php
                                }
                            }
                        ?>
                        <span class="border"></span>
                    </div>   
                    <form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm" action="actions/favorite.php">
                        <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                        <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>"> 
                        <button title="Add to favorites" class="heart-favorite-button <?php echo $isFavorite ? 'selected' : ''; ?> " id="fav"><i class="fas fa-heart"></i></button>
                    </form>            
                    <p class="room-price">Per night: <?php echo $roomInfo['price'];?>€</p>                
                </div>
				<!---ROOM IMAGE--->
                <div class="room-image">
                    <img src="assets/images/rooms/<?php echo $roomInfo['photo_url'];?>" />
                    <div class="clear"></div>
                </div>
				<!---SERVICES BAR--->
                <div class="results-bar services-bar">
                    <div class="guests">
                       <i class="fas fa-user"></i><span> <?php echo $roomInfo['count_of_guests'];?></span>
                        <p>Count of guests</p>
                    </div>
                    <div class="type-room">
                        <i class="fas fa-bed"></i><span> <?php echo $roomInfo['type_id'];?></span>
                        <p>Type of room</p>
                    </div>
                    <div class="parking">
                        <i class="fas fa-car"></i><span> <?php echo $roomInfo['parking'];?></span>
                        <p>Parking</p>
                    </div>
                    <div class="internet">
                        <i class="fas fa-signal"></i><span> <?php echo $roomInfo['wifi'];?></span>
                        <p>Wifi</p>
                    </div>
                    <div class="pets"> 
                        <span><?php echo $roomInfo['pet_friendly'];?></span>
                        <p>Pet friendly</p>
                    </div>
                    <div class="clear"></div>
                </div>
				<!---ROOM DESCRIPTION--->
                <div class="text-border">
                    <h3>Room description</h3>
                    <p><?php echo $roomInfo['description_long'];?></p> 
                </div>
				<!---ROOM BUTTONS--->
                <div class="book-room-buttons">
                    <?php 
                        if($alreadyBooked){
                    ?>
                        <button class="button-booked">Already booked</button>
                    <?php 
                        }else {
                    ?>
                        <form name="bookingForm" method="post" action="actions/book.php">
                            <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
                            <input type="hidden" name="check_in_date" value="<?php echo $checkInDate ?>">
                            <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate ?>">
                            <button type="submit" class="">Book Now!</button>
                        </form>
                    <?php
                        }
                    ?>
                </div> 
				<!---MAP--->
                <div>
                    <iframe src=<?php echo $googleIframeUrl;?> width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <hr class="hr-style">
				<!---REVIEWS--->
                <div class="review-div">
                    <div  class="reviews text-border">
                        <h3 class="reviews-heading">Reviews</h3>
                        <?php
                            foreach ($allReviews as $counter => $review){
                        ?>
                            <p class="review-username"> <?php echo sprintf('%d. %s', $counter + 1, $review['user_name']); ?></p>
                            <?php 
                                for ($i = 0; $i < 5; $i++) {
                                    if($review['rate'] > $i){
                                        ?>
                                        <i class="fas fa-star checked"></i>
                                        <?php
                                    }else{
                                        ?>
                                        <i class="fas fa-star"></i>
                                        <?php
                                    }
                                }
                            ?>                       
                            <p class="review-small-text">Created at: <?php echo $review['created_time']; ?></p>
                            <p class="comment"> <i><?php echo $review['comment']; ?></i></p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="text-border">
                        <h3 class="reviews-heading">Add review</h3>
                        <form name="reviewForm" method="post" action="actions/review.php">
                            <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
                            <h4>
                                <fieldset >
									<span class="rating">
                                        <ul>
                                            <li class="star-items"><label for="rating-1"><i class="fas fa-star" aria-hidden="true"></i></label><input type="radio" name="rate" id="rating-1" value="1"></li>
                                            <li class="star-items"><label for="rating-2"><i class="fas fa-star" aria-hidden="true"></i></label><input type="radio" name="rate" id="rating-2" value="2"></li>
                                            <li class="star-items"><label for="rating-3"><i class="fas fa-star" aria-hidden="true"></i></label><input type="radio" name="rate" id="rating-3" value="3"></li>
                                            <li class="star-items"><label for="rating-4"><i class="fas fa-star" aria-hidden="true"></i></label><input type="radio" name="rate" id="rating-4" value="4"></li>
                                            <li class="star-items"><label for="rating-5"><i class="fas fa-star" aria-hidden="true"></i></label><input type="radio" name="rate" id="rating-5" value="5"></li>
                                        </ul>						
									</span>	
                                </fieldset>
                            </h4>
                            <textarea id="add-review" name="comment"  rows="4" cols="50" placeholder="Review"></textarea>   
                            <div class="submit-button">
                                <button type="submit">Submit</button>
                            </div>
                         </form> 
                    </div>
                </div>
            </div>
        </section>
		<!---FOOTER--->
        <?php include "partial/footer.php" ?>

        <!--SCRIPTS-->
        <script src="assets/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/js/jquery/jquery-ui.js"></script>
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/mobile.js"></script>    
        <script src="assets/js/review.js"></script>  
       
    </body>
</html>