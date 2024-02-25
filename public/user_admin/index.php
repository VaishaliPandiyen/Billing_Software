<?php require_once("../../private/initialise.php"); ?>
<?php $page_title = "Billing Admin" ?>
<?php include(SHARED_PATH . "/admin_header.php"); ?>

<div class="content">
    <nav>
        <h2>Admin Menu</h2>
        <a href="vendors/index.php">Vendors</a>
        <!-- Note: We used vendors directly instead of /vendors. That's because /vendors gives us an absolute path localhost/vendors... instead of a relative path http://localhost/billing_software/public/user_admin/vendors/index.php!-->
    </nav>
</div>
    
<?php include(SHARED_PATH . "/admin_footer.php"); ?>