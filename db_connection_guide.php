<?php

/* 

5 fundamental steps of database interaction using PHP: 

*/

// Credentials
$dbhost = 'localhost';
$dbuser = 'username';
$dbpass = 'secretpassword';
$dbname = 'dbname';

// 1. Create a database connection
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Test if connection succeeded
if(mysqli_connect_errno()) {
  $msg = "Database connection failed: ";
  $msg .= mysqli_connect_error();
  $msg .= " (" . mysqli_connect_errno() . ")";
  exit($msg);
}

// 2. Perform database query
$query = "SELECT * FROM tablename";
$result_set = $connection->query($query);

// Test if query succeeded
if (!$result_set) {
	exit("Database query failed.");
}

// 3. Use returned data (if any)
while($table = $result_set->fetch_assoc()) {
  echo $table["key_x"] . "<br />";
}

// 4. Release returned data
$result_set->free();

// 5. Close database connection
mysqli_close($connection);
