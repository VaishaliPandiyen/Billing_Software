<?php

class Bicycle
{
    public const CATEGORIES = ['road', 'mountain', 'hybrid', 'cruiser', 'city', 'city', 'BMX'];
    public const GENDERS = ['men', 'women', 'unisex'];

    protected const CONDITION_OPTIONS = [1 => "Beat up", 2 => "Decent", 3 => "Good", 4 => "Greater", 5 => "Like New"];

    protected $brand;
    protected $model;
    protected $year;
    protected $category;
    protected $colour;
    protected $description;
    protected $gender;
    protected $price;
    protected $wt_kg;
    protected $condition_id;

    public function __construct($args = [])
    {
        $this->brand = $args['brand'] ?? '';
        $this->model = $args['model'] ?? '';
        $this->year = $args['year'] ?? '';
        $this->category = $args['category'] ?? '';
        $this->colour = $args['colour'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->gender = $args['gender'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->wt_kg = $args['wt_kg'] ?? 0.0;
        $this->condition_id = $args['condition_id'] ?? 3;

        /* 
        SIMPLE, BUT LACKS ERROR VALIDATION & EASY ACCESS TO PVT VARIABLES: 
        */
        // foreach($args as $k => $v) {
        //     if (property_exists($this, $k)) {
        //         $this->$k = $v;
        //     }
        // }
    }

    public function get_wt_kg()
    {
        return number_format($this->wt_kg, 2) . "kg";
    }
    public function set_wt_kg($v)
    {
        return $this->wt_kg = floatval($v);
    }
    public function get_wt_lb()
    {
        $wt_lb = floatval($this->wt_kg) * 2.2046226218;
        return number_format($wt_lb, 2) . "lbs";
    }
    public function set_wt_lb($v)
    {
        $this->wt_kg = floatval($v) / 2.2046226218;
    }

    public function condition()
    {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }

    }
}