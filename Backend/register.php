<?php

include 'config.php';
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type =$_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email ='$email' AND password= '$pass'")
    or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
$message[] = 'user already exist!';
    }else{
       if($pass != $cpass){
$message[] = 'confirm password not matched!';
       }else{
        mysqli_query($conn, "INSERT INTO `users`(`name` , `email`  , `password` , `user_type`)  VALUES ('$name', '$email', '$cpass', '$user_type')") or 
        die('query failed');
       $message[] = 'signup successfully!';
       header('location:login.php');
       }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

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

   <div class=" form-container">
<h1 class="text-center">signup</h1>
    <form action="" method="post">

        
        <label for ="name">name </label>
        <input types = "text"  class="form-control"  name="name"  placeholders="enter your name" required class="box">


        <label for="email">email</label>
        <input types = "email" name="email"  placeholders="enter your email" required class="box">
        

        <label for="password">password</label>
        <input types = "password" name="password" placeholders="enter your password" required class="box">
        
        <label for="cpassword">Confirm  password</label>
        <input types ="password" name="cpassword" placeholders="confirm your password" required class="box">
        
        <select name="user_type"  class ="box">
            <option value="Renter">Renter</option>
            <option value="Rentee">Rentee</option>
<option value = "admin">admin</option>
        </select>
        <input type ="submit" name ="submit" value="signup" class="btn">
        <p> already signup<a href ="login.php"> login now</a> </p>

    </form>
   </div> 
</body>
</html>