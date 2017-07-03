@extends('comment.layout')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ url('student/index') }}">学生列表</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    添加学生
                </li>
            </ul>
        </div>
    </div>

    @include('comment.message')

    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <div class="panel-body">

            @include('student._form')

        </div>
    </div>
@stop

@section('javascript')
    <script src="{{asset('js/modal_student.js')}}"></script>
@stop

