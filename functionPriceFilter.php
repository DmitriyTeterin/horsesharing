<?php

/**
 * Фильтрует массив по цене, от.....до......
 * @param array $getArray
 * @return array
 */
function priceFilter(array $getArray): ?array
{
    global $horses;
    $result = [];
    $getPriceMin = $getArray['price_min'];
    $getPriceMax = $getArray['price_max'];
    $horsePricesArray = [];

    foreach ($horses as $horse) {
        $horsePricesArray [] = $horse['price'];
    }

    $priceMinGet = empty($getPriceMin) ? min($horsePricesArray) : $getPriceMin ;
    $priceMaxGet = empty($getPriceMax) ? max($horsePricesArray) : $getPriceMax ;

    foreach ($horses as $horse) {
        $horsePrice = $horse['price'];
        if($horsePrice >= $priceMinGet && $horsePrice <= $priceMaxGet){
            $result[] =$horse;
        }
    }

    return $result;
}