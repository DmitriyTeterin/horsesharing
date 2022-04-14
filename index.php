<?php

include 'functionGetRequest.php';
include 'functionOutputHorseInfo.php';
include "insert.php";

const BASE_MULTIPLIER = 1;
global $horses;

$checkEmptyGet = checkEmptyRequest($_GET);
$checkEmptyPost = checkEmptyRequest($_POST);

if ($checkEmptyGet and $checkEmptyPost) {
    outputHorseInfo($horses);
    die;
}

if (!$checkEmptyGet) {
    $getArray = checkRequestParameters($_GET);

    if (empty($getArray)) {
        echo 'Вы ввели несуществующие параметры фильтрации';
        die;
    }

    $result = filteringByGetRequest($getArray);


    if (empty($result)) {

        echo "По вашему запросу лошадей не найдено.";
    } else {
        outputHorseInfo($result);
    }
}

if (!$checkEmptyPost) {
    $checkFile = checkFile($_POST);

    if ($checkFile) {
        $postKeysArray = getPOSTKeys($_POST);
        $postKeysArray = array_diff($postKeysArray, ['action']);
        $fileKeysArray = getFileKeys($_POST);
        $missingKeys = array_diff($fileKeysArray, $postKeysArray);
        $excessKeys = array_diff($postKeysArray, $fileKeysArray);
    } else {
        echo 'ОШИБКА! Запрашиваемый файл не найден.';
        die;
    }

    if (!empty($missingKeys)) {
        foreach ($missingKeys as $key) {
            echo 'ОШИБКА! В запросе отсутствуют  параметр ', $key, '</br>';
            die;
        }
    }

    if (!empty($excessKeys)) {
        foreach ($excessKeys as $key) {
            echo 'ОШИБКА! Параметр ', $key, ' не соответствует запрашиваемой таблице ', '</br>';
            die;
        }
    }

    if (empty($missingKeys) and empty($excessKeys)) {
        $uniqueData = uniqueData($_POST);

        if ($uniqueData) {
            $action = $_POST['action'];

            switch ($action) {
                case 'insert' :
                    insert($_POST);
                    $horses = getFileArray($_POST);
                    outputHorseInfo($horses);
                    break;
                case 'update' :
                    echo 'test update';
                    break;
                case 'delete' :
                    echo 'test delete';
                    break;
                default :
                    echo 'ОШИБКА! В запросе отсутствует или не верно введен параметр "action".';
            }
        } else {
            echo 'ОШИБКА! Такая запись уже существует';
        }
    }
}