<?php
include 'database.php';
include 'functionFilter.php';
include 'functionFindByItem.php';
include 'functionReceiveHorseInfo.php';
/**
 * Проверяет есть ли параметры в GET запросе.
 * @param array $GET
 * @return bool
 */
function checkEmptyRequest(array $GET): bool
{
    if (empty($GET)) {
        $result = true;
    } else $result = false;

    return $result;
}

/**
 * Ищет в GET запросе параметры схожие с параметрами из списка лошадей.
 * @param $getArray
 * @return array
 */
function checkingRequestParameters($getArray): array
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
    if (empty($resultArray)) {
        echo 'Вы ввели несуществующие параметры фильтрации';
    }
    return $resultArray;
}

/**
 * Фильтрует список лошадей по найденным в GET запросе параметрам.
 * @param array $getArray
 * @return void
 */
function filteringByGetRequest(array $getArray)
{
    global $horses;
    $count = count($getArray);
    $keyArray = array_keys($getArray);

    for ($i = 0; $i < $count; $i++) {
        $key = $keyArray[$i];
        $value = $getArray[$key];

        $value = is_numeric($value) == true ? (int)$value : $value;
        $horses = filter($horses, $key, $value);
    }

    if (empty($horses) == false) {
        foreach ($horses as $horse) {
            echo receiveHorseInfo($horse);
        }
    } else {
        echo "По вашему запросу лошадей не найдено.";
    }
}
