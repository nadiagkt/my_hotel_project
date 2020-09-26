<?php

use Hotel\Review;
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

$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);

 header(sprintf('Location: ../room.php?room_id=%s', $roomId)); 
?>