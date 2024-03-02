<?php require_once("../../private/initialise.php"); ?>
<?php $page_title = "Billing Staff"; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div class="content">
    <nav>
        <h2>Staff Menu</h2>
        <a href="<?php echo url_for("/user_staff/index.php"); ?>">Invoices</a><br>
        <a href="<?php echo url_for("/user_staff/index.php"); ?>">Inventory</a>
        <!-- Note: We used vendors directly instead of /vendors. That's because /vendors gives us an absolute path localhost/vendors... instead of a relative path http://localhost/billing_software/public/user_admin/vendors/index.php!-->
    </nav>
</div>
    
<?php include(SHARED_PATH . "/staff_footer.php"); ?>