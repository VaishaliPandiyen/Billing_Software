<?php require_once("../../../private/initialise.php");

// Make do with this vendor info until we get to databases
$vendors = [
    ["v_id" => "V_001", "v_name" => "Esme Finch", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_002", "v_name" => "Silas Reyes", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_003", "v_name" => "Hana Nguyen", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_004", "v_name" => "Kieran Blackwood", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_101", "v_name" => "Anya Kapoor", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_102", "v_name" => "Liam O'Connor", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_103", "v_name" => "Mei Chen", "v_fruits" => "Apple, Pear, Orange"],
    ["v_id" => "V_104", "v_name" => "Rafael Gonzalez", "v_fruits" => "Apple, Pear, Orange"],
]; 
$page_title = "Vendors"; 
include(SHARED_PATH . "/admin_header.php");?>
<div class="content">
  <div class="vendors listing">
    <h1>Vendors</h1>

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

      <?php foreach ($vendors as $v) { ?>
              <tr>
                <td><?php echo h($v['v_id']); ?></td>
                  <td><?php echo h($v['v_name']); ?></td>
                <td><a class="action" href="<?php echo url_for("/user_admin/vendors/show.php?id=" . h(u($v['v_id']))); ?>">View</a></td>
                <td><a class="action" href="<?php echo url_for("/user_admin/vendors/edit.php?id=" . h(u($v['v_id']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for("/user_admin/vendors/delete.php?id=" . h(u($v['v_id']))); ?>">Delete</a></td>
                </tr>
      <?php } ?>
      </table>

  </div>

</div>
<?php include(SHARED_PATH . "/admin_footer.php");?>