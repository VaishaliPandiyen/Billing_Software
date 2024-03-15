<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($item)) {
  redirect(url_for('/user_admin/items/index.php'));
}
?>

<dl>
  <dt>Fruit Name</dt>
  <dd><input type="text" name="item[f_name]" value="<?php echo h($item->f_name); ?>" /></dd>
</dl>

<dl>
  <dt>Season</dt>
  <dd>
    <select name="item[f_season]">
    <?php foreach(Fruit::SEASONS as $s) { ?>
      <option value="<?php echo $s; ?>" <?php if($item->f_season == $s) { echo 'selected'; } ?>><?php echo $s; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Vendor</dt>
  <dd>
    <select name="item[v_id]">
        <option value="1" <?php if($item->v_id == 1) { echo 'selected'; } ?>>1</option>
        <option value="2" <?php if($item->v_id == 2) { echo 'selected'; } ?>>2</option>
        <option value="3" <?php if($item->v_id == 3) { echo 'selected'; } ?>>3</option>
    </select>
  </dd>  
</dl>

<dl>
    <dt>Buying Date</dt>
    <dd><input type="date" name="item[b_date]" value="<?php echo date('Y-m-d'); ?>" /></dd>
</dl>

<dl>
  <dt>Buying Price</dt>
  <dd><input type="number" name="item[b_price]" step="0.01" min="0" value="<?php echo h($item->b_price); ?>" /></dd>
</dl>

<dl>
  <dt>Buying Quantity</dt>
  <dd><input type="number" name="item[b_quantity]" step="0.01" min="0" value="<?php echo h($item->b_quantity); ?>" /></dd>
</dl>

<dl>
  <dt>Selling Price</dt>
  <dd><input type="number" name="item[s_price]" step="0.01" min="0"  value="<?php echo h($item->s_price); ?>" /></dd>
</dl>