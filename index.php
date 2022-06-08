<?php

include 'functionGetRequest.php';
include 'functionOutputHorseInfo.php';
include 'insert.php';
include 'errorOutputFunctions.php';
include 'delete.php';
include 'update.php';

const BASE_MULTIPLIER = 1;
global $horses;

$isEmptyGet = checkEmptyRequest($_GET);
$isEmptyPost = checkEmptyRequest($_POST);

if ($isEmptyGet && $isEmptyPost) {
    outputHorseInfo($horses);
    die;
}

if (!$isEmptyGet) {
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

if ($isEmptyPost) {
    die();
}
errorCheckFile($_POST);

$postKeysArray = getRequestKeys($_POST);
$postKeysArray = array_diff($postKeysArray, ['action']);
$fileKeysArray = getFileKeys($_POST);
$missingKeys = array_diff($fileKeysArray, $postKeysArray);
$excessKeys = array_diff($postKeysArray, $fileKeysArray);

$action = $_POST['action'];

$isMissingKeys = errorMissingKeys($missingKeys, $postKeysArray, $action);
$isExcessKeys = errorExcessKeys($excessKeys);
$isMissingData = errorMissingData($_POST);



switch ($action) {
    case 'insert' :
        if (!$isMissingKeys || !$isExcessKeys || !$isMissingData) {
            die();
        }
        errorUniqueData($_POST);
        insert($_POST);
        $horses = getFileArray($_POST);
        outputHorseInfo($horses);
        break;
    case 'update' :
        if (!$isMissingKeys || !$isExcessKeys || !$isMissingData || !searchByIdError($_POST)) { //Макс, то что слева проверка на туеву хучу условий, это легально? есть способ красивее сделать?
            die();
        }
        errorUniqueData($_POST);
        update($_POST);
        $horses = getFileArray($_POST);
        outputHorseInfo($horses);
        break;
    case 'delete' :

        if (!$isMissingKeys || !$isMissingData || !searchByIdError($_POST)) {
            die();
        }
        delete($_POST);
        $horses = getFileArray($_POST);
        outputHorseInfo($horses);
        break;
    default :
        echo 'ОШИБКА! В запросе отсутствует или не верно введен параметр "action".';
}