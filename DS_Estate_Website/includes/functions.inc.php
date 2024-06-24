<?php

// Function to check if the input fields are empty
function emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) {
    $result = false;
    if(empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    return $result;
}

// Function to check if the username is valid
function invalidUid($uid) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = true;
    }
    return $result;
}

// Function to check if the email is valid
function invalidEmail($email) {
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

// Function to check if the passwords match
function pwdMatch($pwd, $pwdRepeat) {
    $result = false;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    return $result;
}

// Function to check if the username or email already exists in the database
function uidExists($conn, $uid, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $em= "Statement failed";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    }
    else {
        mysqli_stmt_close($stmt);
        $result = false;
        return $result;
    }
}

// Function to create a new user in the database
function createUser($conn, $name, $email, $uid, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $em= "Statement failed";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $em= "You have signed up successfully!";
    header("Location: ../signup.php?error=$em");
    exit();
}

// Function to check if the input fields are empty
function emptyInputLogin($uid, $pwd) {
    $result = false;
    if(empty($uid) || empty($pwd)) {
        $result = true;
    }
    return $result;
}

// Function to log the user in
function loginUser($conn, $uid, $pwd) {
    $uidExists = uidExists($conn, $uid, $uid);

    if($uidExists === false) {
        $em= "Wrong login information";
        header("Location: ../login.php?error=$em");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        $em= "Wrong login information";
        header("Location: ../login.php?error=$em");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("Location: ../index.php");
        exit();
    }
}

// Function to check if the input fields are empty
function emptyInputListing($title, $area, $rooms, $price) {
    $result = false;
    if(empty($title) || empty($area) || empty($rooms) || empty($price)) {
        $result = true;
    }
    return $result;
}

// Function to create a new listing in the database
function createListing($conn,$image_name,$usersId, $title, $area, $rooms, $price) {
    $sql = "INSERT INTO listings (user_id, title, area, rooms, price_per_night, image_url) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $em= "Statement failed";
        header("Location: ../create-listing.php?error=$em");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "issids",$usersId, $title, $area, $rooms, $price, $image_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $em= "Listing created successfully";
    header("Location: ../create-listing.php?error=$em");
    exit();
}


// Function to check if the input fields are empty
function emptyInputCheckDate($checkin, $checkout) {
    $result = false;
    if(empty($checkin) || empty($checkout)) {
        $result = true;
    }
    return $result;   
}

// Function to check if the input fields are empty
function emptyInputReservation($name, $email) {
    $result = false;
    if(empty($name) || empty($email)) {
        $result = true;
    }
    return $result;
}

// Function to create a new reservation in the database
function createReservation($conn, $listing_id, $user_id, $checkin, $checkout, $total_amount, $discount, $name, $email) {
    $sql = "INSERT INTO reservations (listing_id, user_id, start_date, end_date, total_amount, discount, fullName, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $em= "Statement failed";
        header("Location: ../booking.php?error=$em");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iissddss", $listing_id, $user_id, $checkin, $checkout,$total_amount, $discount, $name, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $em= "Reservation created successfully";
    header("Location: ../feed.php?error=$em");
    exit();
}

// Function to get a user by their id
function getUserById($conn, $user_id) {
    $sql = "SELECT * FROM users WHERE usersId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user;
}

// Function to get all the listings of a user
function getUsersListings($conn, $user_id) {
    $sql = "SELECT * FROM listings WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $listings = $result->fetch_all(MYSQLI_ASSOC);
    return $listings;
}

// Function to get all the listings
function getAllListings($conn){
    $sql = "SELECT * FROM listings";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->get_result();
    $listings = $result->fetch_all(MYSQLI_ASSOC);
    return $listings;
}

// Function to get a listing by its id
function getListingById($conn, $listing_id) {
    $sql = "SELECT * FROM listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $listing = $result->fetch_assoc();
    return $listing;
}

// Function to get all the reservations of a listing
function getReservationsByListingId($conn, $listing_id) {
    $sql = "SELECT * FROM reservations WHERE listing_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservations = $result->fetch_all(MYSQLI_ASSOC);
    return $reservations;
}

// Function to get a reservation by its dates, to check if a listing is available
function getReservationByDate($conn, $listing_id, $checkin, $checkout){
    // select all reservations for the listing where the selected dates are between the start and end date of the reservation
    $sql = "SELECT * FROM reservations WHERE listing_id = ? 
        AND (
            (start_date <= ? AND end_date >= ?)
            OR (start_date <= ? AND end_date >= ?)
            OR (start_date >= ? AND end_date <= ?)
        );";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $listing_id, $checkout, $checkin,  $checkin, $checkout, $checkin, $checkout);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservations = $result->fetch_assoc();
        return $reservations;
}

// Function to check if the input fields are empty
function emptyInputSearch($area, $checkin, $checkout, $rooms, $price) {
    $result = false;
    if(empty($area) && empty($checkin) && empty($checkout) && empty($rooms) && empty($price)) {
        $result = true;
    }
    return $result;
}

// Function to search for listings based on the user's input, if there is no input gets all listings
function searchListings($conn, $area, $checkin, $checkout, $rooms, $price) {
    $sql = "SELECT * FROM listings";
    $conditions = [];

    if (! empty($checkin) && ! empty($checkout)) {
        $conditions[] = "id NOT IN (SELECT listing_id FROM reservations WHERE (start_date <= '$checkout' AND end_date >= '$checkin') OR (start_date <= '$checkin' AND end_date >= '$checkout') OR (start_date >= '$checkin' AND end_date <= '$checkout'))";
    }
    else if (! empty($checkin)) {
        $conditions[] = "id NOT IN (SELECT listing_id FROM reservations WHERE start_date <= '$checkin')";
    }
    else if (! empty($checkout)) {
        $conditions[] = "id NOT IN (SELECT listing_id FROM reservations WHERE end_date >= '$checkout')";
    }

    if (! empty($area)) {
        $conditions[] = "area LIKE '%$area%'";
    }
    if (! empty($rooms)) {
        $conditions[] = "rooms = $rooms";
    }
    if (! empty($price)) {
        $conditions[] = "price_per_night <= $price";
    }

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $listings = $result->fetch_all(MYSQLI_ASSOC);
    return $listings;
}

// Function to delete a listing
function deleteListing($conn, $listing_id) {
    $sql = "DELETE FROM listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $stmt->close();
    $em= "Listing deleted successfully";
    header("Location: ../profile.php?error=$em");
    exit(); 
}