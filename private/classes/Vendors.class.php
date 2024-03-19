<?php

class Vendor extends Crud
{
    static protected $table_name = 'vendors';
    static protected $db_columns = ['v_id', 'v_name'];

    static protected $id = 'v_id';

    public $v_name;

    public function __construct($args = [])
    {
        $this->v_id = $this->id;
        $this->v_name = $args['v_name'] ?? '';
    }
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->v_name)) {
            $this->errors[] = "Name cannot be blank.";
        }
        return $this->errors;
    }
}