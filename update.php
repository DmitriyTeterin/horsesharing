<?php
/**
 * @param array $request
 * @return void
 * Ищет по id и обновляет запись в БД
 */
function update(array $request)
{
    $requestId = (int)$request['id'];
    $fileKeys = getFileKeys($request);
    $fileArray = getFileArray($request);
    $requestArray = getRequestArray($request);
    unset($requestArray['type'], $requestArray['action']);
    $file = openFile($request, 'w+');
    $updateFileKey = 0;

    foreach ($fileArray as $fileKey => $array) {
        if ($requestId == $array['id']) {
            $updateFileKey = $fileKey;
        }
    }
    foreach ($requestArray as $requestKey => $requestValue) {
        $fileArray[$updateFileKey][$requestKey] = $requestValue;
    }

    fputcsv($file, $fileKeys, ';');
    foreach ($fileArray as $value) {
        fputcsv($file, $value, ';');
    }

    fclose($file);

}