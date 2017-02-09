$(document).ready(function () {
    var base_url = $("#base_url").val();
    var forumpostid = $('body').find('#forumpostid').val();
    //onload comments

    var status = $('body').find('#comment_status').val();
    if (status == 0) {
        loadCommentView(forumpostid);
    } else {
        $('body').find('#comment_view').css('display', 'none');
    }

    // Ajax form submit for add comment
    $('body').on('click', '#send_comment', function () {
//        if(CKEDITOR.instances.comments.getData()!=""){
        $('body').find('.comments li').html('');
        var $form = $('body').find('#comment_form');
        var $com = $('body').find('#comments');
        console.log($com + 'test');
        var obj = $(this);
        var flag = 0;
        $('.small_loader').css('display', 'block');
        $(obj).addClass('disabled');
            CKEDITOR.instances.comments.updateElement();
      
        var form_data = $('body').find('#comment_form').serialize();
      
        $.ajax({
            type: 'post',
            url: base_url + 'support/addComment/',
            data: form_data,
            success: function (response) {
                var err = $.parseJSON(response);
                if (err.result == false) {
                    $.each(err.error, function (index, value) {
                        $('body').find("." + index).find('li').empty();
                        $('body').find("." + index).find('li').text(value);

                    });
                } else {
                    loadCommentView(forumpostid);
                }

             

            },
            complete: function () {
                $(obj).removeClass("disabled");
                $('.small_loader').css('display', 'none');

            }
        });


    });
    //show browse button....
    $('body').on('click', '#attach_file', function () {
        $('body').find('#attachment').trigger('click');
    })
    $('body').on('change', '#attachment', function () {

        var file_data = $(this).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: base_url + 'common/upload_attachment/', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                var attachment_res = $.parseJSON(response);
                $('#attchment_list').append('<div class="col-md-12"><a href="javascript:void(0)" style="font-weight:bold;">' + attachment_res.attachment_name + '</a>\n\
                            <span style="font-weight:normal;"><a href="javascript:void(0)" class="text-danger"  id="remove_file" data-attachment="' + attachment_res.attchment_id + '"><i class="fa fa-remove"></i></span></a><input type="hidden" name="attachment_id[]" value=' + attachment_res.attchment_id + '></div>')
//                   $('#attchment_list').append()
            }
        });

    });

    //remove uploaded file...
    $('body').on('click', '#remove_file', function () {
        var obj = $(this);
        $.ajax({
            type: 'post',
            url: base_url + 'common/delete_attachment/',
            data: {'id': $(obj).attr('data-attachment')},
            success: function (response) {
                $(obj).parent().parent('div').remove();
            }
        });
    });




    $(document).on('click', '#like_btn', function () {
        var user_id = $(this).attr('user_id');
        var post_id = $(this).attr('post_id');

        $.ajax({
            type: 'post',
            url: base_url + 'supportController/likePost/',
            data: {'user_id': user_id, 'post_id': post_id},
            success: function (response) {
                $('body').find('#like_div').empty();
                $('body').find('#like_div').html("<div class='col-md-12'>Your vote has been registered, thanks! (<a post_id='" + post_id + "' user_id='" + user_id + "' href='javascript:void(0)' id='unlike_btn'>undo</a>)</div>");
            }
        });
    });
    $(document).on('click', '#unlike_btn', function () {
        var user_id = $(this).attr('user_id');
        var post_id = $(this).attr('post_id');
        $.ajax({
            type: 'post',
            url: base_url + 'supportController/unlikePost/',
            data: {'user_id': user_id, 'post_id': post_id},
            success: function (response) {

                var obj = $('body').find('.clone_div').clone();
                $(obj).removeAttr('hidden');
                $(obj).find('#count').text(response);
                $('body').find('#like_div').empty();
                $('body').find('#like_div').append(obj);

            }
        });
    });
    $(document).on('click', '.ans_link', function () {
        console.log('test');
        var obj = $(this);
        var comment_id = $(this).attr('comment_id');
        var article_id = $(this).attr('article_id');
        var status = $(this).attr('data-status');
        $.ajax({
            type: 'post',
            url: base_url + 'supportController/postAnswer/',
            data: {'comment_id': comment_id, 'article_id': article_id, 'status': status},
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status > 0) {
                    $(obj).addClass('active-ans');
                    $(obj).removeClass('ans');
                    $(obj).attr('data-status', '0');

                    $('body').find('.ans_span').html('<span class="status_res"><b>Answer</b></span>');
                } else {
                    $(obj).addClass('ans');
                    $(obj).attr('data-status', '1');
                    $(obj).removeClass('active-ans');
                    if (res.count == 0) {
                        $('body').find('.ans_span').empty();
                    }
                }

            }
        });
    });
    $(document).on('click', '.restrict', function () {
        var obj = $(this);
        var article_id = $(this).attr('article_id');
        var post_data = [];
        if (obj.hasClass('restrict_commnet')) {
            $(obj).removeClass('restrict_commnet');
            var type = $(obj).attr('data-type');
            var type = $(obj).attr('data-type');
            if (type == 'highlight') {
                post_data = {"forum_article_highlight_status": "0", "article_id": article_id}
            } else if ((type == 'pin')) {
                post_data = {"forum_article_homepage_status": "0", "article_id": article_id}
            } else {
                post_data = {"forum_article_comment_status": "0", "article_id": article_id}
                loadCommentView(forumpostid);
                $('body').find('#comment_view').css('display', 'block');
            }
        } else {
            $(obj).addClass('restrict_commnet');
            var type = $(obj).attr('data-type');
            if (type == 'highlight') {
                post_data = {"forum_article_highlight_status": "1", "article_id": article_id}
            } else if ((type == 'pin')) {
                post_data = {"forum_article_homepage_status": "1", "article_id": article_id}

            } else {
                post_data = {"forum_article_comment_status": "1", "article_id": article_id}
                $('body').find('#comment_view').css('display', 'none');
            }
        }


        $.ajax({
            type: 'post',
            url: base_url + 'supportController/articleSetting/',
            data: post_data,
            success: function (response) {


            }
        });
    });
    $(document).on('click', '.idea_status', function () {
        var obj = $(this);
        var span = obj.find('span');
        var article_id = $(this).attr('article_id');
        var type = $(this).attr('type');
        if (type == 'Not planned') {
            type = 'not_planned';
        }
        var post_data = [];
        if (span.hasClass('default_idea')) {
            $(span).removeClass('default_idea');
            $(this).parent().find('span').attr('class', '');
            $(this).parent().find('span').attr('class', 'default_idea status_res');
            $(span).attr('class', '');
            $(span).attr('class', type + ' status_res');
            post_data = {"article_idea_status": $(this).attr('type'), "article_id": article_id}
        } else {
            $(span).removeClass(type);
            $(span).addClass('default_idea');
            post_data = {"article_idea_status": 'None', "article_id": article_id}
        }

        $.ajax({
            type: 'post',
            url: base_url + 'supportController/changeIdeaStatus/',
            data: post_data,
            success: function (response) {
                if (response) {
                    if (response != 'None') {
                        if (response == 'Not planned') {
                            var status_class = 'not_planned';
                        } else {
                            var status_class = response;
                        }
                        var status_html = '<span class="status_res dy_status ' + status_class + '"><b>' + response + '</b></span>';
                        $('body').find('.ans_span').empty();
                        $('body').find('.ans_span').append(status_html);
                    } else {
                        $('body').find('.ans_span').empty();

                    }
                }
            }
        });
    });

    $(document).on("click", ".postTypeDelete", function () {
        var id = $(this).attr("id");
        var forum_id = $(this).attr("forum_id");
        bootbox.confirm({
            size: 'small',
            message: "Are you sure?",
            callback: function (result) {
                if (result) {
                    var url = base_url + 'support/deleteforumpost';
                    window.location.href = url + "/" + id + '/' + forum_id;
                }
            }
        });


    });
    $(document).on("click", ".delete_comment", function () {
        var id = $(this).attr("data-id");
        var obj = $(this);
        bootbox.confirm({
            size: 'small',
            message: "Are you sure?",
            callback: function (result) {
                if (result) {
                    var url = base_url + 'support/deletecomment'
                    var method = "POST";
                    var data = {comment_id: id};
                    ajaxRequest(url, method, data, function (data) {
                        var data = $.parseJSON(data);
                        if (data) {
                            $(obj).closest('.mail_list_main').fadeOut("normal", function () {
                                $(obj).remove();
                            });
                        }
                    });
                }
            }
        });


    });
    $(document).on('click', '.edit_comment', function () {
        var id = $(this).attr('data-id');
        $(this).parents('.mail_list').hide();
        $('#' + id).css('display', 'block');
        var obj = $('#' + id).find('.comment');
           CKEDITOR.replace('comment_message_'+id, {height: 150});
    });
    $(document).on('click', '.cancel_update', function () {
        var id = $(this).attr('data-id');
         var comment_id = 'comment_message_'+id;
     
         var oEditor   = CKEDITOR.instances[comment_id];
        
         oEditor.destroy();
        $('#' + id).siblings('.mail_list').css('display', '');
        $('#' + id).css('display', 'none');

    });
    $(document).on('click', '.update_comm', function () {
//        $(this).parents('.mail_list').hide();
        var ths = $(this);
        var comment_id = $(this).attr('data-id');
        var id = 'comment_message_'+comment_id;
        var oEditor   = CKEDITOR.instances[id];
        oEditor.updateElement();
      
        var form_data = $('body').find('#comment_form_' + comment_id).serialize();
        $.ajax({
            type: 'post',
            url: base_url + 'support/updateComment/',
            data: form_data,
            success: function (response) {
                var err = $.parseJSON(response);
                if (err.result == false) {
                    $.each(err.error, function (index, value) {
                        $('body').find('#comment_form_' + comment_id).find("." + index).find('li').empty();
                        $('body').find('#comment_form_' + comment_id).find("." + index).find('li').text(value);

                    });
                } else {
                    
                    $(ths).parents('.mail_list_main').find('.media-body .content').html(err.msg);
                    $(ths).parents('.mail_list_main').find('.media-body p small').html(err.uptime);
                    $('body').find('#comment_form_' + comment_id).find('.comment').val(err.msg);
                    $('#' + comment_id).siblings('.mail_list').css('display', '');
                    $('#' + comment_id).css('display', 'none');
                             oEditor.destroy();
                }
                
           
            }
        });
    });


});
function loadCommentView(forumpostid) {
    var base_url = $("#base_url").val();

    // load comment view....
    $("body").find('#comment_view').load(base_url + 'supportController/comment/' + forumpostid + '', {}, function () {
        $("body").find(".animsition-loading").addClass("hide");
        
    });

}