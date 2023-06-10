<?php
require_once('includes/connection.php');
require_once('includes/query.php');
$PageNumber = 6;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlentities($setting["site_title"])); ?> - About Us</title>
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
            <h2 class="text-center">About Us.</h2>
    <h4 class="text-left text-white">“Vidunetha” is a bookshop that situated in Yakkalamulla area that currently doing their day
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
        increase the monthly profit by a certain margin.<br><br>
        <!-- TEAM INFO -->
        <table>
            <tr>
                <td><b>DeV BY</b></td>
                <td>:-</td>
                <td>alexlanka.com - CHUKzi</td>
            </tr>
            
        </table>
        <br>




    </h4>
        </div>
    </section>

    <?php 
    //Footer Starts Here
    include('includes/sections/Footer.php');
    ?>
</body>
</html>