<?php
require 'database.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $confirm_password = $_POST['confirm-password'];
    $user_type = $_POST['user-type'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO users (username, password, email, user_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $user_type);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Book Companion</title>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Books.php">Books</a></li>
                        <li><a href="About.html">About Us</a></li>
                        <li><a href="Contact.html">Contact Us</a></li>
                    </ul>
                </nav>
                <div class="right">
                    <a href="login.php"> <button class="btn" id="loginBtn">Log In</button> </a>
                    <a href="signup.php"><button class="btn" id="signupBtn">Sign Up</button></a>
                </div>
                <img src="cart.png" width="30px" height="30px">
                <img src="menu.png" width="28px" height="20px" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </div>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="new-username">Username</label>
                <input type="text" id="new-username" name="username" required>
            </div>
            <div class="form-group">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
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
                <button type="submit">Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>
