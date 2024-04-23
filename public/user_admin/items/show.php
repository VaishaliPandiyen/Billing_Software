<?php require_once("../../../private/initialise.php");

// This is the id="" in this url: 
$id = $_GET['id'] ?? null;

if (!$id) {
    redirect(url_for("/user_admin/items/index.php"));
}

$fruit = Fruit::find_one($id);

$page_title = "Info: ". $fruit->f_name;

include(SHARED_PATH . "/admin_header.php");
?>

<p>Item ID: 
    <?php echo h($fruit->f_id); ?>
<br>Fruit: 
    <?php echo h($fruit->f_name);?>
<br>Cost: 
    <?php echo "&#163;".h($fruit->s_price);?>
</p>
<a href="<?php echo url_for("/user_admin/items/index.php"); ?>"> &laquo; Back to item list</a>

<?php include(SHARED_PATH . "/admin_footer.php");?>