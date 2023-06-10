<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 3;
if(isset($_GET['book']))
  {
    $book_id = $_GET['book'];
    if (empty($book_id)) {
        header('Location: 404.php');
    } else {
        $query = "SELECT * FROM book_list WHERE id='{$book_id}'";
        $book_info = mysqli_query($connection, $query);
        $book = mysqli_fetch_assoc($book_info);
        if (empty($book)) {
            header('Location: 404.php');
        }
    }
} else {
    header('Location: 404.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Bookshop - <?php echo $book["book_name"];?></title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>

<body>
    <?php
    //Navbar Section Starts Here
    include('includes/sections/NavBar.php');
    ?>
    <!-- BOOK SEARCH Section Starts Here -->
    <section class="book-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
                <fieldset>
                    <legend><h3 class="text-white">Selected Book</h3></legend>

                    <div class="book-menu-img">
                        <img src="images/books/<?php echo $book["book_image"];?>" alt="The Flame Bird" class="img-responsive img-curve">
                    </div>
                    <div class="book-menu-desc">
                        <h3 class="text-white"><?php echo(htmlentities($book["book_name"]));?></h3>
                        <br><hr>
                        <p class="food-price text-white"><?php echo(htmlentities($book["description"]));?></p>
                        <a href="payment.php?book=<?php echo $book["id"];?>"><button class="btn btn-primary">LKR.<?php echo(htmlentities($book["book_price"]));?> Buy Now</button> </a>
                    </div>
                </fieldset>
        </div>
    </section>
    <!-- BOOK SEARCH Section Ends Here -->
    <?php include('includes/sections/Footer.php');?>
</body>
</html>
<?php mysqli_close($connection); ?>