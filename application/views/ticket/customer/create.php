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


        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                    <a class="btn btn-success btn-sm pull-right" href="<?= base_url('request') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                        <div class="row">
<div class="col-md-9 col-sm-8 col-xs-12" style="background-color: #F6F6F6;border-right: 15px solid white;">
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="organisation_extra">Subject *
                                </label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input  required="required" id="ticket_subject" placeholder="Enter ticket subject" name="ticket_subject" value="<?php echo set_value('ticket_subject'); ?>" type="text" class="form-control col-md-7 col-xs-12"><?php echo form_error('ticket_subject'); ?>
                                </div>     
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="organisation_notes">Description *
                                </label>
                                <div class="col-md-10 col-sm-9 col-xs-12">

                                    <textarea rows="7" required="required" id="ticket_description" placeholder="Enter ticket description" name="ticket_description" class="form-control col-md-7 col-xs-12"><?php echo set_value('ticket_description'); ?></textarea>
                                    <?php echo form_error('ticket_description'); ?>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="organisation_notes">Attachment(s)
                                </label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input  multiple id="image" name="file" type="file" class="file-loading">

                                </div>
                            </div>

                            <input type="hidden" id="attach_ids" name="attachment_id"> 
                            <input type="hidden" id="pre_ids"> 


                            <div class="clearfix"></div>
                            <div class="row">&nbsp;</div>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group  pull-right">

                                <div>
                                    <a id="cancel" href="<?= base_url('request') ?>" class="btn btn-default ">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 pull-right" style="background-color: #F6F6F6">
                                <div class="side-box-content"><h3>Submit a request for assistance</h3>
    <p>Fields marked with an asterisk (*) are mandatory.</p><p>You'll be notified when our staff answers your request.</p>
<div style="clear:left; height:8px;"></div></div>
                            </div>
                        </div></form></div>  </div></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var arr = new Array();

//        CKEDITOR.replace('ticket_description');

        $("#attach_ids").val('');

        var base_url = $("#base_url").val();
        $("#image").fileinput({
            uploadUrl: base_url + 'common/upload_attachment',
            uploadAsync: true,
            overwriteInitial: false,
            showUpload: false,
            showRemove: false,
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


        $(document).on("click", ".kv-file-remove", function () {
            var del_id = $(this).parents(".file-preview-frame").attr("response_id");
            var url = base_url + 'common/delete_attachment';

            ajaxRequest(url, 'POST', {id: del_id}, function (data) {
                if (data == 1) {
                    var attchstr = $('body').find("#attach_ids").val();

                    var new_string = remove(attchstr, del_id);

                    $('body').find("#attach_ids").val('');
                    $('body').find("#attach_ids").val(new_string);
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
    });



</script>


<!-- footer content -->
