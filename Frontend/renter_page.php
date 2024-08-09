<?php


include 'config.php';

session_start();
$_SESSION['renter_id'] = 'id';
//$admin_id = $_SESSION['admin_id'];
if(!isset($renter_id)){
    header('location.login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter panel</title>

<!-- font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/front-awesome/6.0.0/css/all.min.css">

<!-- custom admin css file link -->
 <link rel="stylesheet" href="admin_style.css">
</head>
<body>
   <?php
   include 'renter_header.php';
   ?>

   <!-- admin dashboard section starts -->
<section class="dashboard">

    <h1 class="title">Dashboard</h1>
    
   <div class="box-container">
   
   <div class="box">
    <?php
$total_pendings = 0;
$select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
if(mysqli_num_rows($select_pending) > 0){
    while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
        $total_price = $fetch_pendings['total_price'];
        $total_pendings += $total_price;
    };
};
    ?>
    <h3> <?php echo $total_pendings; ?></h3>
    <p>total pendings</p>
   </div>

   <div class="box">
   <?php
    $total_completed=0;
     $select_completed = mysqli_query( $conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');    
    if(mysqli_num_rows($select_completed)> 0){
    while($fetch_completed = mysqli_fetch_assoc($select_completed)){
        $total_price = $fetch_completed['total_price'];
        $total_completed += $total_price;
    };
};
   ?>
 <h3><?php echo $total_completed; ?></h3>
 <p>completed payments</p>
   </div> 

   <div class="box">
    <?php 
    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die ('query failed');
    $number_of_orders = mysqli_num_rows($select_orders);
    ?>
    <h3><?php echo $number_of_orders;?></h3>
   <p>order placed</p>
</div>

<div class="box">
    <?php 
    $select_books = mysqli_query($conn, "SELECT * FROM `books`") or die ('query failed');
    $number_of_books = mysqli_num_rows($select_books);
    ?>
    <h3><?php echo $number_of_books;?></h3>
   <p>books added</p>
</div>


<div class="box">
    <?php
    $select_returned_books = mysqli_query($conn, "SELECT * FROM `returned_books`") or die('query failed');
    $number_returned_books = mysqli_num_rows($select_returned_books);
    ?>
    <h3><?php echo $number_returned_books;?></h3>
    <p>returned books</p>
</div>
</div>
</section>


    <!-- renter dashboard section ends -->




<!-- custom admin js file link -->
 <script src="js/admin_script.js"> </script>
</body>
</html>