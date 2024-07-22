<?php
require 'database.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement
    $sql = "SELECT password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials!";
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
    <title>Login- Book Companion</title>
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
                    <a href="login.html"> <button class="btn" id="loginBtn">Log In</button> </a>
                    <a href="signup.html"><button class="btn" id="signupBtn">Sign Up</button></a>
                </div>
                <img src="cart.png" width="30px" height="30px">
                <img src="menu.png" width="28px" height="20px" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>