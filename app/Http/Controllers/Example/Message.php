<?php
namespace App\Http\Controllers\Example;

use App\Model\User\UserList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Random;
use DB;
use App\Services\Example\GenerateCard;

class Message extends Controller
{
    private $oGenerateCard;
    public function __construct(GenerateCard $_oGenerateCard)
    {
        $this->oGenerateCard = $_oGenerateCard;
    }

    public function test1(Request $_Request, UserList $oUserList)
    {
        echo '<pre>';
        print_r(config('example'));
        // $this->function();
        // $this->function();
        // $this->function();
        // $this->function();
        echo 123;
    }

    public function test2($sUserName, Request $_Request, UserList $oUserList)
    {
        echo $sUserName;
    }

    public function test3(Request $_Request)
    {
        echo Random::rand(1, 5);
    }

    public function test4(Request $_Request)
    {
        echo '<pre>';
        $aResult1 = DB::connection('user')->select('SELECT * FROM user_list WHERE UserName = :Username', ['Username' => 'jr']);
        print_r($aResult1);

        $aResult2 = DB::connection('user')->select('SELECT * FROM user_list WHERE UserName = ?', ['jr']);
        print_r($aResult2);
    }

    public function test5(Request $_Request)
    {
        return $this->oGenerateCard->getUserData();
    }

    public function test6(Request $_Request)
    {
        return $this->oGenerateCard->generate();
    }
}
