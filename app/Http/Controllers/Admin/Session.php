<?php
namespace App\Http\Controllers\Admin;

use App\Exceptions\CommonException;
use App\Http\Controllers\Controller;
use App\Model\Admin\AvengerList;
use Illuminate\Http\Request;
use Cookie;
use Hash;

use Redis;

class Session extends Controller
{
    public function login(Request $_Request)
    {
        $sUsername = $_Request->input('username');
        $sPassword = $_Request->input('password');
        $aUserData = $_oAvengerList->where('username', $sUsername)->get()->first()->toArray();
        // $bCorrectPassword = $sPassword === $aUserData['password'];

        return response()->json(['result' => true, 'data' => 'login succeed']);
    }

    public function getSession(Request $_Request)
    {
    }

    public function logout(Request $_Request)
    {
    }
}
