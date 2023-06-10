<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 2; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Categorys</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>

<?php
//BOOK SEARCH Section Starts Here
include('includes/sections/SearchBox.php');
//Book SEARCH Section Ends Here
echo "<body>";
include('includes/sections/NavBar.php');
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Books</h2>

            <h1 class="text-left" style="background-color:tomato;">Last Released</h1>

            <center>
                <?php 
            $query = "SELECT * from book_list WHERE is_deleted = '0' order by time DESC Limit 10";
            $books = mysqli_query($connection, $query);
            if ($books) {
            while ($book = mysqli_fetch_assoc($books)) {?>

                <a href="order.php?book=<?php echo $book["id"]; ?>" style="padding: 6px;">
                <img src="images/books/<?php echo $book["book_image"]; ?>" width="200">
            </a>

            <?php 
                } 
            }
            $query = "SELECT * from book_category WHERE is_deleted = '0' order by time DESC";
            $books_category = mysqli_query($connection, $query);
            if ($books_category) {
            while ($book_category = mysqli_fetch_assoc($books_category)) {?>
            
            <h1 class="text-left" style="background-color:tomato;"><?php echo $book_category["category_name"];?></h1>

            <?php 
            $query = "SELECT * from book_list WHERE is_deleted = '0' AND book_category = '{$book_category["id"]}' order by time DESC";
            $books = mysqli_query($connection, $query);
            if ($books) {
            while ($book = mysqli_fetch_assoc($books)) {?>
            <a href="order.php?book=<?php echo $book["id"]; ?>" style="padding: 6px;">
                <img src="images/books/<?php echo $book["book_image"]; ?>" width="200">
            </a><?php } } } } ?>
            </center>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php
//Footer Starts Here
include('includes/sections/Footer.php');
?>
</body>
</html>
<?php mysqli_close($connection); ?>