/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getStep(step) {
    thisobj = $('#step-content');
    if (step === 2 && !check_config()) {
        return false;
    }
    if (step === 3 && !check_databese_set()) {
        return false;
    }

    $('#step').text(step);
    $('#step-list').children().removeClass('active').addClass('disabled');
    $('#step' + step).removeClass('disabled').addClass('active');

    width = step * 25;
    progress = $('#progress');
    progress.attr('aria-valuemin', width);
    progress.width(width + '%');
    progress.text(width + '%');
    progress.addClass('progress-bar-success');

    if (step === 3) {
        db_cover = $('#db_cover').is(':checked') ? 1 : 0;
        thisobj.load('install.php?step=3&db_cover=' + db_cover);
        return;
    }


    $.ajax({
        url: 'install.php?step=' + step,
        success: function (data) {
            thisobj.html(data);
        }
    });

}

function check_config() {
    var base_url=$('#siteurl').val();
    var error=1;
    warning = $('#warning');
    if (!base_url) {
        warning.text("网站地址必须填写！！").show().fadeOut(3000);
        return false;
    }
    $.ajaxSetup({async: false});
    $.post('install.php?step=5', {siteurl:base_url},function(data) {
        if (data) {
            warning.text(data).show().fadeOut(6000);
            error = 2;
        }
    });
    if (error === 1) {
        return true;
    }
}

function check_databese_set() {
    db_host = $('#db_host').val();
    db_name = $('#db_name').val();
    db_user = $('#db_user').val();
    db_pass = $('#db_pass').val();
    db_pref = $('#db_pref').val();

    warning = $('#warning');
    if (!db_host || !db_name || !db_user) {
        warning.text("数据库地址、名称、管理员必须填写！！").show().fadeOut(3000);
        return false;
    }
    var error = 1;
    $.ajaxSetup({async: false});
    $.post('install.php?step=6', {
        'db_host': db_host,
        'db_name': db_name,
        'db_user': db_user,
        'db_pass': db_pass,
        'db_pref': db_pref
    }, function (data) {
        if (data) {
            warning.text(data).show().fadeOut(6000);
            error = 2;
        }
    });

    if (error === 1) {
        return true;
    }

}