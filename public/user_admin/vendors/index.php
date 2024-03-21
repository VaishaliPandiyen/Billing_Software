<?php require_once("../../../private/initialise.php");

$vendors = Vendor::find_all();
// we can now loop through the results for each vendor in the html section

$page_title = "Vendors"; 
include(SHARED_PATH . "/admin_header.php");

?>
<div class="content">
  <div class="vendors listing">
    <div class="actions">
      <a class="action" href="<?php echo url_for("/user_admin/vendors/new.php");?>">Add new vendor</a>
    </div>

      <table class="list">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

      <?php foreach($vendors as $v) { ?>
        <tr>
          <td><?php echo h($v->v_id); ?></td>
          <td><?php echo h($v->v_name); ?></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/vendors/show.php?id=" . h(u($v->v_id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/vendors/edit.php?id=" . h(u($v->v_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/vendors/delete.php?id=" . h(u($v->v_id))); ?>">Delete</a></td>
          </tr>
      <?php } ?>
      </table>

  </div>

</div>
<?php include(SHARED_PATH . "/admin_footer.php");?>