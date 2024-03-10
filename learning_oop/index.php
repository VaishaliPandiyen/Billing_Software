<!-- Some rules:
camelCase class names and make it singular 
[names can be case insensitive when referring]
-->

<?php

get_declared_classes(); // this gives us an array of declared classes (and built-in ones)

class_exists(''); // whether a class is in that array

// USING THE VENDOR CLASS HERE:

$vendor1 = new Vendor;

$vendor1->name = 'Anna';

get_class($vendor1); // this gives us the name of the defined class i.e. Vendor here

is_array($vendor1, 'Vendor'); // whether the instance is made of a Vendor class or not

get_class_vars('Vendor'); // this gives us the variables for the defined class i.e. Vendor here

get_object_vars($vendor1); // this gives us the set of variables for object/instance i.e. vendor1 here

if (property_exists('Vendor', 'first_name')) {
}