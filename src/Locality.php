<?php


/**
 *
 * Класс транспортного Узла
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */

namespace AleksKu\UnitCalc;

use AleksKu\UnitCalc\Graph\VertexInterface;


class Locality implements VertexInterface
{
    protected $id;
    protected $potential;
    protected $potentialFrom;
    protected $connections = array();
    protected $passed = false;

    /**
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Соединяем транспортный узел с указанием стоимости проезда(растояния)
     * A $distance, to balance the connection, can be specified.
     *
     * @param VertexInterface $vertex
     * @param integer $distance
     */
    public function connect(VertexInterface $vertex, $distance = 1)
    {
        $this->connections[$vertex->getId()] = $distance;
    }

    /**
     * Возвращает все пути до транспортного узел от текущего
     *
     * @return Array
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     *
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Возвращает потенциал транспортоног узла
     *
     * @return integer
     */
    public function getPotential()
    {
        return $this->potential;
    }

    /**
     *
     *
     * @return VertexInterface
     */
    public function getPotentialFrom()
    {
        return $this->potentialFrom;
    }

    /**
     * Возвращает, был ли уже пройден данный узел в рамках карты
     *
     * @return boolean
     */
    public function isPassed()
    {
        return $this->passed;
    }

    /**
     *
     * Устанавливает Узел как пройденный в рамках данной карты, т.е. указывает что для узла был вычислен потенциал
     */
    public function markPassed()
    {
        $this->passed = true;
    }

    /**
     * Устанавливает для Узла потенциал.
     *
     * @param   integer $potential
     * @param   VertexInterface $from
     * @return  boolean
     */
    public function setPotential($potential, VertexInterface $from)
    {
        $potential = (int)$potential;
        if (!$this->getPotential() || $potential < $this->getPotential()) {
            $this->potential = $potential;
            $this->potentialFrom = $from;
            return true;
        }
        return false;
    }

    /**
     * @return string
     */

    public function __toString() {
        return $this->id;
    }
}