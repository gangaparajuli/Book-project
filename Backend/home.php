<?php


include 'config.php';

session_start();

//$user_id = $_SESSION['user_id'];
//$renter_id = $_SESSION['renter_id'];
$rentee_id = $_SESSION['rentee_id'];
 //$_SESSION['renter_id'] = 'id';
//$rentee_id = $_SESSION['rentee_id'];

if(!isset($rentee_id)){
//if(!isset($renter_id) ){
    //&& !isset($rentee_id)
    //if(!isset($user_id)){
header('location.login.php');
}

if(isset($_POST['add_to_cart'])){

    $book_name = $_POST['book_name'];
    $book_price = $_POST['book_price'];
    $book_image = $_POST['book_image'];
    $book_quantity = $_POST['book_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$book_name' AND user_id = '$rentee_id'") or die('query failed');
    //$check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$book_name' AND user_id = '$renter_id'") or die('query failed');
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart!';
    }
    else{
       mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES('$rentee_id', '$book_name', '$book_price', '$book_quantity', $book_image')") or die('query failed');
       //mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES('$renter_id', '$book_name', '$book_price', '$book_quantity', $book_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

<!-- font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/front-awesome/6.0.0/css/all.min.css">

<!--custom css file link -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php
include 'header.php';
?>

<section class="home">

<div class="content">
    <h3> Hand Picked Book to your door.</h3>
        <a href="about.php" class="white-btn">discover more</a>
</div>
</section>

<section class="books">

<h1 class="title">latest books</h1>

<div class="box-container">
    <?php
$select_books = mysqli_query($conn, "SELECT * FROM `books` LIMIT 6 ") or die('query failed');
if(mysqli_num_rows($select_books) > 0){
while ($fetch_books =mysqli_fetch_assoc($select_books)){
   ?>
<form action="" method="post" class="box">
<img src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="">
<div class="name"><?php echo $fetch_books['name']; ?></div>
<div class="price">Rs<?php echo $fetch_books['price']; ?>/-</div>
<input type="number"min="1" name="book_quantity" value="1" class="qty">
<input type="hidden" name="book_name" value="<?php echo $fetch_books['name']; ?>">
<input type="hidden" name="book_price" value="<?php echo $fetch_books['price']; ?>">
<input type="hidden" name="book_image" value="<?php echo $fetch_books['image']; ?>">
<input type="submit" value="add to cart" name="add_to_cart" class="btn" >
</form>
    <?php
}
}else{
echo '<p class="empty">no books aded yet!</p>';
}
    ?>
    
</div>
</section>

<div class="about">

<div class="flex">

<div class="image">
<img src="image/about-img.jpg" alt="">
</div>
<div class="content">
    <h3> about us</h3>
    <a href="about.php" class="btn" >read more</a>

</div>

</div>

</section>

<section class="home-contact">
   <div class="content">
   <h3>have any questions?</h3>
   <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>


<?php  include 'footer.php';?>





<!-- custom js file link -->
 <scripr src="js/script.js"></scripr>
</body>
</html>