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
header("location:home.html");
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

