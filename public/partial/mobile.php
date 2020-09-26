<div class="topnav">
    <a href="#" class="active"></a>
    <div id="mobile">
        <a href="index.php">
            <i class="fas fa-home"></i>&nbsp;<span>Home</span>
        </a>
        <?php
            if(!empty($userId)) {
        ?>

            <a href="profile.php">
                <i class="fas fa-user"></i>&nbsp;<span>Profile</span>
            </a>   
            <a href="actions/logout.php">Log out</a>                
        <?php 
            } else {
        ?>
            <a href="login.php">
                </i><span>Log in</span>
            </a>
            
            <a href="register.php">
                <span>Register</span>
            </a>  
        <?php
            }
        ?>
    </div>
</div>
