<?php

// phpinfo();

require_once("../private/initialise.php");
// include(SHARED_PATH . '/admin_header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p>Coming soon... <br><?php
    $name = "Vaishali";
    $welcome = "is working on a new billing software project for per portfolio. It now uses PHP and MySQL. ";
    $output = $name . "  " . $welcome;
    echo $output; ?></p>
</body>
</html>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>