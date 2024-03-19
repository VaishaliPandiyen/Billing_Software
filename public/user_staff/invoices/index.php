<?php require_once ("../../../private/initialise.php");

// In URL, index.php?page=2 will be there for >1st page
$curr_pg = $_GET['page'] ?? 1;
$per_pg = 15;
$total;
// $total = Invoice::count_all();

$pagination = new Pagination($curr_pg, $per_pg, $total);
$invoices = all_invoices();

// $sql = "SELECT * FROM invoices ";
// $sql .= "LIMIT {$per_pg} ";
// $sql .= "OFFSET {$pagination->offset()} ";
// $invoices = Invoice::find_sql();

$page_title = "Invoices";
include (SHARED_PATH . "/staff_header.php");
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
    <?php
    $url = url_for("/user_staff/invoices/index.php");
    echo $pagination->page_links($url);
    ?>
  </div>

</div>
<?php include (SHARED_PATH . "/staff_footer.php");
?>