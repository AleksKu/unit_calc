<?php
/**
 *
 * тест на случайных данных
 */



require 'vendor/autoload.php';
use AleksKu\UnitCalc\TransportCalculator;


/**
 * генерируем коллекцию населенных пунктов
 */
$localities = [];
$routes = [];
$faker = Faker\Factory::create('ru_Ru');

for ($i=0; $i < 50; $i++) {
    $localities[]= $faker->city;
}


$localities = array_unique($localities);

/**
 * генерируем коллекцию маршрутов
 */
for ($i=0; $i < 100; $i++) {
    $routes[] = [
        'from'=>$localities[array_rand($localities)],'to'=>$localities[array_rand($localities)],'cost'=>$faker->randomDigitNotNull
    ];
}




$calc = new TransportCalculator($routes);
$calc->calc($localities[array_rand($localities)],$localities[array_rand($localities)]);


echo "маршрут:";
echo $calc->printPath();

echo "\n Стоимость проезда: ".$calc->getCost();