<?php

require __DIR__.'/../../boot/boot.php';

use Hotel\User;

$userId =  User::getCurrentUserId();

if(!empty($userId)){
    $user = new User();
    $name = $user->getByUserId($userId)['name'];  
}

?> 
<header>
    <div class="header-container">
        <div class="logo">
            <a href="index.php"><img src="assets/images/logo.png"></a>
            </div>
        <nav class="navigation">
            <ul>
                <li class="nav-item mobile-menu">
                    <i class="fas fa-bars"></i>
                </li>
                <li class="nav-item home-page">
                    <a href="index.php">
                        <i class="fas fa-home"></i>&nbsp;<span>Home</span>
                    </a>
                </li>
                <?php
                    if(!empty($userId)) {
                ?>
                    <li class="dropdown nav-item-two profile-page">
                        <div class="dropbtn" onclick="dropdown()">Welcome <?php echo $name ?>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        <div class="dropdown-content" id="dropdown">
                            <a href="profile.php">
                                <i class="fas fa-user"></i>&nbsp;<span>Profile</span>
                            </a>   
                            <a href="actions/logout.php">Log out</a>
                        </div>
                    </li>   
                <?php 
                    } else {
                ?>
                    <li class="nav-item home-page">
                        <a href="login.php">
                            </i><span>Log in</span>
                        </a>
                    </li>
                    <li class="nav-item-two profile-page">
                        <a href="register.php">
                            <span>Register</span>
                        </a>
                    </li>  
                <?php
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>