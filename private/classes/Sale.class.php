<?php

class Sale extends Crud
{
    static protected $table_name = 'sale';
    static protected $db_columns = ['s_id', 'i_id', 's_quantity', 's_item', 's_value'
];

    static protected $id = 's_id';

    public $i_id;
    public $s_quantity;
    public $s_item;
    public $s_value;

    // This is what we'll use to take the values in from the forms
    public function __construct($args = [])
    {
        $this->s_id = static::$id;
        $this->i_id = $args['i_id'] ?? '';
        $this->s_quantity = $args['s_quantity'] ?? '';
        $this->s_item = $args['s_item'] ?? '';
        $this->s_value = $args['s_value'] ?? '';
    }
}