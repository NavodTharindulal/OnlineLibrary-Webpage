    <section class="categories">
        <div class="container">
            <h2 class="text-center" style="background-color:tomato;">Fetured and Newly Released</h2>
            <center>
            <?php 
                $query = "SELECT * from book_list WHERE is_deleted = '0' order by time DESC Limit 10";
                $books = mysqli_query($connection, $query);
                if ($books) {
                while ($book = mysqli_fetch_assoc($books)) {?>
            <a href="order.php?book=<?php echo $book["id"]; ?>" style="padding: 6px;">
                    <img src="images/books/<?php echo($book["book_image"]);?>" width="200">
            </a>
            <?php }} ?>
            </center>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="categories.php">See All Books</a>
        </p>
    </section>