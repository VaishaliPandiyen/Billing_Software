<?php

require_once('db_credentials.php');

// this will be used or called in initialise.php
function db_connect()
{
    /* !IMPORTANT:
    Since my local system config uses custom port 3300 instead of default 3306, I updated it in my.ini in MAMP and added it here too.
    I did this when installing MySQL on this device as 306 wasn't available
    */
    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3300);
    confirm_connection($connection);
    return $connection;
}
// this will be used or called in admin_footer.php
function db_disconnect($connection)
{
    if (isset($connection) && is_object($connection) && get_class($connection) === 'mysqli') {
        $connection->close();
    }
}

function confirm_connection($connection)
{
    if ($connection->connect_errno) {
        $msg = "Database connection failed: ";
        $msg .= $connection->connect_error;
        $msg .= " (" . $connection->connect_errno . ")";
        exit($msg);
    }
}

function confirm_results($results)
{
    if (!$results) {
        exit("Database query failed.");
    }
}

// IMPORTANT : Add this function to all input fields and URL parameters!!!
// Short: Search wherever there are mysqli_query() and implement esc() in their variable/input fields
function esc($db, $str)
{
    // this is used to escape SQL injection (like HTML escaping)
    return $db->escape_string($str);
}
$db = db_connect();
Fruit::set_db($db);
Vendor::set_db($db);
User::set_db($db);
// closing the connection happens in the admin_footer.php file