<?php require_once("../../../private/initialise.php");

/*
// for now, we test our errors here
$test = $_GET['test'];

// if the url reads "localhost/billing_software/public/user_admin/vendors/new.php?test=404":
if ($test == '404') {
    error_404();
} else if ($test == '500') {
    error_500();
} else if ($test == 'redirect') {
    redirect(url_for('/user_admin/vendors/index.php'));
    exit();
}
;
*/

$name = h($_POST['vendor_name']) ?? '';
$fruits = h($_POST['vendor_fruits']) ?? '';

if (is_post() && !$name == "" && !$fruits == "") {

    // Handle form values sent by new.php

    echo "Form parameters: <br />";
    echo "New vendor name: " . $name . "<br />";
    echo "Fruits: " . $fruits . "<br />";
}
;

$page_title = 'Add Vendor';
include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/vendors/index.php'); ?>">&laquo; Back to vendors</a>

  <div class="subject new">
    <h1>Add Vendor</h1>

    <form action="<?php echo url_for("/user_admin/vendors/new.php");?>" method="post">
      <dl>
        <dt>Vendor Name</dt>
        <dd><input type="text" name="vendor_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Fruits</dt>
        <dd><input type="text" name="vendor_fruits" value="" /></dd>
      </dl>
      </dl>
      <div id="operations">
        <input type="submit" value="Add Vendor" />
      </div>
    </form>

  </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>