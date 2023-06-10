<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 9;

if(isset($_GET['search']))
  {
    $search = $_GET['search'];
    if (empty($search)) {
        header('Location: 404.php');
    } else {
        $query = "SELECT * FROM book_list WHERE (book_name LIKE '%{$search}%' OR book_category LIKE '%{$search}%') AND is_deleted = '0'";
        $search_info = mysqli_query($connection, $query);
        $search_result = mysqli_fetch_assoc($search_info);
        if (empty($search_result)) {
            $error = "No Results Found";
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
            <center>
            <?php if (!empty($error)) {?>
            <center><img src="images/search-result-not-found.webp" width="250"></center>
            <h2 class="text-center" style="font-size: 30px;"><?php echo $error;?></a></h2>
            <?php } else { ?>
                <h1 class="text-left" style="background-color:tomato;">Result For "<?php echo $search; ?>"</h1>
            <?php
            $query = "SELECT * from book_list WHERE (book_name LIKE '%{$search}%' OR book_category LIKE '%{$search}%') AND is_deleted = '0' order by time DESC";
            $books = mysqli_query($connection, $query);
            if ($books) {
            while ($book = mysqli_fetch_assoc($books)) {?>
            <a href="order.php?book=<?php echo $book["id"]; ?>" style="padding: 6px;">
                <img src="images/books/<?php echo $book["book_image"]; ?>" width="200">
            </a>
            <?php } } } ?>
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