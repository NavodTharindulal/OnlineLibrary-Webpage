<?php 
session_start();
$PageNumber = 7;
require_once('includes/connection.php'); 
require_once('includes/check-sessions.php');
//seeting-update
if (isset($_POST['update'])) {
  
  $site_title = $_POST['site_title'];
  $stats = $_POST['stats'];
  $fb = $_POST['facebook'];
  $ins = $_POST['instagram'];
  $twi = $_POST['twitter'];
  $yt = $_POST['youtube'];

  $req_fields = array('site_title','facebook', 'instagram', 'twitter', 'youtube');

  foreach ($req_fields as $field) {
    if (empty(trim($_POST[$field]))) {
      $errors[] = $field . ' is required';
    }
  }

  $max_len_fields = array ('site_title' => 25, 'facebook' => 100, 'instagram' => 100, 'twitter' => 100, 'youtube' => 100);

  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len ) {
      $errors[] = $field . ' must be less than ' . $maax_len . ' charactaers';
    }
  }


  if (empty($errors)) {
    $nowtime = date("Y-m-d H:i:s");
    $query = "UPDATE settings SET site_title = '{$site_title}', stats = '{$stats}', fb = '{$fb}', fb = '{$fb}', ins = '{$ins}', twi = '{$twi}', yt = '{$yt}' WHERE id='1'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Setting is Update Successfully. " . $nowtime;
      } else {
        $errors[] = "Update Failed";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Setting</title>
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
        <?php
        $query = "SELECT * FROM settings";
        $settings = mysqli_query($connection, $query);
        $setting = mysqli_fetch_assoc($settings);
        ?>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Answer_1">Site Title</label>

            <input type="text" class="form-control" name="site_title" placeholder="Set Title" value="<?php echo $setting["site_title"];?>">
          </div>

          <div class="form-group">
            <input type="radio" name="stats" value="0" id="site1" <?php if ($setting["stats"] == 0) { ?>checked="checked"<?php } ?>>
            <label for="site1">Site ON</label><span><br>
            <input type="radio" name="stats" id="site2" value="1" <?php if ($setting["stats"] == 1) { ?>checked="checked"<?php } ?>>
            <label for="site2">Site OFF</label><span>
          </div>
          <div class="form-group">
            <label for="Answer_1">Facebook Link</label>
            
            <input type="text" class="form-control" name="facebook" placeholder="Set Link" value="<?php echo $setting["fb"];?>">
          </div>

          <div class="form-group">
            <label for="Answer_3">Instagram Link</label>
            <input type="text" class="form-control" name="instagram" placeholder="Set Link" value="<?php echo $setting["ins"];?>">
          </div>

          <div class="form-group">
            <label for="Answer_4">Twitter link</label>
            <input type="text" class="form-control" name="twitter" placeholder="Set Link" value="<?php echo $setting["twi"];?>">
          </div>

          <div class="form-group">
            <label for="Answer_4">Youtube Link</label>
            <input type="text" class="form-control" name="youtube" placeholder="Set Link" value="<?php echo $setting["yt"];?>">
          </div>
          <button type="submit" name="update" class="btn btn-primary">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php');?>
</body>
</html>
<?php mysqli_close($connection); ?>