/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ajaxRequest(url, method, data, successfun, errorfun) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: successfun,
        error: errorfun
    });
}

function remove(string, to_remove)
{

    if (string != '' && typeof string != 'undefined') {
        var elements = string.split(",");
        var remove_index = elements.indexOf(to_remove);
        elements.splice(remove_index, 1);
        var result = elements.join(",");
        return result;
    }
}


function setLocalStorage(key, value) {

    var user_id = $("body").find("#local_user_id").val();
    var level = $("body").find("#local_access_level").val();

    var data = localStorage.getItem("user" + user_id + level);
    data = JSON.parse(localStorage.getItem("user" + user_id + level));

    if (data != null && data != 'null' && (Object.keys(data).length > 0)) {

        data[key] = value;
        localStorage.setItem("user" + user_id + level, JSON.stringify(data));

    }
    else {
        data = {};
        data[key] = value;
        localStorage.setItem("user" + user_id + level, JSON.stringify(data));

    }
    data = JSON.parse(localStorage.getItem("user" + user_id + level));
    
}

function getLocalStorage(key) {
    var user_id = $("body").find("#local_user_id").val();
    var level = $("body").find("#local_access_level").val();
    data = JSON.parse(localStorage.getItem("user" + user_id + level));

    if ((data != null)) {
        if (data.hasOwnProperty(key))
            return data[key];
        else
            return  "";
    }
    else {
        return "";
    }


}

function clearLocalStorage() {
    var user_id = $("body").find("#local_user_id").val();
    var level = $("body").find("#local_access_level").val();

    localStorage.clear("user" + user_id + level);
}

$(document).ready(function () {

    var base_url = $("#base_url").val();

    $("body").find('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 3000,
        outDuration: 1600,
        linkElement: '.animsition-link',
        // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
//        loadingInner: '<img src="' + base_url + 'assets/img/green_loading.gif" />', // e.g '<img src="loading.svg" />'
        timeout: false,
        unSupportCss: ['animation-duration',
            '-webkit-animation-duration',
            '-o-animation-duration'
        ],
        timeoutCountdown: 10000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',
        transition: function (url) {
            window.location.href = url;
        }
    });


    $('body').on('change', 'form input', function () {
        $(this).removeClass('parsley-error');
        $(this).next('.server_message').css('display', 'none');
    })


    $('body').find('.collapse-link').click(function () {
        var x_panel = $(this).closest('div.x_panel');
        var button = $(this).find('i');
        var content = x_panel.find('div.x_content');
        content.slideToggle(200);
        (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
        (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        setTimeout(function () {
            x_panel.resize();
        }, 50);
    });
});