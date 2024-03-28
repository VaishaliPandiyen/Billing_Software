<?php
/* 
All actions necessary to log in a user
*/

function log_in($user)
{
    // Renerating the ID to protect user from session fixation (what is it??)
    session_regenerate_id();
    $_SESSION['user_id'] = $user['u_id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $user['username'];
    $_SESSION['type'] = $user['user_type'];
    return true;
}
;
function log_out()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    unset($_SESSION['type']);
    // session_destroy(); // optional: destroys the whole session
    return true;
}


// To determine if a request should be considered a "logged in" request:
// [Example: display one link if an admin is logged in]
function is_logged_in()
{
    // user_id purpose: indicates the user is logged in & tells which admin for looking up their record.
    return isset($_SESSION['user_id']);
}

// Call require_login() at the top of any page which needs user to be logged-in before granting acccess to the page.
function require_login()
{
    if (!is_logged_in()) {
        redirect(url_for('/user_admin/login.php'));
    } else {
        // Do nothing, let the rest of the page proceed
    }
}

