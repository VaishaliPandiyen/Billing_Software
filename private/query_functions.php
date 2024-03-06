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

function all_invoices()
{
    global $db; 

    $q = "SELECT * FROM invoice ";
    // echo $q;

    // $q .= "ORDER BY v_id ASC"; 
    $b = mysqli_query($db, $q); 
    confirm_results($b); 
    return $b;
}

function find_vendor($id)
{
    global $db;

    $q = "SELECT * FROM vendors ";
    // Here, we are using DATA DELIMITER -- '' around the integer v_id. Check "../../explainers.txt DATA DELIMITER"
    $q .= "WHERE v_id='" . esc($db, $id) . "'";

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
    $q .= "WHERE f_id='" . esc($db, $id) . "'";

    $r = mysqli_query($db, $q);
    confirm_results($r);

    $i = mysqli_fetch_assoc($r);
    mysqli_free_result($r);

    return $i;
}

function validate_vendor($vendor)
{

    $errors = [];

    // v_name
    if (is_blank($vendor['v_name'])) {
        $errors[] = "Name cannot be blank.";
    } else if (!has_len($vendor['v_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }
    $id = $vendor['v_id'] ?? 0;
    if (!unique_vendor_name($vendor['v_name'], $id)) {
        $errors[] = "Vendor name must be unique.";
    }

    return $errors;
}

function validate_item($item)
{
    $errors = [];

    // f_name
    if (is_blank($item['f_name'])) {
        $errors[] = "Name cannot be blank.";
    } else if (!has_len($item['f_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    //season
    $season = (string) $item['f_season'];
    if (!arr_includes($season, ["All", "Spring", "Summer", "Autumn", "Winter"])) {
        $errors[] = "Specify a season.";
    }

    // vendor_id
    if (is_blank($item['v_id'])) {
        $errors[] = "Vendor cannot be blank.";
    }

    $check_b_price = validate_decimal($item['b_price;']);
    if ($check_b_price !== true) {
        $errors[] = $check_b_price;
        echo $check_b_price;
    }
    $check_b_quantity = validate_decimal($item['b_quantity;']);
    if ($check_b_quantity !== true) {
        $errors[] = $check_b_quantity;
    }
    ;
    $check_s_price = validate_decimal($item['s_price;']);
    if ($check_s_price !== true) {
        $errors[] = $check_s_price;
    }
    ;

    return $errors;
}

function add_vendor($vendor)
{
    global $db;

    // to have an array of all the errors
    $errors = validate_vendor($vendor);
    if (!empty($errors)) {
        // by using a return here, if this is true, the rest of the code (following lines) will not be executed
        return $errors;
    }

    // Handle form values sent by new.php
    $sql = "INSERT INTO vendors ";
    $sql .= "(v_name) ";
    $sql .= "VALUES (";
    $sql .= "\"" . esc($db, $vendor['v_name']) . "\"";
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
    ;
}

function add_item($item)
{
    global $db;

    $errors = validate_item($item);
    if (!empty($errors)) {
        return $errors;
        // if this is true, following code won't be executed
    }

    $sql = "INSERT INTO items ";
    $sql .= "(f_name, f_season, v_id, b_date, b_price, b_quantity, s_price) ";
    $sql .= "VALUES (";
    $sql .= "\"" . esc($db, $item['f_name']) . "\"";
    $sql .= "\"" . esc($db, $item['f_season']) . "\"";
    $sql .= "\"" . esc($db, $item['v_id']) . "\"";
    $sql .= "\"" . esc($db, $item['b_date']) . "\"";
    $sql .= "\"" . esc($db, $item['b_price']) . "\"";
    $sql .= "\"" . esc($db, $item['b_quantity']) . "\"";
    $sql .= "\"" . esc($db, $item['s_price']) . "\"";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        $new_id = mysqli_insert_id($db);
        redirect(url_for('/user_admin/items/show.php?id=' . $new_id));
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
        db_disconnect($db);
        exit();
    }
    ;
}

function add_invoice($inv, $sales)
{
    global $db;

    // $errors = validate_invoice($inv);
    // if (!empty($errors)) {
    //     return $errors;
    //     // if this is true, following code won't be executed
    // }

    $sql = "INSERT INTO invoice ";
    $sql .= "(i_date, i_mode, i_total) ";
    $sql .= "VALUES (";
    $sql .= "\"" . date('Y-m-d H:i:s') . "\"";
    $sql .= "\"" . esc($db, $inv['i_mode']) . "\"";
    $sql .= "\"" . esc($db, $inv['i_total']) . "\"";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        $new_id = mysqli_insert_id($db);

        // Insert sales
        $success = true;
        foreach ($sales as $s) {
            $item = esc($db, $s['s_item']);
            $quantity = intval($s['s_quantity']);

            $sql_s = "INSERT INTO sale (i_id, s_quantity, s_item) ";
            $sql_s .= "VALUES ($new_id, $quantity, '$item')";

            $result_s = mysqli_query($db, $sql_s);
            if (!$result_s) {
                $success = false;
                break; // If one sale insertion fails, stop and rollback
            }
        } 

        if ($success) {
            // All sales inserted successfully
            redirect(url_for('/user_staff/invoices/show.php?id=' . $new_id));
            return true;
        } else {
            // Rollback invoice insertion
            mysqli_query($db, "DELETE FROM invoice WHERE i_id = $new_id");
            echo "Error inserting sales.";
            db_disconnect($db);
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
        db_disconnect($db);
        exit();
    }
    ;
}
function edit_vendor($vendor)
{
    global $db;

    $errors = validate_vendor($vendor);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE vendors SET ";
    $sql .= "v_name= \"" . esc($db, $vendor['v_name']) . "\" ";
    $sql .= "WHERE v_id='" . esc($db, $vendor['v_id']) . "' ";
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

function edit_item($item)
{
    global $db;

    $errors = validate_item($item);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE items SET";
    $sql .= "f_name = \"" . esc($db, $item["f_name"]) . "\" ";
    $sql .= "f_season = \"" . esc($db, $item["f_season"]) . "\" ";
    $sql .= "v_id = \"" . esc($db, $item["v_id"]) . "\" ";
    $sql .= "b_date = \"" . esc($db, $item["b_date"]) . "\" ";
    $sql .= "b_price = \"" . esc($db, $item["b_price"]) . "\" ";
    $sql .= "b_quantity = \"" . esc($db, $item["b_quantity"]) . "\" ";
    $sql .= "s_price = \"" . esc($db, $item["s_price"]) . "\" ";
    $sql .= "WHERE f_id='" . esc($db, $item['f_id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
        db_disconnect($db);
        exit();
    }
    ;
}

function delete_vendor($id)
{
    global $db;

    $sql = "DELETE FROM vendors ";
    $sql .= "WHERE v_id='" . esc($db, $id) . "' ";
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
    /* 
    FOR LATER: 
    --- THINK: ---
    If vendors are assigned to items, how should we be able to delete the vendor (it's a validation question) 
    */
}



function delete_item($id)
{
    global $db;

    $sql = "DELETE FROM items ";
    $sql .= "WHERE f_id='" . esc($db, $id) . "' ";
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