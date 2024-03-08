<?php require_once("../../private/initialise.php");
$page_title = "Billing Admin";
include(SHARED_PATH . "/admin_header.php");
?>
<div class="content">
    <nav>
        <h2>Admin Menu</h2>
        <a href="<?php echo url_for("/user_admin/vendors/index.php"); ?>">Vendors</a><br>
        <a href="<?php echo url_for("/user_admin/items/index.php"); ?>">Items</a><br>
        <a href="<?php echo url_for("/user_admin/users/index.php"); ?>">Users</a>
        <!-- Note: We used vendors directly instead of /vendors. That's because /vendors gives us an absolute path localhost/vendors... instead of a relative path http://localhost/billing_software/public/user_admin/vendors/index.php!-->
    </nav>
</div>
    
<?php include(SHARED_PATH . "/admin_footer.php");
?>