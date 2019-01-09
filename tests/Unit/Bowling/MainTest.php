<?php
namespace Tests\Unit\Bowling;

use Mockery;
use Tests\TestCase;
use Tests\Unit\Bowling\Main;

class MainTest extends TestCase
{
    public function SetUp()
    {
    }

    public function testBasicTest()
    {
        $bExpect = true;

        $oMain = new Main();

        $bActual = $oMain->getBasic();

        $this->assertEquals($bExpect, $bActual);
    }

}
