<?php 
session_start();
$PageNumber = 9;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
//message-delete
if(isset($_GET['del']))
  {
    $del_id = $_GET['del'];
    $errors = array();
    $query = "DELETE FROM contact_messages WHERE id='{$del_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Delete Successfully. ";
    } else {
      $errors[] = "Delete Failed";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Messages</title>
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
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Message names.." title="Type in a name"></div>
          <div class="panel-body">
          <table id="myTable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>User Name</th>
              <th>Message</th>
              <th>Date & Time</th>
              <th>Action</th>
            </tr>
            </thead>
              <tbody>
              <?php 
                $query = "SELECT * from contact_messages order by time DESC";
                $messages = mysqli_query($connection, $query);
                $cnt=1;
                if ($messages) {
                while ($message = mysqli_fetch_assoc($messages)) {?>
              <tr>
                <td><?php echo($cnt);?></td>
                <td><?php echo htmlentities($message["first_name"]. " " . $message["last_name"]);?></td>
                <td><?php if ($message["is_seen"]==0) {?><button type="button" class="btn btn-danger btn-sm disabled">New</button><?php } else { ?><button type="button" class="btn btn-success btn-sm disabled"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Seen</button><?php } ?>&nbsp;<?php echo htmlentities(mb_strimwidth ($message["message"], 0, 50,"..."));?></td>
                <td><?php echo htmlentities($message["time"]);?></td>
                <td>
                <center>
                    <a href="message-info.php?id=<?php echo $message["id"];?>">
                      <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View More</button>
                    </a>
                    <a href="messages.php?del=<?php echo $message["id"];?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" onclick="return confirm('Are you sure want to Delete this Order?');"><i class="fa fa-trash"></i>&nbsp;DELETE </button></a>
                  </center>
                </td>
              </tr>
            <?php $cnt=$cnt+1; }} if ($cnt==1) {echo "<td colspan='5'><center>No Messages yet</center></td>";}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
include('includes/footer.php');
?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>
<?php mysqli_close($connection); ?>