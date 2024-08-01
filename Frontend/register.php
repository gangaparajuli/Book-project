<?php
//include config file contains database connection details.
include 'config.php';

//Initialize an empty array to hold message tht will be shown to the user.
$message = [];

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
    $user_type = $_POST['user-type'];


    //query the database to check if a user with the given username and email already exists.
    $select_users_username = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$username'") or die('query failed');

    $select_users_email= mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    //check if the username already exists.
    if(mysqli_num_rows($select_users_username) > 0){
        $message[] = 'User with this username already exists!';

        //check if the password already exists.
    }elseif(mysqli_num_rows($select_users_email)>0){
        $message[] = 'User with this email already exists!';
    } 
    else {
        if($password != $confirm_password){
            $message[] = 'Confirm password does not match!';
        } else {
            //insert the new user into the database.
            mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `password`, `user_type`) VALUES ('$username', '$email', '$password', '$user_type')") or die('query failed');
            $message[] = 'Signup successful!';
            //redirect to the login page.
            header('location:login.html');
        }
    }
}

//if there is any message, display to the user.
if(!empty($message)){
    foreach($message as $msg){
        echo '
        <div class="message">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- Book Companion</title>
    <link rel="stylesheet" href="style.css">
    </head>

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
                    <a href="login.php"> <button class="btn" id="loginBtn">Log In</button></a>
                     <a href="register.php" ><button class="btn" id="signupBtn">Sign Up</button></a>
                </div>
                <img src="cart.png" width="30px" height="30px">
                <img src="menu.png" width="28px" height="20px" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </div>
    <div class="signup-container">
        <h2>Sign-up</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="new-name">Username</label>
                <input type="text" id="new-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" required>
            </div>
           
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="form-group">
                <label for="user-type">User Type</label>
                <select id="user-type" name="user-type" required>
                    <option value="rentee">Rentee</option>
                    <option value="renter">Renter</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Sign Up</button>
                <p> already signup. <a href = "login.php" >login now</a></p>
            </div>
        </form>
        </div>
    
    </body>
</html>
