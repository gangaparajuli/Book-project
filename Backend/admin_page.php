<?php
include 'config.php';

session_start();

// Assuming the session variable for admin is stored as 'admin_id'
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin CSS file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <!-- admin dashboard section starts -->
    <section class="dashboard">
        <h1 class="title">Dashboard</h1>
        
        <div class="box-container">
            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('Query failed');
                if (mysqli_num_rows($select_pending) > 0) {
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                    }
                }
                ?>
                <h3>$<?php echo $total_pendings; ?></h3>
                <p>Total Pendings</p>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('Query failed');    
                if (mysqli_num_rows($select_completed) > 0) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                    }
                }
                ?>
                <h3>$<?php echo $total_completed; ?></h3>
                <p>Completed Payments</p>
            </div> 

            <div class="box">
                <?php 
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Orders Placed</p>
            </div>

            <div class="box">
                <?php 
                $select_books = mysqli_query($conn, "SELECT * FROM `books`") or die('Query failed');
                $number_of_books = mysqli_num_rows($select_books);
                ?>
                <h3><?php echo $number_of_books; ?></h3>
                <p>Books Added</p>
            </div>

            <div class="box">
                <?php 
                $select_rentee = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'rentee'") or die('Query failed');
                $number_of_rentee = mysqli_num_rows($select_rentee);
                ?>
                <h3><?php echo $number_of_rentee; ?></h3>
                <p>Rentee</p>
            </div>

            <div class="box">
                <?php 
                $select_renter = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'renter'") or die('Query failed');
                $number_of_renter = mysqli_num_rows($select_renter);
                ?>
                <h3><?php echo $number_of_renter; ?></h3>
                <p>Renter</p>
            </div>

            <div class="box">
                <?php 
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('Query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admin</p>
            </div>

            <div class="box">
                <?php 
                $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('Query failed');
                $number_of_account = mysqli_num_rows($select_account);
                ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>Total Users</p>
            </div>

            <div class="box">
                <?php 
                $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('Query failed');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>New Messages</p>
            </div>
        </div>
    </section>
    <!-- admin dashboard section ends -->

    <!-- custom admin JS file link -->
    <script src="js/admin_script.js"></script>
    <!-- changes made -->
</body>
</html>
