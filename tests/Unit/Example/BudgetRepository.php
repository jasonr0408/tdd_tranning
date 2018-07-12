<?php
namespace Tests\Unit\Example;

class BudgetRepository
{
    public function getAllBudget()
    {
        $aBudgetList = array(
            2017 => array(
                4 => 3000,
                5 => 3100,
                6 => 3000,
                7 => 3100,
            ),
            2018 => array(
                4 => 3000,
                5 => 3100,
                6 => 3000,
                7 => 3100,
            ),
        );

        return $aBudgetList;
    }
}
