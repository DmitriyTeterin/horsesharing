<?php

/**
 * Открывает CSV файл с указанным типом доступа.
 * @param array $POST
 * @param string $mode
 * @return false|resource
 */
function openFile(array $POST, string $mode)
{
    $filename = $POST['type'];
    $filepath = './database/' . $filename . '.csv';
    return fopen($filepath, $mode);
}

/**
 * Проверяет наличие в базе данных запрашиваемой таблицы.
 * @param array $POST
 * @return bool
 */
function checkFile(array $POST): bool
{
    $filename = $POST['type'];
    $filepath = './database/' . $filename . '.csv';
    return file_exists($filepath);
}

/**
 * Возвращает массив с названиями столбцов запрашиваемой таблицы.
 * @param array $POST
 * @return array
 */
function getFileKeys(array $POST): array
{
    $file = openFile($POST, 'r');
    return fgetcsv($file, 1000, ";");
}

/**
 * Возвращает массив с ключами из POST запроса, кроме 'type' (хранит название редактируемой таблицы).
 * @param array $POST
 * @return array
 */
function getPOSTKeys(array $POST): array
{
    $postArray = $POST;
    $postKeysArray = [];
    unset($postArray['type']);

    foreach ($postArray as $key => $value) {
        $postKeysArray[] = $key;
    }
    return $postKeysArray;
}

/**
 * Возвращает запрашиваемую таблицу переведенную в массив.
 * @param array $POST
 * @return array
 */
function getFileArray(array $POST): array
{
    $filename = $POST['type'];
    $filepath = './database/' . $filename . '.csv';
    return csvArray($filepath);
}

/**
 * Возвращает массив из $_POST с переводом числовых значений из string в int.
 * @param array $POST
 * @return array
 */
function getPostArray(array $POST): array
{
    $postArray = $POST;
    $result = [];

    foreach ($postArray as $key => $value) {
        $result[$key] = is_numeric($value) == true ? (int)$value : $value;
    }

    return $result;
}

/**
 * Проверяет, является ли запись из POST запроса уникальной для БД.
 * @param array $POST
 * @return bool
 */
function uniqueData(array $POST): bool
{
    $result = true;

    $fileArray = getFileArray($POST);
    $postArray = getPostArray($POST);
    unset($postArray['type'], $postArray['id'], $postArray['action']);

    foreach ($fileArray as $array) {
        unset($array['id']);

        if ($postArray == $array) {
            $result = false;
            break;
        }
    }

    return $result;
}
