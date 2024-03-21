<?php 

require_once("../../../private/initialise.php");

if(!isset($_GET['id'])) {
  redirect(url_for('/user_admin/vendors/index.php'));
}
$id = $_GET['id'];

$vendor = Vendor::find_one($id);
if ($vendor == false) {
  redirect(url_for('/user_admin/vendors/index.php'));
}

if (is_post()) {
  $args = $_POST['vendor'];
  //need this bit for save() to update instead of create! notice this $args["id"] is passed in from get request for a condition in save(), not put request f_id or it's refrence!
  $args['id'] = $id;
  $vendor->merge_attributes($args);
  $result = $vendor->save();

  if ($result === true) {
    $_SESSION['message'] = "Vendor updated successfully";
    // $session->message('Vendor was updated successfully.');
    redirect(url_for("/user_admin/vendors/show.php?id=" . $id));
  } else {
    // errors
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
    
    <?php include ('vendor_form.php'); ?>

      <div id="operations">
        <input type="submit" value="Save Edit" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');?>