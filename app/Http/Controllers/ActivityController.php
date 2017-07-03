<?php
/**
 * Created by PhpStorm.
 * User: wanglong
 * Date: 2017/7/3
 * Time: 12:06
 */
namespace App\Http\Controllers;

class ActivityController extends Controller
{
    public function index()
    {
       return view('m.activity.everyDay');
    }
}