<?php
// Вежба 1.1 – Дефинирање на полиња
$numericArray = array(2, 5, 6, 10, 41, 24, 32, 9, 16, 19);
$associativeArray = array(
    'name' => 'Andrej',
    'lastName' => 'Todorovski',
    'city' => 'Skopje'
);
$multidimensionalArray = array(
    array(
        'name' => 'Andrej',
        'lastName' => 'Todorovski',
        'city' => 'Skopje'
    ),
    array(
        'name' => 'Bojan',
        'lastName' => 'Trpeski',
        'city' => 'Skopje'
    ),
    array(
        'name' => 'Ivana',
        'lastName' => 'Trpeska',
        'city' => 'Kumanovo'
    )
);
// Вежба 1.2 – Изминување на полиња
foreach ($numericArray as $key => $value) {
    echo "Key: $key, Value: $value\n";
}

// Вежба 1.3 – Изминување на полиња и додавање во ново поле
$numericArrayHigherThan20 = [];

foreach ($numericArray as $value) {
    if ($value > 20) {
        $numericArrayHigherThan20[] = $value;
    }
}

print_r($numericArrayHigherThan20);

// Вежба 1.4 - Должина на стринг

$sentence = "PHP is a widely-used general-purpose scripting language that is especially suited for Web development";
$words = explode(" ", $sentence);
$wordLengths = [];

foreach ($words as $word) {
    $wordLengths[$word] = strlen($word);
}

print_r($wordLengths);