<?php 
require_once('../../../private/initialise.php');

$users = all_users();

$page_title = "Admins & Staff";
include(SHARED_PATH . '/admin_header.php');
?>
<div>
<div class="actions">
      <a class="action" href="<?php echo url_for('/user_admin/users/new.php') ?>">Add new user</a>
    </div>
<table class="list">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Type</th>
          <th>Email</th>
          <th>&nbsp;</th> 
          <th>&nbsp;</th> 
        </tr>

      <?php 
      if ($users) { 
        while ($u = $users->fetch_assoc()) { 
      ?>
        <tr>
          <td><?php echo h($u['id']); ?></td>
          <td><?php echo h($u['first_name'])." ".h($u['last_name']); ?></td>
          <td><?php echo h($u['user_type']); ?></td>
          <td><?php echo h($u['email']); ?></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/users/edit.php?id=" . h(u($u['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/users/delete.php?id=" . h(u($u['id']))); ?>">Delete</a></td>
          </tr>
      <?php } 
      } else {
        echo "Error: " . $db->error;
      } ?>
      </table>
</div>
<?php 
include(SHARED_PATH . '/admin_footer.php');
?>