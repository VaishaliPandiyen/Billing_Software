<?php require_once("../../../private/initialise.php");

/*  This is the id="" in this url: 
href="<?php echo url_for("/user_admin/vendors/show.php?id=" . $v['v_id']); back in the vendors index page*/
$id = $_GET['id'] ?? null;
// This null coalesescing operator works as a ternary operator in PHP > 7.0

$this_vendor = find_vendor($id);

$page_title = "Vendors Info";

include(SHARED_PATH . "/admin_header.php");
?>

<p>Vendor ID: 
    <?php echo h($this_vendor['v_id']); ?>
<br>Vendor Name: 
    <?php echo h($this_vendor['v_name']); ?>
</p>
<a href="<?php echo url_for("/user_admin/vendors/index.php"); ?>"> &laquo; Back to vendors list</a>

<?php include(SHARED_PATH . "/admin_footer.php");?>