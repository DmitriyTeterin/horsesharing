<?php
include 'database.php';
include 'functionFilter.php';
include 'functionFindByItem.php';
include 'functionReceiveHorseInfo.php';

/**
 * @return string
 * Проверяет есть ли GET запрос, если да то фильтрует по заданным параметрам и выводит на экран.
 */
global $horses;

function request(array $getArray)
{
    global $horses;
    if (empty($_GET) == true) {
        foreach ($horses as $horse) {
            echo receiveHorseInfo($horse);
        }
    } else {
        $keysGetArray = array_keys($getArray);
        $file = fopen('./database/horses.csv', "r");
        $keysHorsesArray = fgetcsv($file, 1000, ";");
        fclose($file);
        $count = count($keysGetArray);

        for ($i = 0; $i < $count; $i++) {
            if (in_array($keysGetArray[$i], $keysHorsesArray)) {
                $key = $keysGetArray[$i];
                $value = $getArray[$key];
                $value = is_numeric($value) == true ? (int)$value : $value;
                $horses = filter($horses, $key, $value);
            }
        }

        if (empty($horses) == false) {
            foreach ($horses as $horse) {
                echo receiveHorseInfo($horse);
            }
        } else {
            echo "По вашему запросу лошадей не найдено.";
        }
    }
}