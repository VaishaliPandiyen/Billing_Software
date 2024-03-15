<!-- SOLUTION: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/solution-pages-crud-14191293?resume=false -->

<!-- Check this out for adding selectors for seasons: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/form-options-from-database-data-14185925?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false -->
<?php

require_once ('../../../private/initialise.php');

if (is_post()) {
  //  $_POST["item"] has data from form fields with name="item[x]" instead of writing $args['x'] = $_POST['x'] ?? NULL;
  $args = $_POST['item'];
  // Remember __construct($args = [])!?
  $item = new Fruit($args);
  $result = $item->save();

  if ($result === true) {
    // id created in crud class
    $new_id = $item->getId();
    $_SESSION['message'] = "Item saved successfully";
    // $session->message("Item added successfully");
    redirect(url_for("/user_admin/items/show.php?id=" . $new_id));
  } else {
    //show errors
  }
} else {
  // display blank form:
  $item = new Fruit;
}
;

/* 
WRITE code for dropdowns here 
If you write it inside if(is_post()), the values will load only when the page is initialised, not when the user clicks submit and waits to rectify errors. Ref: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/display-validation-errors-14187614?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false 
*/

$page_title = 'Add Item';
include SHARED_PATH . '/admin_header.php';
?>
<div id="content">

<a class="back-link" href="<?php echo url_for('/user_admin/items/index.php'); ?>">&laquo; Back to items</a>

<div class="subject new">

  <form action="<?php echo url_for("/user_admin/items/new.php"); ?>" method="post">

  <?php include ('item_form.php'); ?>

    <div id="operations">
      <input type="submit" value="Add Fruit" />
    </div>
  </form>

</div>

</div>
<?php include (SHARED_PATH . '/admin_footer.php'); ?>