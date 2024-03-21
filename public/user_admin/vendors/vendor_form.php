<?php
// prevents this code from being loaded directly in the browser or without first setting the necessary object
if(!isset($vendor)) {
  redirect(url_for('/user_admin/vendors/index.php'));
}
?>

<dl>
  <dt>Vendor Name</dt>
  <dd><input type="text" name="vendor[v_name]" value="<?php echo h($vendor->v_name); ?>" /></dd>
</dl>
