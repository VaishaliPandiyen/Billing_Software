<?php require_once ("../../../private/initialise.php");


if (is_post()) {
  //  $_POST["vendor"] has data from form fields with name="vendor[x]" instead of writing $args['x'] = $_POST['x'] ?? NULL;
  $args = $_POST['vendor'];
  // Remember __construct($args = [])!?
  $vendor = new Vendor($args);
  $result = $vendor->save();

  if ($result === true) {
    // id created in crud class
    $new_id = $vendor->getId();
    $_SESSION['message'] = "Vendor saved successfully";
    // $session->message("Vendor added successfully");
    redirect(url_for("/user_admin/vendor/show.php?id=" . $new_id));
  } else {
    //show errors
  }
} else {
  // display blank form:
  $vendor = new Vendor;
}
;

$page_title = 'Add Vendor';
include (SHARED_PATH . '/admin_header.php');
?>
<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/vendors/index.php'); ?>">&laquo; Back to vendors</a>

  <div class="subject new">

    <form action="<?php echo url_for("/user_admin/vendors/new.php"); ?>" method="post">

    <?php include ('vendor_form.php'); ?>
      <div id="operations">
        <input type="submit" value="Add Vendor" />
      </div>
    </form>

  </div>

</div>
<?php include (SHARED_PATH . '/admin_footer.php'); ?>