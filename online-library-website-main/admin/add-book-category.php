<?php 
session_start();
$PageNumber = 2;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
$category        = '';
$update_category = '';
//create-a-book-category
if (isset($_POST['submit'])) {
  $category   = $_POST['category'];
  $req_fields = array('category');

  foreach ($req_fields as $field) {
    if (empty(trim($_POST[$field]))) {
      $errors[] = $field . ' is required';
    }
  }
  $max_len_fields = array('category' => 50);

  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len ) {
      $errors[] = $field . ' must be less than ' . $maax_len . ' charactaers';
    }
  }
  if (empty($errors)) {
    $query = "SELECT * FROM book_category WHERE category_name = '{$category}' && is_deleted = '0' LIMIT 1";
    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
        $errors[] = 'Catogory Name is already exists';
      }
    }
  }
  if (empty($errors)) {
    $query = "INSERT INTO book_category (category_name, is_deleted) VALUES ('{$category}', '0')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $nowtime = date("Y-m-d H:i:s");
      $msg = $category . " is Create Successfully. " . $nowtime;
      $category = '';
      } else {
        $errors[] = "Create Failed";
    }
  }
}
//book-category-delete
if(isset($_GET['del']))
  {
    $del_id = $_GET['del'];
    $query = "UPDATE book_category SET is_deleted = '1' WHERE id='{$del_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Delete Successfully. ";
    } else {
      $errors[] = "Delete Failed";
    }
  }
//book-category-update
if (isset($_POST['update'])) {
  
  $update_category = $_POST['category'];
  $category_id = $_POST['category_id'];

  $req_fields = array('category');

  foreach ($req_fields as $field) {
    if (empty(trim($_POST[$field]))) {
      $errors[] = $field . ' is required';
    }
  }

  $max_len_fields = array('category' => 50);

  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len ) {
      $errors[] = $field . ' must be less than ' . $maax_len . ' charactaers';
    }
  }

  if (empty($errors)) {
    $query = "SELECT * FROM book_category WHERE category_name = '{$update_category}' && is_deleted = '0' LIMIT 1";
    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
        $errors[] = 'Catogory Name is already exists';
      }
    }
  }

  if (empty($errors)) {
    $nowtime = date("Y-m-d H:i:s");
    $query = "UPDATE book_category SET category_name = '{$update_category}', time = '{$nowtime}' WHERE id='{$category_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = $update_category . " is Update Successfully. " . $nowtime;
      } else {
        $errors[] = "Update Failed";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Category</title>
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
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Category Name:</label>
              <input type="text" class="form-control" value="<?php echo $category; ?>" name="category" placeholder="Set a Category Name">
            </div>
            <div class="form-group">
              <a href="dashboard.php"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button></a>
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
          <hr>
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Category names.." title="Type in a name"></div>
          <div class="panel-body">
          <table id="myTable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
            </thead>
              <tbody>
              <?php 
                $query = "SELECT * from book_category WHERE is_deleted = '0' order by time DESC";
                $books = mysqli_query($connection, $query);
                $cnt=1;
                if ($books) {
                while ($book = mysqli_fetch_assoc($books)) {?>
              <tr>
                <td><?php echo($cnt);?></td>
                <td><?php echo htmlentities($book["category_name"]);?></td>
                <td><?php echo htmlentities($book["time"]);?></td>
                <td>
                  <center>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $book["id"];?>" data-whatever="@mdo"><i class="fa fa-pencil"></i>&nbsp;EDIT</button>
                   <a href="add-book-category.php?del=<?php echo $book["id"];?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" onclick="return confirm('Are you sure want to Delete this category?');"><i class="fa fa-trash"></i>&nbsp;DELETE</button></a>
                  </center>
                </td>
              </tr>
            <?php $cnt=$cnt+1; }} if ($cnt==1) {echo "<td colspan='4'><center>No Categorys yet</center></td>";}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
$query = "SELECT id, category_name from book_category WHERE is_deleted = '0' order by time DESC";
$books = mysqli_query($connection, $query);
if ($books) {
while ($book = mysqli_fetch_assoc($books)) {?>
<div class="modal fade" id="<?php echo $book["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Edit Name:</label>
            <input type="text" class="form-control" name="category" value="<?php echo $book["category_name"];?>" placeholder="Set a new Name">
            <input type="hidden" value="<?php echo $book["id"];?>" name="category_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
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