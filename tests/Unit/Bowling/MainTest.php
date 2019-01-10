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

    public function testScore()
    {
        $bExpect = true;

        $oMain = new Main();

        $bActual = $oMain->score();

        $this->assertEquals($bExpect, $bActual);
    }

}
