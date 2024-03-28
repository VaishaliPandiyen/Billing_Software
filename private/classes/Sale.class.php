<?php

class Sale extends Crud
{
    static protected $table_name = 'sale';
    static protected $db_columns = ['s_id', 'i_id', 's_quantity', 's_item', 's_value'];

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
        $this->s_value = $args['s_value'] ?? $this->calculateSaleValue($args['s_item'], $args['s_quantity']);
    }
    private function calculateSaleValue($item, $quantity) {
        // You need to fetch the price of the selected fruit based on $item from your data source
        // Assuming $items is your data source
        global $items;
        $selected_fruit = null;
        foreach ($items as $fruit) {
            if ($fruit->f_name === $item) {
                $selected_fruit = $fruit;
                break;
            }
        }
        if ($selected_fruit) {
            // Calculate the sale value based on the price of the selected fruit and the quantity
            return $selected_fruit->s_price * $quantity;
        } else {
            return '';
        }
    }
}