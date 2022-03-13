<?php

include 'functionRequest.php';
include 'functionOutputHorseInfo.php';

const BASE_MULTIPLIER = 1;
global $horses;

$value = checkEmptyRequest($_GET);

if ($value == true) {
    outputHorseInfo($horses);
    die;
}

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