<?php require_once("../../../private/initialise.php");

// This is the id="" in this url: 
$id = $_GET['id'] ?? null;

if (!$id) {
    redirect(url_for("/user_staff/invoices/index.php"));
}

$invoice = Invoice::find_one($id);
$sale = Sale::find_all_by_key('i_id', $id);

$page_title = "Invoice: ". $invoice->i_id;

include(SHARED_PATH . "/staff_header.php");
?>

<p>Date: 
    <?php echo h($invoice->i_date); ?>
<br>Paid by: 
    <?php echo h($invoice->i_mode);?>
<br>Value: 
    <?php echo "&#163;".h($invoice->i_total);?>
<br>

<table class="list">
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Value</th>
    </tr>
    <?php 
    if (is_array($sale)) { 
        echo "Count: ".count($sale);
        foreach($sale as $s) { 
      ?>
        <tr>
            <td><?php echo h($s->s_item); ?></td>
            <td><?php echo h($s->s_quanitiy)."kg(s)"; ?></td>
            <td><?php echo "&#163;".h($s->s_value); ?></td> 
        </tr>
    <?php } } else { ?>
        <tr>
            <td><?php echo h($sale->s_item); ?></td>
            <td><?php echo h($sale->s_quantity)."kg(s)"; ?></td>
            <td><?php echo "&#163;".h($sale->s_value); ?></td> 
        </tr>
    <?php } ?>
</table>

</p>
<a href="<?php echo url_for("/user_staff/invoices/index.php"); ?>"> &laquo; Back to invoices list</a>

<?php include(SHARED_PATH . "/staff_footer.php");?>