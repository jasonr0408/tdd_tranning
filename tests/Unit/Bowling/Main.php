<?php
namespace Tests\Unit\Bowling;
// Game有2 methods
// roll(pins : int)
// • 每次玩家都一個球。
// • 參數是擊倒的瓶數。

// score() : int
// • 在遊戲結束呼叫。
// • 回傳此次遊戲的最後分數。

// 遊戲有 10 局。每一局1~2次丟球。第10局有2~3次丟球。
// 分數功能要每次丟球反覆計算。分數計算需依賴下一局。
class Main
{
    private $iTotal = 0;

    public function roll(int $iPins) : int
    {
        $this->iTotal += $iPins;
        return $iPins;
    }

    public function score()
    {
        return $this->iTotal;
    }
}