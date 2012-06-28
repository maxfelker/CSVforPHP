CSVforPHP
=========

A very easy PHP class for parsing CSVs. Built around the fgetcsv() php function @ http://php.net/manual/en/function.fgetcsv.php

### Usage (returns array of CSV data)

$csv = CSV::parse("my.csv");

### Setting Delimiter (pipe as example)

$csv = CSV::parse("my.csv","|");

### Setting Delimiter & Enclosure (pipe as delimiter, single quote for enclousre)

$csv = CSV::parse("my.csv","'");

### Output

$csv = array (

    [line_count] => 3,
    
    [line_length] => 3,
    
    [headers] => array (
    
            [0] => my_header
            
    ),
    
    [rows] => array (
  
            [1] => Array
                (
                    [my_header] => 1403890
                )

            [2] => Array
                (
                    [my_header] => 1403552
                )

            [3] => Array
                (
                    [my_header] => 1398709
                )
     )
);
          
