<?php require_once("../../../private/initialise.php");

$items = all_items();
function profit($i)
{
    return round(($i['s_price'] - $i['b_price']) / ($i['s_price']) * 100, 2);
}
;

$page_title = "Items";
include(SHARED_PATH . "/admin_header.php");

?>
<div class="content">
  <div class="items listing">
    <div class="actions">
      <a class="action" href="">Add new item</a>
    </div>

      <table class="list">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Season</th>
            <th>V_ID</th>
            <th colspan="3">Buying</th>
            <th colspan="2">Sales</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>B_Date</th>
            <th>B_Price</th>
            <th>B_Quantity</th>
            <th>S_Price</th>
            <th>S_Profit</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
       </tr>

      <?php if ($items) {
          while ($i = mysqli_fetch_assoc($items)) {
              ?>
                <tr>
                    <td><?php echo h($i['f_id']); ?></td>
                    <td><?php echo h($i['f_name']); ?></td>
                    <td><?php echo h($i['f_season']); ?></td> 
                    <td><a class="action" href="<?php echo url_for("/user_admin/vendors/show.php?id=" . h(u($i['v_id']))); ?>">
                    <?php echo h($i['v_id']) ?></a></td>
                    <td><?php echo h($i['b_date']); ?></td>
                    <td><?php echo '&pound;' . h($i['b_price']); ?></td>
                    <td><?php echo h($i['b_quantity']) . 'kg'; ?></td>
                    <td><?php echo '&pound;' . h($i['s_price']); ?></td>
                    <td><?php echo profit($i); ?></td>
                    <td><a class="action" href="<?php echo url_for("/user_admin/items/show.php?id=" . h(u($i['f_id']))); ?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for("/user_admin/items/edit.php?id=" . h(u($i['f_id']))); ?>">Edit</a></td>
                    <td><a class="action" href="<?php echo url_for("/user_admin/items/delete.php?id=" . h(u($i['f_id']))); ?>">Delete</a></td>
                </tr>
          <?php }
      } else {
          echo "Error: " . mysqli_error($db);
      }
      ?>
      </table>

  </div>

</div>
    
<?php include(SHARED_PATH . "/admin_footer.php"); ?>