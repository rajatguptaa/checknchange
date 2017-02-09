$(document).ready(function () {

    var base_url = $("#base_url").val();
    $(".chosen").chosen({width: "100%"});
    $(".chosen_width").chosen({width: "41%"});

    $('body').on('change', '.select_content', function () {

        var content_value = $(this).val();
        if (content_value == 'Articles') {
            $('.content_order_div').css('display', 'block');
        } else {
            $('.content_order_div').css('display', 'none');
        }
    });
    var content_value = $('.select_content').val();
    if (content_value == 'Articles') {
        $('.content_order_div').css('display', 'block');
    } else {
        $('.content_order_div').css('display', 'none');
    }
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

    if ($('input[name="edit_visibility_restriction_id"]:checked').val() != 'Agents only') {
        console.log('TEST');
        $('#forum_is_locked_false').attr('disabled', false);
        $('#forum_is_locked_false').attr('checked', 'true');
    } else {


        $('#forum_is_locked_false').attr('checked', false);
        $('#forum_is_locked_true').prop('checked', true)
        $('#forum_is_locked_false').attr('disabled', 'true');

    }

    $('input[name="visibility_restriction_id"]').change(function () {
        if ($(this).val() != 'Agents only') {
            console.log('TEST');
            $('#forum_is_locked_false').attr('disabled', false);
            $('#forum_is_locked_false').attr('checked', 'true');
        } else {


            $('#forum_is_locked_false').attr('checked', false);
            $('#forum_is_locked_true').prop('checked', true)
            $('#forum_is_locked_false').attr('disabled', 'true');

        }
    });


    $("body").on("click", ".delete", function () {
        var id = $(this).attr("id");
        bootbox.confirm({
            size: 'small',
            message: "Are you sure delete forum and associates post?",
            callback: function (result) {
                if (result) {
                    var url = base_url + 'support/deletesupportforum';
                    window.location.href = url + "/" + id;
                }
            }
        });


    });
    $("body").on("click", ".postTypeDelete", function () {
       var id = $(this).attr("id");
        var forum_id = $(this).attr("forum_id");
        bootbox.confirm({
            size: 'small',
            message: "You are about to delete this article and all associated comments. Are you sure ?",
            callback: function (result) {
                if (result) {
                    var url = base_url + 'support/deleteforumpost';
                    window.location.href = url + "/" + id +'/'+forum_id;
                }
            }
        });


    });
});


