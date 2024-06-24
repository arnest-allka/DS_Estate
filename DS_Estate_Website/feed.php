<!-- // Purpose: Displays all listings in the database and allows users to book a listing only if they are logged in -->

<?php
include_once 'header.php';

// Check if search parameters are set, else display all listings
if (isset($_GET['search_area']) || isset($_GET['$search_checkin']) || isset($_GET['$search_checkout']) || isset($_GET['search_rooms']) || isset($_GET['search_price'])){
    $listings = searchListings($conn, $_GET['search_area'], $_GET['search_checkin'], $_GET['search_checkout'], $_GET['search_rooms'], $_GET['search_price']);
} else {
    $listings = getAllListings($conn);
}
?>

<section class="listing-content">
    
    <?php 
        // Display a message if there are listings available
        if ($listings) {
            echo '<h1>Available Properties</h1>';
        } else {
            echo '<h1>No properties available</h1>';
        }
    ?>
    <?php
    // Display error message or success message
    if(isset($_GET["error"])) {
        if ($_GET["error"] == "Reservation created successfully") {
            echo '<div class="success-message">' . $_GET["error"] . '</div>';
        } else {
        echo '<div class="error-message">' . $_GET["error"] . '</div>';
        }
    }
    ?>
    <div class="listings">
        <!-- // Display all listings -->
        <?php foreach($listings as $listing): ?>
            <div class="listing">
                <img src="img/<?php echo $listing['image_url']; ?>" alt="<?php echo $listing['title']; ?>">
                <h2><?php echo $listing['title']; ?></h2>
                <p>Area: <?php echo $listing['area']; ?></p>
                <p>Rooms: <?php echo $listing['rooms']; ?></p>
                <p>Price per night: <?php echo $listing['price_per_night']; ?></p>

                <form action="includes/booking.inc.php" method="post">
                    <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
                    <button type="submit" name="booking-submit">Book Now</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- // Pagination -->
    <div class="pagination">
                <button class="pagination-btn-prev" disabled>&lt; Prev</button>
                <span class="page-info">Page 1 of <?php echo ceil(count($listings) / 3); ?></span>
                <button class="pagination-btn-next">Next &gt;</button>
    </div>
</section>

<!-- // Include pagination.js -->
<script src="js/pagination.js?v=<?php echo time(); ?>"></script>

<?php
include_once 'footer.php';
?>