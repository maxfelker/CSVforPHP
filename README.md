CSVforPHP
=========

A very easy PHP class for parsing CSVs. Built around the fgetcsv() php function @ http://php.net/manual/en/function.fgetcsv.php

### Usage (returns array of CSV data)

$csv = CSV::parse("my.csv");

### Setting Delimiter (pipe as example)

$csv = CSV::parse("my.csv","|");

### Setting Delimiter & Enclosure (pipe as delimiter, single quote for enclousre)

$csv = CSV::parse("my.csv","'");