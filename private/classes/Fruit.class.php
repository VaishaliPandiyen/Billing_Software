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
        $object->b_price = $record['b_price'] ?? 0;
        $object->b_quantity = $record['b_quantity'] ?? '';
        $object->s_price = $record['s_price'] ?? 0;
        $object->s_profit = $record['s_profit'];
        return $object;
    }

    public function getId() {
        return $this->id;
    }
    protected function create()
    {
        // Calculate profit before calling parent create method
        $this->set_profit();
        return parent::create();
    }
    protected function update()
    {
        $this->set_profit();
        return parent::update();
    }
    protected function set_profit()
    {
        $sp = $this->s_price;
        $bp = $this->b_price;
        $this->s_profit = round(($sp - $bp) / $sp * 100, 2);
        return $this->s_profit;
    }

    // This is what we'll use to take the values in from the forms
    public function __construct($args = [])
    {
        $this->f_name = $args['f_name'] ?? '';
        $this->f_season = $args['f_season'] ?? '';
        $this->v_id = $args['v_id'] ?? '';
        $this->b_date = $args['b_date'] ?? '';
        $this->b_price = $args['b_price'] ?? '';
        $this->b_quantity = $args['b_quantity'] ?? '';
        $this->s_price = $args['s_price'] ?? '';
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