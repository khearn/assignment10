<nav>
    <ul>
        <?php
        if (basename($_SERVER['PHP_SELF']) == "index.php") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == "register.php") {
            print '<li class="activePage">Register</li>';
        } else {
            print '<li><a href="register.php">Register</a></li>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == "profile.php") {
            print '<li class="activePage">Profile</li>';
        } else {
            print '<li><a href="profile.php">Profile</a></li>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == "manage_task.php") {
            print '<li class="activePage">Manage & Create Tasks</li>';
        } else {
            print '<li><a href="manage_task.php">Manage & Create Tasks</a></li>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == "random_task.php") {
            print '<li class="activePage">Random Task</li>';
        } else {
            print '<li><a href="random_task.php">Random Task</a></li>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == "about_us.php") {
            print '<li class="activePage">About Us</li>';
        } else {
            print '<li><a href="about_us.php">About Us</a></li>';
        }
        ?>
    </ul>
</nav>