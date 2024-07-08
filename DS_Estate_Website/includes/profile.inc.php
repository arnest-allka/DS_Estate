<!-- // Purpose: Backend for profile.php -->
<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

// if the delete button is clicked, delete the listing
if(isset($_POST['delete_submit'])) {

    $listing_id = $_POST['listing_id'];
    
    //get all reservations for the listing
    $reservations = getReservationsByListingId($conn, $listing_id);

    // if there are reservations for the listing, the listing cannot be deleted
    if ($reservations) {
        $em = "Listing has reservations and cannot be deleted";
        header("Location: ../profile.php?error=$em");
        exit();
    }
    // if there are no reservations for the listing, delete the listing
    else {
        deleteListing($conn, $listing_id);
        $em= "Listing deleted successfully";
        header("Location: ../profile.php?error=$em");
        exit();
    }
}
// if the show reservations button is clicked, show the reservations for the listing
else if(isset($_POST['show_reservations'])) {

    $listing_id = $_POST['listing_id'];
    
    //get all reservations for the listing
    $reservations = getReservationsByListingId($conn, $listing_id);

    // if there are reservations for the listing, show the reservations
    if ($reservations) {
        header("Location: ../reservations.php?listing_id=$listing_id");
        exit();
    }
    // if there are no reservations for the listing, show an error message
    else {
        $em = "No reservations for this listing";
        header("Location: ../profile.php?error=$em");
        exit();
    }
}
else {
    header("Location: ../profile.php");
    exit();
}