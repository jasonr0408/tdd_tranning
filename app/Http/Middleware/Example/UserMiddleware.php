<?php
namespace App\Http\Middleware\Example;
use Closure;
use App\Model\User\UserList;
use App\Exceptions\Example\UserException;

/**
 * 簡單中間層
 */
class UserMiddleware
{
    public function handle($request, Closure $next, ...$guard)
    {
        $sUserName = $request->input('user_name');
        $oUserList = new UserList;
        $aUser = $oUserList->where('UserName', $sUserName)->get()->first()->toArray();
        // if ($aUser['Level'] !== 1) {
        //     return response()->json(['result' => false, 'message' => 'error']);
        // }
        throw_if(($aUser['Level'] !== 1), new UserException('no User!', 1001));

        config(['example.oprator.MemberId' => $aUser['MemberId']]);
        config(['example.oprator.UserName' => $aUser['UserName']]);
        config(['example.oprator.Passwd' => $aUser['Passwd']]);
        config(['example.oprator.Level' => $aUser['Level']]);

        return $next($request);
    }
}
