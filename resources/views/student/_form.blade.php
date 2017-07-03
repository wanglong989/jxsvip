<div class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-lg-2">
            姓名
        </label>
        <div class="col-lg-9">
            <input id="name" class="form-control " placeholder="姓名" value="{{isset($student->name) ? $student->name :''}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">
            年龄
        </label>
        <div class="col-lg-9">
            <input id="age" class="form-control col-lg-9" placeholder="年龄" value="{{isset($student->age) ? $student->age : ''}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">
            性别
        </label>
        <div class="col-lg-9">
            @foreach($student->sexArr() as $ind=>$val)
                <label class="radio-inline">
                    <input type="radio" name="sex"
                           {{ isset($student->sex) && $student->sex == $ind ? 'checked' : ''}}
                           value="{{$ind}}"> {{$val}}
                </label>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-lg-9 text-right">
            <a class="btn btn-sm btn-info js-save-student" data-id="{{isset($student->id) ? $student->id : ''}}">添加</a>
        </div>
    </div>

</div>