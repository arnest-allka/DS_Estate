<!-- // Purpose: This file is used to check if the user has entered the correct login credentials and logs them in if they have. -->
<?php
if (isset($_POST['login-submit'])){

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // if the user has not filled in all fields, redirect them back to the login page with an error message
    if(emptyInputLogin($uid, $pwd) !== false) {
        $em= "Please fill in all fields";
        header("Location: ../login.php?error=$em");
        exit();
    }

    // log the user in
    loginUser($conn, $uid, $pwd);
}
else {
    header("Location: ../login.php");
    exit();
}