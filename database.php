<?php
/**
 * Переводит информацию из таблицы в массив.
 * @param string $path
 * @return array
 */
function csvArray ($path):array {

    if (($handle = fopen($path, "r")) !== FALSE) {
        $keys = fgetcsv($handle, 1000, ";");
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            
            $num = count($data);
            $item = [];
            
            for ($c = 0; $c < $num; $c++) {
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

/**
 * Переводит информацию из таблицы в строку, далее из строки в массив.
 * @param string $path
 * @return array
 */
function csvString ($path):array{
    $string = file_get_contents($path, true, null, 0);
    $array = explode("\n", $string);
    $keys []= $array[0];
    $keys = explode(";", $keys[0]);
    $num = count($array);
    $cnt = count($keys);
    
    for($i = 1; $i < $num; $i++){
        $horse = explode(";", $array[$i]);
       
        for($n = 0; $n < $cnt; $n++){
           
            if(is_numeric(trim($horse[$n])) === TRUE){
                $horseArr[trim($keys[$n])] = (int)$horse[$n];
                }
            else{$horseArr[$keys[$n]] = $horse[$n];}       
        }
        $horses[$i-1] = $horseArr;
    }
    fclose;
    return $horses;
    
}




$tariffs = csvArray('./database/tariffs.csv');
$cities = csvString('./database/cities.csv');
$colors = csvString('./database/colors.csv');
$horses = csvString('./database/horses.csv');

