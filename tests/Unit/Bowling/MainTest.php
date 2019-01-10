<?php
namespace Tests\Unit\Bowling;

use Tests\TestCase;
use Tests\Unit\Bowling\Main;

// 準備測試兩個案例
// 1. 測試都沒打中
// 2. 測試每次都打中一顆
// 3. 重構
// 4. 只寫測試案例，測試one Spare
class MainTest extends TestCase
{
    private $oMain;

    public function SetUp()
    {
        $this->oMain = new Main();
    }

    private function rollMany(int $iTimes, int $iPins)
    {
        $x = 0;
        for ($i = 0; $i < $iTimes; $i++) {
            $this->oMain->roll($iPins);
        }
    }

    public function testNothingRoll()
    {
        $bExpect = 0;
        $this->rollMany(20, 0);

        $bActual = $this->oMain->score();

        $this->assertEquals($bExpect, $bActual);
    }

    public function testAllOneRoll()
    {
        $bExpect = 20;
        $this->rollMany(20, 1);

        $bActual = $this->oMain->score();

        $this->assertEquals($bExpect, $bActual);
    }

    public function testAllOneSpare()
    {
        $bExpect = 16;
        $this->oMain->roll(3);
        $this->oMain->roll(7);
        $this->oMain->roll(3);
        $this->rollMany(17, 0);

        $bActual = $this->oMain->score();

        $this->assertEquals($bExpect, $bActual);
    }

}
