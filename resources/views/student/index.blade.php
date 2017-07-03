@extends('comment.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li>
                    <a href="#">学生列表</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    修改学生
                </li>
            </ul>
        </div>
    </div>

    @include('comment.message')

    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <div class="panel-body">
            {{--{{dd($students)}}--}}

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>姓名</th>
                    <th>年龄</th>
                    <th>性别</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $val)
                    <tr>
                        <td>{{$val['id']}}</td>
                        <td>{{$val['name']}}</td>
                        <td>{{$val['age']}}</td>
                        <td>{{$val->sexArr($val['sex'])}}</td>
                        <td>{{date('Y-m-d',$val['created_at'])}}</td>
                        <td style="width: 200px;">
                            <a href="{{url('student/detail',['id' => $val['id']])}}" class="btn btn-xs btn-link">详情</a>
                            <a href="{{url('student/update',['id'=>$val['id'] ])}}" class="btn btn-xs btn-info">修改</a>
                            <a class="btn btn-xs btn-danger js-student-del" data-id="{{$val['id']}}">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--分页--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-right">
                        {{$students->render()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@section('javascript')
    <script src="{{asset('js/modal_student.js')}}"></script>
@stop

