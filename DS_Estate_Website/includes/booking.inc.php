<!-- This file is included in the feed.php and booking.php files. It handles the booking of a listing and checking if a listing is available for the selected dates. It also redirects the user to the booking page with an error message if the listing is not available for the selected dates. -->
<?php

// if the user clicks the book button on the feed page, checks if the user is logged in and redirects to the booking page
if (isset($_POST['booking-submit'])){

    $listing_id = $_POST['listing_id'];

    session_start();
    if (isset($_SESSION['useruid'])){
        header("Location: ../booking.php?listing_id=$listing_id");
        exit();
    }
    else {
        $em = "Please login to book a listing";
        header("Location: ../feed.php?error=$em");
        exit();
    }
}
// if the user clicks the check date button on the booking page, check if the listing is available for the selected dates
else if (isset($_POST['check-date-submit'])){
    $listing_id = $_POST['listing_id'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    
    // check if the input fields are empty
    if(emptyInputCheckDate($checkin, $checkout) !== false) {
        $em= "Please fill in all fields";
        header("Location: ../booking.php?error=$em&listing_id=$listing_id");
        exit();
    }

    //get reservations for the listing
    $reservations = getReservationsByListingId($conn, $listing_id);

    // if there are reservations for the listing, check if the listing is available for the selected dates
    if ($reservations) {
        // check if the check out date is after the check in date
        if (strtotime($checkin) >= strtotime($checkout)) {
            $em = "Check out date must be after check in date";
            header("Location: ../booking.php?error=$em&listing_id=$listing_id");
            exit();
        }

        // get the reservation for the selected dates, here the function getReservationByDate returns a reservation if there is one for the selected dates
        $reservations = getReservationByDate($conn, $listing_id, $checkin, $checkout);

        // if there are reservation for the selected dates, the listing is not available
        if ($reservations) {
            $em = "Listing not available for selected dates";
            header("Location: ../booking.php?error=$em&listing_id=$listing_id");
            exit();
        }
        // if there are no reservations for the selected dates, the listing is available and the second part of the booking form is shown
        else {
            header("Location: ../booking.php?listing_id=$listing_id&checkin=$checkin&checkout=$checkout&form=2");
            exit();
        }
    }
    else {
        header("Location: ../booking.php?listing_id=$listing_id&checkin=$checkin&checkout=$checkout&form=2");
            exit();
    }
}
else {
    header("Location: ../feed.php");
    exit();
}