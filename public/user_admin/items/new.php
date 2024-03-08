<!-- SOLUTION: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/solution-pages-crud-14191293?resume=false -->

<!-- Check this out for adding selectors for seasons: https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/form-options-from-database-data-14185925?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&resume=false -->
<?php

require_once('../../../private/initialise.php');

if (is_post()) {
  $item = [];
  // $vendor["v_name"] = isset($_POST["v_name"]) ? $_POST["v_name"] : "";
  $item["f_name"] = $_POST["f_name"] ?? "";
  $item["f_season"] = $_POST["f_season"] ?? "";
  $item["v_id"] = $_POST["v_id"] ?? "";
  $item["b_date"] = $_POST["b_date"] ?? "";
  $item["b_price"] = $_POST["b_price"] ?? "";
  $item["b_quantity"] = $_POST["b_quantity"] ?? "";
  $item["s_price"] = $_POST["s_price"] ?? "";

  $result = add_item($item);

  if ($result === true) {
    $_SESSION['message'] = "Item added successfully";
    redirect(url_for("/user_admin/items/show.php?id=" . $item["v_id"]));
  } else {
    $errors = $result;
    // var_dump($errors);
  }
} else {
  // display blank form:
  $item = [];
  $item["f_name"] = "";
  $item["f_season"] = "";
  $item["v_id"] = "";
  $item["b_date"] = "";
  $item["b_price"] = "";
  $item["b_quantity"] = "";
  $item["s_price"] = "";
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
    <dl>
      <dt>Fruit Name</dt>
      <dd><input type="text" name="f_name" value="" /></dd>
    </dl>
    <dl>
      <dt>Season</dt>
      <dd>
        <select name="f_season">
            <option value="all">All</option>
            <option value="spring">Spring</option>
            <option value="summer">Summer</option>
            <option value="autumn">Autumn</option>
            <option value="winter">Winter</option>
        </select>
      </dd>
    </dl>
    <dl>
      <dt>Vendor</dt>
      <dd>
        <select name="v_id">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
      </dd>
    </dl>
    <dl>
      <dt>Buying Date</dt>
      <dd><input type="date" name="b_date" value="" /></dd>
    </dl>
    <dl>
      <dt>Buying Price</dt>
      <dd><input type="number" name="b_price" step="0.01" min="0" value="" /></dd>
    </dl>
    <dl>
      <dt>Buying Quantity</dt>
      <dd><input type="number" name="b_quantity" step="0.01" min="0" value="" /></dd>
    </dl>
    <dl>
      <dt>Selling Price</dt>
      <dd><input type="number" name="s_price" step="0.01" min="0" value="" /></dd>
    </dl>
    </dl>
    <div id="operations">
      <input type="submit" value="Add Fruit" />
    </div>
  </form>

</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php');?>