<?php

include 'config.php';
session_start();
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    //$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    //$user_type =$_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name ='$name'  AND password= '$pass'")
    or die('query failed');

    if(mysqli_num_rows($select_users) > 0){

    $row = mysqli_fetch_assoc($select_users);
if($row['user_type'] == 'admin'){
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION['admin_email'] = $row['email'];
    //$_SESSION ['admin_password'] =$row['password'];
    $_SESSION['admin_id'] = $row['id'];
    header('location:admin_page.php');
}
elseif($row['user_type'] == 'Rentee'){
    $_SESSION['renter_name'] = $row['name'];
    $_SESSION['renter_email'] = $row['email'];
    //$_SESSION ['renter_password'] =$row['password'];
    $_SESSION['rentee_id'] = $row['id'];
header('location:home.php');
}
elseif($row['user_type'] == 'Renter'){
   $_SESSION['rentee_name'] = $row['name'];
   $_SESSION['rentee_email'] = $row['email'];
    //$_SESSION ['rentee_password'] =$row['password'];
    $_SESSION['renter_id'] = $row['id'];
header('location:home.php');
}

}else{
$message[] = 'incorrect password!';       
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

<!-- font awesome cdn link-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/front-awesome/6.0.0/css/all.min.css">

 <!-- custom css file link-->
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  
<?php 

if(isset($message)){
    foreach($message as $message){
echo '
 <div class="message">
    <span>'.$message.'</span>
    <i class="fas fa-times" onclick ="this.parentElement.remove();"></i>
   </div> 
';
    }
}
?>

   <div class="form-container">

    <form action="" method="post">
        <h3> login now</h3>

        <label for="name">name</label>
        <input type = "text" name="name" placeholders="enter your name" required class="box">
        
        <label for="email">email</label>
        <input type ="email" name="email" placeholder=" enter your email"  required class="box">
        
        <label for="password">password</label>
        <input type = "password" name="password" placeholders="enter your password" required class="box">
        
        <input type ="submit" name ="submit" value="login now" class="btn">
        <p> don't have a account? <a href ="signup.php"> signup now</a></p>

    </form>
   </div> 
</body>
</html>