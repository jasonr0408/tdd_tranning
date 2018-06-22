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
        return response()->json(['result' => true, 'data' => 'login succeed']);
    }

    public function getSession(Request $_Request)
    {
    }

    public function logout(Request $_Request)
    {
    }
}
