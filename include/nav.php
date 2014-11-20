<nav class="main">
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
        ?>

        <?php include 'userNav.php'; ?>

        <?php
        if (basename($_SERVER['PHP_SELF']) == "about_us.php") {
            print '<li class="activePage">About Us</li>';
        } else {
            print '<li><a href="about_us.php">About Us</a></li>';
        }
        ?>

    </ul>
</nav>