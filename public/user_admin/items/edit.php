<?php
// Check this out for adding selectors for seasons: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/form-options-from-database-data-14185925?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false

// SOLUTION: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/solution-pages-crud-14191293?resume=false

// Check this out for adding selectors for seasons: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/form-options-from-database-data-14185925?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false

require_once ('../../../private/initialise.php');

if (!isset ($_GET['id'])) {
  redirect(url_for('/user_admin/items/index.php'));
}
$id = $_GET['id'];

$item = Fruit::find_one($id);
if ($item == false) {
  redirect(url_for('/user_admin/items/index.php'));
}

if (is_post()) {
  $args = $_POST['item'];
  //need this bit for save() to update instead of create! notice this $args["id"] is passed in from get request for a condition in save(), not put request f_id or it's refrence!
  $args['id'] = $id;
  $item->merge_attributes($args);
  $result = $item->save();

  if ($result === true) {
    $_SESSION['message'] = "Item updated successfully";
    // $session->message('Item was updated successfully.');
    // redirect(url_for("/user_admin/items/show.php?id=" . $id));
  } else {
    // errors
  }
} 
;

/* 
WRITE code for dropdowns here 
If you write it inside if(is_post()), the values will load only when the page is initialised, not when the user clicks submit and waits to rectify errors. Ref: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/display-validation-errors-14187614?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false 
*/

$page_title = 'Edit Item';
include SHARED_PATH . '/admin_header.php';
?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/user_admin/items/index.php'); ?>">&laquo; Back to items</a>

  <div class="subject new">
    <form action="<?php echo url_for("/user_admin/items/edit.php?id=" . u($id)); ?>" method="post">

    <?php include ('item_form.php'); ?>
    
    <div id="operations">
      <input type="submit" value="Save Edit" />
    </div>
    </form>
  </div>
</div>
<?php include (SHARED_PATH . '/admin_footer.php'); ?>