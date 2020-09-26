<?php

error_reporting(E_ERROR);

spl_autoload_register(function ($class){
    require_once sprintf(__DIR__."/../app/%s.php", $class);
});

use Hotel\User;

$user = new User();

$userToken = $_COOKIE['user_token'];
if($userToken){
   
    if($user->verifyToken($userToken)){
        
        $userInfo = $user->getTokenPayload($userToken);
        User::setCurrentUserId($userInfo['user_id']);
    }
}

?>
