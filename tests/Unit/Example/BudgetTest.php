<?php
namespace Tests\Unit\Example;

use Mockery;
use Tests\TestCase;
use Tests\Unit\Example\Budget;
use Tests\Unit\Example\BudgetRepository;

class BudgetTest extends TestCase
{
    # 兩個日期 2018-05 2018-06
    # 2018-05 3100
    # 2018-06 3000
    # 2018-07 3100
    private $oTarget;

    public function SetUp()
    {
        $oBudgetRepositorySub = Mockery::mock(BudgetRepository::class);
        $oBudgetRepositorySub->shouldReceive('getAllBudget')
            ->andReturn(array(
                2018 => array(
                    4 => 3000,
                    5 => 3100,
                    6 => 3000,
                    7 => 3100,
                ),
            ));
        $this->oTarget = new Budget($oBudgetRepositorySub);
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
        $sStart = '2017-04-1';
        $sEnd = '2018-05-15';
        $oBudgetRepositorySub = Mockery::mock(BudgetRepository::class);
        $oBudgetRepositorySub->shouldReceive('getAllBudget')
            ->andReturn(array(
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
            ));
        $oTarget = new Budget($oBudgetRepositorySub);

        $iAction = $oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals(3000 + 3100 + 3000 + 3100 + 3000 + 1500, $iAction);
    }

}
