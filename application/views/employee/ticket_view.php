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

                    <div class="x_content">
                        <div class="">

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                                            <a class="btn btn-success btn-sm pull-right" href="javascript:history.back();"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-1 col-sm-2">
                                                        <article class="media event">
                                                            <span class="pull-left date">
                                                                <p class="month"><?php echo getMonth($form_data['ticket_updated']); ?></p>
                                                                <p class="day"><?php echo getDay($form_data['ticket_updated']); ?></p>
                                                            </span></div>
                                                    <div class="col-md-11 col-sm-10">
                                                        <div class="message_wrapper">
                                                            <h4 class="heading"><?php
                                                                if (!empty($form_data)) {
                                                                    echo $form_data['ticket_subject'];
                                                                }
                                                                ?></h4>
                                                            <p class="message"><?php
                                                                if (!empty($form_data)) {
                                                                    echo $form_data['ticket_description'];
                                                                }
                                                                ?>.</p>
                                                        </div></div>

                                                    </article>
                                                </div>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title collapse-link ">
                                            <h2>Attachment</h2>
                                            <ul class="nav navbar-right pull-right panel_toolbox">
                                                <li><a class=""><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div class="row">
                                                <div class="col-md-12">
                                                   <input  multiple id="image" name="file" type="file" class="file-loading"></div>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Comments</h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          
                                            <div class="row">
                                               <div class="col-sm-12 col-md-12 col-xs-12 mail_list_column">

                                            <div class="mail_list">
                                                <div class="left image">
                                                    <img alt="Avatar" class=" img-responsive" src="<?php echo base_url().'assets/images/default_avatar_male.jpg';?>">
                                                </div>
                                                <div class="right">
                                               <textarea class="form-control comment_box" name="textarea" required="required" id="textarea"></textarea>
                                               <div class="clearfix"></div>
                                               <button class="btn btn-primary btn-sm pull-right" type="button">Comment</button>
                                                   
                                                </div>
                                            </div>
                                            <div class="mail_list">
                                                <div class="left image">
                                                    <img alt="Avatar" class=" img-responsive" src="<?php echo base_url().'assets/images/default_avatar_male.jpg';?>">
                                                </div>
                                                <div class="right">
                                                    <h3>Dennis Mugo <small >3.00 PM</small></h3>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                            <div class="mail_list">
                                                <div class="left image">
                                                  <img alt="Avatar" class=" img-responsive"  src="<?php echo base_url().'assets/images/default_avatar_male.jpg';?>">
                                                </div>
                                                <div class="right">
                                                    <h3>Jane Nobert <small>4.09 PM</small></h3>
                                                    <p><span class="badge">To</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                            <div class="mail_list">
                                                <div class="left image">
                                                 <img alt="Avatar" class=" img-responsive"  src="<?php echo base_url().'assets/images/default_avatar_male.jpg';?>">
                                                </div>
                                                <div class="right">
                                                    <h3>Musimbi Anne <small>4.09 PM</small></h3>
                                                    <p><span class="badge">CC</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                            <div class="mail_list">
                                                <div class="left image">
                                                 <img alt="Avatar" class=" img-responsive"  src="<?php echo base_url().'assets/images/default_avatar_male.jpg';?>">
                                                </div>
                                                <div class="right">
                                                    <h3>Jon Dibbs <small>4.09 PM</small></h3>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation t enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                            

                                          <p class="url">
                                                            <span data-icon="" aria-hidden="true" class="fs1 text-info"></span>
                                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                        </p>

                                        </div>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    $(document).ready(function() {
        var arr = new Array();
        $("#attach_ids").val('');
        ;
        var base_url = $("#base_url").val();
        $("#image").fileinput({
            showUpload: false,
            overwriteInitial: false,
            showCaption: false,
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




        $(document).on("click", ".btn-preview", function() {
            var type = $(this).attr("data-type");
            var this_obj = $(this);
            var html;

            switch (type)
            {
                case "doc":
                    html = "<pre>" + $(this_obj).parents().find("pre").html() + "</pre>";
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







        $("body").find(".file-preview-thumbnails .file-footer-buttons").each(function() {

            $(this).append('<a target="_blank" href="' + base_url + 'common/download/' + $(this).find(".kv-file-remove").attr("data-key") + '" title="Download file" class="kv-file-download btn btn-xs btn-default" type="button"><i class="fa fa-download"></i></a>');
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

    .btn.btn-primary.btn-file,.fileinput-remove,.kv-file-remove {
        display: none;
    }
    .comment_box{
        margin-bottom: 1%;
        height: available !important;
        max-height: 100%;
        overflow: visible !important
        
    }
    .mail_list_column .right {
        padding-bottom: 10px
    }


</style>

