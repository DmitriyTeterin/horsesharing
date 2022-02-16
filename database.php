<?php
include 'functionReformatArray.php';

/**
 * Переводит информацию из таблицы в массив.
 * @param string $path
 * @return array
 */
function csvArray(string $path): array
{
    $array = [];
    if (($file = fopen($path, "r")) !== false) {
        $keys = fgetcsv($file, 1000, ";");

        while (($data = fgetcsv($file, 1000, ";")) !== false) {
            $num = count($data);
            $item = [];

            for ($c = 0; $c < $num; $c++) {
                $a = $keys[$c];
                $item[$a] = is_numeric($data[$c]) === true ? (int)$data[$c] : $data[$c];
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
function csvString(string $path): array
{
    $array = explode("\n", file_get_contents($path, true, null, 0));
    return reformatArray($array);
}

/**
 * Читает таблицу построчно и преобразует в массив.
 * @param string $path
 * @return array
 */
function csvGets(string $path): array
{
    $file = fopen($path, 'r');
    $a = 0;
    $array = [];
    while (($string = fgets($file)) !== false) {
        $array[$a] = $string;
        $a++;
    }

    fclose($file);
    return reformatArray($array);

}

/**
 * Читает таблицу построчно и преобразует в массив.
 * @param string $path
 * @return array
 */
function csvRead(string $path): array
{
    $file = fopen($path, 'r');
    $array = explode("\n", fread($file, filesize($path)));
    fclose($file);
    return reformatArray($array);
}

$tariffs = csvArray('./database/tariffs.csv');
$cities = csvString('./database/cities.csv');
$colors = csvRead('./database/colors.csv');
$horses = csvGets('./database/horses.csv');

