<?php
/**
 * Created by PhpStorm.
 * User: wanglong
 * Date: 2017/6/27
 * Time: 16:23
 */
namespace App\Http\Controllers;

use App\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;

class StudentController extends Controller
{

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('student.index', [
            'students' => $students
        ]);
    }

    /**
     * 添加页面 and 保存页面
     */
    public function create(Request $request)
    {
//        $request->isMethod('post') $request->ajax();
        $student = new Student();
        if ($request->isMethod('post')) {

            //校验信息是否正确  ajax请求的方式如果输入错误会是422HTTP状态码
            $this->validate($request, [
                'name' => 'required|min:2|max:20',
                'age' => 'required|integer',
                'sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'name' => '姓名',
                'age' => '年龄',
                'sex' => '性别',
            ]);

            //  接受 ajax 的数据
            $data = Input::all();

            if (Student::create($data)) {
                return response()->json(array(
                    'success' => 1,
                    'msg' => '添加成功',
                ));
            } else {
                return response()->json(array(
                    'status' => 0,
                    'msg' => '添加失败',
                ));
            }
        }

        return view('student.create', [
            'student' => $student
        ]);
    }

    /**
     * 修改学生页面
     */
    public function update(Request $request, $id)
    {

        $student = Student::find($id);

        //  ajax的请求实现数据更新
        if ($request->ajax()) {

            //校验信息是否正确  ajax请求的方式如果输入错误会是422HTTP状态码
            $this->validate($request, [
                'name' => 'required|min:2|max:20',
                'age' => 'required|integer',
                'sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'name' => '姓名',
                'age' => '年龄',
                'sex' => '性别',
            ]);

            $data = Input::all();
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];

            //  保存数据
            if ($student->save()) {
                return response()->json(array(
                    'success' => 1,
                    'msg' => '修改成功',
                ));
            } else {
                return response()->json(array(
                    'status' => 0,
                    'msg' => '修改失败',
                ));
            }
        }
        //  url 访问返回页面
        return view('student.update', [
            'student' => $student,
            'id' => $id
        ]);

    }

    public function detail($id, Request $request)
    {
        $student = Student::find($id);
        return view('student.detail', [
            'student' => $student
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $student = Student::find($id);

        if ($student->delete()) {
            return response()->json(array(
                'success' => 1,
                'msg' => '删除成功',
            ));
        } else {
            return response()->json(array(
                'status' => 0,
                'msg' => '删除失败',
            ));
        }
    }

    //  文件上传
    public function upload(Request $request)
    {

        if ($request->isMethod('post')) {
//            var_dump($_FILES);
            $file = $request->file('source');

            //文件是否上传成功；
            if ($file->isValid()) {
                //原文件名
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //MimeType
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();

                $filename = date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $ext;

                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                var_dump($bool);
            }

            exit();
        }

        return view('student.upload');
    }

    public function email()
    {

        //文本邮件
//        Mail::raw('邮件：hello world',function ($message){
//            $message -> from('1058841870@qq.com','胖龙');
//            $message -> subject('邮件：主题测试');
//            $message -> to('13031161644@sina.cn');
//        });

        //html 邮件
        Mail::send('student.email',['name'=>'工位预订通知'],function ($message){
            $message -> from('1058841870@qq.com','胖龙');
            $message -> subject('邮件：主题测试');
            $message -> to('13031161644@sina.cn');
        });
    }

    public function cache1()
    {
        //put()
//        Cache::put('key1','val1',1);
        //add()
//        $bool = Cache::add('key2','val2',1);
//        var_dump($bool);
        //forever()
//        Cache::forever('key3','val3');
        //has()
        $bool = Cache::has('key3');
        if($bool){
            $val = Cache::get('key3');
            var_dump($val);
        }else{
            var_dump('NO');
        }
    }

    public function cache2()
    {
        //get()
//        $val = Cache::get('key3');
//        var_dump($val);
        //pull()
//        $val = Cache::pull('key1');
//        var_dump($val);
        //forget()
        $bool = Cache::forget('key3');
        var_dump($bool);
    }

    public function error()
    {
//        $name = 'sean';
//        var_dump($name);

//        abort('405');
        Log::info('这是一个info级别的log');
    }


}

