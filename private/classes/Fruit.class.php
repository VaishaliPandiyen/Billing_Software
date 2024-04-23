<?php

class Fruit extends Crud
{
    static protected $table_name = 'items';
    static protected $db_columns = ['f_id', 'f_name', 'f_season', 's_price'];

    static protected $id = 'f_id';
    public $f_id;
    public $f_name;
    public $f_season;
    // public $v_id;
    // public $b_date;
    // public $b_price;
    // public $b_quantity;
    public $s_price;
    // public $s_profit;

    public const SEASONS = ['All', 'Spring', 'Summer', 'Autumn', 'Winter'];

    // protected function create()
    // {
    //     // Calculate profit before calling parent create method
    //     $this->set_profit();
    //     return parent::create();
    // }
    // public function update()
    // {
    //     $this->set_profit();
    //     return parent::update();
    // }
    // protected function set_profit()
    // {
    //     $sp = $this->s_price;
    //     $bp = $this->b_price;
    //     $this->s_profit = round(($sp - $bp) / $sp * 100, 2);
    //     return $this->s_profit;
    // }

    // This is what we'll use to take the values in from the forms
    public function __construct($args = [])
    {
        $this->f_id = static::$id;
        $this->f_name = $args['f_name'] ?? '';
        $this->f_season = $args['f_season'] ?? '';
        // $this->v_id = $args['v_id'] ?? '';
        // $this->b_date = $args['b_date'] ?? '';
        // $this->b_price = $args['b_price'] ?? '';
        // $this->b_quantity = $args['b_quantity'] ?? '';
        $this->s_price = $args['s_price'] ?? '';
    }
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->f_name)) {
            $this->errors[] = "Name cannot be blank.";
        }
        // if (is_blank($this->b_price)) {
        //     $this->errors[] = "Model cannot be blank.";
        // }
        return $this->errors;
    }

    // public function decrease_quantity($quantity) {
    //     $this->b_quantity = floatval($this->b_quantity) - floatval($quantity);
    //     if ($this->b_quantity < 0) {
    //       $this->errors[] = "Error: Insufficient quantity in stock.";
    //       return false; // Indicate an error if quantity goes negative
    //     }
    //     $update_result = $this->update_quantity($quantity);
    //     return $update_result;
    //   }
      
    //   private function update_quantity($quantity) {
    //     $sql = "UPDATE " . static::$table_name . " SET ";
    //     $sql .= "b_quantity = b_quantity - '" . self::$db->escape_string($quantity) . "' ";
    //     $sql .= "WHERE " . static::$id . "='" . self::$db->escape_string($this->id) . "' ";
    //     $sql .= "LIMIT 1";
    //     $result = self::$db->query($sql);
    //     return $result;
    //   }
      
}