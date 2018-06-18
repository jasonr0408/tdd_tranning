<?php
namespace App\Services\Example;

use App\Repositories\Game\BettingRepositories;

/**
 * 寫單進DB
 */
class GenerateService
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
