<?php 
session_start();
$PageNumber = 9;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
//message-seen
if(isset($_GET['id']))
  {
    $message_id = $_GET['id'];
    $errors = array();

    $query = "UPDATE contact_messages SET is_seen = '1' WHERE id='{$message_id}'";
    $result = mysqli_query($connection, $query);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Message</title>
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
            <h2>Message</h2>
          <br>
          <?php 
          $query = "SELECT * FROM contact_messages WHERE id='{$message_id}'";
          $messsge_info = mysqli_query($connection, $query);
          $message = mysqli_fetch_assoc($messsge_info);

          if (empty($message)) {
            $errors[] = "Message Load Failed";
          }

          include('includes/info/AlertBox.php');
          ?>

          <?php if (!empty($message)) {?>

          <table>
            <tr>
              <td>User Name</td>
              <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
              <td><?php echo(htmlentities($message["first_name"]." ".$message["last_name"]));?></td>
            </tr>

            <tr>
              <td>User Email Address</td>
              <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
              <td><?php echo(htmlentities($message["email"]));?></td>
            </tr>

            <tr>
              <td>Message Sent Date & Time</td>
              <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
              <td><?php echo $message["time"];?></td>
            </tr>
          </table>

          <br>
          <textarea name="message" rows="10" class="form-control" disabled><?php echo(htmlentities($message["message"]));?></textarea>
          <hr>
          <a href="messages.php"><button type="button" class="btn btn-primary btn-sm">&nbsp;<i class="fa fa-arrow-left" aria-hidden="true"></i>BACK</button></a>

          <a href="messages.php?del=<?php echo $message["id"];?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" onclick="return confirm('Are you sure want to Delete this Order?');"><i class="fa fa-trash"></i>&nbsp;DELETE </button></a>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php 
include('includes/footer.php');
?>
</body>
</html>
<?php mysqli_close($connection); ?>