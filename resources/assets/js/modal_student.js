
var build = require('./modal_build');
/**
 * 添加修改学生信息
 */
$(document).on('click','.js-save-student',function () {

    var t = $(this),
        dataPost = {
            'name':$('#name').val(),
            'age':$('#age').val(),
            'sex':$("input[name='sex']:checked").val()
        };

    if(!t.hasClass('disabled')){
        t.addClass('disabled');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            url:!!t.attr('data-id') ? '/student/update/'+t.attr('data-id'):'/student/create' ,
            data: dataPost,
            dataType: 'json',
            async: true,
            success: function (data) {
                t.removeClass('disabled');

                if (!!data.success) {
                    build.showMessenger(data.msg,'success');
                    setTimeout(function () {
                        window.location.href = '/student/index';
                    },1000)
                } else {
                    build.showMessenger(data.msg,'error');
                }
            },
            error:function (msg) {
                t.removeClass('disabled');
                var response=JSON.parse(msg.responseText),
                    errorArray = [];
                for(var item in response){
                    errorArray.push(response[item][0]);
                }
                build.showMessenger(errorArray[0],'error');

            }
        });
    }
});

/**
 * 删除学生信息
 */
$(document).on('click','.js-student-del',function () {
    var t = $(this),
        dataPost = {
            'id':t.attr('data-id')
        };
    if(confirm('确定要删除吗？')){
        if(!t.hasClass('disabled')){
            t.addClass('disabled');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url:'/student/delete',
                data: dataPost,
                dataType: 'json',
                async: true,
                success: function (data) {
                    t.removeClass('disabled');
                    if (!!data.success) {
                        build.showMessenger(data.msg,'success');
                        setTimeout(function () {
                            location.reload();
                        },1000)
                    } else {
                        build.showMessenger(data.msg,'error');
                    }
                },
                error:function (msg) {
                    t.removeClass('disabled');
                }
            });
        }
    }

});

/**
 * 书籍文件上传
 */
$(document).on('change','#file',function (e) {
    console.log(e);
    var t = $(this),
        url = '/student/upload',
        id = t.attr('id'),
        callBack = function (data) {
            console.log(data);
            if(!!data.success){
                build.showMessenger(data.data.msg,'success');
            }else{
                build.showMessenger(data.data.msg,'error');
            }
        };

    build.UploadFile(url,id,callBack)
});


/**
 * 点击确认发送邮件
 */
$(document).on('click','.js-send-email',function () {
        var t = $(this);
        if(!t.hasClass('disabled')){
            t.addClass('disabled');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url:'/student/email',
                data: {},
                dataType: 'json',
                async: true,
                success: function (data) {
                    consoe.log(data);
                },
                error:function (msg) {
                    t.removeClass('disabled');
                }
            });
        }
    });
