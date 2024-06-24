<!-- // Purpose: This file is used to book a property. It displays the property details and a form to book the property. The form is used to check for available dates and to make a reservation. The form is displayed based on the value of the form parameter in the URL. If the form parameter is 1, the form to check for available dates is displayed. If the form parameter is 2, the form to make a reservation is displayed. The form data is sent to the booking.inc.php file for processing. The booking.inc.php file is used to check for available dates and to make a reservation. If the dates are available, the user is redirected to the reservation.php file to confirm the reservation. If the dates are not available, an error message is displayed. The reservation.php file is used to confirm the reservation and to display the reservation details. The reservation details are stored in the database and the user is redirected to the index.php file. -->

<?php
include_once 'header.php';

$listing_id = $_GET['listing_id'];
$form= $_GET['form'] ?? 1;

$listing = getListingById($conn, $listing_id);

if (!$listing) {
    echo "Listing not found.";
    exit();
}
?>

<section class="booking">
    <h1>Book Property</h1>  
    <?php
        if(isset($_GET["error"])) {   
            if (isset($_GET["error"])) {
            echo '<div class="error-message">' . $_GET["error"] . '</div>';
            }
        }
    ?>
    <div class="booking-content">
        <div class="listing">
            <img src="img/<?php echo $listing['image_url']; ?>" alt="<?php echo $listing['title']; ?>">
            <h2><?php echo $listing['title']; ?></h2>
            <p>Area: <?php echo $listing['area']; ?></p>
            <p>Rooms: <?php echo $listing['rooms']; ?></p>
            <p>Price per night: $<?php echo $listing['price_per_night']; ?></p>
        </div>
        <div class="booking-form">
            <?php if($form==1): ?>
                <form action="includes/booking.inc.php" method="post">
                    <h2>Check for available dates</h2>
                    <label for="checkin">Check In</label>
                    <input type="date" name="checkin">
                    <label for="checkout">Check Out</label>
                    <input type="date" name="checkout">
                    <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
                    <button type="submit" name="check-date-submit">Check</button>
                </form>      
            <?php
            elseif($form==2):
                include_once 'reservation.php';
            endif;
            ?>
        </div>
    </div>
        
</section>

<?php
include_once 'footer.php';
?>