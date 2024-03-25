<?php 
require_once('../../../private/initialise.php');

$user = User::find_all();

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
      foreach($user as $u){
      ?>
        <tr>
          <td><?php echo h($u->u_id); ?></td>
          <td><?php echo h($u->full_name()); ?></td>
          <td><?php echo h($u->user_type); ?></td>
          <td><?php echo h($u->email); ?></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/users/edit.php?id=" . h(u($u->u_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/user_admin/users/delete.php?id=" . h(u($u->u_id))); ?>">Delete</a></td>
          </tr>
      <?php } ?>
      </table>
</div>
<?php 
include(SHARED_PATH . '/admin_footer.php');
?>