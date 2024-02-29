<?php require_once("../../../private/initialise.php"); ?>

<?php

/*  This is the id="" in this url: 
href="<?php echo url_for("/user_admin/vendors/show.php?id=" . $v['v_id']); back in the vendors index page*/
$id = $_GET['id'] ?? null;
// This null coalesescing operator works as a ternary operator in PHP > 7.0

$this_item = find_item($id);

$page_title = "Items Info";

include(SHARED_PATH . "/admin_header.php");
?>

<p>Item ID: 
    <?php echo h($this_item['f_id']); ?>
<br>Fruit: 
    <?php echo "&#163;".h($this_item['f_name']);?>
<br>Cost: 
    <?php echo h($this_item['s_price']);?>
<br>
    <?php echo "(Brought for: &#163;" . h($this_item['b_price'])." on ".h($this_item['b_date']).")";?>
</p>
<a href="<?php echo url_for("/user_admin/items/index.php"); ?>"> &laquo; Back to item list</a>

<?php include(SHARED_PATH . "/admin_footer.php"); ?>
