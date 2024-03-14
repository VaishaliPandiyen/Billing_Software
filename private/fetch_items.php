<?php
// Include database connection and all_items function
require_once 'initialise.php';

// Fetch items from database
$items = all_items();
$data = [];
while ($item = $items->fetch_assoc()) {
    $data[] = $item;
}
// Free the result set
$items->free(); 

// Send items data as JSON response
header('Content-Type: application/json');
echo json_encode($data);