<!-- // Purpose: This page is used to allow users to sign up for an account. It takes in the user's name, email, username, and password. It then sends this information to the signup.inc.php file to be processed. If there are any errors, the user will be notified. -->
<?php
    include_once 'header.php';
?>

    <section class="form">
        <h2>Sign Up</h2>
        <?php
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "You have signed up successfully!") {
                echo '<div class="success-message">' . $_GET["error"] . '</div>';
            } else {
            echo '<div class="error-message">' . $_GET["error"] . '</div>';
            }
        }
        ?>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Repeat Password">
            <button type="submit" name="signup-submit">Sign Up</button>
        </form>
    </section>
    
<?php
    include_once 'footer.php';
?>