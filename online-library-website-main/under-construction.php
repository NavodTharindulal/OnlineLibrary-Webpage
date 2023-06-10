<?php
require_once('includes/connection.php');

$query = "SELECT * FROM settings";
$settings = mysqli_query($connection, $query);
$setting = mysqli_fetch_assoc($settings);

if ($setting["stats"]==0) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Under Construction</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <center>
                <img src="images/under_construction_PNG38.png" width="350">
            </center>
            <h2 class="text-center" style="font-size: 30px;">Under Construction, Please check back later</a></h2>
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