<!-- // Purpose: Display all reservations for a specific listing of the user currently logged in. -->

<?php
include_once 'header.php';

$listing_id = $_GET['listing_id'];
$reservations = getReservationsByListingId($conn, $listing_id);
$listing = getListingById($conn, $listing_id);

?>

<section class="reservations">
    <h1>Reservations</h1>
    <div class="listings">
        <?php foreach($reservations as $reservation): ?>
            <div class="listing">
                <h2><?php echo $listing['title']; ?></h2>
                <p>Check In: <?php echo $reservation['start_date']; ?></p>
                <p>Check Out: <?php echo $reservation['end_date']; ?></p>
                <p>Total Amount: <?php echo $reservation['total_amount']; ?></p>
                <p>Guest: <?php echo $reservation['fullName']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
include_once 'footer.php';
?>
