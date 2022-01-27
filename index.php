<?php
include 'database.php';
include 'functionFilter.php';
include 'functionFindByItem.php';
include 'functionReceiveHorseInfo.php';

const BASE_MULTIPLIER = 1;

$horses = filter($horses, 'tariff', 3);
$horses = filter($horses, 'city', 2);

foreach($horses as $horse){
    echo receiveHorseInfo($horse);
}