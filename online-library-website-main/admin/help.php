<?php 
session_start();
$PageNumber = 11;
require_once('includes/connection.php');
require_once('includes/check-sessions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard - Help</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <h2>Help</h2>
          <br>
          <h4 class="text-left text-white">“Vidunetha” is a bookshop that situated in Rathnapura area that currently doing their day
          today business in a normal offline way. As a team we selected this shop to develop our online
          book store website. First, we identified the requirements of this book shop and discussed with
          the manger about the problems and the solutions and benefitsthat our team can supply them
          through an online bookshop website.<br><br>

          After gathering the requirements our team decided to develop a unique, attractive and simple
          website that customers can use freely and easily. The 1
          st page we clan to develop in our
          webpage is the homepage. This homepage is made with lots of eye-catching book and
          stationery product presentations and the homepage includes the newly realized books,
          newspapers and other stationeries. This may help the customers top get the idea about the
          new products that they sell in their shop, if the customer wants to purchase of see further
          details of the products in the website, he/she has to register to the system by completing a
          register form, then each customer will assign a certain username and password to login to
          this online book store.<br><br>

          After login customers can browse the books by their name in the search bar, customer can
          also view a short description including name, author, and the price for each product they search by clicking on the image of the book. After customers choosing their product, they can
          purchase it by using 100% secure payment method by adding their credit or debit card details
          in the payment form in the webpage. Customers can also contact with the social media
          platforms of the shop by clicking on the buttons that displayed in the homepage. Customers
          can also view the range of books and items of the shop categorized in a proper way.
          Customers can also get an idea about the shop by referring abut us page. Customers can also
          contact the shop using the contacts in contact us page too. Customers also can read the terms
          and condition that seller provides for them by clicking on the Terms and Policy. As a team we
          think that this overall web page will increase the range of customers island wide & this will
          increase the monthly profit by a certain margin.</h4>
        </div>
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