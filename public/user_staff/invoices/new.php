<?php

require_once ("../../../private/initialise.php");

$fruits = Fruit::find_all();

if (is_post()) {
    $total_sale_value = 0;
    $sales = [];

    // Start SAVE EACH ITEM SOLD :--
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
            $s_value = round((floatval($selected_fruit->s_price) * floatval($s['s_quantity'])), 2); // s_value input is a string, convert it to a float to add to total
            
            $args_s = [
                's_item' => $name,
                's_quantity' => $s['s_quantity'],
                's_value' => round($s_value, 2)
            ];
            var_dump($args_s);
    
            $sale = new Sale($args_s);
            $sales[] = $sale; 
            // $result_s = $sale->save();
    
            $total_sale_value += $s_value;
        }
    }
     // End SAVE EACH ITEM SOLD

    date_default_timezone_set('Europe/London'); 
    // Create the invoice with the initial total value
    $args_i = [
        'i_date' => date('Y-m-d H:i:s'),
        'i_mode' => $_POST['invoice']['i_mode'],
        'i_total' => $total_sale_value
    ];
    $invoice = new Invoice($args_i);
    ?><pre><?php echo"Invoice: <br>"; var_dump($invoice); ?></pre><?php 

    // Save the invoice to generate i_id
    $result_i = $invoice->save();

    if ($result_i === true) {
        // Update the i_id for each sale with the generated i_id of the invoice
        foreach ($sales as $s) {
            $s->i_id = $invoice->i_id;
            ?><pre><?php var_dump($s); ?></pre><?php 
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

            <template id="item-template">
                <div class="sale-item" id="item-1">
                    <select name="sale[0][s_item]">
                        <?php foreach ($fruits as $f) { ?>
                            <option value="<?php echo h($f->f_name) ?>">
                                <?php echo h($f->f_name) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="text" name="sale[0][s_quantity]" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)
                    <button type="button" class="remove-item" onclick="remove_item(this)">-</button>
                </div>
            </template>

            <div id="items-container">
                <!-- Initial sale item -->
                <div class="sale-item" id="item-1">
                    <select name="sale[0][s_item]">
                        <?php foreach ($fruits as $f) { ?>
                            <option value="<?php echo h($f->f_name) ?>">
                                <?php echo h($f->f_name) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="text" name="sale[0][s_quantity]" placeholder="Enter quantity" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid decimal number">kg(s)
                    <button type="button" class="remove-item" onclick="remove_item(this)">-</button>
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
    let itemCounter = 1; // Counter for unique IDs  
    const add_item = async () => {
        let c = document.getElementById('items-container');
        let newItem = document.getElementById('item-template').content.cloneNode(true); // Clone the template container
        newItem.querySelectorAll('[name^="sale"]').forEach(input => {
            let newName = input.getAttribute('name').replace('[0]', '[' + itemCounter + ']'); // Update name from sale[0][] to sale[1][]
            input.setAttribute('name', newName);
        });
        newItem.querySelector('.remove-item').addEventListener('click', function() {
            remove_item(this);
        });
        newItem.id = 'item-' + (++itemCounter); // Update item ID 
        c.appendChild(newItem); // Append the new item to the container
    }

    const remove_item = async (element) => {
        let i = element.parentNode;
        i.parentNode.removeChild(i);
    }
</script>

<?php include (SHARED_PATH . '/staff_footer.php');
?>