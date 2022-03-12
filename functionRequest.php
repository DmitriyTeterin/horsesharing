<?php
include 'database.php';
include 'functionFilter.php';
include 'functionFindByItem.php';

/**
 * Проверяет есть ли параметры в GET запросе.
 * @param array $GET
 * @return bool
 */
function checkEmptyRequest(array $GET): bool
{
    return empty($GET);
}

/**
 * Ищет в GET запросе параметры схожие с параметрами из списка лошадей.
 * @param array $getArray
 * @return array
 */
function checkRequestParameters(array $getArray): array
{
    $file = fopen('./database/horses.csv', "r");
    $keysHorsesArray = fgetcsv($file, 1000, ";");
    fclose($file);
    $count = count($keysHorsesArray);
    $resultArray = [];

    for ($i = 0; $i < $count; $i++) {
        $searchKey = $keysHorsesArray[$i];
        $keysGetArray = array_key_exists($searchKey, $getArray);

        if ($keysGetArray) {
            $resultArray[$searchKey] = $getArray[$searchKey];
        }
    }

    return $resultArray;
}

/**
 * Фильтрует список лошадей по найденным в GET запросе параметрам и выводит на экран.
 * @param array $getArray
 * @return array
 */
function filteringByGetRequest(array $getArray): array
{
    global $horses;

    foreach ($getArray as $key => $value) {

        $value = is_numeric($value) == true ? (int)$value : $value;
        $horses = filter($horses, $key, $value);

    }
    return $horses;
}
