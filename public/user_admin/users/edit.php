<?php

require_once ('../../../private/initialise.php');

if (!isset ($_GET['id'])) {
  redirect(url_for('/user_admin/users/index.php'));
}
$id = $_GET['id'];

$user = User::find_one($id);
if ($user == false) {
  redirect(url_for('/staff/users/index.php'));
}

if (is_post()) {
  $args = $_POST['user'];
  //need this bit for save() to update instead of create! notice this $args["id"] is passed in from get request for a condition in save(), not put request f_id or it's refrence!
  $args['id'] = $id;
  $user->merge_attributes($args);
  $result = $user->save();

  if ($result === true) {
    $_SESSION['message'] = 'User updated.';
    // redirect(url_for('/user_admin/users/index.php'));
  } else {
    // error
  }
}

$page_title = 'Edit User';
include (SHARED_PATH . '/admin_header.php'); 
?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">

    <form action="<?php echo url_for('/user_admin/users/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include ('user_form.php'); ?>

      <div id="operations">
        <input type="submit" value="Save Edit" />
      </div>
    </form>

  </div>

</div>

<?php include (SHARED_PATH . '/admin_footer.php'); ?>
