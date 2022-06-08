<?php

/**
 * @param array $missingKeys
 * @param array $postKeysArray
 * @param string $action
 * @return bool
 * Выводит ошибку с указанием отсутствующего ключа в запросе.
 */
function errorMissingKeys(array $missingKeys, array $postKeysArray, string $action): bool
{
    switch ($action) {
        case 'insert' :
            if (in_array('id', $missingKeys)) {
                $missingKeys = array_diff($missingKeys, ['id']);
            }
            if (!empty($missingKeys)) {
                foreach ($missingKeys as $key) {
                    echo 'ОШИБКА записи! В запросе отсутствуют  ключ : ', $key, '</br>';
                }
                return false;
            }
            break;

        case 'update' :
            if (in_array('id', $missingKeys)) {
                echo 'ОШИБКА обновления! В запросе отсутствует ключ ID .', '</br>';
                return false;
            }
            $postKeysArray = array_diff($postKeysArray, ['id']);
            if (empty($postKeysArray)) {
                echo 'ОШИБКА! В запросе отсутствуют ключи параметров для обновления.', '</br>';
                return false;
            }
            break;
        case 'delete' :
            if (in_array('id', $missingKeys)) {
                echo 'ОШИБКА удаления! В запросе отсутствует ключ ID.', '</br>';
                return false;
            }
            break;
    }
    return true;
}

/**
 * @param array $excessKeys
 * @return bool
 * Выводит ошибку с указанием неправильных ключей в запросе.
 */
function errorExcessKeys(array $excessKeys): bool
{
    $result = true;
    if (!empty($excessKeys)) {
        foreach ($excessKeys as $key) {
            echo 'ОШИБКА! Параметр ', $key, ' не соответствует запрашиваемой таблице ', '</br>';
            $result = false;
        }
    }
    return $result;
}

/**
 * @param array $request
 * @return void
 * Выводит ошибку о том, что запрашиваемый файл не найден.
 */
function errorCheckFile(array $request)
{
    $checkFile = checkFile($request);

    if (!$checkFile) {
        echo 'ОШИБКА! Запрашиваемый файл не найден.';
        die;
    }
}

/**
 * @param array $request
 * @return void
 * Выводит ошибку о том, что такая запись уже существует.
 */
function errorUniqueData(array $request)
{
    $uniqueData = uniqueData($request);

    if (!$uniqueData) {
        echo 'ОШИБКА! Такая запись уже существует';
        die();
    }
}

/**
 * @param array $request
 * @return bool
 * Выдает ошибку о том, что в запросе отсутствует значение того или иного параметра.
 */
function errorMissingData(array $request): bool
{
    $requestArray = getRequestArray($request);
    $action = $requestArray['action'];
    $requestId = $requestArray['id'];

    switch ($action) {
        case 'insert' :
            unset($requestArray['id']);

            foreach ($requestArray as $key => $value) {
                if (empty($value)) {
                    echo 'ОШИБКА записи! В запросе не задано значение параметра : ', $key, '</br>';
                    return false;
                }
            }
            break;

        case 'update' :
            foreach ($requestArray as $key => $value) {
                if (empty($value)) {
                    echo 'ОШИБКА обновления! В запросе не задано значение параметра : ', $key, '</br>';
                    return false;
                }
            }
            break;
        case 'delete' :
            if (empty($requestId)) {
                echo 'ОШИБКА удаления! В запросе не задано значение параметра ID.', '</br>';
                return false;

            }

            break;
    }
    return true;
}

/**
 * @param array $request
 * @return bool
 * Проверяет есть ли в БД запись со значением id переданным из запроса,
 * выводит ошибку если таковой нет.
 */
function searchByIdError(array $request): bool
{
    $fileArray = getFileArray($request);
    $requestArray = getRequestArray($request);
    $requestId = $requestArray['id'];
    $fileIdArray = [];

    foreach ($fileArray as $array) {
        $fileIdArray[] = $array['id'];
    }

    if (!in_array($requestId, $fileIdArray)) {
        echo 'ОШИБКА! Запись с ID = ', $requestId, ' не найдена в БД.', '</br>';
        return false;
    }
    return true;
}