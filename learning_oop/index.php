<!-- Some rules:
camelCase class names and make it singular 
[names can be case insensitive when referring]
-->

<?php

require_once("vendor_class.php");

get_declared_classes(); // this gives us an array of declared classes (and built-in ones)

class_exists(''); // whether a class is in that array

// USING THE VENDOR CLASS HERE:

$vendor1 = new Vendor;

$vendor1->name = 'Anna';

echo get_class($vendor1). "<br/>"; // this gives us the name of the defined class i.e. Vendor here

echo is_a($vendor1, 'Vendor'). "<br/>"; // whether the instance is made of a Vendor class or not

print_r(get_class_vars('Vendor')); // this gives us the variables for the defined class i.e. Vendor here
//get_class_methods('Vendor'); gives methods/functions for Vendor
echo "<br/>";

print_r(get_object_vars($vendor1)). "<br/>"; // this gives us the set of variables for object/instance i.e. vendor1 here
echo "<br/>";

if (property_exists('Vendor', 'first_name')) {
}// method_exists('Vendor', 'say_name')

$vendor1->say_name();

$vendor1->location = "Canton, Cardiff";

print_r($vendor1->add_items(['Lemon', 'Apple', 'Plums']));
