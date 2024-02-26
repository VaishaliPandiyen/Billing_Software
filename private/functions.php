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
