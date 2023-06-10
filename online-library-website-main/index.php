<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 1; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Official Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
<?php 
//BOOK SEARCH Section Starts Here
include('includes/sections/SearchBox.php');
//Navbar Section Starts Here
include('includes/sections/NavBar.php');
//BOOK MENU Section Starts Here
include('includes/sections/BookMenu.php');
//SlideShow Starts Here
include('includes/sections/SlideShow.php');
//Categories Section Starts Here
include('includes/sections/LastUpdateBooks.php');
//Our Service Section Starts Here
include('includes/sections/OurService.php');
//Footer Starts Here
include('includes/sections/Footer.php');
echo "</body>";
echo "</html>";
mysqli_close($connection); 
?>
