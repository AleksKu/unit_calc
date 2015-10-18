<?


require 'vendor/autoload.php';


use AleksKu\UnitCalc\TransportCalculator;



$routes = [
    ['from'=>'Москва','to'=>'Самара','cost'=>2],
    ['from'=>'Москва','to'=>'Воронеж','cost'=>3],
    ['from'=>'Москва','to'=>'Тверь','cost'=>3],
    ['from'=>'Самара','to'=>'Воронеж','cost'=>1],
    ['from'=>'Самара','to'=>'Тверь','cost'=>1],
    ['from'=>'Воронеж','to'=>'Владивосток','cost'=>10],
    ['from'=>'Тверь','to'=>'Хабаровск','cost'=>8],
    ['from'=>'Хабаровск','to'=>'Краснодар','cost'=>2],
    ['from'=>'Владивосток','to'=>'Краснодар','cost'=>3],
];



$calc = new TransportCalculator($routes);
$calc->calc('Москва','Краснодар');

echo "маршрут: ";
echo $calc->printPath();

echo "\n Стоимость проезда: ".$calc->getCost();