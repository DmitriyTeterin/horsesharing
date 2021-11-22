<?php
const BASE_MULTIPLIER = 1;
$horses = [
    [
        'name' => 'Дакар',
        'color' => 'Рыжий',
        'price' => 200,
        'filingTime' => 5,
    ],
    [
        'name' => 'Гамлет',
        'color' => 'Серый',
        'price' => 350,
        'filingTime' => 9,
    ],
    [
        'name' => 'Буцефал',
        'color' => 'Вороной',
        'price' => 1000,
        'filingTime' => 1,
    ],
    [
        'name' => 'Зевс',
        'color' => 'Пегой',
        'price' => 450,
        'filingTime' => 7,
    ],
    [
        'name' => 'Аполлон',
        'color' => 'Буланой',
        'price' => 150,
        'filingTime' => 13,
    ],
    [
        'name' => 'Спирит',
        'color' => 'Вороной',
        'price' => 650,
        'filingTime' => 3,
    ],
    [
        'name' => 'Алтай',
        'color' => 'Серый',
        'price' => 250,
        'filingTime' => 8,
    ],
    [
        'name' => 'Вегас',
        'color' => 'Гнедой',
        'price' => 700,
        'filingTime' => 4,
    ],
    [
        'name' => 'Гром',
        'color' => 'Черный',
        'price' => 1250,
        'filingTime' => 2,
    ]
];
$horse = $horses[0];

/**
 * Принимает список лошадей с параметрами(массив) и выводит информацию о лошади в виде строки
 * @param array $horse
 * @return string
 */
function showHorseInfo(array $horse): string
{
    $format = '%s, цвет %s, цена за поездку- %d руб. <br/>
           Время подачи лошади: %d мин. <br/><br/>';

    $horseName = $horse['name'];
    $color = $horse['color'];
    $price = $horse['price'] * BASE_MULTIPLIER;
    $filingTime = $horse['filingTime'];
    return sprintf($format, $horseName, $color, $price, $filingTime);
}

echo showHorseInfo($horses[0]);

echo '<h4>  ВЫВОД ЧЕРЕЗ sprintf:  </h4>';


            echo showHorseInfo($horses[1]);


echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через for:  </h4>';

            for ($i = 0; $i < count($horses); $i++)
            {echo showHorseInfo($horses[$i]);}

echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через foreach:  </h4>';


            foreach ($horses as $key => $value) {
            echo showHorseInfo($value);
            }

echo '<h4>  СПИСОК ВСЕХ ЛОШАДЕЙ через while: </h4>';

            $i = 0;

            while ($i < count($horses)) {
            echo showHorseInfo($horses[$i]);
            $i++;
            }

echo '<h4>  ОТБОР ЛОШАДЕЙ ПО ПАРАМЕТРАМ:   </h4>';

    echo '<h5>  ОТБОР  ПО СТОИМОСТИ:  </h5>';

            foreach ($horses as $key => $value) {
            $price = $value['price'] * BASE_MULTIPLIER;
            if ($price < 400) {echo showHorseInfo($value);}
            }

echo '<h5>  ОТБОР  ПО ЦВЕТУ:  </h5>';

            foreach ($horses as $key => $value) {
            $color = $value['color'];
            if ($color == 'Серый') {echo showHorseInfo($value);}
            }
