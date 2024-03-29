<?php

class Invoice extends Crud
{
    static protected $table_name = 'invoice';
    static protected $db_columns = ['i_id', 'i_date', 'i_mode', 'i_total'];
    static protected $id = 'i_id';

    public $i_id; // Change this from protected to public to access while saving each sale
    public $i_date;
    public $i_mode;
    public $i_total;

    public const MODE = ["Cash", "Debit Card", "Credit Card", "Paytm", "Other"];

    // This is what we'll use to take the values in from the forms
    public function __construct($args = [])
    {
        $this->i_id = static::$id;
        $this->i_date = $args['i_date'] ?? '';
        $this->i_mode = $args['i_mode'] ?? '';
        $this->i_total = $args['i_total'] ?? '';
    }
}