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
    for(var i = 0, len = arr.length; i < len; i++){
        if(!hash[arr[i]['id']]){
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
//调用ajax的dialog
var ajax_dialog = function (title, url) {
    var width = arguments[2] ? arguments[2] : '70%';

    var str = $('<div id="ajax_dialog" title="' + title + '"></div>')
        .load(url);
    str.dialog({
        width: width,
        modal: true,
        position: {my: "left+100 top+30", at: "left+100 top+30"},

        close: function () {
            str.dialog("destroy");
        }
    });
}

//建立树形表格
$.fn.tree_table = function (data) {
    var pid = arguments[1] ? arguments[1] : 0;
    var checkbox = arguments[2] ? true : false;

    //表头
    str = '<thead>';
    $.each(data.title, function (key, val) {
        str += "<th>" + val + "</th>";
    });
    if (checkbox == true) {
        str += '<th><input type="checkbox" id="select_table_checkbox" title="反选" /></th>';
    }
    str += "</thead><tbody>";

    //排序表体，通过递归进行排序
    function sort(data, pid) {
        for (i in data) {
            if (data[i]['parent_id'] == pid) {
                str += '<tr class="table_tr" id="' + data[i].id + '" data-tt-id="' + data[i].id + '" ';
                //if (data[i].parent_id == pid) {
                str += 'data-tt-parent-id="' + data[i].parent_id + '"';
                //}
                str += '>';

                $.each(data[i], function (k, v) {
                    str += '<td > ' + v + ' </td >';
                });
                if (checkbox == true) {
                    str += '<td><input type="checkbox" value="' + data[i].id + '" /></td>';
                }
                str += '</tr>';
                sort(data, data[i]['id']);
            }
        }
    }

    //获得表体
    table_data = sort(data.data, pid);

    str += '</tbody>'
    this.append(str);
    this.treetable({
        column: 1,
        expandable: true,
        initialState: "expanded",
        expanderTemplate: '<a href="#"><i class="glyphicon glyphicon-folder-open"></i></a>'
    });
    //可以全选的checkbox
    if (checkbox == true) {
        $('#select_table_checkbox').click(function () {
            $.each($('tbody input:checkbox'), function () {
                obj = $(this);
                if (obj.prop("checked") == true) {
                    obj.prop('checked', false);
                } else {
                    obj.prop('checked', true);
                }
            });
        });
    }
}

$(function () {

    $(window).resize(function () {
        $('body').find('iframe').attr('height', $('body').height() - 70);
    });

});