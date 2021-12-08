<?php
/**
 * Переводит информацию о лошади из массива в форматированную строку.
 * @param array $horse
 * @return string
 */
function receiveHorseInfo(array $horse): string
{
    global $colors, $cities, $tariffs;
    $format = '%s, цвет %s, тариф- %s, цена за поездку- %d руб. <br/>
           Время подачи лошади в городе %s: %d мин. <br/><br/>';

    $horseName = $horse['name'];
    $color = findByItem($colors, 'id', $horse['color'])['name'];
    $price = $horse['price'] * BASE_MULTIPLIER;
    $filingTime = $horse['filingTime'];
    $tariff = findByItem($tariffs, 'id', $horse['tariff'])['name'];
    $city = findByItem($cities, 'id', $horse['city'])['name'];

    return sprintf($format, $horseName, $color, $tariff, $price, $city, $filingTime);
}