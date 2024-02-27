<?php require_once("../../../private/initialise.php"); ?>

<!-- Make do with this vendor info until we get to databases -->
<?php $fruits = [
    [
        "f_id" => "F_001",
        "f_name" => "Lemon",
        "f_season" => "All",
        "v_id" => "V_002",
        "buying" => [
            "b_date" => "29 Feb 2024",
            "b_price" => "1.9",
            "b_quantity" => "2"
        ],
        "selling" => [
            "s_price" => "2.2",
            "s_profit" => ""
        ]
    ],
    [
        "f_id" => "F_002",
        "f_name" => "Lime",
        "f_season" => "All",
        "v_id" => "V_002",
        "buying" => [
            "b_date" => "29 Feb 2024",
            "b_price" => "1.85",
            "b_quantity" => "1.5"
        ],
        "selling" => [
            "s_price" => "2",
            "s_profit" => ""
        ]
    ],
    [
        "f_id" => "F_003",
        "f_name" => "Easy Peeler Orange",
        "f_season" => "All",
        "v_id" => "V_002",
        "buying" => [
            "b_date" => "29 Feb 2024",
            "b_price" => "2.3",
            "b_quantity" => "4"
        ],
        "selling" => [
            "s_price" => "2.6",
            "s_profit" => ""
        ]
    ],
]; 
function profit($i) {
    return round((($i['selling']['s_price'] - $i['buying']['b_price']) / ($i['selling']['s_price'])  * 100), 2) ;
};
?>

<?php $page_title = "Items" ?>
<?php include(SHARED_PATH . "/admin_header.php"); ?>

<div class="content">
  <div class="items listing">
    <h1>Items</h1>

    <div class="actions">
      <a class="action" href="">Add new item</a>
    </div>

      <table class="list">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Season</th>
            <th>V_ID</th>
            <th colspan="3">Buying</th>
            <th colspan="2">Sales</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>B_Date</th>
            <th>B_Price</th>
            <th>B_Quantity</th>
            <th>S_Price</th>
            <th>S_Profit</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
       </tr>

      <?php foreach ($fruits as $i) { ?>
        <tr>
            <td><?php echo h($i['f_id']); ?></td>
            <td><?php echo h($i['f_name']); ?></td>
            <td><?php echo h($i['f_season']); ?></td> 
            <td><a class="action" href="<?php echo url_for("/user_admin/vendors/show.php?id=" . h(u($i['v_id']))); ?>">
            <?php echo h($i['v_id'])?></a></td>
            <td><?php echo h($i['buying']['b_date']); ?></td>
            <td><?php echo '&pound;'.h($i['buying']['b_price']); ?></td>
            <td><?php echo h($i['buying']['b_quantity']).'kg'; ?></td>
            <td><?php echo '&pound;'.h($i['selling']['s_price']); ?></td>
            <td><?php echo profit($i); ?></td>
            <td><a class="action" href="<?php echo url_for("/user_admin/items/show.php?id=" . h(u($i['f_id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for("/user_admin/items/edit.php?id=" .  h(u($i['f_id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for("/user_admin/items/delete.php?id=" .  h(u($i['f_id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
      </table>

  </div>

</div>
    
<?php include(SHARED_PATH . "/admin_footer.php"); ?>