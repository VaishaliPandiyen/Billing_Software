<?php

class Vendor
{
    var $name;
    var $location;
    var $items = [];

    function say_name() {
        return 'Vendor name is '. $this->name;
    }

    function add_items($arr) {
        foreach ($arr as $item) {
            $this->items[] = $item;
        }
        return $this->items;
    }

}