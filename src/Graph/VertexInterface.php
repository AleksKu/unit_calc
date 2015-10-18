<?php


/**
 * Контракт для вершины графа
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */
namespace AleksKu\UnitCalc\Graph;
interface VertexInterface
{
    /**
     * Присоединяет  вершинну к указанной вершине с указанием веса
     *
     * @param VertexInterface $vertex
     * @param integer $distance
     */
    public function connect(VertexInterface $vertex, $distance = 1);

    /**
     * Возвращает все пути до вершины от текущей
     *
     * @return Array
     */
    public function getConnections();

    /**
     * Возвращает id вершины
     *
     * @return mixed
     */
    public function getId();

    /**
     * Возвращает потенциал вершины
     *
     * @return integer
     */
    public function getPotential();

    /**
     *
     *
     * @return VertexInterface
     */
    public function getPotentialFrom();

    /**
     *  Возвращает, был ли уже пройден данная вершинв в рамках графа
     *
     * @return boolean
     */
    public function isPassed();

    /**
     * Устанавливает Узел как пройденный в рамках данной карты, т.е. указывает что для узла был вычислен потенциал
     */
    public function markPassed();

    /**
     * Устанавливает для Узла потенциал.
     *
     * @param   integer $potential
     * @param   VertexInterface $from
     * @return  boolean
     */
    public function setPotential($potential, VertexInterface $from);
}