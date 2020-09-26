<?php

use Hotel\Favorite;
use Hotel\User;

require_once __DIR__.'/../../boot/boot.php';

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /'); 
    return;
}

if(empty(User::getCurrentUserId())){
    header('Location: /');  
    return;
}

$roomId = $_REQUEST['room_id'];

if(empty($roomId)){
    header('Location: /');  
    return;
}

$favorite = new Favorite();

session_start();
$isFavorite = $_SESSION['is_favorite'];
if(!$isFavorite){
    $favorite->addFavorite($roomId, User::getCurrentUserId());
}else{
    $favorite->removeFavorite($roomId, User::getCurrentUserId());
}

 header(sprintf('Location: ../room.php?room_id=%s', $roomId)); 
?>