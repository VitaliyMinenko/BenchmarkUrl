<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-31
 * Time: 12:52
 */

namespace controllers;

use classes\GameOfLife;

class ApiController
{
    public function setStateAction()
    {
        $size = [10, 10];
        $live = [[2, 2], [2, 3], [3, 1], [3, 4], [1, 1], [1, 2]];
        $game = new GameOfLife($size, $live);
        $game->getNext();

    }

    public function getNextAction()
    {

    }

}