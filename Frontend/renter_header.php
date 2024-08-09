<?php

if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
        <span>' .$message.'</span>
        <i class="fas fa-times" onclick ="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">
   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<link rel="stylesheet" href="header_style.css">

    <div class="flex">
        <a href="renter_page.php" class="logo">Renter<span>Panel</span></a>

        <nav class="navbar">
            <a href="renter_page.php">Home</a>
            <a href="renter_books.php">Books</a>
            <a href="renter_orders.php">Orders</a>
           
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        
        <div class="account-box">
            <p> username : <span>
            <?php 
            if(isset($_SESSION['user_name'])){
                echo $_SESSION['user_name'];
            }
            ?>
            </span>

                </p>
                <p>
                <?php 
                if(isset($_SESSION['renter_name'])){
                    echo $_SESSION['renter_name'];
                }
                ?>
            </p>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </div>
</header>
