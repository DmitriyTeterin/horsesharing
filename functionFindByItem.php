<?php
/**
 * Ищет в массивах значение параметра  по id.
 * @param array $array
 * @param string $key
 * @param int|string $value
 * @return array|null
 */
function findByItem(array $array, string $key, $value): ?array
{
    foreach ($array as $item) {
        if ($item[$key] === $value) {
            return $item;
            
        }
    }

    return null;
}