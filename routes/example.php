<?php
## 需要驗證session才能call
Route::group(['middleware' => ['User_check']], function() {
    Route::get('/test1', 'Example\Message@test1');
});
## 利用route組成restful風格
Route::get('/{name}/test2', 'Example\Message@test2');
Route::get('/test3', 'Example\Message@test3');
Route::get('/test4', 'Example\Message@test4');
Route::get('/test5', 'Example\Message@test5');
Route::get('/test6', 'Example\Message@test6');


