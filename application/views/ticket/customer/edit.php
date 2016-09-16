<div role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= $mainHeading ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                        <a class="btn btn-success btn-sm pull-right" href="<?= base_url('request') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal form-label-left"   action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $form_data['ticket_id'] ?>" name="ticket_id">

                            <span class="section">Ticket Information</span>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-2 col-xs-12" for="ticket_subject">Subject <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7 col-sm-9 col-xs-12 ">
                                            <input id="ticket_subject" data-parsley-error-message="The Subject field is required." class="form-control col-md-7 col-xs-12 <?php echo (strlen(form_error('ticket_subject')) > 0) ? "parsley-error" : "" ?>" value="<?php echo ( $method == "post") ? set_value('ticket_subject') : $form_data['ticket_subject']; ?>" name="ticket_subject" placeholder="Ticket Subject"  type="text">
                                            <?php echo form_error('ticket_subject'); ?>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-2 col-xs-12" for="ticket_description">Description <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7 col-sm-9 col-xs-12 ">
                                            <textarea  rows="7" data-parsley-error-message="The Description field is required."  id="ticket_description" required="required" placeholder="Enter Description" name="ticket_description" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('ticket_description')) > 0) ? "parsley-error" : "" ?>"><?= ( $method == "post") ? set_value('ticket_description') : $form_data['ticket_description']; ?></textarea>
                                            <?php echo form_error('ticket_description'); ?>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-2 col-xs-12" for="organisation_notes" >Attachment(s)
                                        </label>
                                        <div class="col-md-7 col-sm-9 col-xs-12">
                                            <input  multiple id="image" name="file" type="file" class="file-loading">

                                        </div>
                                    </div>
                                </div></div>



                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group  pull-right">
                                <div class="">
                                    <a id="cancel" href="<?= base_url('request') ?>" class="btn btn-default ">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                    </div>
                    <input type="hidden" id="attach_ids" name="attachment_id"> 
                    <input type="hidden" id="pre_ids"> 


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div tabindex="-1" class="file-preview-detail-modal modal fade" id="file-preview">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&#10006;</button>
                <h3 class="modal-title">Detailed Preview <small class="small-name"></small></h3>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function () {
        var arr = new Array();
        $("#attach_ids").val('');
        
//          CKEDITOR.replace('ticket_description');
        
        
        var base_url = $("#base_url").val();
        $("#image").fileinput({
            uploadUrl: base_url + 'common/upload_attachment',
            uploadAsync: true,
            showRemove: false,
            overwriteInitial: false,
            initialPreview: [
<?php
if (!empty($attachment)) {
    foreach ($attachment as $val) {
        echo "'$val'" . ',';
    }
}
?>

            ],
            previewFileIconSettings: {
                'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                'sql': '<i class="fa fa-file-word-o text-primary"></i>',
                'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                'htm': '<i class="fa fa-file-code-o text-info"></i>',
                'txt': '<i class="fa fa-file-text-o text-info"></i>',
                'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
                'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
            },
            initialPreviewConfig: <?php
if ($attachment_info != '') {
    echo $attachment_info;
} else {
    echo '{}';
}
?>,
        });


        $image = $('#image');

        $image.on('fileuploaded', function (event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;


            arr.push(response.attchment_id);
            $("#attach_ids").val(arr);
            $("#pre_ids").val(arr);
            $("#" + previewId).attr("response_id", response.attchment_id);
        }).on("filebatchselected", function (event, files) {
            $image.fileinput("upload");
        });

        $(document).on("click", ".btn-preview", function () {
            var type = $(this).attr("data-type");
            var this_obj = $(this);
            var html;
          
            switch (type)
            {
                case "doc":
                    html = "<pre>"+$(this_obj).parents().find("pre").html()+"</pre>";
                    break;
                case "object":
                    html = '<object class="obj_class" type="pdf" data="' + $(this_obj).attr("data-value") + '"></object>';
                    break;
            }

            var caption = $(this).parent(".file-preview-other-frame").find(".file-footer-caption").text();
            console.log(html);
            $("#file-preview").find(".small-name").text(caption);
            $("#file-preview").find(".modal-body").html(html);
            $("#file-preview").modal("show");
        })

        $(document).on("click", ".kv-file-remove", function () {
            var delete_id = $(this).attr('data-key');

            if (typeof delete_id != 'undefined') {
                del_id = delete_id;
            }
            else {
                del_id = $(this).parents(".file-preview-frame").attr("response_id");
            }


            var url = base_url + 'common/delete_attachment';

            ajaxRequest(url, 'POST', {id: del_id}, function (data) {
                if (data == 1) {
                    var attchstr = $('body').find("#attach_ids").val();
                    if (attchstr != '') {
                        var new_string = remove(attchstr, del_id);

                        $('body').find("#attach_ids").val('');
                        $('body').find("#attach_ids").val(new_string);
                    }
                }
            });
        });

        $image.on("filepredelete", function (jqXHR) {
            console.log($(this).parents(".file-preview-frame").attr("response_id"));
            // you can also send any data/object that you can receive on `filecustomerror` event
        });

        var pre_ids = $("#pre_ids").val();
        if (pre_ids != '') {
            var url = base_url + 'common/delete_attachment';
            ajaxRequest(url, 'POST', {id: pre_ids}, function (data) {
            });
        }

        $('body').find("#cancel").click(function () {
            var pre_ids = $("#pre_ids").val();
            if (pre_ids != '') {
                var url = base_url + 'common/delete_attachment';
                ajaxRequest(url, 'POST', {id: pre_ids}, function (data) {
                });
            }
        });

        $('body').find(".kv-file-download").click(function () {
            
        });

        $("body").find(".file-preview-thumbnails .file-footer-buttons").each(function () {

            $(this).append('<a target="_blank" href="'+base_url+'common/download/'+$(this).find(".kv-file-remove").attr("data-key")+'" title="Download file" class="kv-file-download btn btn-xs btn-default" type="button"><i class="fa fa-download"></i></a>');
        })
    });



</script>

<style>

    .obj_class{
        width: 100%;
        min-height: 400px;
    }
    @media all and (max-width:640px) {
        .obj_class{
            max-height: 300px;
            min-height: 300px;
        }

    }
</style>