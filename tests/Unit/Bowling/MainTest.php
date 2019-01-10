<?php
namespace Tests\Unit\Bowling;

use Mockery;
use Tests\TestCase;
use Tests\Unit\Bowling\Main;

// 準備測試兩個案例
// 1. 測試都沒打中
// 2. 測試每次都打中一顆
// 3. 重構
// 4. 只寫測試案例，測試one Spare
class MainTest extends TestCase
{
    public function SetUp()
    {
    }

    public function testNothingRoll()
    {
        $bExpect = 0;

        $oMain = new Main();
        $x = 0;
        for ($i=0; $i < 21; $i++) {
            $oMain->roll($x);
        }

        $bActual = $oMain->score();

        $this->assertEquals($bExpect, $bActual);
    }

}
