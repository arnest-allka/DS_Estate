<!-- Purpose: Main page of the website, where users can search for properties and view the available properties -->
<!-- includes header.php at top and footer.php at bottom -->
<?php
    include_once 'header.php';
?>

<section class="index-intro">
    <h1>Welcome to DS Estate</h1>
    <?php
        // Check if user is logged in and display a welcome message
        if(isset($_SESSION["useruid"])) {
            echo "<p>Hello there " . $_SESSION["useruid"] . "</p>";
        }
    ?>
</section>

<section class="search-properties">
    <h2>Search Properties</h2>
    <form action="includes/search.inc.php" method="post">
        <input type="text" name="search_area" placeholder="Location">
        <input type="date" name="search_checkin">
        <input type="date" name="search_checkout">
        <input type="number" name="search_rooms" placeholder="Rooms">
        <input type="number" step="0.01" min="0" name="search_price" placeholder="Price">
        <button type="submit" name="search_submit">Search</button>
    </form>
    <?php
    if(isset($_GET["error"])) {
        echo '<div class="error-message">' . $_GET["error"] . '</div>';
    }
    ?>
</section>
        
<?php
    include_once 'footer.php';
?>