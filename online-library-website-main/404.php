<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 4; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - 404</title>
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
            <h2 class="text-center" style="font-size: 100px;">404</h2>
            <h2 class="text-center" style="font-size: 30px;">Back to <a href="index.php">home page</a></h2>
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