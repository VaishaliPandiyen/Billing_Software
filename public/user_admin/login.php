<?php
require_once('../../private/initialise.php');

$errors = [];
$username = '';
$password = '';

if(is_post()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $_SESSION['username'] = $username;

  redirect(url_for('/user_admin/index.php'));
}

$page_title = 'Admin Log in'; 
include(SHARED_PATH . '/admin_header.php');
?>

<div id="content">

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