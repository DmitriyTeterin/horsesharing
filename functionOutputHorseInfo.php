<?php
include 'functionReceiveHorseInfo.php';
global $horses;
/**
 * Выводит информацию о лошади на экран.
 * @param array $horses
 * @return void
 */
function outputHorseInfo(array $horses)
{
    foreach ($horses as $horse) {
        echo receiveHorseInfo($horse);
    }
}
