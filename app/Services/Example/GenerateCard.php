<?php
namespace App\Services\Example;

use App\Repositories\Example\UserList;
use Random;

class GenerateCard
{
    private $oUserList;

    public function __construct(UserList $_oUserList)
    {
        $this->oUserList = $_oUserList;
    }

    public function getUserData()
    {
        $aUserData = $this->oUserList->getUserData();

        return $aUserData;
    }

    public function generate()
    {
        $iNumber = Random::rand(1, 10);
        $iNumber += 1;
        return $iNumber;
    }

}
