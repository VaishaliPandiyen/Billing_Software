<?php 

require_once('db_credentials.php');

// this will be used or called in initialise.php
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3300);
    /* !IMPORTANT:
    Since my local system config uses custom port 3300 instead of default 3306, I updated it in my.ini in MAMP and added it here too.
    I did this when installing MySQL on this device as 306 wasn't available
    */ 
    confirm_connection();
    return $connection;
}
// this will be used or called in admin_footer.php
function db_disconnect($connection) {
    if(isset($connection) && is_object($connection) && get_class($connection) === 'mysqli') {
        mysqli_close($connection);
    }
}   

function confirm_connection() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
      }
}

function confirm_results($results) { 
    if (!$results) {
        exit("Database query failed.");
    }
}