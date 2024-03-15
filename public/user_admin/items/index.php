<?php require_once("../../../private/initialise.php");

$fruits = Fruit::find_all();

$page_title = "Items";
include(SHARED_PATH . "/admin_header.php");

?>
<div class="content">
  <div class="items listing">
    <div class="actions">
      <a class="action" href="<?php echo url_for('/user_admin/items/new.php') ?>">Add new item</a>
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

      <?php foreach($fruits as $f) {
      ?>
        <tr>
          <td><?php echo h($f->f_id); ?></td>
          <td><?php echo h($f->f_name); ?></td>
          <td><?php echo h($f->f_season); ?></td> 
          <td><a class="action" href="<?php echo url_for("/user_admin/vendors/show.php?id=" . h(u($f->v_id))); ?>">
          <?php echo h($f->v_id) ?></a></td>
          <td><?php echo h($f->b_date); ?></td>
          <td><?php echo '&pound;' . h($f->b_price); ?></td>
          <td><?php echo h($f->b_quantity) . 'kg'; ?></td>
          <td><?php echo '&pound;' . h($f->s_price); ?></td>
          <td><?php echo h($f->s_profit); ?></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/show.php?id=" . h(u($f->f_id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/edit.php?id=" . h(u($f->f_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/delete.php?id=" . h(u($f->f_id))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

  </div>

</div>
    
<?php include(SHARED_PATH . "/admin_footer.php"); ?>