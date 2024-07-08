<!-- Purpose: This file is used to process the user's sign up information. It checks if the user has filled in all fields, if the username is valid, if the email is valid, if the passwords match, and if the username is already taken. If any of these conditions are met, the user is redirected back to the sign up page with an error message. If all conditions are met, the user is signed up and redirected to the sign up page with a success message. -->

<?php

if(isset($_POST['signup-submit'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) !== false) {
        $em= "Please fill in all fields";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    if(invalidUid($uid) !== false) {
        $em= "Invalid username";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    if(invalidEmail($email) !== false) {
        $em= "Invalid email";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false) {
        $em= "Passwords don't match";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    if(uidExists($conn, $uid, $email) !== false) {
        $em= "Username already taken";
        header("Location: ../signup.php?error=$em");
        exit();
    }

    createUser($conn, $name, $email, $uid, $pwd);

} 
else {
    header("Location: ../signup.php");
}