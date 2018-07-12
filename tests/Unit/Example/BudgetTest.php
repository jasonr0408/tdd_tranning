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

    public function testNoBudget()
    {
        $sStart = '2018-01-01';
        $sEnd = '2018-01-30';
        $iExpect = 0;

        $oTarget = new Budget();
        $iAction = $oTarget->calculateMoney($sStart, $sEnd);

        $this->assertEquals($iExpect, $iAction);
    }
}
