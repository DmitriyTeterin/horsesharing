<?php
/**
 * Фильтрует массив по заданному параметру.
 * @param array $horses
 * @param string $key
 * @param $value
 * @return array
 */
function filter(array $horses, string $key, $value): ?array
{
    $result = [];
    foreach ($horses as $horse) {
        if ($horse[$key] === $value) {
            $result[] = $horse;
        }
    }

    return $result;
   
}