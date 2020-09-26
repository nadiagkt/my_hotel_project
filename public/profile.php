<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Favorite;
use Hotel\Review;
use Hotel\Booking;
use Hotel\User;

$userId = User::getCurrentUserId();
if(empty($userId)){
    header('Location: index.php');
    return;
}

$favorite = new Favorite();
$userFavorites = $favorite->getListByUser($userId);

$review = new Review();
$userReviews = $review->getListByUser($userId);

$booking = new Booking();
$userBookings = $booking->getListByUser($userId);

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
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/list.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profile.css">  
        <link rel="stylesheet" type="text/css" href="assets/css/drop.css">
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
            <div class="search-results">
                <!---SIDEBAR--->
                <div class="sidebar-filters">
                    <div class="favourites">
                        <h2>My Favorites</h2>
                        <?php
                            if(count($userFavorites) > 0){
                        ?>
                        <ol>
                            <?php 
                                foreach ($userFavorites as $favorite) {
                            ?>
                            <li class="hotel-fav-rev">
                                <span><a class="name-styles" href="room.php?room_id=<?php echo $favorite['room_id']; ?>"><?php echo $favorite['name']; ?></a></span>
                            </li>
                            <?php
                                }
                            ?>
                        </ol>
                        <?php
                            }else{
                        ?> 
                        <h2 class="check-search">You don't have any favorite Hotel!</h2>   
                        <?php
                            }
                        ?>
                    </div>
                    <div class="reviews">
                        <h2>My Reviews</h2>
                        <?php
                            if(count($userReviews) > 0){ 
                        ?>
                        <ol>
                            <?php 
                                foreach ($userReviews as $review){
                            ?>
                            <li class="hotel-fav-rev">
                                <span><a class="name-styles" href="room.php?room_id=<?php echo $favorite['room_id']; ?>"><?php echo $review['name']; ?></a></span>
                            </li>
                            <?php 
                                for ($i = 1; $i <= 5; $i++){
                                    if($review['rate'] >= $i){
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
                           <?php
                                }
                           ?>          
                        </ol>
                        <?php
                            }else{
                        ?>
                        <h2 class="check-search">You don't have any reviews!</h2>   
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!---BOOKINGS--->
                <div class="hotel-results">
                    <div class="results-bar">
                        <h2>My bookings</h2>
                    </div>
                    <?php
                        if(count($userBookings) > 0){ 
                    ?>
                        <article class="room">
                            <?php
                                foreach ($userBookings as $booking){
                            ?>
                            <aside class="media">
                                <img  src="assets/images/rooms/<?php echo $booking['photo_url']; ?>">
                            </aside>
                            <div class="info">    
                                <h1><?php echo $booking['name']; ?></h1>
                                <h2><?php echo sprintf('%s, %s' , $booking['city'], $booking['area']); ?></h2>
                                <p><?php echo $booking['description_short']; ?></p>
                                <button class="go-to-room-button"><a href="room.php?room_id=<?php echo $booking['room_id']; ?>"><i class="fas fa-bed"></i> Go to Rooom Page</a></button>
                            </div>   
                            <div class="room-details">
                                <h3 class="room-price room-profile-price"><span class="per-night-price total"> Total Cost:</span><?php echo $booking['total_price']; ?>€</h3>
                                <div class="details profile-d">
                                    <p class="detail-text1 profile-detail"><span class="detail-titles">Check-in Date:</span> <span class="break"><?php echo $booking['check_in_date']; ?></span></p>
                                    <p class="detail-text2 profile-detail"><span class="detail-titles">Check-out Date: </span><span class="break"><?php echo $booking['check_out_date']; ?></span></p>
                                    <p class="detail-text3 profile-detail"><span class="detail-titles">Type of Room: </span><span class="break"><?php echo $booking['room_type']; ?></span></p>
                                </div>
                            </div>
                            </div>
                            <?php
                                }
                            ?>
                        </article>
                    <?php
                        } else{
                    ?>
                        <h2 class="check-search">You don't have any booking</h2> 
                        <hr class="hr">  
                    <?php
                        }
                    ?>              
                </div> 
                <div class="clear"></div>
            </div>        
        </section>
        <!---FOOTER--->
        <?php include "partial/footer.php" ?>

        <!---SCRIPTS--->
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/mobile.js"></script>     
    </body>
</html>