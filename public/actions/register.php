<?php

require_once __DIR__."/../../boot/boot.php";

use Hotel\User;

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /');
    return;
}

$user = new User();
$user->insert($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);

$userInfo = $user->getByEmail($_REQUEST['email']);

$token = $user->generateToken($userInfo['user_id']);

setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');

header('Location: /my_hotel_project/public/index.php');

?>