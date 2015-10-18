<?php
/**
 * Created by PhpStorm.
 * User: newage
 * Date: 18.10.15
 * Time: 12:23
 */

namespace AleksKu\UnitCalc\Graph;


class DijkstraAlgorithm implements AlgorithmInterface
{
    protected $startingVertex;
    protected $endingVertex;
    protected $graph;
    protected $paths = array();
    protected $solution = false;
    /**
     *
     * @param GraphInterface $graph
     */
    public function __construct(GraphInterface $graph)
    {
        $this->graph = $graph;
    }
    /**
     * Возвращает стоимомсть пути от начальной и конечной точкой
     *
     * @return integer
     */
    public function getCost()
    {
        if (!$this->isSolved()) {
            throw new \LogicException(
                "Невозможно просчитать дистанцию:\nВызывали метод ->solve()?"
            );
        }
        return $this->getEndingVertex()->getPotential();
    }
    /**
     * Возвращает конечную точку
     *
     * @return VertexInterface
     */
    public function getEndingVertex()
    {
        return $this->endingVertex;
    }

    /**
     * Возвращает минимальный путь, используя обратный проход
     *
     * @return Array
     */
    public function getShortestPath()
    {
        $path   = array();
        $vertex = $this->getEndingVertex();

        $startingId = $this->getStartingVertex()->getId();


        while ($vertex->getId() != $startingId) {
            $path[] = $vertex;
            $vertex = $vertex->getPotentialFrom();
        }
        $path[] = $this->getStartingVertex();
        return array_reverse($path);
    }
    /**
     *
     * @return VertexInterface
     */
    public function getStartingVertex()
    {
        return $this->startingVertex;
    }
    /**
     *
     * @param VertexInterface $vertex
     */
    public function setEndingVertex(VertexInterface $vertex)
    {
        $this->endingVertex = $vertex;
    }
    /**
     *
     * @param VertexInterface $vertex
     */
    public function setStartingVertex(VertexInterface $vertex)
    {
        $this->paths[] = array($vertex);
        $this->startingVertex = $vertex;
    }

    /**
     * @return Array|bool
     * @throws \LogicException
     */
    public function solve()
    {
        if (!$this->getStartingVertex() || !$this->getEndingVertex()) {
            throw new \LogicException("Для решение алгоритма, необходимо указать начальную и конечную точку");
        }
        $this->calculatePotentials($this->getStartingVertex());
        $this->solution = $this->getShortestPath();
        return $this->solution;
    }
    /**
        Рекурсивно вычисляет потенциалы  графа
     *
     * @param VertexInterface $vertex
     */
    protected function calculatePotentials(VertexInterface $vertex)
    {
        $connections = $vertex->getConnections();
        $sorted = array_flip($connections);
        krsort($sorted);
        foreach ($connections as $id => $distance) {
            $v = $this->getGraph()->getVertex($id);
            $v->setPotential($vertex->getPotential() + $distance, $vertex);
            foreach ($this->getPaths() as $path) {
                $count = count($path);
                if ($path[$count - 1]->getId() === $vertex->getId()) {
                    $this->paths[] = array_merge($path, array($v));
                }
            }
        }
        $vertex->markPassed();


        foreach ($sorted as $id) {
            $vertex = $this->getGraph()->getVertex($id);
            if (!$vertex->isPassed()) {
                $this->calculatePotentials($vertex);
            }
        }
    }
    /**
     *
     *
     * @return GraphInterface
     */
    protected function getGraph()
    {
        return $this->graph;
    }
    /**
     * Возвращает возможные пути в этом графе
     *
     * @return Array
     */
    protected function getPaths()
    {
        return $this->paths;
    }
    /**
     * Проверяет был ли просчитан данный алгоритм
     *
     * @return boolean
     */
    protected function isSolved()
    {
        return (bool) $this->solution;
    }
}
