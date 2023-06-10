    <div class="col-sm-3 sidenav">
      <h4>Hello <?php echo $login_u["first_name"]; ?></h4>
      <ul class="nav nav-pills nav-stacked">
        <li<?php if ($PageNumber==1) { ?> class="active"<?php } ?> ><a href="dashboard.php">Home</a></li>
        <li<?php if ($PageNumber==2) { ?> class="active"<?php } ?> ><a href="add-book-category.php">Books Category</a></li>
        <li <?php if ($PageNumber==9) { ?> class="active"<?php } ?>><a href="messages.php">Messages Box</a></li>
        <li <?php if ($PageNumber==10) { ?> class="active"<?php } ?>><a href="admins.php">Admins</a></li>
        <li <?php if ($PageNumber==8) { ?> class="active"<?php } ?>><a href="orders.php">Orders</a></li>
        <li<?php if ($PageNumber==7) { ?> class="active"<?php } ?>><a href="settings.php">Settings</a></li>
        <li <?php if ($PageNumber==11) { ?> class="active"<?php } ?>><a href="help.php">Help</a></li>
      </ul><br>
      <a href="logout.php?log_out_code=3"><button type="button" class="btn btn-danger btn-lg btn-block">Logout</button></a>
    </div>