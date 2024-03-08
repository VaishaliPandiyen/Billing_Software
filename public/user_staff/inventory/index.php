<?php require_once("../../../private/initialise.php");

require_login();

$inv_items = all_items();

$page_title = "Inventory";
include(SHARED_PATH . "/staff_header.php");
?>
<div class="content">
  <div class="vendors listing">
    <!-- You can add search functionality here -->
      <table class="list">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Cost</th>
          <!-- <th>&nbsp;</th> -->
        </tr>

      <?php
      if ($inv_items) {
          while ($f = mysqli_fetch_assoc($inv_items)) {
      ?>
      <tr>
         <td><?php echo h($f['f_id']); ?></td>
         <td><?php echo h($f['f_name']); ?></td>
         <td><?php echo h($f['b_quantity']); ?>kgs</td>
         <td><?php echo h($f['s_price']); ?></td>
         <!-- <td><a class="action" href="<?php echo url_for("/user_staff/inventory/show.php?id=" . h(u($f['f_id']))); ?>">View</a></td> 
        Enable this later when you have analysis -->
      </tr>
      <?php /* end while inv_items */}
      } else {
          echo "Error: " . mysqli_error($db);
      } ?>
      </table>

  </div>

</div>
<?php include(SHARED_PATH . "/staff_footer.php");
?>