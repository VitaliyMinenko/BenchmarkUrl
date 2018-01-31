<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-31
 * Time: 12:51
 */

namespace classes;


class GameOfLife
{
    public $world = [];
    public $live = [];
    public $size = [];

    public function __construct($size, $live)
    {
        $this->size = $size;
        $this->live = $live;
        $this->makeWorld();
        $this->setPopulation();
    }

    protected function makeWorld()
    {


        $x = $this->size[0];
        $y = $this->size[1];
        $world = [];
        for ($i = 1; $i <= $x; $i++) {
            for ($z = 1; $z <= $y; $z++) {
                $world[$i][$z] = 0;
            }

        }
        $this->world = $world;
    }

    protected function setPopulation()
    {
        $live = $this->live;
        $world = $this->world;
        foreach ($live as $key => $val) {
            $x = $val[0];
            $y = $val[1];

            $world[$x][$y] = 1;
        }
        $this->world = $world;
//        $res = $this->canLive(1, 2, 3);
//        var_dump($res);
//        die;
    }

    public function getNext()
    {
        $world = $this->world;
        foreach ($world as $x => $val) {
            foreach ($val as $y => $v) {
                $world[$x][$y] = $this->canLive($world[$x][$y], $x, $y);
            }
        }
        $this->anybodyLive($world);
        $this->world = $world;

    }

    public function anybodyLive($world){
        foreach ($world as $key => $val) {
            $x = $val[0];
            $y = $val[1];
            if($world[$x][$y] == 1){
                return true;
            }else{
                return false;
            }
        }
    }

    public function canLive($state, $x, $y)
    {
        $size = $this->size;
        $world = $this->world;
        $liveNeighbors = 0;
        $arr = [
            [$x, $y - 1],
            [$x, $y + 1],
            [$x + 1, $y],
            [$x - 1, $y],
            [$x - 1, $y - 1],
            [$x + 1, $y - 1],
            [$x + 1, $y + 1],
            [$x - 1, $y + 1],
        ];
        foreach ($arr as $key => $val) {
            if (isset($world[$val[0]][$val[1]])) {
                if ($world[$val[0]][$val[1]] == 1) {
                    $liveNeighbors++;
                }
            }
        }
        if ($state == 1) {
            if ($liveNeighbors > 2 && $liveNeighbors < 4) {
                return 1;
            } else {
                return 0;
            }
        } else {
            if ($liveNeighbors == 3) {
                return 1;
            } else {
                return 0;
            }
        }

    }
}