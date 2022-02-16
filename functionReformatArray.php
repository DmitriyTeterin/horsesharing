<?php
/**
 * реформатирует входящий массив созданный из csv файла
 * @param array $array
 * @return array
 */
function reformatArray(array $array): array
{
    $keys = explode(";", $array[0]);
    $arrayCount = count($array);
    $keysCount = count($keys);
    $finalArray = [];
    $result =[];

    for ($i = 1; $i < $arrayCount; $i++) {
        $splitArray = explode(";", $array[$i]);

        for ($n = 0; $n < $keysCount; $n++) {
            $key = $keys[$n];
            $trimKey = trim($key);
            $trimValue = trim($splitArray[$n]);

            if (is_numeric($trimValue) === true) {
                $finalArray[$trimKey] = (int)$splitArray[$n];
            } else {
                $finalArray[$key] = $splitArray[$n];
            }
        }
        $result[] = $finalArray;
}
    return $result;
}