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
        <th>Price</th>
      </tr>

      <?php foreach($fruits as $f) {
      ?>
        <tr>
          <td><?php echo h($f->f_id); ?></td>
          <td><?php echo h($f->f_name); ?></td>
          <td><?php echo h($f->f_season); ?></td> 
          <td><?php echo '&pound;' . h($f->s_price); ?></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/show.php?id=" . h(u($f->f_id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/edit.php?id=" . h(u($f->f_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/items/delete.php?id=" . h(u($f->f_id))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

  </div>

</div>
    
<?php include(SHARED_PATH . "/admin_footer.php"); ?>