//错误提醒窗口
var show_error = function (message) {
    var color = arguments[1] ? arguments[1] : 'warning';
    if (check_json(message)) {
        m = JSON.parse(message);
        message = m.message;
    }

    str = $('<div class="alert alert-' + color + ' alert-dismissible boxmsg" role="alert"></div>');
    str.html(message);
    $('body').append(str);
    str.fadeIn().fadeOut(6000);
    setTimeout(function () {
        str.remove();
    }, 6000);
}

//检测字符串是否是JSON
var check_json = function (str) {
    return (str.match("\{(.+:.+,*){1,}\}")) ? true : false;
}

//JSON数组去重
function unique(arr) {
    var hash = {};
    var result = [];
    for (var i = 0, len = arr.length; i < len; i++) {
        if (!hash[arr[i]['id']]) {
            result.push(arr[i]);
            hash[arr[i]['id']] = true;
        }
    }
    return result;
}
//差集
minus = function (a, b) {
    return $.merge($.grep(a, function (i) {
            return $.inArray(i, b) == -1;
        }), $.grep(b, function (i) {
            return $.inArray(i, a) == -1;
        })
    );
};


$(function () {

    $(window).resize(function () {
        $('body').find('iframe').attr('height', $('body').height() - 70);
    });

});