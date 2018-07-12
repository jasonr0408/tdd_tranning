<?php
namespace Tests\Unit\Example;

use Tests\TestCase;
use Mockery;
use Tests\Unit\Example\Budget;

class BudgetTest extends TestCase
{
    # 兩個日期 2018-05 2018-06
    # 2018-05 3100
    # 2018-06 3000
    # 2018-07 3100
    private $oTarget;

    public function SetUp()
    {
        $this->oTarget = new Budget();
    }

    public function testNoBudget()
    {
        $sStart = '2018-01-01';
        $sEnd = '2018-01-30';
        $iExpect = 0;

        $iAction = $this->oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals($iExpect, $iAction);
    }

    public function testOneBudget()
    {
        $sStart = '2018-05-01';
        $sEnd = '2018-05-31';
        $iExpect = 3100;

        $iAction = $this->oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals($iExpect, $iAction);
    }
}
