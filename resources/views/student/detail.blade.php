@extends('comment.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ url('student/index') }}">学生列表</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    学生详情
                </li>
            </ul>
        </div>
    </div>

    @include('comment.message')

    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <div class="panel-body">
            {{--{{dd($students)}}--}}

            <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{$student['id']}}</td>
                </tr>
                <tr>
                    <td>姓名</td>
                    <td>{{$student['name']}}</td>
                </tr>
                <tr>
                    <td>年龄</td>
                    <td>{{$student['age']}}</td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td>{{$student->sexArr($student['sex'])}}</td>
                </tr>
                <tr>
                    <td>添加时间</td>
                    <td>{{date('Y-m-d',$student['created_at'])}}</td>
                </tr>
                <tr>
                    <td>最后修改</td>
                    <td>{{date('Y-m-d',$student['updated_at'])}}</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
@stop

