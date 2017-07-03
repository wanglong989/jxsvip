<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学习Laravel--@yield('title')</title>
    <meta name="keywords" content="这个是学习Laravel的表单成果"/>
    <meta name="description" content="这个是学习Laravel的表单成果"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <meta name="viewport" content="user-scalable=no,width=device-width,initial-scale=1"/>
    <meta name="apple-mobile-web-app-title" content="Title"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <link rel="stylesheet" href="{{asset('library/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('library/bower_components/bootstrap/dist/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('library/bower_components/message/css/messenger.css')}}">
    <link rel="stylesheet" href="{{asset('library/bower_components/message/css/messenger-theme-future.css')}}">
    <link rel="stylesheet" href="{{asset('css/vip.css')}}">
    @section('css')

    @show
</head>
<body>


@section('header')
    <header class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand hidden-sm" href="http://www.bootcss.com">Laravel</a>
            </div>
            <div class="navbar-collapse collapse" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a>学习</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right hidden-sm">
                    <li><a>关于</a></li>
                </ul>
            </div>
        </div>
    </header>
@show

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @section('leftmenu')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="list-group">
                                <a href="{{url('student/index')}}" class="list-group-item
                                {{Request::getPathInfo() == '/student/index' ? 'active' :''}}
                                ">学生列表</a>
                                <a href="{{url('student/create')}}" class="list-group-item
                                {{Request::getPathInfo() == '/student/create' ? 'active' :''}}
                                ">添加学生</a>
                            </div>
                        </div>
                    </div>
                @show
            </div>

            <div class="col-lg-9">

                @yield('content')

            </div>
        </div>
    </div>
</div>

@section('footer')
    <footer style="margin-top: 400px;" class="footer panel-footer">
        <div class="container">
            <!-- To the right -->
            <div class="pull-right">
                京ICP
            </div>
            <!-- Default to the left -->
            <strong>Copyright © 2017</strong>
        </div>
    </footer>
    <script src="{{asset('library/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('library/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('library/bower_components/message/js/messenger.min.js')}}"></script>
    <script src="{{asset('library/bower_components/message/js/messenger-theme-future.js')}}"></script>
    <script src="{{asset('js/ajaxfileupload.js')}}"></script>
    <script src="{{asset('js/modal_build.js')}}"></script>
@show
@section('javascript')

@show
</body>
</html>
