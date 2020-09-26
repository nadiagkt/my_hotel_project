<?php

require __DIR__.'/../../boot/boot.php';

use Hotel\User;

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /'); 

    return;
}

$userId = User::getCurrentUserId();
if(!empty($userId)){
    header('Location: ../index.php');
    return;
}

$user = new User();
if(!$user->verify($_REQUEST['email'], $_REQUEST['password'])){
        header('Location: /my_hotel_project/public/login.php?error=Unable to verify user'); 
        return;
}

$userData = $user->getByEmail($_REQUEST['email']);
$token = $user->generateToken($userData['user_id']);
setcookie('user_token', $token, time() + 60 * 60 * 24 * 30, '/');

header('Location: /my_hotel_project/public/index.php');  
?>