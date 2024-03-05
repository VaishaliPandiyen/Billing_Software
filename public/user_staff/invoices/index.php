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
          <th>Value</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

      <?php
      if ($invoices) {
          while ($s = mysqls_fetch_assoc($invoices)) {
      ?>
      <tr>
        <!-- 

        WE NEED A SALES DATABASE FIRST! CREATE IT WHEN YOU HAVE INTERNET CONNECTION -- CHECK HOW TO MAKE item, quantity, value PAIR!

        quantity WILL BE INPUT. item SHOULD DRAW FROM itemsDB. value SHOULD BE CALCULATED from itemsDB['s_price].
         -->
         <td><?php echo h($s['s_id']); ?></td>
         <td><?php echo h($s['s_date']); ?></td>
         <td><?php echo h($s['s_tot_value']); ?></td>
         <td><a class="action" href="<?php echo url_for("/user_staff/invoices/show.php?id=" . h(u($s['s_id']))); ?>">View</a></td>
         <td><a class="action" href="<?php echo url_for("/user_staff/invoices/suggest_edit.php?id=" . h(u($s['s_id']))); ?>">Suggest Edit</a></td>
      </tr>
      <?php }
      } else {
          echo "Error: " . mysqls_error($db);
      } ?>
      </table>

  </div>

</div>
<?php include(SHARED_PATH . "/staff_footer.php");
?>