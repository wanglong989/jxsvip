/**
 * 通用提示弹窗
 */

Messenger.options = {
    extraClasses: 'messenger-fixed messenger-theme-future messenger-on-bottom messenger-on-right'
};

/**
 * 公用 alert 方法
 * @param message 提示文字
 * @param type success error
 */
function showMessenger(message, type) {
    Messenger().post({
        message: message,
        type: type,
        hideAfter: 3,
        showCloseButton: true
    });
}

/**
 * 文件通用上传方法
 * @url 接口地址
 * @id  input id
 * @callback 回调函数
 */
function UploadFile(url, id, callback) {
    $.ajaxFileUpload({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            'is_ajax': '1'
        },
        url: url, //你处理上传文件的服务端
        secureuri: false,
        fileElementId: id,
        dataType: 'json',
        success: function (data) {
            callback(data);
        }
    });
    return false;
}

module.exports = {
    UploadFile: UploadFile,
    showMessenger: showMessenger
};
