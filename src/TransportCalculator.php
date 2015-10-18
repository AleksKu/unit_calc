<?php
/**
 * Класс транспортного калькулятора
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */

namespace AleksKu\UnitCalc;

use AleksKu\UnitCalc\Graph;


class TransportCalculator
{

    /**
     * Название алгоритма для вычисления
     * По умолчанию: алгоритм Дейкстры
     * @var string
     */

    protected static $algorithmDefault = \AleksKu\UnitCalc\Graph\DijkstraAlgorithm::class;

    /**
     * @var \AleksKu\UnitCalc\Graph\AlgorithmInterface
     */
    protected $algorithm = null;


    /**
     * @var TransportMap
     */
    protected $map = null;


    protected $routes;


    /**
     * @var float|int
     */
    protected $cost = null;

    /**
     * @var \ArrayAccess
     */
    protected $path = null;


    /**
     * @param $routes
     * @throws \Exception
     */
    public function __construct( $routes)
    {

        $this->routes = $routes;
        $this->transformRoutesToMap();

        $this->setAlgorithm(static::$algorithmDefault);



    }


    /**
     * @return $this
     * @throws \Exception
     */
    protected function transformRoutesToMap()
    {

        $map = new TransportMap();


        foreach ($this->routes as $route) {


            if(!is_string($route['from']) || !is_string($route['to']))
            {
                throw new \Exception('id пункта должно быть строкой');
            }

            if(!is_numeric($route['cost']))
            {
                throw new \Exception('стоимость проезда должна быть числом');
            }

            if($map->hasLocality($route['from']))
            {
                $start =   $map->getLocality($route['from']);
            } else {
                $start =   new Locality($route['from']);
                $map->add($start);
            }


            if($map->hasLocality($route['to']))
            {
                $finish =   $map->getLocality($route['to']);
            } else {
                $finish =   new Locality($route['to']);
                $map->add($finish);
            }

            $cost = $route['cost'];

            $start->connect($finish, $cost);




        }

        $this->map = $map;

        return $this;
    }








    /**
     * Установить название алгоритма для расчета
     * @param $algorithmName
     * @return $this
     * @throws \Exception
     */
    public function setAlgorithm($algorithmName)
    {

        if (empty($algorithmName))
            throw new \Exception('Название алгоритма не может быть пустым');


        if (!class_exists($algorithmName)) {
            throw new \Exception('Не найден класс алгоритма');
        }



        $this->algorithm = new $algorithmName($this->map);


        return $this;
    }


    public function calc($startLocalityName, $finishLocalityName)
    {



        $this->algorithm->setStartingVertex($this->map->getLocality( $startLocalityName));
        $this->algorithm->setEndingVertex($this->map->getLocality( $finishLocalityName));

        $this->path = $this->algorithm->solve();
        $this->cost = $this->algorithm->getCost();

        return $this;
    }


    public function getCost()
    {
        return $this->cost;
    }


    public function getPath()
    {
        return $this->path;
    }

    /**
     *
     * @return string
     *
     */
    public function printPath()
    {
        $literal = '';
        foreach ($this->path as $p) {
            $literal .= "{$p->getId()} - ";
        }
        return substr($literal, 0, count($literal) - 4);
    }


}