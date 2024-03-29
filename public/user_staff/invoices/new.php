<?php

require_once ("../../../private/initialise.php");

$fruits = Fruit::find_all();

if (is_post()) {
    $total_sale_value = 0;

    foreach ($_POST['sale'] as $s) {
        $name = $s["s_item"];
        
        // Find the fruit object with the matching name
        $selected_fruit = null;
        foreach ($fruits as $f) {
            if ($f->f_name === $name) {
                $selected_fruit = $f;
                break;
            }
        }
        
        if ($selected_fruit) {
            // Calculate s_value based on the quantity and price of the selected fruit
            $s_value = $selected_fruit->s_price * $s['s_quantity'];
            
            $args_s = [
                'i_id' => null, // Will be updated after saving invoice
                's_item' => $name,
                's_quantity' => $s['s_quantity'],
                's_value' => $s_value
            ];
    
            $sale = new Sale($invoice, $args_s);
            // $result_s = $sale->save();
    
            $total_sale_value += $s_value;
        }
    }

    // Create the invoice with the initial total value
    $args_i = [
        'i_date' => date('Y-m-d H:i:s'),
        'i_mode' => $_POST['invoice']['i_mode'],
        'i_total' => $total_sale_value
    ];
    $invoice = new Invoice($args_i);

    // Save the invoice to generate i_id
    $result_i = $invoice->save();

    if ($result_i === true) {
        // Update the i_id for each sale with the generated i_id of the invoice
        foreach ($sale as $s) {
            $sale->i_id = $invoice->i_id;
            $result_s = $s->save();
        }
        $_SESSION['message'] = "Invoice saved successfully";
        // $session->message("Item added successfully");
        // redirect(url_for("/user_staff/invoices/index.php));
    }
} else {
    // display blank form:
    $invoice = new Invoice;
    $sale = new Sale($invoice);
}

$page_title = 'Add invoice';
include (SHARED_PATH . '/staff_header.php');
?>
<div id="content">

  <a class="back-link" href="<?php echo url_for('/user_staff/invoices/index.php'); ?>">&laquo; Back to invoices</a>

  <div class="subject new">

    <form action="<?php echo url_for("/user_staff/invoices/new.php"); ?>" method="post">
        <dl name="items">
            <label for="sale[s_item]">Items:</label>
            <div id="items-container">
                <!-- Initial item selector and quantity input -->
                <div id="item-1">
                    <select name="sale[s_item]">
                    <?php foreach ($fruits as $f) { ?>
                        <option value="<?php echo h($f->f_name) ?>">
                                <?php echo h($f->f_name) ?>
                        </option>
                    <?php } ?>
                    </select>
                    <input type="text" name="sale[s_quantity]" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)
                </div>
            </div>
            
            <!-- Button to add new item selector and quantity input -->
            <button type="button" onclick="add_item()">+</button>
        </dl>
        <dl>
            <dt>Mode</dt>
            <dd>
            <select name="invoice[i_mode]">
            <?php foreach (Invoice::MODE as $m) { ?>
                <option value="<?php echo $m; ?>" 
                <?php if ($invoice->i_mode == $m) { echo 'selected'; } ?>>
                    <?php echo $m; ?>
                </option>
            <?php } ?>
            </select>
        </dl>
        <div id="operations">
            <input type="submit" value="Add invoice" />
        </div>
    </form>

  </div>

</div>
<script>
    const add_item = async () => {
        let c = document.getElementById('items-container');
        let item = document.createElement('div');
        item.innerHTML = `
            <select name="sale[s_item][]">
                <?php foreach ($fruits as $f) { ?>
                    <option value="<?php echo h($f->f_name) ?>">
                        <?php echo h($f->f_name) ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="sale[s_quantity][]" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)
            <button type="button" class="remove-item" onclick="remove_item(this)">-</button>
        `;
        c.appendChild(item);
    }

    const remove_item = async (element) => {
        let i = element.parentNode;
        i.parentNode.removeChild(i);
    }
</script>

<?php include (SHARED_PATH . '/staff_footer.php');
?>