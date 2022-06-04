<?php
include 'functionPostRequest.php';

/**
 * Записывает данные из $_POST в CSV файл.
 * @param array $request
 * @return void
 */
function insert(array $request)
{
    $postArray = getRequestArray($request);

    $file = openFile($request, 'a');
    $fileKeys = getFileKeys($request);
    $fileArray = getFileArray($request);

    $idArray =[];

    foreach ($fileArray as $value){
        $idArray[] = $value['id'];
    }
    $newId = max($idArray) + 1;

    $fields = [];

    foreach ($fileKeys as $key){
        $fields[$key] = $key == 'id' ?  $newId :  $postArray[$key];
    }

    fputcsv($file, $fields, ';');
    fclose($file);
}