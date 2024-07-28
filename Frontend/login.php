<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    // Get the username and password from the form using the correct names
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Corrected: changed 'name' to 'username'
    $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // No changes needed here

    // Query to select user from database based on username and password
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username ='$username' AND password = '$password'") or die('Query failed');

    // Check if any matching user exists
    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        //Admin login check
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['username'];
            $_SESSION['admin_password'] = $row['password'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.html');
        }
        // Rentee login check
        elseif ($row['user_type'] == 'Rentee') {
            $_SESSION['rentee_name'] = $row['username']; // Corrected: changed 'renter_name' to 'rentee_name'
            $_SESSION['rentee_password'] = $row['password'];
            $_SESSION['rentee_id'] = $row['id'];
            header('location:home.html');
        }
        // Renter login check
        elseif ($row['user_type'] == 'Renter') {
            $_SESSION['renter_name'] = $row['username']; // Corrected: changed 'rentee_name' to 'renter_name'
            $_SESSION['renter_password'] = $row['password'];
            $_SESSION['renter_id'] = $row['id'];
            header('location:home.html');
        }
    } else {
        $message[] = 'Incorrect username or password!';
    }
}

// Display messages if there are any
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
