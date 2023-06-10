<?php 
session_start();
require_once('includes/connection.php'); 
require_once('includes/check-sessions.php');
$PageNumber = 1;
//upload-book

if (isset($_POST['submit'])) {
  $errors        = array();
  $book_image    = '';
  $book_image    = $_FILES["book_image"]["name"];
  $book_name     = $_POST['book_name'];
  $book_category = $_POST['book_category'];
  $description   = $_POST['description'];
  $book_price    = $_POST['book_price'];

  $req_fields = array('book_name','book_category', 'description', 'book_price');

  foreach ($req_fields as $field) {
    if (empty(trim($_POST[$field]))) {
      $errors[] = $field . ' is required';
    }
  }

  $max_len_fields = array('book_name' => 100, 'description' => 1600);

  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len ) {
      $errors[] = $field . ' must be less than ' . $max_len . ' charactaers';
    }
  }

  if (!empty($book_image)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["book_image"]["name"], PATHINFO_EXTENSION ));
    $basename     = $filename . "." . $extension;
    $source       = $_FILES["book_image"]["tmp_name"];
    $destination  = "../images/books/{$basename}";
    //valied files
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    //check valied and move file
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $errors[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $errors[] = 'book image is required';
  }

  if (empty($errors)) {
    $query = "INSERT INTO book_list (book_image, book_name, book_category, description, book_price, is_deleted) VALUES ('{$basename}', '{$book_name}', '{$book_category}', '{$description}', '{$book_price}', '0')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $nowtime = date("Y-m-d H:i:s");
      $msg = $book_name . " is Create Successfully. " . $nowtime;
      $book_name = '';
      } else {
        $errors[] = "Upload Failed";
    }
  }
}
//delete-book
if(isset($_GET['del']))
  {
    $del_id = $_GET['del'];
    $query = "UPDATE book_list SET is_deleted = '1' WHERE id='{$del_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = "Delete Successfully. ";
    } else {
      $errors[] = "Delete Failed";
    }
  }
//book-update
if (isset($_POST['update'])) {
  $errors        = array();
  $update_book_image    = '';
  $update_book_image    = $_FILES["book_image"]["name"];
  $update_book_name     = $_POST['book_name'];
  $update_book_category = $_POST['book_category'];
  $update_description   = $_POST['description'];
  $update_book_price    = $_POST['book_price'];
  $update_book_id       = $_POST['book_id'];

  $req_fields = array('book_name','book_category', 'description', 'book_price');

  foreach ($req_fields as $field) {
    if (empty(trim($_POST[$field]))) {
      $errors[] = $field . ' is required';
    }
  }

  $max_len_fields = array('book_name' => 100, 'description' => 1600);

  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len ) {
      $errors[] = $field . ' must be less than ' . $max_len . ' charactaers';
    }
  }

  if (!empty($update_book_image)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["book_image"]["name"], PATHINFO_EXTENSION ));
    $basename     = $filename . "." . $extension;
    $source       = $_FILES["book_image"]["tmp_name"];
    $destination  = "../images/books/{$basename}";
    //valied files
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    //check valied and move file
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $errors[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $basename = $_POST['book_image'];
  }

  if (empty($errors)) {
    $nowtime = date("Y-m-d H:i:s");
    $query = "UPDATE book_list SET book_image = '{$basename}', book_name = '{$update_book_name}', book_category = '{$update_book_category}', description = '{$update_description}', book_price = '{$update_book_price}', time = '{$nowtime}' WHERE id='{$update_book_id}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      $msg = $update_book_name . " is Update Successfully. " . $nowtime;
      } else {
        $errors[] = "Update Failed";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Home Page</title>
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
<body>

<div class="container-fluid">

  <div class="row content">

  <?php include('includes/left-bar.php');?>
  <div class="col-sm-9">
    <style>
.welcome-box {
  border: 1px solid gray;
  padding: 8px;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  color: #4CAF50;
}

</style>


<div class="welcome-box">
  <h1>Vidunetha Admin Dashboard</h1>
</div><br>
	<div class="panel panel-default">
	  <div class="panel-heading">

      <?php include('includes/info/AlertBox.php');?>

      <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-upload" aria-hidden="true"></i> UPLOAD A NEW BOOK</button>
      <br>
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Book names.." title="Type in a name"></div>
	 	<div class="panel-body">
	 		<table id="myTable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	 			<thead>
	 				<tr>
            <th>#</th>
            <th>Name</th>
            <th>Book Name</th>
            <th>Book Category</th>
            <th>Book Price</th>
            <th>Upload Date & Time</th>
            <th>Action</th>
	 				</tr>
	 			</thead>
	 			<tbody>
        <?php 
            $query = "SELECT * from book_list WHERE is_deleted = '0' order by time DESC";
            $books = mysqli_query($connection, $query);
            $cnt=1;
            if ($books) {
            while ($book = mysqli_fetch_assoc($books)) {?>
	 				<tr>
            <td><?php echo($cnt);?></td>
            <td><img src="../images/books/<?php echo($book["book_image"]);?>" width="100"></td>
	 					<td><?php echo htmlentities($book["book_name"]);?></td>
            <?php
            
            $query = "SELECT id, category_name, is_deleted FROM book_category WHERE id='{$book["book_category"]}'";
            $book_categorys = mysqli_query($connection, $query);
            $get_book_category = mysqli_fetch_assoc($book_categorys);

            if ($get_book_category["is_deleted"]==1) { ?>
              <td>Unknown Category</td>
            <?php  } else { ?>
            <td><?php echo htmlentities($get_book_category["category_name"]);?></td>
            <?php } ?>

            <td>LKR.<?php echo htmlentities($book["book_price"]);?></td>
	 					<td><?php echo htmlentities($book["time"]);?></td>
            <td>
              <center>
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $book["id"];?>" data-whatever="@mdo"><i class="fa fa-pencil"></i>&nbsp;EDIT</button>

               <a href="dashboard.php?del=<?php echo $book["id"];?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" onclick="return confirm('Are you sure want to Delete this book?');"><i class="fa fa-trash"></i>&nbsp;DELETE</button></a>
              </center>
            </td>
	 				</tr>
        <?php $cnt=$cnt+1; }} if ($cnt==1) {echo "<td colspan='7'><center>No Books yet</center></td>";}?>
	 			</tbody>
	 		</table>
	 	   </div>
	   </div>
    </div>
  </div>
</div>
<!-- Modal Area -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label for="recipient-name" class="col-form-label">Book Image:</label>
            <input type="file" name="book_image" class="form-control">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Name:</label>
            <input type="text" class="form-control" name="book_name" placeholder="Enter Book Name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Book Category</label>
            <select class="form-control" name="book_category">
              <?php
              $query = "SELECT id, category_name from book_category WHERE is_deleted = '0' order by time DESC";
              $books = mysqli_query($connection, $query);
              if ($books) {
              while ($book = mysqli_fetch_assoc($books)) { ?>
              <option value="<?php echo $book["id"];?>"><?php echo $book["category_name"]; ?></option>
              <?php }} ?>

            </select>
          </div>
          <p><a href="add-book-category.php" target=”_blank”>+ Add a New Category</a></p>
          <div class="form-group">
            <label for="message-text" class="col-form-label">description:</label>
            <textarea class="form-control" name="description" rows="5" placeholder="Enter description"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Price (LKR):</label>
            <input type="number" class="form-control" name="book_price" placeholder="Enter Book Price (LKR 15)">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
$query = "SELECT id, book_image, book_name, book_category, description, book_price  from book_list WHERE is_deleted = '0'";
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
        <img src="../images/books/<?php echo $book["book_image"];?>" width="150">
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Image:</label>
            <input type="file" name="book_image" class="form-control">
            <input type="hidden" name="book_image" value="<?php echo $book["book_image"];?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Name:</label>
            <input type="text" class="form-control" name="book_name" value="<?php echo $book["book_name"];?>" placeholder="Enter Book Name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Book Category</label>
            <select class="form-control" name="book_category">
              <?php
                $query = "SELECT id, category_name, is_deleted FROM book_category WHERE id='{$book["book_category"]}'";
                $book_categorys = mysqli_query($connection, $query);
                $get_book_category = mysqli_fetch_assoc($book_categorys);
              ?>
              <option value="<?php echo $get_book_category["id"]?>">Selected <?php echo $get_book_category["category_name"];?></option>
              <?php
              $query = "SELECT id, category_name from book_category WHERE is_deleted = '0' order by time DESC";
              $books_c = mysqli_query($connection, $query);
              if ($books_c) {
              while ($bookc = mysqli_fetch_assoc($books_c)) { ?>

              <option value="<?php echo $bookc["id"];?>"><?php echo $bookc["category_name"]; ?></option>

              <?php }} ?>

            </select>
          </div>
          <p><a href="add-book-category.php" target=”_blank”>+ Add a New Category</a></p>
          <div class="form-group">
            <label for="message-text" class="col-form-label">description:</label>
            <textarea class="form-control" rows="5" name="description" placeholder="Enter description"><?php echo $book["description"];?></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Price (LKR):</label>
            <input type="number" class="form-control" name="book_price" value="<?php echo $book["book_price"];?>" placeholder="Enter Book Price (LKR 15)">
          </div>
          <input type="hidden" name="book_id" value="<?php echo $book["id"];?>">

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
    td = tr[i].getElementsByTagName("td")[2];
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