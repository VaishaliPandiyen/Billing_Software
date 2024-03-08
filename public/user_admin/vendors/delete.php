<?php

/* Why do we have a page for deleting?
It's for having post requests instead of get requests.
Why is that?
For security reasons.
If a search engine spider is used, they will click on all links that are get requests. 
They will then be able to delete all the data. 
But they will not submit any forms which are post requests.
Ofcourse you would have your pages password protected and it's safe. 
But it still illustrates the point.
And it's only going to return t/f, not a record, just whether it's succeeded. 
*/

require_once('../../../private/initialise.php');

if (!isset($_GET['id'])) {
  redirect(url_for('/user_admin/vendors/index.php'));
}
$id = $_GET['id'];

if (is_post()) {
  $result = delete_vendor($id);
  $_SESSION['message'] = "Vendor deleted successfully";
  redirect(url_for('/user_admin/vendors/index.php'));

} else {
  $vendor = find_vendor($id);
}
;
?>
<?php $page_title = 'Delete Vendor'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/vendors/index.php'); ?>">&laquo; Back to vendors list</a>

  <div class="subject delete">
    <p>Are you sure you want to delete this vendor?</p>
    <p class="item"><?php echo h($vendor['v_name']); ?></p>

    <form action="<?php echo url_for('/user_admin/vendors/delete.php?id=' . h(u($vendor['v_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');?>