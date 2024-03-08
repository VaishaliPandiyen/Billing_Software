<?php

// USING THEM IN QUERY_FUNCTIONS DEFINER
function is_blank($val)
{
    // trim(): so empty spaces don't count
    // === to avoid false positives
    // empty() considers "0" to be empty
    return !isset($val) || trim($val) === '';
}
function has_val($val)
{
    return !is_blank($val);
}

function has_gt_len($val, $min)
{
    $len = strlen(trim($val));
    return $len > $min;
}

function has_lt_len($val, $max)
{
    $len = strlen(trim($val));
    return $len < $max;
}

function has_exact_len($val, $exact)
{
    $len = strlen($val);
    return $len == $exact;
}

// has_len('abcd', ['min' => 3, 'max' => 5])
function has_len($val, $opt)
{
    if (isset($opt['min']) && !has_gt_len($val, $opt['min'] - 1)) {
        return false;
    } elseif (isset($opt['max']) && !has_lt_len($val, $opt['max'] + 1)) {
        return false;
    } elseif (isset($opt['exact']) && !has_exact_len($val, $opt['exact'])) {
        return false;
    } else {
        return true;
    }
}

// arr_includes( 5, [1,3,5,7,9] )
function arr_includes($val, $set)
{
    return in_array($val, $set);
}

// arr_excludes( 5, [1,3,5,7,9] )
function arr_excludes($val, $set)
{
    return !in_array($val, $set);
}

// str_includes('nobody@nowhere.com', '.com')
// validate inclusion of character(s)
// strpos returns string start position or false
// uses !== to prevent position 0 from being considered false
// strpos is faster than preg_match()
function str_includes($val, $required_string)
{
    return strpos($val, $required_string) !== false;
}

// format: [chars]@[chars].[2+ letters]
// returns 1 for a match, 0 for no match
// http://php.net/manual/en/function.preg-match.php
function valid_email($val)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $val) === 1;
}

// default id is for new vendor. for existing vendor, pass in the id of the vendor.
function unique_vendor_name($v_name, $id = "0")
{
    global $db;

    $sql = "SELECT * FROM vendors ";
    $sql .= "WHERE v_name='" . esc($db, $v_name) . "' ";
    $sql .= "AND id != '" . esc($db, $id) . "'";

    $page_set = mysqli_query($db, $sql);
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);

    return $page_count === 0;
}

// for login:
function unique_username($username, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . esc($db, $username) . "' ";
    $sql .= "AND id != '" . esc($db, $current_id) . "'";

    $r = mysqli_query($db, $sql);
    $user_count = mysqli_num_rows($r);
    mysqli_free_result($r);

    return $user_count === 0;
  }


// Function to validate decimal input
function validate_decimal($input)
{
    if (!is_numeric($input)) {
        return "Input must be a number.";
    }

    // Check if the input is a decimal number
    if (!preg_match('/^\d+(\.\d+)?$/', $input)) {
        return "Input must be a decimal number.";
    }

    // Convert input to float
    $input_float = (float) $input;

    // Check if the input is within the desired range
    if ($input_float <= 0) {
        return "Number must be greater than zero.";
    }
    if ($input_float > 999) {
        return "Number must be less than 999.";
    }

    // Validation passed
    return true;
}