<!-- Purpose: Header for the website, includes navigation bar and links to other pages -->
<?php
    session_start(); // Start session to check if user is logged in
    require_once 'includes/dbh.inc.php'; // Include database connection
    require_once 'includes/functions.inc.php'; // Include functions file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DS Estate</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/listing.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/booking.css?v=<?php echo time(); ?>">
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">DS Estate</a>
            <div class="nav-menu" id="navMenu">
            <a href="feed.php" class="nav-item <?php echo isActive('feed.php'); ?>">Feed</a>
            <a href="create-listing.php" class="nav-item <?php echo isActive('create-listing.php'); ?>">Create Listing</a>
            <?php
            // Check if user is logged in
                if(isset($_SESSION["useruid"])) {
                    echo "<a href='profile.php' class='nav-item ".isActive('profile.php')."'>Profile Page</a>";
                    echo "<a href='includes/logout.inc.php' class='nav-item ".isActive('includes/logout.inc.php')."'>Log Out</a>";
                } else {
                    echo "<a href='signup.php' class='nav-item ".isActive('signup.php')."'>Sign Up</a>";
                    echo "<a href='login.php' class='nav-item ".isActive('login.php')."'>Login</a>";
                }
            ?>
            </div>
            <div class="hamburger-icon" onclick="toggleMobileMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <nav class="mobile-menu">
                    <a href="feed.php" class="nav-item">Feed</a>
                    <a href="create-listing.php" class="nav-item">Create Listing</a>
                    <?php
                        if(isset($_SESSION["useruid"])) {
                            echo "<a href='profile.php' class='nav-item'>Profile Page</a>";
                            echo "<a href='includes/logout.inc.php' class='nav-item'>Log Out</a>";
                        } else {
                            echo "<a href='signup.php' class='nav-item'>Sign Up</a>";
                            echo "<a href='login.php' class='nav-item'>Login</a>";
                        }
                    ?>              
                </nav>
            </div>
        </div>
    </header>
    
<?php
    // Function to check if the current page is active, and add the active class to the link
    function isActive($url) {
        return strpos($_SERVER['REQUEST_URI'], $url) ? 'active' : '';
    }
?>

<script>
// Function to toggle the mobile menu
function toggleMobileMenu(menu) {
  menu.classList.toggle("open");
}
</script>