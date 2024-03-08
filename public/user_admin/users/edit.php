<?php

require_once('../../../private/initialise.php');

if(!isset($_GET['id'])) {
    redirect(url_for('/user_admin/users/index.php'));
  }
$id = $_GET['id'];

if(is_post()) {
  $user = [];
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  $user['user_type'] = $_POST['user_type'] ?? '';
  $user['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = edit_user($user);
  if($result === true) {
    $_SESSION['message'] = 'User updated.';
    redirect(url_for('/user_admin/users/index.php'));
  } else {
    $errors = $result;
  }

} else {
    $user = find_user($id);
}

?>

<?php $page_title = 'Edit User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Edit User</h1>

    <form action="<?php echo url_for('/user_admin/users/edit.php'. h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email </dt>
        <dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($user['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>User Type</dt>
        <dd>
            <select name="user_type">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </dd>
      </dl>
      
      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
      </p>

      <div id="operations">
        <input type="submit" value="Save Edit" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
