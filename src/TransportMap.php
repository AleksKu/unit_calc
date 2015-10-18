<?php

/**
 * Класс транспортной карты
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */
namespace AleksKu\UnitCalc;


use AleksKu\UnitCalc\Graph\GraphInterface;
use AleksKu\UnitCalc\Graph\VertexInterface;
use AleksKu\UnitCalc\Locality;

class TransportMap implements GraphInterface
{
    /**
     * Все населенные пункты карты
     *
     * @var array
     */
    protected $localities = array();


    /**
     *
     * Добавляет нас. пункт на карту
     *
     * @param Locality $vertex
     * @return $this
     * @throws \Exception
     */
    public function add(VertexInterface $vertex)
    {
        if (array_key_exists($vertex->getId(), $this->getVertices())) {
            throw new \Exception('Невозможно добавить на карту нас. пункт, который уже был ранее добавлен');
        }
        $this->localities [$vertex->getId()] = $vertex;
        return $this;
    }

    /**
     *
     * Возвращает нас. пункт из заданной карты по  id
     * @param mixed $id
     * @return mixed
     * @throws \Exception
     */
    public function getVertex($id)
    {
        $vertices = $this->getVertices();
        if (!array_key_exists($id, $vertices)) {
            throw new \Exception("Невозможно найти нас. пункт с id= $id на этой карте");
        }
        return $vertices[$id];
    }

    /**
     *
     * Возвращает нас. пункт из заданной карты по  id
     * @param $id
     * @return mixed
     */
    public function getLocality($id) {
        return $this->getVertex($id);
    }

    /**
     *
     * @param $id
     * @return bool
     */
    public function hasLocality($id) {
        $vertices = $this->getVertices();
        if (array_key_exists($id, $vertices))
            return true;

        return false;
    }

    /**
     * @return array
     */
    public function getVertices()
    {
        return $this->localities;
    }
}