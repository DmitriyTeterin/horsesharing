<?php
const BASE_MULTIPLIER = 1;

$tariffs = [
    [
        'id' => 1,
        'name' => 'Эконом',
    ],
    [
        'id' => 2,
        'name' => 'Комфорт',
    ],
    [
        'id' => 3,
        'name' => 'Бизнес',
    ],
];

$cities = [
    [
        'id' => 1,
        'name' => 'Томск',

    ],
    [
        'id' => 2,
        'name' => 'Новосибирск',
    ],
];

$colors = [
    [
        'id' => 1,
        'name' => 'Рыжий',
    ],
    [
        'id' => 2,
        'name' => 'Серый',
    ],
    [
        'id' => 3,
        'name' => 'Вороной',
    ],
    [
        'id' => 4,
        'name' => 'Пегой',
    ],
    [
        'id' => 5,
        'name' => 'Буланой',
    ],
    [
        'id' => 6,
        'name' => 'Гнедой',
    ],
    [
        'id' => 7,
        'name' => 'Черный',
    ],
];

$horses = [
    [
        'name' => 'Дакар',
        'color' => 1,
        'price' => 200,
        'filingTime' => 5,
        'tariff' => 1,
        'city' => 2,
    ],
    [
        'name' => 'Гамлет',
        'color' => 2,
        'price' => 350,
        'filingTime' => 9,
        'tariff' => 1,
        'city' => 1,
    ],
    [
        'name' => 'Буцефал',
        'color' => 3,
        'price' => 1000,
        'filingTime' => 1,
        'tariff' => 3,
        'city' => 2,
    ],
    [
        'name' => 'Зевс',
        'color' => 4,
        'price' => 450,
        'filingTime' => 7,
        'tariff' => 2,
        'city' => 1,
    ],
    [
        'name' => 'Аполлон',
        'color' => 5,
        'price' => 150,
        'filingTime' => 13,
        'tariff' => 1,
        'city' => 2,
    ],
    [
        'name' => 'Спирит',
        'color' => 3,
        'price' => 650,
        'filingTime' => 3,
        'tariff' => 2,
        'city' => 2,

    ],
    [
        'name' => 'Алтай',
        'color' => 2,
        'price' => 250,
        'filingTime' => 8,
        'tariff' => 1,
        'city' => 1,
    ],
    [
        'name' => 'Вегас',
        'color' => 6,
        'price' => 700,
        'filingTime' => 4,
        'tariff' => 2,
        'city' => 1,
    ],
    [
        'name' => 'Гром',
        'color' => 7,
        'price' => 1250,
        'filingTime' => 2,
        'tariff' => 3,
        'city' => 2,
    ]
];

/**
 * Ищет в справочниках значение параметра лошади по id.
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

/**
 * Фильтрует список лошадей по заданному параметру.
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

$filteredHorseByTariff = filter($horses, 'tariff', 2);
$filteredHorseByCity = filter($filteredHorseByTariff, 'city', 1);

foreach ($filteredHorseByCity as $horse) {
    echo receiveHorseInfo($horse);
}
