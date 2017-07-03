<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['web']],function (){

    /**
     * 首页
     */
    Route::get('student/index', ['uses' => 'StudentController@index']);
    /**
     * 添加学生信息页
     */
    Route::any('student/create', ['uses' => 'StudentController@create']);
    /**
     * 修改学生页面
     */
    Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
    /**
     * 修改学生详情
     */
    Route::any('student/detail/{id}', ['uses' => 'StudentController@detail']);
    /**
     * 删除学生信息
     */
    Route::any('student/delete', ['uses' => 'StudentController@delete']);
    /**
     * 文件上传
     */
    Route::any('student/upload', ['uses' => 'StudentController@upload']);

    /**
     * 发送邮件
     */
    Route::any('student/email', ['uses' => 'StudentController@email']);

    /**
     * 添加缓存
     */
    Route::any('student/cache1', ['uses' => 'StudentController@cache1']);

    /**
     * 获取缓存
     */
    Route::any('student/cache2', ['uses' => 'StudentController@cache2']);

    /**
     * 错误日志
     */
    Route::any('student/error', ['uses' => 'StudentController@error']);

});


/**
 * 这是一个活动页面的路由
 */
Route::get('activity/index/{id}', ['uses' => 'ActivityController@index']);

