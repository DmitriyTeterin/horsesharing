<?php
const BASE_MULTIPLIER = 1;

//эконом 0-399, комфорт 400-899, бизнес 900-....
$horses = [
    [
        'name' => 'Дакар',
        'color' => 'Рыжий',
        'price' => 200,
        'filingTime' => 5,
        'tariff' => 'Эконом',
    ],
    [
        'name' => 'Гамлет',
        'color' => 'Серый',
        'price' => 350,
        'filingTime' => 9,
        'tariff' => 'Эконом',
    ],
    [
        'name' => 'Буцефал',
        'color' => 'Вороной',
        'price' => 1000,
        'filingTime' => 1,
        'tariff' => 'Бизнес',
    ],
    [
        'name' => 'Зевс',
        'color' => 'Пегой',
        'price' => 450,
        'filingTime' => 7,
        'tariff' => 'Комфорт',
    ],
    [
        'name' => 'Аполлон',
        'color' => 'Буланой',
        'price' => 150,
        'filingTime' => 13,
        'tariff' => 'Эконом',
    ],
    [
        'name' => 'Спирит',
        'color' => 'Вороной',
        'price' => 650,
        'filingTime' => 3,
        'tariff' => 'Комфорт',
    ],
    [
        'name' => 'Алтай',
        'color' => 'Серый',
        'price' => 250,
        'filingTime' => 8,
        'tariff' => 'Эконом',
    ],
    [
        'name' => 'Вегас',
        'color' => 'Гнедой',
        'price' => 700,
        'filingTime' => 4,
        'tariff' => 'Комфорт',
    ],
    [
        'name' => 'Гром',
        'color' => 'Черный',
        'price' => 1250,
        'filingTime' => 2,
        'tariff' => 'Бизнес',
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
           Время подачи лошади: %d мин. <br/><br/>';

    $horseName = $horse['name'];
    $color = $horse['color'];
    $price = $horse['price'] * BASE_MULTIPLIER;
    $filingTime = $horse['filingTime'];
    $tariff = $horse['tariff'];

    return sprintf($format, $horseName, $color, $tariff, $price, $filingTime);
}


/**
 * @param $horses
 * @param $tariff
 * @return array
 */

function filterByTariff($horses, $tariff): array
{
    $filteredHorses = [];

    foreach ($horses as $key => $value) {

        if ($tariff == $value['tariff']) {
            for ($i = 0; $i < count($horses); $i++) {
                $filteredHorses [$i] = $value;

            }
        }
    }
    return $filteredHorses;
}


for ($i = 0; $i < count($horses); $i++) {
    echo receiveHorseInfo(filterByTariff($horses, 'Эконом'));
}


die;
echo receiveHorseInfo($horses[0]);

echo '<h4>  ВЫВОД ЧЕРЕЗ sprintf:  </h4>';


echo receiveHorseInfo($horses[1]);


echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через for:  </h4>';

for ($i = 0; $i < count($horses); $i++) {
    echo receiveHorseInfo($horses[$i]);
}

echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через foreach:  </h4>';


foreach ($horses as $key => $value) {
    echo receiveHorseInfo($value);
}

echo '<h4>  СПИСОК ВСЕХ ЛОШАДЕЙ через while: </h4>';

$i = 0;

while ($i < count($horses)) {
    echo receiveHorseInfo($horses[$i]);
    $i++;
}

echo '<h4>  ОТБОР ЛОШАДЕЙ ПО ПАРАМЕТРАМ:   </h4>';

echo '<h5>  ОТБОР  ПО СТОИМОСТИ:  </h5>';

foreach ($horses as $key => $value) {
    $price = $value['price'] * BASE_MULTIPLIER;
    if ($price < 400) {
        echo receiveHorseInfo($value);
    }
}




