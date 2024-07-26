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

    $select_users_email = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

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
