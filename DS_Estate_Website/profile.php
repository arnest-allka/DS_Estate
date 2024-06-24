<!-- Profile page for users to view their details and listings -->
<?php
include_once 'header.php';

// get user and lis listings from session
$user = getUserById($conn, $_SESSION['userid']);
$usersListings = getUsersListings($conn, $_SESSION['userid']);

?>

<section class="profile">
    <!-- Profile details -->
    <div class="users-details">
        <h1>Profile Page</h1>
        <h2>Welcome <?php echo $user['usersUid']; ?></h2>
        <p>Full Name: <?php echo $user['usersName']?></p>
        <p>Email: <?php echo $user['usersEmail']?></p>
    </div>
    <!-- Profile listings -->
    <div class="listing-content">
        <h1>Your Listings</h1>
        <?php
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "Listing deleted successfully") {
                echo '<div class="success-message">' . $_GET["error"] . '</div>';
            } else {
            echo '<div class="error-message">' . $_GET["error"] . '</div>';
            }
        }
        ?>
        <div class="listings-container">                   
            <div class="listings">
                <?php foreach($usersListings as $listing): ?>
                    <div class="listing">
                        <img src="img/<?php echo $listing['image_url']; ?>" alt="<?php echo $listing['title']; ?>">
                        <h2><?php echo $listing['title']; ?></h2>
                        <p>Area: <?php echo $listing['area']; ?></p>
                        <p>Rooms: <?php echo $listing['rooms']; ?></p>
                        <p>Price per night: <?php echo $listing['price_per_night']; ?></p>

                        <!-- Two buttons for reservations and delete a listing, with the delete a are you sure prompt appears when clicked -->
                        <form action="includes/profile.inc.php" method="post">
                            <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
                            <button type="submit" name="show_reservations">Reservations</button>
                            <button type="submit" name="delete_submit" onclick="return  confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination">
                <button class="pagination-btn-prev" disabled>&lt; Prev</button>
                <span class="page-info">Page 1 of <?php echo ceil(count($usersListings) / 3); ?></span>
                <button class="pagination-btn-next">Next &gt;</button>
            </div>
        </div>
    </div>
</section>

<script src="js/pagination.js?v=<?php echo time(); ?>"></script>

<?php
include_once 'footer.php';
?>