<?php

function csvArray ($path):array {

    if (($handle = fopen($path, "r")) !== FALSE) {
        $keys = fgetcsv($handle, 1000, ";");
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            
            $num = count($data);
            $item = [];
            
            for ($c=0; $c < $num; $c++) {
                if(is_numeric($data[$c]) === TRUE){
                   $item[$keys[$c]] = (int)$data[$c];
               }
               else{$item[$keys[$c]] = $data[$c];}
           }
            $array[] = $item;        
        }
    }
    fclose;
    return $array;
}

$tariffs = csvArray('./database/tariffs.csv');
$cities = csvArray('./database/cities.csv');
$colors = csvArray('./database/colors.csv');
$horses = csvArray('./database/horses.csv');
var_dump($tariffs);