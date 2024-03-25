<?php

require_once ("../../../private/initialise.php");

$fruits = Fruit::find_all();

if (is_post()) {
    //  $_POST["sale"] has data from form fields with name="sale[x]" instead of writing $args['x'] = $_POST['x'] ?? NULL;
    $args = $_POST['sale'];
    $args = $_POST['invoice'];
    // Remember __construct($args = [])!?
    $sale = new Sale($args);
    $invoice = new Invoice($args);
    $result_s = $sale->save();
    $result_i = $invoice->save();

    foreach ($_POST['s_item'] as $item) {
        $sale = [];
        $sale["s_item"] = $item["s_item"] ?? "";
        $sale["s_quantity"] = $item["s_quantity"] ?? "";
        $sales[] = $sale;
    }

    if ($result_i === true && $result_s === true) {
        // id created in crud class
        $new_id = $item->getId();
        $_SESSION['message'] = "Invoice saved successfully";
        // $session->message("Invoice created successfully");
        redirect(url_for("/user_staff/invoices/show.php?id=" . $new_id));
    }
} else {
    // display blank form:
    $sale = new Sale;
    $invoice = new Invoice;
}
;
// write code for calculating i_total here

$page_title = 'Add invoice';
include (SHARED_PATH . '/staff_header.php');
?>
<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_staff/invoices/index.php'); ?>">&laquo; Back to invoices</a>

  <div class="subject new">

    <form action="<?php echo url_for("/user_staff/invoices/new.php"); ?>" method="post">
        <dl>
            <dt>Mode</dt>
            <dd>
            <select name="invoice[i_mode]">
            <?php foreach (Invoice::MODE as $m) { ?>
                        <option value="<?php echo $m; ?>" <?php if ($invoice->i_mode == $m) {
                               echo 'selected';
                           } ?>><?php echo $m; ?></option>
            <?php } ?>
            </select>
        </dl>
        <dl name="items">
            <label for="sale[s_item]">Items:</label>
            <div id="items-container">
                <!-- Initial item selector and quantity input -->
                <div id="item-1">
                    <select name="sale[s_item]">
                    <?php foreach ($fruits as $f) { ?>
                                <option value="<?php echo h($f->f_name) ?>"><?php echo h($f->f_name) ?></option>
                    <?php } ?>
                    </select>
                    <input type="text" name="s_quantity" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)
                </div>
            </div>
            
            <!-- Button to add new item selector and quantity input -->
            <button type="button" onclick="addItem()">+</button>
      
        </dl>
        <div id="operations">
            <input type="submit" value="Add invoice" />
        </div>
    </form>

  </div>

</div>
<?php include (SHARED_PATH . '/staff_footer.php');
?>