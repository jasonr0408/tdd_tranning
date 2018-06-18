<?php
namespace App\Services\Bet;

use App\Repositories\Game\BettingRepositories;

/**
 * 寫單進DB
 */
class WriteWagersService
{

    private $oBettingRepositories;

    public function __construct()
    {
        $this->oBettingRepositories = new BettingRepositories;
    }

    public function writeSingleNumberWagers($_aWagersBetDataList, $_aWagerPercentData)
    {
    }


}
