<?php
const BASE_MULTIPLIER = 1;
$horses = [
    [
        'name' => 'Дакар',
        'color' => 'Рыжий',
        'prise' => 200,
        'filing time' => 5
    ],
    [
        'name' => 'Гамлет',
        'color' => 'Серый',
        'prise' => 350,
        'filing time' => 9
    ],
    [
        'name' => 'Буцефал',
        'color' => 'Вороной',
        'prise' => 1000,
        'filing time' => 1
    ],
    [
        'name' => 'Зевс',
        'color' => 'Пегой',
        'prise' => 450,
        'filing time' => 7
    ],
    [
        'name' => 'Аполлон',
        'color' => 'Буланой',
        'prise' => 150,
        'filing time' => 13
    ],
    [
        'name' => 'Спирит',
        'color' => 'Вороной',
        'prise' => 650,
        'filing time' => 3
    ],
    [
        'name' => 'Алтай',
        'color' => 'Серый',
        'prise' => 250,
        'filing time' => 8
    ],
    [
        'name' => 'Вегас',
        'color' => 'Гнедой',
        'prise' => 700,
        'filing time' => 4
    ],
    [
        'name' => 'Гром',
        'color' => 'Черный',
        'prise' => 1250,
        'filing time' => 2
    ]


];


echo $horses[0]['name'], ', ', 'цвет ', $horses[0]['color'],
', ', 'цена за поездку- ', ($horses[0]['prise'] * BASE_MULTIPLIER), ' руб.',
'<br/>', 'Время подачи лошади: ', $horses[0]['filing time'], ' мин.';

echo '<h4>  ВЫВОД ЧЕРЕЗ sprintf:  </h4>';


$format = '%s, цвет %s, цена за поездку- %d руб. <br/> 
           Время подачи лошади: %d мин. ';

$horseName = $horses[1]['name'];
$color = $horses[1]['color'];
$prise = $horses[1]['prise'] * BASE_MULTIPLIER;
$filingTime = $horses[1]['filing time'];

echo sprintf($format, $horseName, $color, $prise, $filingTime);

echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через for:  </h4>';

for ($i = 0; $i < count($horses); $i++) {
    echo $i + 1, ') ', $horses[$i]['name'], ', ', 'цвет ', $horses[$i]['color'],
    ', ', 'цена за поездку- ', ($horses[$i]['prise'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $horses[$i]['filing time'], ' мин.', '<br/><br/>';
}
echo '<h4>   СПИСОК ВСЕХ ЛОШАДЕЙ через foreach:  </h4>';

$num = 1;

foreach ($horses as $key => $value) {
    echo $num, ') ', $value['name'], ', ', 'цвет ', $value['color'],
    ', ', 'цена за поездку- ', ($value['prise'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $value['filing time'], ' мин.', '<br/><br/>';
    $num++;
}

echo '<h4>  СПИСОК ВСЕХ ЛОШАДЕЙ через while: </h4>';

$i = 0;
$num = 1;

while ($i < count($horses)) {
    echo $num, ') ', $horses[$i]['name'], ', ', 'цвет ', $horses[$i]['color'],
    ', ', 'цена за поездку- ', ($horses[$i]['prise'] * BASE_MULTIPLIER), ' руб.',
    '<br/>', 'Время подачи лошади: ', $horses[$i]['filing time'], ' мин.', '<br/><br/>';
    $i++;
    $num++;
}

echo '<h4>  ОТБОР ЛОШАДЕЙ ПО ПАРАМЕТРАМ:   </h4>';

echo '<h5>  ОТБОР  ПО СТОИМОСТИ:  </h5>';

foreach ($horses as $key => $value) {
    $prise = $value['prise'] * BASE_MULTIPLIER;

    if ($prise < 400) {
        echo $value['name'], ', ', 'цвет ', $value['color'],
        ', ', 'цена за поездку- ', $prise, ' руб.',
        '<br/>', 'Время подачи лошади: ', $value['filing time'], ' мин.', '<br/><br/>';
        $num++;
    }
}

echo '<h5>  ОТБОР  ПО ЦВЕТУ:  </h5>';


foreach ($horses as $key => $value) {
    $color = $value['color'];
    if ($color == 'Серый') {
        echo $value['name'], ', ', 'цвет ', $color,
        ', ', 'цена за поездку- ', $value['prise'] * BASE_MULTIPLIER, ' руб.',
        '<br/>', 'Время подачи лошади: ', $value['filing time'], ' мин.', '<br/><br/>';
        $num++;

    }
}