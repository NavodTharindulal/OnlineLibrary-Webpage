<?php 
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 5; 
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

if (isset($_POST['submit'])) {
  $errors     = array();
  $qty        = $_POST['qty'];
  $first_name = $_POST['first_name'];
  $last_name  = $_POST['last_name'];
  $contact    = $_POST['contact'];
  $email      = $_POST['email'];
  $address    = $_POST['address'];

  if (empty($errors)) {
    $query = "INSERT INTO book_order (qty, book_id, first_name, last_name, phone_number, email,  address, is_confirm) VALUES ('{$qty}', '{$book_id}', '{$first_name}', '{$last_name}', '{$contact}', '{$email}', '{$address}', '0')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $nowtime = date("Y-m-d H:i:s");
      $msg = $first_name . "'s Order Sent Successfully. " . $nowtime;

      } else {
        $errors[] = "Order Sent Failed";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Payment</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>

<body>

<?php
//BOOK SEARCH Section Starts Here
include('includes/sections/NavBar.php');
?>
    <!-- Navbar Section Ends Here -->

    <!-- BOOK SEARCH Section Starts Here -->
    <section class="book-search">
        <div class="container">
            <?php if (empty($msg)) { ?>
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form method="post" enctype="multipart/form-data" class="order">
                <fieldset>
                    <legend><h3>Selected Book</h3></legend>

                    <div class="book-menu-img">
                        <img src="images/books/<?php echo $book["book_image"];?>" alt="The Flame Bird" class="img-responsive img-curve">
                    </div>
    
                    <div class="book-menu-desc">
                        <h3><?php echo (htmlentities($book["book_name"]));?></h3>
                        <p class="food-price">LKR.<?php echo $book["book_price"];?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" max="10" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">First Name</div>
                    <input type="text" name="first_name" placeholder="Vidunetha" class="input-responsive" required>

                    <div class="order-label">Last Name</div>
                    <input type="text" name="last_name" placeholder="Smith" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="076xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="chamishka@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="4" placeholder="Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" class="btn btn-primary">

                </fieldset>


            </form>
        <?php } else { ?>
            <h2 class="text-center text-white"><?php echo $msg;?></h2>
        <?php } ?>
        </div>
    </section>

    <?php 
    //Footer
    include('includes/sections/Footer.php');
    ?>
</body>
</html>