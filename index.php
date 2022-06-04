<?php

include 'functionGetRequest.php';
include 'functionOutputHorseInfo.php';
include 'insert.php';
include 'errorOutputFunctions.php';

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
ErrorCheckFile($_POST);

$postKeysArray = getRequestKeys($_POST);
$postKeysArray = array_diff($postKeysArray, ['action']);
$fileKeysArray = getFileKeys($_POST);
$missingKeys = array_diff($fileKeysArray, $postKeysArray);
$excessKeys = array_diff($postKeysArray, $fileKeysArray);

$action = $_POST['action'];
if (empty($action)) {
    $action = 'parameter not set';

}
$errorMissingKeys = ErrorMissingKeys($missingKeys, $postKeysArray, $action);
$errorExcessKeys = ErrorExcessKeys($excessKeys);

switch ($action) {
    case 'insert' :
        if (!$errorMissingKeys || !$errorExcessKeys) {
            die();
        }
        ErrorUniqueData($_POST);
        insert($_POST);
        $horses = getFileArray($_POST);
        outputHorseInfo($horses);
        break;
    case 'update' :
        if (!$errorMissingKeys || !$errorExcessKeys) {
            die();
        }
        ErrorUniqueData($_POST);
        echo 'test update';
        break;
    case 'delete' :
        if (!$errorMissingKeys) {
            die();
        }
        echo 'test delete';
        break;
    default :
        echo 'ОШИБКА! В запросе отсутствует или не верно введен параметр "action".';
}
