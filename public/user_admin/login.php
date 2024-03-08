<?php
require_once('../../private/initialise.php');

$errors = [];
$username = '';
$password = '';

if (is_post()) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if (is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if (is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if (empty($errors)) {
    $login_fail_msg = "Log in unsuccessful."; // ensuring msg uniformity by saving in a variable

    $user = find_user_by_username($username);
    if ($user) {
      if (password_verify($password, $user['hashed_password'])) {
        log_in($user); // password matches
        redirect(url_for('/user_admin/index.php'));
      } else { // username found, but password does not match
        $errors[] = $login_fail_msg;
      }
    } else {
      // no username found
      $errors[] = $login_fail_msg;
    }
  }
}

$page_title = 'Admin Log in';
include(SHARED_PATH . '/admin_header.php');
?>
<div id="content">
  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>
</div>
<?php include(SHARED_PATH . '/admin_footer.php');
?>