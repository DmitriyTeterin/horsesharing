<?php
include 'database.php';
include 'functionFilter.php';
include 'functionFindByItem.php';
include 'functionReceiveHorseInfo.php';

const BASE_MULTIPLIER = 1;

$horses = filter($horses, 'tariff', 1);
$horses = filter($horses, 'city', 1);

