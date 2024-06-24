<!-- // Purpose: This file is used to display the reservation form and calculate the total amount of the reservation. -->

<?php
    if(isset($_GET["checkin"])) {

        $user = getUserById($conn, $_SESSION['userid']);

        $checkin = $_GET["checkin"];
        $checkout = $_GET["checkout"];
        $days = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);

        $discount = rand(10, 30);
        $total_amount = $days * $listing["price_per_night"] * (1 - $discount / 100);
    ?>
        <form action="includes/reservation.inc.php" method="post" class="reservation-form">
            <h2>Confirm Booking</h2>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" value="<?php echo $user['usersName']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $user['usersEmail']; ?>">
            </div>
            <div class="form-group">
                <label for="checkin">Check In</label>
                <input type="date" name="checkin" value="<?php echo $_GET['checkin']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="checkout">Check Out</label>
                <input type="date" name="checkout" value="<?php echo $_GET['checkout']; ?>" readonly>
            </div>
            <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['usersId'] ?>">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount?>">
            <input type="hidden" name="discount" value="<?php echo $discount ?>">
            <button type="submit" name="reservation-submit">Book Now</button>
        </form>
        <div class="total-amount">
            <h3>Total Amount:</h3>
            <p>$<?php echo $total_amount ?></p>
        </div>
    <?php } ?>