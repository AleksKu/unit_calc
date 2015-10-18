<?php


/**
 * Контракт Графа
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */



namespace AleksKu\UnitCalc\Graph;

interface GraphInterface
{
    /**
     * Добавляет новую вершину в граф
     *
     * @param   VertexInterface $vertex
     * @return  GraphInterface
     * @throws  \Exception
     */
    public function add(VertexInterface $vertex);
    /**
     * Возвращает вершину из заданного графа по  id вершины
     *
     * @param   mixed $id
     * @return  VertexInterface
     * @throws  \Exception
     */
    public function getVertex($id);
    /**
     * Возвращает все вершины графа
     *
     * @return array
     */
    public function getVertices();
}