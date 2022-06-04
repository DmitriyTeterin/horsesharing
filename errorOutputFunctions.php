<?php

/**
 * @param array $missingKeys
 * @param array $postKeysArray
 * @param string $action
 * @return bool
 * Выводит ошибку с указанием отсутствующего ключа в запросе.
 */
function ErrorMissingKeys(array $missingKeys, array $postKeysArray, string $action): bool
{
    $result = true;

    switch ($action) {
        case 'insert' :
            if (in_array('id', $missingKeys)) {
                $missingKeys = array_diff($missingKeys, ['id']);
            }
            if (!empty($missingKeys)) {
                foreach ($missingKeys as $key) {
                    echo 'ОШИБКА! В запросе отсутствуют  параметр: ', $key, '</br>';
                }
                $result = false;
            }
            break;

        case 'update' :
            if (in_array('id', $missingKeys)) {
                echo 'ОШИБКА! В запросе отсутствует ID обновляемой записи.', '</br>';
                $result = false;
            }
            $postKeysArray = array_diff($postKeysArray, ['id']);
            if (empty($postKeysArray)) {
                echo 'ОШИБКА! В запросе отсутствуют параметры для обновления.', '</br>';
                $result = false;
            }
            break;
        case 'delete' :
            if (in_array('id', $missingKeys)) {
                echo 'ОШИБКА! В запросе отсутствует ID удаляемой записи.', '</br>';
                $result = false;
            }
            break;
    }
    return $result;

}


/**
 * @param array $excessKeys
 * @return bool
 * Выводит ошибку с указанием неправильных ключей в запросе.
 */
function ErrorExcessKeys(array $excessKeys): bool
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
function ErrorCheckFile(array $request)
{
    $checkFile = checkFile($request);

    if (!$checkFile) {
        echo 'ОШИБКА! Запрашиваемый файл не найден.';
        die;
    }
}

/**
 * @param $request
 * @return void
 * Выводит ошибку о том, что такая запись уже существует.
 */
function ErrorUniqueData($request)
{
    $uniqueData = uniqueData($request);

    if (!$uniqueData) {
        echo 'ОШИБКА! Такая запись уже существует';
        die();
    }
}