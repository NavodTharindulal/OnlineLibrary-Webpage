<section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-center">
                <ul>
                    <li>
                        <a href="index.php" <?php if ($PageNumber==1) {?>style="color: #0096FC;"<?php } ?>>Home</a>
                    </li>
                    <li>
                        <a href="categories.php" <?php if ($PageNumber==2) {?>style="color: #0096FC;"<?php } ?>>Books</a>
                    </li>
                    <li>
                        <a href="about-us.php" <?php if ($PageNumber==6) {?>style="color: #0096FC;"<?php } ?>>About Us</a>
                    </li>
                    <li>
                        <a href="terms-&-policy.php" <?php if ($PageNumber==7) {?>style="color: #0096FC;"<?php } ?>>Terms & Policy</a>
                    </li>
                    <li>
                        <a href="contact-us.php" <?php if ($PageNumber==8) {?>style="color: #0096FC;"<?php } ?>>Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>