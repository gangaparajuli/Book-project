<?php include 'header.php'; ?>
<div class="heading">
    <h3>shopping cart</h3>
    <p><a href="home.php">home</a>cart</p>
</div>
<section class ="shopping-cart">
    <h1 class="title">Products added</h1>
    <div class="box-container">
        <?php
        $select_cart =mysqli_query($conn,"SELECT FROM'cart' WHERE user_id=$user_id") or die('query failed');
        if(mysqli_num_rows($selct_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){

            ?>
            <?php
            }  

        }else{
            echo '<p class="empty"> Your Cart is Empty</p>';
        }
        ?>
        
    </div>
</section>