<?php
// Include database connection and all_items function
require_once 'initialise.php';

// Fetch items from database
$items = all_items();
$data = [];
while ($item = mysqli_fetch_assoc($items)) {
    $data[] = $item;
}
// Free the result set
mysqli_free_result($items); 

// Send items data as JSON response
header('Content-Type: application/json');
echo json_encode($data);