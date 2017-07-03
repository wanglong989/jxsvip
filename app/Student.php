<?php
/**
 * Created by PhpStorm.
 * User: wanglong
 * Date: 2017/6/27
 * Time: 17:16
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const sex_un = 2;
    const sex_girl = 1;
    const sex_boy = 0;

    protected $table = 'student';

    protected $date = ['created_at','updated_at'];

    //  指定id为 key
    protected $primaryKey = 'id';

    //指定允许批量赋值的字段
    protected $fillable = ['name', 'age', 'sex'];

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

    public function sexArr($ind = null)
    {
        $arr = [
            self::sex_boy => '男',
            self::sex_girl => '女',
            self::sex_un => '未知',
        ];

        if($ind !== null){
            return array_key_exists($ind,$arr)? $arr[$ind] : $arr[self::sex_un];
        }

        return $arr;
    }

}