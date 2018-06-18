<?php
namespace App\Facades\Example;

class Random
{
    public function shuffle($_aArray)
    {
        shuffle($_aArray);
        return $_aArray;
    }
    public function rand($_iMin, $_iMax)
    {
        return rand($_iMin, $_iMax);
    }
    public function array_rand($_aArray, $_iNum = 1)
    {
        return array_rand($_aArray, $_iNum);
    }

}
