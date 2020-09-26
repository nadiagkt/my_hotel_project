<?php
require __DIR__.'/../boot/boot.php';

use Hotel\User;

if(!empty(User::getCurrentUserId())){
    header('Location: /my_hotel_project/public/index.php'); die;
}
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
				<!---REGISTER FORM--->
				<section class="form">
					<div class="form-box register-form">
						<form method="post" action="actions/register.php">
							<?php if (!empty($_GET['error'])){?>
								<div class="">Register Error</div>
							<?php } ?>
							<h2>Register!</h2>
							<input class="styling-fields" type="name" id="name" name="name" value="" placeholder="Full Name">
							<input class="styling-fields" type="email" id="email" name="email" value="" placeholder="E-mail">
							<input class="styling-fields" type="email" id="repeatEmail" name="email_repeat" value="" placeholder="Repeat E-mail" disabled>
							<input class="styling-fields" type="password" id="password" name="password" value="" placeholder="Password">
							<div class="name-error error display-error ">
							    Insert a valid name!
						    </div>
                            <div class="email-error error display-error">
							    Invalid email address!
						    </div>
                            <div class="repeat-email-error error display-error">
							    Email does not match!
						    </div>
						    <div class="password-error error display-error">
							    Password must be more than 4 characters!
                            </div>
                            <button class="register-login-buttons" type="submit" disabled>Sign up</button><br>
                            <span class="log-in">Do you have an account? <a href="login.php"> Click here to Log in!</a></span>
						</form>
					</div>
				</section>
			</div>
		</div>
		<!---FOOTER--->		
		<?php include "partial/footer.php" ?>	

		<!---SCRIPTS--->
		<script src="assets/js/dropdown.js"></script>
		<script src="assets/js/gallery.js"></script>
        <script src="assets/js/register.js"></script>
		<script src="assets/js/mobile.js"></script>     
    </body>
</html>