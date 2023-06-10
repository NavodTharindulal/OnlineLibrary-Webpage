<?php 
session_start();
$PageNumber = 10;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
  if (isset($_POST['submit'])) {

    $errors     = array();
    $first_name = '';
    $last_name  = '';
    $email      = '';
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    // checking required fields
    $req_fields = array('first_name', 'last_name', 'email');

    foreach ($req_fields as $field) {
      if (empty(trim($_POST[$field]))) {
        $errors[] = $field . ' is required';
      }
    }
    // checking max length
    $max_len_fields = array('first_name' => 50, 'last_name' =>50, 'email' => 40);

    foreach ($max_len_fields as $field => $max_len) {
      if (strlen(trim($_POST[$field])) > $max_len) {
        $errors[] = $field . ' must be less than ' . $max_len . ' characters';
      }
    }

    if (empty($errors)) {
      // no errors found... adding new record
      $query = "UPDATE admins SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}' WHERE id='1000'";
      $result = mysqli_query($connection, $query);
      if ($result) {
        // query successful... redirecting to users page
        $msg=" Edited Successfully";
      } else {
        $errors[] = 'Failed Edit..!';
      }
    }
  }


  if (isset($_POST['changepas'])) {

    $errors      = array();
    $cpassword   = $_POST['cpassword'];
    $password    = $_POST['password'];
    $conpassword = $_POST['conpassword'];

    $req_fields = array('cpassword', 'password', 'conpassword');
      foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
          $errors[] = $field . ' is required';
        }
      }
      // checking max length
      $max_len_fields = array( 'cpassword' => 40, 'password' => 40, 'conpassword' => 40);

      foreach ($max_len_fields as $field => $max_len) {
        if (strlen(trim($_POST[$field])) > $max_len) {
          $errors[] = $field . ' must be less than ' . $max_len . ' characters';
        }
      }

    if ($password == $conpassword) {
      $query = "SELECT * FROM admins WHERE id='1000'";
      $passwords = mysqli_query($connection, $query);
      $ccpassword = mysqli_fetch_assoc($passwords);

      if($ccpassword["password"] == sha1($cpassword)){

      }else{
        $errors[] = 'Current password is incorrect';
      }
    } else {
      $errors[] = 'The password confirmation does not match';
    }

    if (empty($errors)) {
      // no errors found... adding new record
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      $hashed_password = sha1($password);
      $query = "UPDATE admins SET password = '{$hashed_password}' WHERE id='1000'";
      $result = mysqli_query($connection, $query);
      if ($result) {

        header('Location: logout.php?log_out_code=6');
      } else {
        $errors[] = 'Failed to update the password.';
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Admins</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
  <style>
    .row.content {height: 700px;}
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
      text-align: center;
    }
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    #myInput {
      background-image: url('https://www.w3schools.com/css/searchicon.png');
      background-position: 10px 10px;
      background-repeat: no-repeat;
      width: 100%;
      font-size: 14px;
      padding: 10px 18px 10px 38px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }
    .modal-body {
    padding: 4%;
    }
  </style>
</head>
<div class="container-fluid">
  <div class="row content">
  <?php include('includes/left-bar.php');?>
      <div class="col-sm-9">
        <div class="panel panel-default">
          <div class="panel-heading">
          <?php include('includes/info/AlertBox.php');?>
          </div>
          <div class="panel-body">
          <table id="myTable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Admin Name</th>
              <th>Admin Email</th>
              <th>Last Login Date & Time</th>
              <th>Action</th>
            </tr>
            </thead>
              <tbody>
              <?php 
                $query = "SELECT * from admins WHERE is_deleted = '0' order by last_login DESC";
                $admins = mysqli_query($connection, $query);
                $cnt=1;
                if ($admins) {
                while ($admin = mysqli_fetch_assoc($admins)) {?>
              <tr>
                <td><?php echo($cnt);?></td>
                <td><?php if ($admin["id"] == $_SESSION['user_id']) { ?> <button class="btn btn-info btn-sm" style="pointer-events: none;"><i id="UserUser" class="fa fa-user" aria-hidden="true"></i> Current User</button><?php } ?><?php echo htmlentities($admin["first_name"]. " " . $admin["last_name"]);?></td>
                <td><?php echo htmlentities($admin["email"]);?></td>
                <td><?php echo htmlentities($admin["last_login"]);?></td>
                <td>
                <center>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#admin_profile" data-whatever="@mdo"><i class="fa fa-pencil"></i>&nbsp;EDIT PROFILE</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#admin_password_chnage" data-whatever="@mdo"><i class="fa fa-pencil"></i>&nbsp;CHANGE PASSWORD</button>
                </center>
                </td>
              </tr>
            <?php $cnt=$cnt+1; }} if ($cnt==1) {echo "<td colspan='5'><center>No Orders yet</center></td>";}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $query = "SELECT * FROM admins WHERE is_deleted = '0' AND id='1000'";
  $admin_profile = mysqli_query($connection, $query);
  $profile = mysqli_fetch_assoc($admin_profile);
?>
<div class="modal fade" id="admin_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Change Admin Profile:</h5>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $profile["first_name"];?>" placeholder="Enter First Name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php echo $profile["last_name"];?>" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email address:</label>
            <input type="text" class="form-control" name="email" value="<?php echo $profile["email"];?>" placeholder="Enter Email address" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-shipping-fast"></i> &nbsp;Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="admin_password_chnage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Change Admin Password</h5>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Current Password:</label>
            <input type="password" class="form-control" name="cpassword" placeholder="Enter Current">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">New Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password">
            <input type="checkbox" name="showpassword" id="showpassword" style="width:20px;height:20px">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Confirm password:</label>
            <input type="password" class="form-control" name="conpassword" placeholder="Enter Confirm">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="changepas"><i class="fas fa-shipping-fast"></i> &nbsp;Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
include('includes/footer.php');
?>
<script>
    $(document).ready(function(){
      $('#showpassword').click(function(){
        if ( $('#showpassword').is(':checked') ) {
          $('#password').attr('type','text');
        } else {
          $('#password').attr('type','password');
        }
      });
    });
</script>
</body>
</html>
<?php mysqli_close($connection); ?>