<?php
include 'functionPostRequest.php';

/**
 * Записывает данные из $_POST в CSV файл.
 * @param array $POST
 * @return void
 */
function insert(array $POST)
{
    $postArray = getPostArray($POST);

    $file = openFile($POST, 'a');
    $fileKeys = getFileKeys($POST);
    $fileArray = getFileArray($POST);

    $newId = count($fileArray) + 1;

    $count = count($fileKeys);

    $fields = [];

    for ($i = 0; $i < $count; $i++) {
        $key = $fileKeys[$i];
        $key == 'id' ? $fields[$key] = $newId : $fields[$key] = $postArray[$key];
    }

    fputcsv($file, $fields, ';');
    fclose($file);
}