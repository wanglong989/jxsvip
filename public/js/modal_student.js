/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/modal_build.js":
/***/ (function(module, exports) {

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
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            'is_ajax': '1'
        },
        url: url, //你处理上传文件的服务端
        secureuri: false,
        fileElementId: id,
        dataType: 'json',
        success: function success(data) {
            callback(data);
        }
    });
    return false;
}

module.exports = {
    UploadFile: UploadFile,
    showMessenger: showMessenger
};

/***/ }),

/***/ "./resources/assets/js/modal_student.js":
/***/ (function(module, exports, __webpack_require__) {


var build = __webpack_require__("./resources/assets/js/modal_build.js");
/**
 * 添加修改学生信息
 */
$(document).on('click', '.js-save-student', function () {

    var t = $(this),
        dataPost = {
        'name': $('#name').val(),
        'age': $('#age').val(),
        'sex': $("input[name='sex']:checked").val()
    };

    if (!t.hasClass('disabled')) {
        t.addClass('disabled');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'post',
            url: !!t.attr('data-id') ? '/student/update/' + t.attr('data-id') : '/student/create',
            data: dataPost,
            dataType: 'json',
            async: true,
            success: function success(data) {
                t.removeClass('disabled');

                if (!!data.success) {
                    build.showMessenger(data.msg, 'success');
                    setTimeout(function () {
                        window.location.href = '/student/index';
                    }, 1000);
                } else {
                    build.showMessenger(data.msg, 'error');
                }
            },
            error: function error(msg) {
                t.removeClass('disabled');
                var response = JSON.parse(msg.responseText),
                    errorArray = [];
                for (var item in response) {
                    errorArray.push(response[item][0]);
                }
                build.showMessenger(errorArray[0], 'error');
            }
        });
    }
});

/**
 * 删除学生信息
 */
$(document).on('click', '.js-student-del', function () {
    var t = $(this),
        dataPost = {
        'id': t.attr('data-id')
    };
    if (confirm('确定要删除吗？')) {
        if (!t.hasClass('disabled')) {
            t.addClass('disabled');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'post',
                url: '/student/delete',
                data: dataPost,
                dataType: 'json',
                async: true,
                success: function success(data) {
                    t.removeClass('disabled');
                    if (!!data.success) {
                        build.showMessenger(data.msg, 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        build.showMessenger(data.msg, 'error');
                    }
                },
                error: function error(msg) {
                    t.removeClass('disabled');
                }
            });
        }
    }
});

/**
 * 书籍文件上传
 */
$(document).on('change', '#file', function (e) {
    console.log(e);
    var t = $(this),
        url = '/student/upload',
        id = t.attr('id'),
        callBack = function callBack(data) {
        console.log(data);
        if (!!data.success) {
            build.showMessenger(data.data.msg, 'success');
        } else {
            build.showMessenger(data.data.msg, 'error');
        }
    };

    build.UploadFile(url, id, callBack);
});

/**
 * 点击确认发送邮件
 */
$(document).on('click', '.js-send-email', function () {
    var t = $(this);
    if (!t.hasClass('disabled')) {
        t.addClass('disabled');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'post',
            url: '/student/email',
            data: {},
            dataType: 'json',
            async: true,
            success: function success(data) {
                consoe.log(data);
            },
            error: function error(msg) {
                t.removeClass('disabled');
            }
        });
    }
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/modal_student.js");


/***/ })

/******/ });