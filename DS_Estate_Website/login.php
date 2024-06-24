<!-- // Purpose: Displays the login form and allows users to login -->
<?php
    include_once 'header.php';
?>

    <!-- // login form -->
    <section class="form">
        <h2>Login</h2>
        <?php
        if(isset($_GET["error"])) {
            echo '<div class="error-message">' . $_GET["error"] . '</div>';
        }
        ?>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
        </form>
    </section>

<?php
    include_once 'footer.php';
?>