<!-- // Purpose: To log out the user from the website. -->
<?php

session_start();
session_unset();
session_destroy();

header("Location: ../index.php");
exit();