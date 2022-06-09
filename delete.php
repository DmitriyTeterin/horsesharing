<?php

/**
 * Ищет по id и удаляет запись из БД.
 * @param array $request
 * @return void
 */
function delete(array $request)
{
    $requestId = (int)$request['id'];
    $fileKeys = getFileKeys($request);
    $fileArray = getFileArray($request);
    $file = openFile($request, 'w');

    foreach ($fileArray as $key => $array) {
        if ($requestId == $array['id']) {
            unset($fileArray[$key]);
        }
    }
    fputcsv($file, $fileKeys, ';');
    foreach ($fileArray as $value) {
        fputcsv($file, $value, ';');
    }

    fclose($file);

}

