<!-- // Purpose: This file is used to search for properties based on the user's input. -->
<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['search_submit'])) {
    // get the user's search input
    $search_area = $_POST['search_area'];
    $search_checkin = $_POST['search_checkin'];
    $search_checkout = $_POST['search_checkout'];
    $search_rooms = $_POST['search_rooms'];
    $search_price = $_POST['search_price'];

    // check if the input fields are all empty, we can do search with at least one field
    if (emptyInputSearch($search_area, $search_checkin, $search_checkout, $search_rooms, $search_price) !== false) {
        $em = "Please fill at least one field to search a property";
        header("Location: ../index.php?error=$em");
        exit();
    }

    // redirect the user to the feed page with the search parameters
    header("Location: ../feed.php?search_area=$search_area&search_checkin=$search_checkin&search_checkout=$search_checkout&search_rooms=$search_rooms&search_price=$search_price");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}