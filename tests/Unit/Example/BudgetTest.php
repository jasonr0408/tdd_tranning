<?php
namespace Tests\Unit\Example;

use Tests\TestCase;
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

    public function testOneHaveDayBudget()
    {
        $sStart = '2018-05-01';
        $sEnd = '2018-05-15';
        $iExpect = 1500;

        $iAction = $this->oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals($iExpect, $iAction);
    }

    public function testTwoBudget()
    {
        $sStart = '2018-05-18';
        $sEnd = '2018-07-15';

        $iAction = $this->oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals(1400 + 3000 + 1500, $iAction);
    }

    public function testMultipleBudget()
    {
        $sStart = '2018-04-2';
        $sEnd = '2018-07-15';

        $iAction = $this->oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals(2900 + 3100 + 3000 + 1500, $iAction);
    }
}
