<?php
function all_vendors()
{
    global $db; // we need to bring it from outside the scope of this function, as it's not passed as an argument.

    $q = "SELECT * FROM vendors "; // the space at the end is important to concatenate

    // echo $q;

    // $q .= "ORDER BY v_id ASC"; // this is SQLv8 concatenation
    $v = mysqli_query($db, $q); //the $db is from initialise.php where we opened the database connection
    confirm_results($v); // function defined in database.php to handle no results due to MySQL query errors
    return $v;
}

function all_items()
{
    global $db;

    $q = "SELECT * FROM items ";
    // echo $q;

    // $q .= "ORDER BY v_id ASC"; 
    $i = mysqli_query($db, $q);
    confirm_results($i);
    return $i;
}

function find_vendor($id)
{
    global $db;

    $q = "SELECT * FROM vendors ";
    $q .= "WHERE v_id='" . $id . "'";

    $r = mysqli_query($db, $q);
    confirm_results($r);

    // to extract the $r into an array:
    $v = mysqli_fetch_assoc($r);

    mysqli_free_result($r); // now that we have the array, we can free up the memory:
    return $v; // Return the vendor data
}

function find_item($id)
{
    global $db;

    $q = "SELECT * FROM items ";
    $q .= "WHERE f_id='" . $id . "'";

    $r = mysqli_query($db, $q);

    confirm_results($r);

    $i = mysqli_fetch_assoc($r);
    mysqli_free_result($r);

    return $i;
}

function add_vendor($vendor)
{
    global $db;
    $name = $vendor['v_name'];
    if (is_post() && !$name == "") {
        // Handle form values sent by new.php
        $sql = "INSERT INTO vendors ";
        $sql .= "(v_name) ";
        $sql .= "VALUES (";
        $sql .= "\"" . $name . "\"";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if ($result) {
            $new_id = mysqli_insert_id($db);
            redirect(url_for('/user_admin/vendors/show.php?id=' . $new_id));
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }
    ;
}

function edit_vendor($vendor)
{
    global $db;

    $sql = "UPDATE vendors SET ";
    $sql .= "v_name= \"" . $vendor['v_name'] . "\" ";
    $sql .= "WHERE v_id='" . $vendor['v_id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // for update, result is true if successful
    if ($result) {
        return true;
    } else {
        mysqli_error($db);
        db_disconnect($db);
        exit();
    }
}

function delete_vendor($id)
{
    global $db;

    $sql = "DELETE FROM vendors ";
    $sql .= "WHERE v_id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


function per_item_profit($i)
{
    return round(($i['s_price'] - $i['b_price']) / ($i['s_price']) * 100, 2);
}
;