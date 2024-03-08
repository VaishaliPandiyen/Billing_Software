<?php

/* Why do we have a page for deleting?
Refer to vendors/delete.php
*/

require_once('../../../private/initialise.php');

if (!isset($_GET['id'])) {
  redirect(url_for('/user_admin/items/index.php'));
}
$id = $_GET['id'];

if (is_post()) {
  $result = delete_item($id);
  $_SESSION['message'] = "Item deleted successfully";
  redirect(url_for('/user_admin/items/index.php'));

} else {
  $item = find_item($id);
}
;
?>
<?php $page_title = 'Delete Item'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/items/index.php'); ?>">&laquo; Back to items list</a>

  <div class="subject delete">
    <p>Are you sure you want to delete this item?</p>
    <p class="item"><?php echo h($item['f_name']); ?></p>

    <form action="<?php echo url_for('/user_admin/items/delete.php?id=' . h(u($item['f_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');?>