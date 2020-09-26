<?php 

unset($_COOKIE['user_token']); 
setcookie('user_token', null, -1, '/'); 
header('Location: /my_hotel_project/public/index.php');

?>