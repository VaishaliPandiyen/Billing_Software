<?php

class Fruit extends Crud
{

    static protected $table_name = 'items';
    static protected $db_columns = ['f_id', 'f_name', 'f_season', 'v_id', 'b_date', 'b_price', 'b_quantity', 's_price', 's_profit'];

    static protected $id = 'f_id';
    public $f_name;
    public $f_season;
    public $v_id;
    public $b_date;
    public $b_price;
    public $b_quantity;
    public $s_price;
    public $s_profit;

    public const SEASONS = ['All', 'Spring', 'Summer', 'Autumn', 'Winter'];

    protected function instantiate($record)
    {
        $object = new self();
        $object->f_id = $record['f_id'] ?? '';
        $object->f_name = $record['f_name'] ?? '';
        $object->f_season = $record['f_season'] ?? '';
        $object->v_id = $record['v_id'] ?? '';
        $object->b_date = $record['b_date'] ?? '';
        $object->b_price = (float) ($record['b_price'] ?? 0);
        $object->b_quantity = $record['b_quantity'] ?? '';
        $object->s_price = (float) ($record['s_price'] ?? 0);
        $object->s_profit = self::set_profit($object->s_price, $object->b_price);
        return $object;
    }


    static protected function set_profit($sp, $bp)
    {
        return round(($sp - $bp) / $sp * 100, 2);

    }
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->f_name)) {
            $this->errors[] = "Name cannot be blank.";
        }
        if (is_blank($this->b_price)) {
            $this->errors[] = "Model cannot be blank.";
        }
        return $this->errors;
    }
}