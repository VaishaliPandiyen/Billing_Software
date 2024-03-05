<?php 

require_once("../../../private/initialise.php");

if(!isset($_GET['id'])) {
  redirect(url_for('/user_admin/vendors/index.php'));
}
$id = $_GET['id'];

if (is_post()) {
  $vendor = [];
  $vendor["v_id"] = $id; 
  $vendor["v_name"] = $_POST['vendor_name'] ?? '';

  $result = edit_vendor($vendor);

  if ($result === true) {
    redirect(url_for("/user_admin/vendors/show.php?id=". $id));
  } else {
    $errors = $result;
    // var_dump($errors);
  }

} else {
  $this_vendor = find_vendor($id);
}
;

$page_title = 'Edit Vendor';
include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/vendors/index.php'); ?>">&laquo; Back to vendors</a>

  <div class="subject new">
 
    <form action="<?php echo url_for("/user_admin/vendors/edit.php?id=" . u($id));?>" method="post">
      <dl>
        <dt>Vendor Name</dt>
        <dd><input type="text" name="vendor_name" value="<?php echo h($this_vendor["v_name"]) ?>" /></dd>
      </dl>
      </dl>
      <div id="operations">
        <input type="submit" value="Save Edit" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');?>