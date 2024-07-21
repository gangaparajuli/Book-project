<?php


include 'config.php';

session_start();

//$renter_id = $_SESSION['renter_id'];
 $_SESSION['renter_id'] = 'id';
//$rentee_id = $_SESSION['rentee_id'];

if(!isset($renter_id) ){
    //&& !isset($rentee_id)
header('location.login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

<!-- font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/front-awesome/6.0.0/css/all.min.css">

<!--custom css file link -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php
include 'header.php';
?>






<?php  include 'footer.php';?>





<!-- custom js file link -->
 <scripr src="js/script.js"></scripr>
</body>
</html>