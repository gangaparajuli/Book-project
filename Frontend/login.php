<?php

//include the configuration file to establish database connection
include 'config.php';


 session_start();
 if(isset($_POST['submit'])){
   $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    //execute the query to find the user with the provided username and password.
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name ='$username'  AND password = '$password'") or die('query failed');

    //check  if any user is found with the given credentials.
    if(mysqli_num_rows($select_users) > 0){

    $row = mysqli_fetch_assoc($select_users);

    //check the user type and set session variables accordingly.
if($row['user_type'] == 'admin'){
   
   $_SESSION['user_name'] = $row['name'];
   $_SESSION['user_password'] = $row['password'];
    $_SESSION['user_id'] = $row['id'];
    header("location:admin_page.php");
}
elseif($row['user_type'] == 'rentee'){
   $_SESSION['user_name'] = $row['name'];
    $_SESSION ['user_password'] =$row['password'];
    $_SESSION['user_id'] = $row['id'];
header("location:home.html");
}

elseif($row['user_type'] == 'renter'){
  $_SESSION['user_name'] = $row['name'];
   $_SESSION ['user_password'] =$row['password'];
    $_SESSION['user_id'] = $row['id'];
header("location:renter_page.php");
}

}else{
$message[] = 'incorrect password!';       
   }
}

//check if there are any message to display
if(isset($message)){
    //loop through each message and display it.
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Book Companion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="loogo.png" width="125px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="home.html">Home</a></li>
                        <li><a href="Books.html">Books</a></li>
                        <li><a href="About.html">About Us</a></li>
                        <li><a href="Contact.html">Contact Us</a></li>
                    </ul>
                </nav>
                <div class="right">
                    <a href="login.html"><button class="btn" id="loginBtn">Log In</button></a>
                    <a href="signup.html"><button class="btn" id="signupBtn">Sign Up</button></a>
                </div>
                <img src="cart.png" width="30px" height="30px">
                <img src="menu.png" width="28px" height="20px" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </div>

    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Log In</button>
                <p> don't have a account? <a href = "signup.html" > signup now</a></p>
            </div>
        </form>
    </div>
</body>
</html>

