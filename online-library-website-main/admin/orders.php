<?php 
session_start();
$PageNumber = 8;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
//book-order-delete
if(isset($_GET['del']))
  {
    $del_id = $_GET['del'];
    $errors = array();
    $query = "DELETE FROM book_order WHERE id='{$del_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Delete Successfully. ";
    } else {
      $errors[] = "Delete Failed";
    }
  }
//book-order-update
if (isset($_POST['update'])) {
  
  $errors     = array();
  $order_book = $_POST['order_book'];
  if (empty($errors)) {
    $nowtime = date("Y-m-d H:i:s");
    $query = "UPDATE book_order SET is_confirm = '1' WHERE id='{$order_book}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Confirm Successfully. " . $nowtime;
      } else {
        $errors[] = "Confirm Failed";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Orders</title>
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
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Order names.." title="Type in a name"></div>
          <div class="panel-body">
          <table id="myTable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>User Name</th>
              <th>User Number</th>
              <th>Order Date & Time</th>
              <th>Action</th>
            </tr>
            </thead>
              <tbody>
              <?php 
                $query = "SELECT * from book_order order by time DESC";
                $books_order = mysqli_query($connection, $query);
                $cnt=1;
                if ($books_order) {
                while ($book_order = mysqli_fetch_assoc($books_order)) {?>
              <tr>
                <td><?php echo($cnt);?></td>
                <td><?php echo htmlentities($book_order["first_name"]. " " . $book_order["last_name"]);?></td>
                <td><?php echo htmlentities($book_order["phone_number"]);?></td>
                <td><?php echo htmlentities($book_order["time"]);?></td>
                <td>
                <center>
                  <?php 
                    if ($book_order["is_confirm"]==0) {?>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $book_order["id"];?>" data-whatever="@mdo"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;CONFIRM ORDER</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-success btn-sm" disabled><i class="fas fa-shipping-fast"></i>&nbsp;DELIVERY IS IN PROGRESS..</button>
                    <?php } ?>
                    <a href="orders.php?del=<?php echo $book_order["id"];?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" onclick="return confirm('Are you sure want to Delete this Order?');"><i class="fa fa-trash"></i>&nbsp;DELETE ORDER</button></a>
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
$query = "SELECT * from book_order order by time DESC";
$books_order = mysqli_query($connection, $query);
if ($books_order) {
while ($book_order = mysqli_fetch_assoc($books_order)) {?>
<div class="modal fade" id="<?php echo $book_order["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <?php
        $query = "SELECT * FROM book_list WHERE id='{$book_order["book_id"]}'";
        $order_book_info = mysqli_query($connection, $query);
        $order_book = mysqli_fetch_assoc($order_book_info);
      ?>
        <img src="../images/books/<?php echo $order_book["book_image"]?>" width="150">
        <h3 class="modal-title" id="exampleModalLongTitle"><?php echo $order_book["book_name"]; ?></h3>
        <h3 class="modal-title" id="exampleModalLongTitle">LKR.<?php echo $order_book["book_price"]; ?></h3>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td>User Name</td>
            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo htmlentities($book_order["first_name"]. " " . $book_order["last_name"]);?></td>
          </tr>
          <tr>
            <td>Phone Number</td>
            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo htmlentities($book_order["phone_number"]);?></td>
          </tr>
          <tr>
            <td>User Email Address</td>
            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo htmlentities($book_order["email"]);?></td>
          </tr>
          <tr>
            <td>User Address</td>
            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo htmlentities($book_order["address"]);?></td>
          </tr>
          <tr>
            <td>Quantity</td>
            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo htmlentities($book_order["qty"]);?></td>
          </tr>
          <tr>
            <td><b>Total Price</b></td>
            <td>&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;</td>
            <td><b>LKR.<?php echo (htmlentities($order_book["book_price"] * $book_order["qty"]));?></b></td>
          </tr>
        </table>
        <br>
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-footer">
            <input type="hidden" value="<?php echo $book_order["id"];?>" name="order_book">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update"><i class="fas fa-shipping-fast"></i> &nbsp;Confirm Order</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
  }
}
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