<?php require_once("../../../private/initialise.php");

if (!isset($_GET['id'])) {
    redirect(url_for('/user_admin/vendors/index.php'));
} else {
    $id = $_GET['id'];
}
;

$name = '';
$fruits = '';

if (is_post()) {
    $name = $_POST['vendor_name'] ?? '';
    $fruits = $_POST['vendor_fruits'] ?? '';

    echo "Form parameters: <br />";
    echo "New vendor name: " . $name . "<br />";
    echo "Fruits: " . $fruits . "<br />";
}
;

$page_title = 'Edit Vendor';
include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_admin/vendors/index.php'); ?>">&laquo; Back to vendors</a>

  <div class="subject new">
    <h1>Edit Vendor</h1>

    <form action="<?php echo url_for("/user_admin/vendors/edit.php?id=" . h(u('id'))); ?>" method="post">
      <dl>
        <dt>Vendor Name</dt>
        <dd><input type="text" name="vendor_name" value="<?php echo $name?>" /></dd>
      </dl>
      <dl>
        <dt>Fruits</dt>
        <dd><input type="text" name="vendor_fruits" value="<?php echo $fruits?>" /></dd>
      </dl>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Vendor" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>