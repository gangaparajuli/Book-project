<?php


include 'config.php';

session_start();
$_SESSION['renter_id'] = 'id';
//$admin_id = $_SESSION['admin_id'];
if(!isset($renter_id)){
    header('location.login.php');
};

if(isset($_POST['add_book'])){

 $name = mysqli_real_escape_string($conn,$_POST['name']);
 $price = $_POST['price'];
 $category = $_POST['category'];
 $status =$_POST['status'];
 $image = $_FILES['image']['name'];
 $image_size = $_FILES['image']['size'];
 $image_tmp_name = $_FILES['image']['tmp_name'];
 $image_folder ='uploaded_img/'.$image;

 $select_book_price = mysqli_query($conn, "SELECT price FROM `books` WHERE price ='$price'") or die('query fail');

 if(mysqli_num_rows($select_book_price) >0 ){
    $message[] = 'book price already added';
 }
 else{
    $add_book_query = mysqli_query($conn, "INSERT INTO `books`(name, price, category, status, image) VALUES ('$name','$price', '$category', '$status', '$image')") or die('query fail');
    
    if($add_book_query){
        if($image_size > 200000){
            $message[] = 'image size is too large';
        }else{
        move_uploaded_file($image_tmp_name, $image_folder);
        $message[] = 'book added successfully!';
        } 
    }else{
     $message[] = 'book could not be added!';
    }
 }
}
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `books` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' .$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `books` WHERE id = '$delete_id'") or die ('query failed');
    header('location:admin_books.php');
}

if(isset($_POST['update_book'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_category = $_POST['update_category'];
    $update_status =$_POST['update_status'];

    mysqli_query($conn, "UPDATE `books` SET name = '$update_name', price = '$update_price',  category ='$update_category', status = '$update_status'  WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];
    
    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $message[] = 'image file size is too large';
        }else{
            mysqli_query($conn, "UPDATE `books` SET image = '$update_image' WHERE id = '$update_p_id'") or die ('query failed');
            move_uploaded_file($update_img_tmp_name, $update_folder);
            unlink('uploaded_img/'.$update_old_image);

        }

    }
    header('location:admin_books.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>

<!-- font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/front-awesome/6.0.0/css/all.min.css">

<!-- custom admin css file link -->
 <link rel="stylesheet" href="admin_style.css">
</head>
<body>

   <?php
   include 'admin_header.php';
   ?>

<!-- book CRUD section starts -->

<section class="add-books">
    <h1 class="title">Rent books</h1>

<form action="" method="post" enctype="multipart/form-data">
  <h3>Add book</h3>
<input type="text"  name ="name" class="box" placeholder="enter book name" required>
<input type="number" min="0" name ="price" class="box" placeholder="enter book price" required>
<select name="category" class="box" required>
    <option value="" disadble selected>Select category</option>
    <option value="romnace">Romance</option>
    <option value="sci-fi">Sci-Fi</option>
    <option value="thriller">Thriller</option>
    <option value="course book">Course Book</option>
</select>
<select name="status" class="box" required>
    <option value="" disable selected>Select status</option>
    <option value="available">Available</option>
    <option value="not available">Not Available</option>
</select>
<input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
</select>
<input type="submit" valus="add books" name="add_book" class="btn">
</form>

</section>

 <!--book CRUD section ends -->

<!-- show books -->
  
<section class="show-books">

<div class="box-container">

<?php
$select_books = mysqli_query($conn, "SELECT *FROM `books`") or die('query failed');
if(mysqli_num_rows($select_books) > 0){
while($fetch_books = mysqli_fetch_assoc($select_books)){
?>

<div class="box">
    <img src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="">
    <div class="name"><?php echo $fetch_books['name']; ?></div>
    <div class="price">Rs<?php echo $fetch_books['price']; ?>/-</div>
    <div class="category"><?php echo $fetch_books['category']; ?></div>
    <div class="status"><?php echo $fetch_books['status']; ?></div>
    <a href="renter_books.php?update=<?php echo $fetch_books['id']; ?>" class="option-btn">update</a>
    <a href="renter_books.php?delete=<?php echo $fetch_books['id']; ?>" class="delete-btn" onclick="return confirm('delete this books?');">Delete</a>
</div>
<?php
}
}else{
    echo '<p class="empty">no book added yet!</p>';
}
?>
</div>
</section>

<section class="edit-book-form">

<?php
if(isset($_GET['update'])){
    $update_id =$_GET['update'];
    $update_query = mysqli_query($conn, "SELECT *FROM `books` WHERE id = '$update_id'") or die('query failed');
if(mysqli_num_rows($update_query) > 0){
while ($fetch_update = mysqli_fetch_assoc($update_query)){
?>

<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
<input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
 <img src="uploaded_img/<?php echo $fetch_update['image']; ?>"alt="">
<input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter book name">
 <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>" min="0" class="box" required palceholder="enter book price">
 <select name="update_category" class="box" requird>
    <option value="romance" <?php if($fetch_update['category'] == 'roamnce') echo 'selected'; ?>>Romance</option>
    <option value="sci-fi" <?php if($fetch_update['category'] == 'sci-fi') echo 'selected'; ?>>Sci-Fi</option>
    <option value="thrillar" <?php if($fetch_update['category'] == 'thriller') echo 'selected'; ?>>Thrillar</option>
    <option value="course book" <?php if($fetch_update['category'] == 'course book') echo 'selected'; ?>>Course Book</option>
 </select>
 <select name="update_status" class="box" required>
    <option value="available" <?php if($fetch_update['status'] == 'available') echo 'selected'; ?>>Available</option>
   <option value="not available" <?php if($fetch_update['status'] == 'not available') echo 'selected'; ?>>Not Available</option>
 </select>
 <input type="file" class="box" name="update_img" accept="image/jpg, image/jpeg,  img/png">
 <input type="submit" value="update"  name="update_book"  class="btn">
 <input type="reset" value="cancel" id="close-update" class="option-btn">
</form>
<?php
}
}
}else{
    echo '<script>document.querySelector(".edit-book-form").style.display = "none";</script>';
}
?>

</section>

<!-- custom admin js file link -->
<script src="js/admin_script.js"> </script>
</body>
</html>