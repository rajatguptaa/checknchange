<div role="main">
    <div class="container">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= $mainHeading ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                     <a class="btn btn-success btn-sm pull-right" href="javascript:void(0);" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-xs-12" style="border-right: 15px solid white;">
                                <div class="item form-group">
                                    <h2 class="col-md-12 col-sm-12 col-xs-12" for="title">
                                        <?php
                                        if (!empty($forum_detail)) {

                                            if (!empty($forum_detail)) {
                                                $posttype = posttype($forum_detail[0]['forum_type']);
                                                echo $posttype['title'];
                                            }
                                        }
                                        ?>

                                    </h2>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input  required="required" id="forum_type_title" placeholder="Enter title" name="forum_type_title" value="<?= ( $method == "post") ? set_value('forum_type_title') : $forum_post_detail[0]['forum_article_title']; ?>" type="text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The title  field is required."><?php echo form_error('forum_type_title'); ?>
                                    </div>     
                                </div>

                                <div class="item form-group">
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="forum_type_text">Text
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea required="required" id="forum_type_text" placeholder="Enter forum text" name="forum_type_text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The Forum typetext field is required."><?= ( $method == "post") ? set_value('forum_type_text') : $forum_post_detail[0]['forum_article_desc']; ?></textarea><?php echo form_error('forum_type_text'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="forum_type_attachment">Attachment(s)
                                    </label>
                                    <div class='col-md-12' style="padding-top: 3px;">

                                        <a href='javascript:void(0)' class='' id='attach_file'><i class="fa fa-paperclip"></i>  Attach file</a>
                                        <?php
                                        if (!empty($forum_post_attach)) {
                                            $attachment_detail = array();
                                            foreach ($forum_post_attach as $value) {
                                                $attachment_detail = getattachement($value['attachment_id']);
                                                foreach ($attachment_detail as $attach_value) {
                                                    ?>
                                                    <p class="url">
                                                        <span data-icon="" aria-hidden="true" class="fs1 text-info">
                                                        </span>
                                                        <a href="<?php echo base_url('common/download/' . $attach_value['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $attach_value['attachment_name']; ?></a>
                                                    </p>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <input type='file' name='attachments' class='hidden' id='attachment' >
                                    </div>
                                    <div id='attchment_list' class='col-md-12 col-xs-12'>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">&nbsp;</div>
                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                                <div class="form-group  pull-right">
                                    <div>
                                        <?php
                                        if (!empty($forum_detail)) {
                                            ?>
                                        <a id="<?= $forum_post_detail[0]['forum_article_id'];?>" class="postTypeDelete btn btn-default" href="javascript:void(0)" >Delete</a>
                                        <?php }
                                        ?>
                                        <button id="send" type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 pull-right" style="background-color: #F6F6F6">
                                <div class="side-box-content"><h3><?php
                                        if (!empty($forum_detail)) {

                                            if (!empty($forum_detail)) {
                                                $posttype = posttype($forum_detail[0]['forum_type']);
                                                echo $posttype['edit'];
                                            }
                                        }
                                        ?></h3>
                                    <p></p>
                                    <div style="clear:left; height:8px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('forum_type_text', {height: 100});
        $("#forum_type_tags").val();
        $('.bootstrap-tagsinput').addClass('col-md-12 col-sm-12 col-xs-12');

    });
</script>