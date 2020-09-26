<?php

require __DIR__.'/../boot/boot.php';

use Hotel\User;

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
        <link rel="stylesheet" type="text/css" href="assets/css/register.css">
		<link rel="stylesheet" type="text/css" href="assets/css/login.css">
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
				<!---LOG IN FORM--->
				<section class="form">
					<div class="form-box">
						<form class="login-form" method="post" action="actions/login.php">
							<h2>Log in</h2>
                            <input class="styling-fields" type="email" id="email" name="email" value="" placeholder="E-mail">
							<input class="styling-fields" type="password" id="password" name="password" value="" placeholder="Password">
							<div class="email-error error display-none">
								Invalid email address!
							</div>
							<div class="password-error error display-none">
								Password must be more than 4 characters!
							</div>
							<div class="login-error error display-none">
								Wrong email or password!
							</div>
                            <button class="register-login-buttons" type="submit">Sign in</button>
						</form>
						<span class="log-in">You don't have an account?<a href="register.php"> Click here to Register!</a></span>
					</div>
				</section>
			</div>
		</div>	
		<!---FOOTER--->
		<?php include "partial/footer.php" ?>

		<!---SCRIPTS--->
		<script src="assets/js/gallery.js"></script>
		<script src="assets/js/dropdown.js"></script>
		<script src="assets/js/login.js"></script>
		<script src="assets/js/mobile.js"></script>
    </body>
</html>