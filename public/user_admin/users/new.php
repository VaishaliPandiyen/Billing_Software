<?php

require_once('../../../private/initialise.php');

if(is_post()) {
  $args = $_POST['user'];
  $user = new User($args);
  $result = $user->save();
  
  if($result === true) {
    $new_id = $user->getId();
    $_SESSION['message'] = 'User created.';
    // $session->message("User added successfully");
    redirect(url_for('/user_admin/users/index.php'));
  } else {
    // show errors
  }
} else {
  // display the blank form
  $user = new User;
}

?>

<?php $page_title = 'Add User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">

    <form action="<?php echo url_for('/user_admin/users/new.php'); ?>" method="post">
      
      <?php include ('user_form.php'); ?>

      <div id="operations">
        <input type="submit" value="Create User" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
