<!-- //Purpose: This file is used to create a reservation in the database, if they have entered the correct information. -->
<?php

if (isset($_POST['reservation-submit'])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // get the user's reservation information
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $listing_id = $_POST['listing_id'];
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];
    $discount = $_POST['discount'];

    // check if the input fields are all empty
    if (emptyInputReservation($name, $email) !== false) {
        $em = "Please fill in all fields";
        header("Location: ../booking.php?error=$em&listing_id=$listing_id&checkin=$checkin&checkout=$checkout&form=2");
        exit();
    }

    // check if the email is valid
    if (invalidEmail($email) !== false) {
        $em = "Please enter a valid email";
        header("Location: ../booking.php?error=$em&listing_id=$listing_id&checkin=$checkin&checkout=$checkout&form=2");
        exit();
    }

    // create the reservation
    createReservation($conn, $listing_id, $user_id, $checkin, $checkout, $total_amount, $discount, $name, $email);
}
else {
    header("Location: ../feed.php");
    exit();
}