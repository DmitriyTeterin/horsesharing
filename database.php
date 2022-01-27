<?php
/**
 * Переводит информацию из таблицы в массив.
 * @param string $path
 * @return array
 */
function csvArray ($path): array {

    if (($file = fopen($path, "r")) !== FALSE) {
        $keys = fgetcsv($file, 1000, ";");
        
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {            
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
    fclose($file);
    return $array;
}

/**
 * Переводит информацию из таблицы в одну строку, далее из строки в массив.
 * @param string $path
 * @return array
 */
function csvString ($path): array{

    $array = explode("\n", file_get_contents($path, true, null, 0));
    $keys = explode(";", $array[0]);
    $num = count($array);
    $cnt = count($keys);
    
    for($i = 1; $i < $num; $i++){
        $res = explode(";", $array[$i]);
       
        for($n = 0; $n < $cnt; $n++){           
            if(is_numeric(trim($res[$n])) === TRUE){
                $resultArr[trim($keys[$n])] = (int)$res[$n];
                }
            else{$resultArr[$keys[$n]] = $res[$n];}       
        }
        $result[$i-1] = $resultArr;
    }
    fclose; 
    return $result;
    
}

/**
 * Читает таблицу построчно и преобразует в массив.
 * @param string $path
 * @return array
 */
function csvFgets ($path): array{

    $file = fopen($path, 'r');
    $a = 0; 

    while(($string = fgets($file)) !== FALSE){        
        $array[$a] = $string;
        $a++;
    }

    $keys = explode(";", $array[0]);
    $num = count($array);
    $cnt = count($keys);

    for($i = 1; $i < $num; $i++){
        $res = explode(";", $array[$i]);
       
        for($n = 0; $n < $cnt; $n++){           
            if(is_numeric(trim($res[$n])) === TRUE){
                $resultArr[trim($keys[$n])] = (int)$res[$n];
                }
            else{$resultArr[$keys[$n]] = $res[$n];}       
        }
        $result[$i-1] = $resultArr;
    }
    fclose($file);
    return $result;

}
/**
 * Читает таблицу построчно и преобразует в массив.
 * @param string $path
 * @return array
 */
function csvFread ($path): array{

    $file = fopen($path, 'r');
    $array = explode("\n" , fread($file,filesize($path)));
    $keys = explode(";", $array[0]);
    $num = count($array);
    $cnt = count($keys);

    for($i = 1; $i < $num; $i++){
        $res = explode(";", $array[$i]);
       
        for($n = 0; $n < $cnt; $n++){           
            if(is_numeric(trim($res[$n])) === TRUE){
                $resultArr[trim($keys[$n])] = (int)$res[$n];
                }
            else{$resultArr[$keys[$n]] = $res[$n];}       
        }
        $result[$i-1] = $resultArr;
    }
    fclose($file);
    return $result;
}

$tariffs = csvArray('./database/tariffs.csv');
$cities = csvString('./database/cities.csv');
$colors = csvFread('./database/colors.csv');
$horses = csvFgets('./database/horses.csv');

