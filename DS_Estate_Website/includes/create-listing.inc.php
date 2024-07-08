<!-- //Purpose: Backend for create-listing.php -->
<?php
// if the create-listing-submit button is clicked
if (isset($_POST['create-listing-submit'])){

    session_start();
    if (isset($_SESSION['useruid'])){ //if user loggedIn

        if (isset($_FILES['image'])){ //if image uploaded

            // get the image information
            $image_name = $_FILES['image']['name'];
            $image_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            // get the listing information
            $usersId = $_SESSION['userid'];
            $title = $_POST['title'];
            $area = $_POST['area'];
            $rooms = $_POST['rooms'];
            $price = $_POST['price'];

            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';

            // check if there is no error
            if ($error === 0) {
                // check if the image size is less than 125000
                if ($image_size > 125000) {
                    $em= "Image too large";
                    header("Location: ../create-listing.php?error=$em");
                    exit();
                }
                else {

                    // check if the input fields are empty
                    if(emptyInputListing($title, $area, $rooms, $price) !== false) {
                        $em = "Please fill in all fields";
                        header("Location: ../create-listing.php?error=$em");
                        exit();
                    }

                    // gets the image extension and makes it lowercase
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex_lc = strtolower($image_ex);

                    // allowed image extensions
                    $allowed_exs = array("jpg", "jpeg", "png");

                    // check if the image extension is allowed
                    if (in_array($image_ex_lc, $allowed_exs)) {
                        // create a new image name and uploads it to the folder img
                        $new_image_name = uniqid("IMG-", true).'.'.$image_ex_lc;
                        $image_upload_path = '../img/'.$new_image_name;
                        move_uploaded_file($tmp_name, $image_upload_path);

                        // create the listing
                        createListing($conn, $new_image_name,$usersId, $title, $area, $rooms, $price);
                    }
                    // if the image extension is not allowed
                    else {
                        $em = "You can't upload files of this type";
                        header("Location: ../create-listing.php?error=$em");
                        exit();
                    }
                }    
            }
            else {
                $em = "You need to upload an image";
                header("Location: ../create-listing.php?error=$em");
                exit();
            }
        }
        else {
            $em = "You need to upload an image";
            header("Location: ../create-listing.php?error=$em");
            exit();
        }

    }
    else {
        $em = "You need to be logged in to create a listing";
        header("Location: ../create-listing.php?error=$em");
        exit();
    }
} else {
    header("Location: ../create-listing.php");
    exit();
}