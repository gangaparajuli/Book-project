<?php
include 'config.php';
$message = [];

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
    $user_type = $_POST['user-type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exists!';
    } else {
        if($password != $confirm_password){
            $message[] = 'Confirm password does not match!';
        } else {
            mysqli_query($conn, "INSERT INTO `users`(`username`, `email`, `password`, `user_type`) VALUES ('$username', '$email', '$password', '$user_type')") or die('query failed');
            $message[] = 'Signup successful!';
            header('location:login.php');
        }
    }
}

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
