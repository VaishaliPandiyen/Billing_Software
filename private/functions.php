<?php
// Generates a complete URL based on the provided script path.

// @param string $script_path The path to the script or resource
// @return string The complete URL

function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    // Combine the root URL and the script path to form the complete URL
    return WWW_ROOT . $script_path;
}


// shortcuts for urlencode and rawurlencode:
function u($string = "")
{
    return urlencode($string);
}
function ru($string = "")
{
    return rawurlencode($string);
}

// this shortcut for htmlspecialchars is used to escape special characters and prevent XSS attacks
function h($string = "")
{
    return htmlspecialchars($string);
}

/* 

HEADER ERRORS 

*/

function error_404()
{
    // header("HTTP/1.1 404 Page Not Found");
    /* not hardcoding HTTP/1.1 since the protocol could change */
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Page Not Found");
    // We could render our 404 page here, but for now we'll just display a generic error message
    exit();
}

function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
    exit();
}

function redirect($location)
{
    header("Location: " . $location);
    exit();
}