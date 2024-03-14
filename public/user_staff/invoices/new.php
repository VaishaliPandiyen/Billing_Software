<?php require_once("../../../private/initialise.php");

$items = all_items();
$fruits = [];
while ($i = $items->fetch_assoc()) {
    $price = (float) $i["s_price"];
    $fruits[$i["f_name"]] = $price;
    var_dump($i["f_name"] . ' sells at £' . $price, '<br/>');
}

if (is_post()) {
    $invoice = [];
    $invoice["i_mode"] = $_POST["i_mode"] ?? "";

    $sales = [];
    foreach ($_POST['s_item'] as $item) {
        $sale = [];
        $sale["s_item"] = $item["s_item"] ?? "";
        $sale["s_quantity"] = $item["s_quantity"] ?? "";
        $sales[] = $sale;
    }
    var_dump($sales);

    $result = add_invoice($invoice, $sales);

    if ($result === true) {
        redirect(url_for("/user_staff/invoices/show.php?id=" . $invoice["v_id"]));
    } else {
        $errors = $result;
        // var_dump($errors);
    }


} else {
    // display blank form:
    $invoice = [];
    $invoice["i_mode"] = "";
    $invoice["i_total"] = "";
}
;
// write code for calculating i_total here

$page_title = 'Add invoice';
include(SHARED_PATH . '/staff_header.php');
?>
<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_staff/invoices/index.php'); ?>">&laquo; Back to invoices</a>

  <div class="subject new">

    <form action="<?php echo url_for("/user_staff/invoices/new.php"); ?>" method="post">
        <dl>
            <dt>Mode</dt>
            <dd>
            <select name="i_mode">
                <option value="cash">Cash</option>
                <option value="debitC">Debit Card</option>
                <option value="creditC">Credit Card</option>
                <option value="paytm">Paytm</option>
                <option value="other">Other</option>
            </dd>
            </select>
        </dl>
        <dl name="items">
            <label for="s_item">Items:</label>
            <div id="items-container">
                <!-- Initial item selector and quantity input -->
                <div id="item-1">
                    <select name="s_item">
                    <?php foreach ($fruits as $name => $price) { ?>
                        <option value="<?php echo $name ?>"><?php echo $name?></option>
                    <?php } ?>

                    </select>
                    <input type="text" name="s_quantity" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)</p>
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
<?php include(SHARED_PATH . '/staff_footer.php');
?>