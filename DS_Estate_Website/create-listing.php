<!-- // Purpose: Page for creating a listing -->
<?php
include_once 'header.php';
?>

<!-- // Form for creating a listing -->
<section class="form">
        <h2>Create a Listing</h2>
        <?php
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "Listing created successfully") {
                echo '<div class="success-message">' . $_GET["error"] . '</div>';
            } else {
            echo '<div class="error-message">' . $_GET["error"] . '</div>';
            }
        }
        ?>
        <form action="includes/create-listing.inc.php" method="post" enctype="multipart/form-data">
            <input type="file" name="image" >
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="area" placeholder="Area">
            <input type="number" name="rooms" placeholder="Rooms">
            <input type="number" step="0.01" min="0" name="price" placeholder="$0.00">
            <button type="submit" name="create-listing-submit">Create</button>
        </form>  
</section>

<?php
    include_once 'footer.php';
?>