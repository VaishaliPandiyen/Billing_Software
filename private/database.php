<?php 

require_once('db_credentials.php');

// this will be used or called in initialise.php
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3300);
    /* !IMPORTANT:
    Since my local system config uses custom port 3300 instead of default 3306, I updated it in my.ini in MAMP and added it here too*/ 
    return $connection;
}
// this will be used or called in admin_footer.php
function db_disconnect($connection) {
    if(isset($connection) && is_object($connection) && get_class($connection) === 'mysqli') {
        mysqli_close($connection);
    }
}   