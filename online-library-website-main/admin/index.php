<?php 
session_start(); 
require_once('includes/connection.php'); 
require_once('includes/functions.php');
$email = '';
$msg = '';
  if (isset($_POST['login'])) {
    $errors = array();
    $email = $_POST['email'];
    // check if the username and password has been entered
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
      $errors[] = 'Enter a username';
    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
      $errors[] = 'Enter a password';
    }
    // check if there are any errors in the form
    if (empty($errors)) {
      // save username and password into variables
      $email    = mysqli_real_escape_string($connection, $_POST['email']);
      $password   = mysqli_real_escape_string($connection, $_POST['password']);
      $hashed_password = sha1($password);
      // prepare database query
      $query = "SELECT * FROM admins WHERE email = '{$email}' AND password = '{$hashed_password}' AND is_deleted=0 LIMIT 1";
      $result_set = mysqli_query($connection, $query);

      $query = "SELECT * FROM admins WHERE email = '{$email}' AND password = '{$hashed_password}' AND is_deleted=1 LIMIT 1";
      $result_deleted = mysqli_query($connection, $query);

      if (mysqli_num_rows($result_deleted) == 1) {
        $msg = '<br><p style="color:red;text-align: center;">This account has been Deleted</p>';
      }

      if ($result_set) {
        // query succesfful
        if (mysqli_num_rows($result_set) == 1) {
          // valid user found
          $user = mysqli_fetch_assoc($result_set);
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['first_name'] = $user['first_name'];
          // updating last login
          $query = "UPDATE admins SET last_login = NOW() ";
          $query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";
          $result_set = mysqli_query($connection, $query);
          // redirect to users.php
          header('Location: dashboard.php');
        } else {
          // user name and password invalid
          $errors[] = 'Invalid Username OR Password';
        }
      } else {
        $errors[] = 'Database query failed';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">   
</head>
<body>
    <div class="center">
        <br>
        <h1>Admin Login</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="email" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <?php 
              if (isset($errors) && !empty($errors)) {
                foreach ($errors as $error) {
                  echo '<p style="text-align: center; color :red;">  ' . $error . ' </p>';
                }
              }

              if(isset($_GET['log_out']))
              {
                $code=$_GET['log_out'];
                if($code == 1){
                  echo '<p style="color:red;text-align: center;">Please login to continue</p>';
                }
              }

              if(isset($_GET['log_out']))
              {
                $code=$_GET['log_out'];
                if($code == 2){
                  echo '<p style="color:red;text-align: center;">Your account has been Deleted</p>';
                }
              }

              if(isset($_GET['log_out']))
              {
                $code=$_GET['log_out'];
                if($code == 3){
                  echo '<p style="color:green;text-align: center;">You are successful log out</p>';
                }
              }

              if(isset($_GET['log_out']))
              {
                $code=$_GET['log_out'];
                if($code == 5){
                  echo '<p style="color:red;text-align: center;">You are NOT login</p>';
                }
              }

              if(isset($_GET['log_out']))
              {
                $code=$_GET['log_out'];
                if($code == 6){
                  echo '<p style="color:green;text-align: center;">Password Change successful</p>';
                }
              }

            ?>
            <input name="login" type="submit">

            <div class="signup_link">
                <!-- Not a memeber? , <a href="signup.html">Signup</a> -->
            </div>

        </form>
    </div>
    
</body>
</html>
<?php mysqli_close($connection); ?>