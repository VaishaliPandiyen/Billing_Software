<?php

// After <tr> and <th>s,...:

$bike_array = [];

?>
      <?php foreach ($bike_array as $args) { 
        $bike = new Bicycle($args); ?>
          <tr>
            <td><?php echo h($bike->brand); ?></td>
            <td><?php echo h($bike->model); ?></td>
            <td><?php echo h($bike->year); ?></td>
            <td><?php echo h($bike->category); ?></td>
            <td><?php echo h($bike->gender); ?></td>
            <td><?php echo h($bike->colour); ?></td>
            <td><?php echo h($bike->get_wt_kg()) . ' / ' . h($bike->get_wt_lb()); ?></td>
            <td><?php echo h($bike->condition()); ?></td>
            <td><?php echo h('$'. $bike->price); ?></td>
          </tr>
      <?php } ?>

    </table>
  </div>
