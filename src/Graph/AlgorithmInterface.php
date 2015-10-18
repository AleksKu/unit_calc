<?php

/**
 * Interface Algorithm
 *
 * @package     AleksKu\UnitCalc
 * @subpackage  Graph
 * @author      Aleks Ku <ak@newage.pw>
 */


namespace AleksKu\UnitCalc\Graph;

interface AlgorithmInterface
{
    /**
     * Решает алгоритм и возвращает все возможные руезультаты
     *
     * @return mixed
     */
    public function solve();

    /**
     * Стоимость
     * @return mixed
     */
    public function getCost();
}