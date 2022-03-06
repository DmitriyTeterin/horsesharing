<?php

include 'functionRequest.php';

const BASE_MULTIPLIER = 1;
global $horses;

$value = checkEmptyRequest($_GET);

if ($value == true) {
    foreach ($horses as $horse) {
        echo receiveHorseInfo($horse);
    }
    die;
}

$getArray = checkingRequestParameters($_GET);

if (empty($getArray)) {
   die;}
 else filteringByGetRequest($getArray);
