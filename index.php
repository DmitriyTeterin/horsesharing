<?php
const BASE_MULTIPLIER = 1;

$horses = [
    [
        'name' => 'Дакар',
        'color' => 'Рыжий',
        'price' => 200,
        'filingTime' => 5,
        'tariff' => 'Эконом',
        'city' => 'Томск',
    ],
    [
        'name' => 'Гамлет',
        'color' => 'Серый',
        'price' => 350,
        'filingTime' => 9,
        'tariff' => 'Эконом',
        'city' => 'Новосибирск',
    ],
    [
        'name' => 'Буцефал',
        'color' => 'Вороной',
        'price' => 1000,
        'filingTime' => 1,
        'tariff' => 'Бизнес',
        'city' => 'Новосибирск',
    ],
    [
        'name' => 'Зевс',
        'color' => 'Пегой',
        'price' => 450,
        'filingTime' => 7,
        'tariff' => 'Комфорт',
        'city' => 'Томск',
    ],
    [
        'name' => 'Аполлон',
        'color' => 'Буланой',
        'price' => 150,
        'filingTime' => 13,
        'tariff' => 'Эконом',
        'city' => 'Томск',
    ],
    [
        'name' => 'Спирит',
        'color' => 'Вороной',
        'price' => 650,
        'filingTime' => 3,
        'tariff' => 'Комфорт',
        'city' => 'Новосибирск',

    ],
    [
        'name' => 'Алтай',
        'color' => 'Серый',
        'price' => 250,
        'filingTime' => 8,
        'tariff' => 'Эконом',
        'city' => 'Томск',
    ],
    [
        'name' => 'Вегас',
        'color' => 'Гнедой',
        'price' => 700,
        'filingTime' => 4,
        'tariff' => 'Комфорт',
        'city' => 'Томск',
    ],
    [
        'name' => 'Гром',
        'color' => 'Черный',
        'price' => 1250,
        'filingTime' => 2,
        'tariff' => 'Бизнес',
        'city' => 'Новосибирск',
    ]
];
$horse = $horses[0];

/**
 * Переводит информацию о лошади из массива в форматированную строку.
 * @param array $horse
 * @return string
 */
function receiveHorseInfo(array $horse): string
{
    $format = '%s, цвет %s, тариф- %s, цена за поездку- %d руб. <br/>
           Время подачи лошади в городе %s: %d мин. <br/><br/>';

    $horseName = $horse['name'];
    $color = $horse['color'];
    $price = $horse['price'] * BASE_MULTIPLIER;
    $filingTime = $horse['filingTime'];
    $tariff = $horse['tariff'];
    $city = $horse['city'];

    return sprintf($format, $horseName, $color, $tariff, $price, $city, $filingTime);
}

/**
 * Фильтрует список лошадей по городу.
 * @param $horses
 * @param $city
 * @return array
 */
function filterByCity($horses, $city): array
{
    $horsesFilteredByCity = [];

    foreach ($horses as $key => $value) {
        if ($city == $value['city']) {
            $horsesFilteredByCity [$key] = $value;
        }
    }

    return $horsesFilteredByCity;

}

$newFilteredHorsesByCity = filterByCity($horses, 'Новосибирск');

/**
 * Фильтрует список лошадей по тарифу.
 * @param $newFilteredHorsesByCity
 * @param $tariff
 * @return array
 */
function filterByTariff($newFilteredHorsesByCity, $tariff): array
{
    $horsesFilteredByTariff = [];

    foreach ($newFilteredHorsesByCity as $key => $value) {
        if ($tariff == $value['tariff']) {
            $horsesFilteredByTariff [$key] = $value;
        }
    }

    return $horsesFilteredByTariff;
}

$newFilteredHorsesByTariff = filterByTariff($newFilteredHorsesByCity, 'Комфорт');

foreach ($newFilteredHorsesByTariff as $horse) {
    echo receiveHorseInfo($horse);
}








