<?php
// Output buffering is enabled because... <add reason>      
ob_start();

session_start(); // Turn on sessions


// Defining file paths for easier file manipulation:

// PRIVATE_PATH: Parent directory of this file
define("PRIVATE_PATH", dirname(__FILE__));
// PROJECT_PATH: Parent directory of the private directory
define("PROJECT_PATH", dirname(PRIVATE_PATH));
// PUBLIC_PATH: Public directory within the project
define("PUBLIC_PATH", PROJECT_PATH . '/public');
// SHARED_PATH: Shared directory within the private directory
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Define the root URL for the project: (when we use modular code from different levels and layers of file folders, relative paths won't work)
// * Do not include the domain | * Use the same document root as the webserver
// * You can hardcode the value: define("WWW_ROOT", '/billing_software/public'); (or) define("WWW_ROOT", ''); in production machine 

// * Or dynamically find everything in the URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7; // Looks for "/public" in the URL and figures it as the document root
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end); // Extract everything up to that point
define("WWW_ROOT", $doc_root); // we can now use WWW_ROOT on all our pages as the root of the website, irrespective of where the root directory is wrt the machine/server

require_once("functions.php");
require_once("query_functions.php");
require_once("validation.php");
require_once("auth_users.php");


// LOADING ALL CLASSES & AUTOLOAD:

// here, * is a wildcard character. Using glob, we can get all the files in the classes directory
foreach (glob("classes/*.class.php") as $f) {
    require_once($f);
}
function my_autoload($class)
{
    if (preg_match('/\A\w+\Z/', $class)) {
        include('classes/' . $class . ".class.php");
    }
}
spl_autoload_register("my_autoload");

// END OF LOADING CLASSES


require_once("database.php");