<?php
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 8;
if (isset($_POST['submit'])) {
  $errors     = array();
  $first_name = $_POST['first_name'];
  $last_name  = $_POST['last_name'];
  $email      = $_POST['email'];
  $message    = $_POST['message'];

  if (empty($errors)) {
    $query = "INSERT INTO contact_messages (first_name, last_name, email, message, is_seen) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$message}', '0')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $nowtime = date("Y-m-d H:i:s");
      $msg = $first_name . "'s Message Sent Successfully. " . $nowtime;

      } else {
        $errors[] = "Message Sent Failed";
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
    <title><?php echo(htmlentities($setting["site_title"])); ?> - Terms & Policy</title>
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
?>
    <section class="book-menu">
        <div class="container">
            <?php if (empty($msg)) { ?>
            <form method="post" enctype="multipart/form-data" class="order">
                <fieldset>
                    <legend><h2>Contact Us</h2></legend>
                    <div class="contact-label">First Name</div>
                    <input type="text" name="first_name" placeholder="Vidunetha" class="input-responsive" required>

                    <div class="contact-label">Last Name</div>
                    <input type="text" name="last_name" placeholder="Smith" class="input-responsive" required>

                    <div class="contact-label">Email</div>
                    <input type="email" name="email" placeholder="chamishka@gmail.com" class="input-responsive" required>

                    <div class="contact-label">Message</div>
                    <textarea name="message" rows="4" placeholder="Text Here" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" class="btn btn-primary">
                </fieldset>

            </form>
        <?php } else { ?>
            <h2 class="text-center text-white"><?php echo $msg;?></h2>
        <?php } ?>

        </div>
    </section>

    <?php 
    //Footer Starts Here
    include('includes/sections/Footer.php');
    ?>
</body>
</html>