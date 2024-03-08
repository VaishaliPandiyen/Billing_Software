<?php

require_once('../../../private/initialise.php');

if (!isset($_GET['id'])) {
  redirect(url_for('/user_admin/users/index.php'));
}
$id = $_GET['id'];

if (is_post()) {
  $result = delete_user($id);
  $_SESSION['message'] = "User deleted successfully";
  redirect(url_for('/user_admin/user/index.php'));

} else {
  $user = find_user($id);
}
;
?>
<?php $page_title = 'Delete User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/user/index.php'); ?>">&laquo; Back to user list</a>

  <div class="subject delete">
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?php echo h($user['user_name']); ?></p>

    <form action="<?php echo url_for('/user_admin/users/delete.php?id=' . h(u($user['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');?>