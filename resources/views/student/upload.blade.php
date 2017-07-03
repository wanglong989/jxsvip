@extends('comment.layout')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ url('student/index') }}">学生列表</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    文件上传
                </li>
            </ul>
        </div>
    </div>

    @include('comment.message')

    <div class="panel panel-default">
        <div class="panel-heading">文件上传</div>
        <div class="panel-body">

            <div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-2">
                        文件
                    </label>
                    <div class="col-lg-9">
                        <input id="file" type="file" class="form-control" name="source">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">

                    </label>
                    <div class="col-lg-9">
                        <button class="btn btn-primary btn-group js-send-email">发送邮件</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
@stop

@section('javascript')
    <script src="{{asset('js/modal_student.js')}}"></script>
@stop

