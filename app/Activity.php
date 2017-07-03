<?php
/**
 * Created by PhpStorm.
 * User: wanglong
 * Date: 2017/7/3
 * Time: 12:45
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $date = ['created_at','updated_at'];

    //  指定id为 key
    protected $primaryKey = 'id';

    //指定允许批量赋值的字段
    protected $fillable = ['title', 'content', 'pic'];

    //自动维护时间
    public $timestamps = true;

    //返回时间戳
    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }

}