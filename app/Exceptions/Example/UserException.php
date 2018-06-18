<?php
namespace App\Exceptions\Example;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class UserException extends Exception
{
    // final function getMessage();                // 返回異常信息
    // final function getCode();                   // 返回異常代碼
    // final function getFile();                   // 返回發生異常的文件名
    // final function getLine();                   // 返回發生異常的代碼行號
    // final function getTrace();                  // backtrace() 數組
    // final function getTraceAsString();          // 已格成化成字符串的 getTrace() 信息
    /**
     * 再丟出去前端之前，中間處理的過程寫在這邊
     *
     * @return void
     */
    // public function report()
    // {
    //     ## 紀錄log
    //     ## 發emill
    //     ## 發telegram
    //     // dd(123);
    // }

    /**
     * 處理好你要顯示的錯誤訊息丟出去
     *
     * @param  \Illuminate\Http\Request
     * @return void
     */
    public function render($request)
    {
        return response()->json(['result' => false, 'message' => $this->getmessage(), 'code' => $this->getcode(), 'timestamp' => date('Y-m-d H:m:s')], 500);
    }
}
