<?php

class Crud
{
    static protected $db;
    static protected $table_name = "";
    static protected $id = "";
    static protected $db_columns = [];
    public $errors = [];

    static public function set_db($db)
    {
        self::$db = $db;
    }

    public function getId()
    {
        return static::$id;
    }

    static protected function find_sql($sql)
    {
        $result = self::$db->query($sql);
        $object_array = [];
        if (!$result) {
            exit ("Database query failed.");
        }
        $instance = new static(); //  creates an instance of the child class dynamically to call the child's instantiate method 
        while ($record = $result->fetch_assoc()) {
            $object_array[] = $instance->instantiate($record);
        }
        $result->free();
        return $object_array;
    }

    static public function find_all()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::find_sql($sql);
    }

    static public function count_all()
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }

    static public function find_one($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE " . static::$id . "='" . self::$db->escape_string($id) . "'";
        $obj_array = static::find_sql($sql);
        if (!empty ($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static public function find_all_by_key($key, $id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE " . $key . "='" . self::$db->escape_string($id) . "'";
        $obj_array = static::find_sql($sql);
        if (!empty ($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    protected function instantiate($record)
    {
        $class_name = get_called_class(); // Get the name of the child class
        $object = new $class_name; // Instantiate the child class. 
        // If we did $object = new static instead, instantiate() being called from the parent class will search for $property in the parent scope when they are defined in the child class! (ex: f_name)
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate()
    {
        $this->errors = [];
        // SPACE FOR CUSTOM VALIDATIONS
        return $this->errors;
    }

    protected function create()
    {
        $this->validate();
        if (!empty ($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        // making a string out of the array:
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        echo $sql;
        $result = self::$db->query($sql);
        if ($result) {
            static::$id = self::$db->insert_id;
        }
        return $result;
    }

    // In update & delete, ID isn't passed in as the methods are called on specific records' objects. ID is accessed directly from the object's properties. 
    protected function update()
    {
        $this->validate();
        if (!empty ($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= "WHERE " . static::$id . "='" . self::$db->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$db->query($sql);
        return $result;
    }

    public function save()
    {
        if (isset ($this->id)) {
            return $this->update();
        } else {
            // A new record will not have an ID yet
            return $this->create();
        }
    }

    // to update the existing value with form values:
    public function merge_attributes($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Properties with db columns (excluding ID):--
    // Created for dynamically adding key and value during CRUD ops
    public function attributes()
    {
        $attributes = [];
        // loop through all columns
        foreach (static::$db_columns as $column) {
            // since db_colums have id but we don't need to CRUD 'em
            if ($column == static::$id) {
                continue; // skips id
            }
            // sets the associative array's keys using db_column's values
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // esc fn for input values:--
    protected function sanitized_attributes()
    {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function delete($d_id)
    {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE " . static::$id . "='" . self::$db->escape_string($d_id) . "' ";
        $sql .= "LIMIT 1";
        echo $sql;
        $result = self::$db->query($sql);
        return $result;

        // After deleting, the instance of the object will still exist, even though the database record does not. 
        // This can be useful, as in: echo $user->first_name . " was deleted."; 
        // but, for example, we can't call $user->update() after calling $user->delete().
    }

}