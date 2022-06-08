<?php

/**
 * Открывает CSV файл с указанным типом доступа.
 * @param array $request
 * @param string $mode
 * @return false|resource
 */
function openFile(array $request, string $mode)
{
    $filename = $request['type'];
    $filepath = './database/' . $filename . '.csv';
    return fopen($filepath, $mode);
}

/**
 * Проверяет наличие в базе данных запрашиваемой таблицы.
 * @param array $request
 * @return bool
 */
function checkFile(array $request): bool
{
    $filename = $request['type'];
    $filepath = './database/' . $filename . '.csv';
    return file_exists($filepath);
}

/**
 * Возвращает массив с названиями столбцов запрашиваемой таблицы.
 * @param array $request
 * @return array
 */
function getFileKeys(array $request): array
{
    $file = openFile($request, 'r');
    return fgetcsv($file, 1000, ";");
}

/**
 * Возвращает массив с ключами из запроса, кроме 'type' (хранит название редактируемой таблицы).
 * @param array $request
 * @return array
 */
function getRequestKeys(array $request): array
{
    $postArray = $request;
    unset($postArray['type']);

    return array_keys($postArray);
}

/**
 * Возвращает запрашиваемую таблицу переведенную в массив.
 * @param array $request
 * @return array
 */
function getFileArray(array $request): array
{
    $filename = $request['type'];
    $filepath = './database/' . $filename . '.csv';
    return csvArray($filepath);
}

/**
 * Возвращает массив из запроса с переводом числовых значений из string в int.
 * @param array $request
 * @return array
 */
function getRequestArray(array $request): array
{
    $postArray = $request;
    $result = [];

    foreach ($postArray as $key => $value) {
        $result[$key] = is_numeric($value) == true ? (int)$value : $value;
    }

    return $result;
}

/**
 * Проверяет, является ли запись из POST запроса уникальной для БД.
 * @param array $request
 * @return bool
 */
function uniqueData(array $request): bool
{
    $fileArray = getFileArray($request);
    $requestArray = getRequestArray($request);
    unset($requestArray['type'], $requestArray['id'], $requestArray['action']);

    foreach ($fileArray as $array) {
        unset($array['id']);

        if ($requestArray == $array) {
            return false;
        }
    }

    return true;
}
