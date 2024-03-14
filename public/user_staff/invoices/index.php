<?php require_once("../../../private/initialise.php");

$invoices = all_invoices();

$page_title = "Invoices";
include(SHARED_PATH . "/staff_header.php");
?>
<div class="content">
  <div class="vendors listing">
    <div class="actions">
      <a class="action" href="<?php echo url_for("/user_staff/invoices/new.php"); ?>">Add new invoice</a>
    </div>

      <table class="list">
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Mode</th>
          <th>Value</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

      <?php
      if ($invoices) {
          while ($i = $invoices->fetch_assoc()) {
      ?>
      <tr>
         <td><?php echo h($i['i_id']); ?></td>
         <td><?php echo h($i['i_date']); ?></td>
         <td><?php echo h($i['i_mode']); ?></td>
         <td><?php echo h($i['i_total']); ?></td>
         <td><a class="action" href="<?php echo url_for("/user_staff/invoices/show.php?id=" . h(u($i['i_id']))); ?>">View</a></td>
         <td><a class="action" href="<?php echo url_for("/user_staff/invoices/suggest_edit.php?id=" . h(u($i['i_id']))); ?>">Suggest Edit</a></td>
      </tr>
      <?php }
      } else {
          echo "Error: " . $db->error;
      } ?>
      </table>

  </div>

</div>
<?php include(SHARED_PATH . "/staff_footer.php");
?>