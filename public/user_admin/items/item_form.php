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

<!-- <dl>
  <dt>Vendor</dt>
  <dd>
    <select name="item[v_id]">
    <?php
      $vendors = Vendor::find_all();
      foreach ($vendors as $vendor) {
        $v_id = $vendor->v_id;
        $v_name = $vendor->v_name;
        ?>
        <option value="<?php echo h($v_id); ?>" <?php if ($item->v_id == $v_id) {
          echo 'selected';
        } ?>><?php echo h($v_name); ?></option>
        <?php
      }
      ?>
    </select>
  </dd>  
</dl> -->

<!-- <dl>
    <dt>Buying Date</dt>
    <dd><input type="date" name="item[b_date]" value="<?php echo h($item->b_date); ?>" /></dd>
</dl>

<dl>
  <dt>Buying Price</dt>
  <dd><input type="number" name="item[b_price]" step="0.01" min="0" value="<?php echo h($item->b_price); ?>" /></dd>
</dl>

<dl>
  <dt>Buying Quantity</dt>
  <dd><input type="number" name="item[b_quantity]" step="0.01" min="0" value="<?php echo h($item->b_quantity); ?>" /></dd>
</dl> -->

<dl>
  <dt>Selling Price</dt>
  <dd><input type="number" name="item[s_price]" step="0.01" min="0"  value="<?php echo h($item->s_price); ?>" /></dd>
</dl>