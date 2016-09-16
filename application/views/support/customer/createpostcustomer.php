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
        <div class="col-md-12 col-sm-12 col-xs-12" >
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
                                            $forum_id = $forum_detail[0]['category_id'];
                                            if ($forum_detail[0]['forum_type'] == 'Article') {
                                                echo '  Title *';
                                            } else if ($forum_detail[0]['forum_type'] == 'Ideas') {
                                                echo "What's your idea ?";
                                            } else {
                                                echo "What's your question ?";
                                            }
                                        }
                                        ?>

                                    </h2>
                                    <?php if (isset($forum_detail)) { ?>
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $forum_detail[0]['category_id']; ?>"/>
                                        <input type="hidden" name="forum_id" id="category_id" value="<?php echo $forum_detail[0]['forum_id'];?>"/>
                                               <?php
                                           }
                                           ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input  required="required" id="forum_type_title" placeholder="Enter title" name="forum_type_title" value="<?php echo set_value('forum_type_title'); ?>" type="text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The title  field is required."><?php echo form_error('forum_type_title'); ?>
                                    </div>     
                                </div>

                                <div class="item form-group">
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="forum_type_text">Text
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea required="required" id="forum_type_text" placeholder="Enter forum text" name="forum_type_text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The Forum typetext field is required."><?php echo set_value('forum_type_text'); ?></textarea><?php echo form_error('forum_type_text'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="forum_type_attachment">Attachment(s)
                                    </label>
                                    <div class='col-md-12' style="padding-top: 3px;">

                                        <a href='javascript:void(0)' class='' id='attach_file'><i class="fa fa-paperclip"></i>  Attach file</a>

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
                                        <a id="cancel" href="<?= base_url('support/index') ?>" class="btn btn-default ">Cancel</a>
                                        <button id="send" type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 pull-right" style="background-color: #F6F6F6">
                                <div class="side-box-content"><h3><?php
                                        if (!empty($forum_detail)) {
                                            if ($forum_detail[0]['forum_type'] == 'Article') {
                                                echo '  Add Article *';
                                            } else if ($forum_detail[0]['forum_type'] == 'Ideas') {
                                                echo "What's your Idea ?";
                                            } else {
                                                echo "Ask a Question ?";
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