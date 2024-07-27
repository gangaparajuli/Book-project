<?php

include 'config.php';
 session_start();
 if(isset($_POST['submit'])){
   $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name ='$username'  AND password = '$password'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){

    $row = mysqli_fetch_assoc($select_users);
if($row['user_type'] == 'admin'){
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION ['admin_password'] =$row['password'];
    $_SESSION['admin_id'] = $row['id'];
    header('location:admin_page.html');
}
elseif($row['user_type'] == 'Rentee'){
    $_SESSION['renter_name'] = $row['name'];
    $_SESSION ['renter_password'] =$row['password'];
    $_SESSION['rentee_id'] = $row['id'];
header('location:home.html');
}
elseif($row['user_type'] == 'Renter'){
   $_SESSION['rentee_name'] = $row['name'];
   $_SESSION ['rentee_password'] =$row['password'];
    $_SESSION['renter_id'] = $row['id'];
header('location:home.html');
}

}else{
$message[] = 'incorrect password!';       
    }
}

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