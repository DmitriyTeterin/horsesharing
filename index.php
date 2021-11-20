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


echo $horses[0]['name'], ', цвет ', $horses[0]['color'],
', цена за поездку- ', ($horses[0]['price'] * BASE_MULTIPLIER), ' руб.',
'<br/>', 'Время подачи лошади: ', $horses[0]['filingTime'], ' мин.';

echo '<h4>  ВЫВОД ЧЕРЕЗ sprintf:  </h4>';


$format = '%s, цвет %s, цена за поездку- %d руб. <br/> 
           Время подачи лошади: %d мин. ';

$horseName = $horses[1]['name'];
$color = $horses[1]['color'];
$price = $horses[1]['price'] * BASE_MULTIPLIER;
$filingTime = $horses[1]['filingTime'];

echo sprintf($format, $horseName, $color, $price, $filingTime);

echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через for:  </h4>';

for ($i = 0; $i < count($horses); $i++) {
    echo $i + 1, ') ', $horses[$i]['name'], ', цвет ', $horses[$i]['color'], ', цена за поездку- ',
    ($horses[$i]['price'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $horses[$i]['filingTime'], ' мин.', '<br/><br/>';
}
echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через foreach:  </h4>';

$num = 1;

foreach ($horses as $key => $value) {
    echo $num, ') ', $value['name'], ', цвет ', $value['color'],
     ', цена за поездку- ', ($value['price'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $value['filingTime'], ' мин.', '<br/><br/>';
    $num++;
}

echo '<h4>  СПИСОК ВСЕХ ЛОШАДЕЙ через while: </h4>';

$i = 0;


while ($i < count($horses)) {
    echo $i+1, ') ', $horses[$i]['name'],  ', цвет ', $horses[$i]['color'],
     ', цена за поездку- ', ($horses[$i]['price'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $horses[$i]['filingTime'], ' мин.', '<br/><br/>';
    $i++;

}

echo '<h4>  ОТБОР ЛОШАДЕЙ ПО ПАРАМЕТРАМ:   </h4>';

echo '<h5>  ОТБОР  ПО СТОИМОСТИ:  </h5>';

foreach ($horses as $key => $value) {
    $price = $value['price'] * BASE_MULTIPLIER;

    if ($price < 400) {
        echo $value['name'],  ', цвет ', $value['color'],
         ', цена за поездку- ', $price, ' руб.',
        '<br/>', 'Время подачи лошади: ', $value['filingTime'], ' мин.', '<br/><br/>';
        $num++;
    }
}

echo '<h5>  ОТБОР  ПО ЦВЕТУ:  </h5>';


foreach ($horses as $key => $value) {
    $color = $value['color'];
    if ($color == 'Серый') {
        echo $value['name'],  ', цвет ', $color,
         ', цена за поездку- ', $value['price'] * BASE_MULTIPLIER, ' руб.',
        '<br/>', 'Время подачи лошади: ', $value['filingTime'], ' мин.', '<br/><br/>';
        $num++;

    }
}