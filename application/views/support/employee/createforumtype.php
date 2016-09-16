<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
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
                                            $posttype = posttype($forum_detail[0]['forum_type']);
                                            echo $posttype['title'];
                                        }
                                        ?>
                                    </h2>
                                    <input type="hidden" name="category_id" id="category_id" value="<?php echo  $forum_detail[0]['category_id']; ?>"/>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input  required="required" id="forum_type_title" placeholder="Enter title" name="forum_type_title" value="<?php echo set_value('forum_type_title'); ?>" type="text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The title  field is required."><?php echo form_error('forum_type_title'); ?>
                                    </div>     
                                </div>
                                <div class="item form-group">
                                    <h4 class="col-md-12 col-sm-12 col-xs-12" for="forum_topic">Which forum does this topic belong to? *
                                    </h4>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <select name="forum_post_id" tabindex="-1" class="chosen_width form-control col-md-7 col-xs-12 <?= (strlen(form_error('forum_post_id')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('forum_post_id'); ?>">
                                            <?php
                                            if (!empty($forum_detail)) {
                                                $org_id = getForumCategoryOrgid($forum_detail[0]['category_id']);
                                                $cat_ids = getForumCategoryId($org_id[0]['organisation_id']);

                                                foreach ($cat_ids as $value) {
                                                    ?>
                                                    <optgroup label="<?php echo $value['forum_category_name'] ?>">

                                                        <?php
                                                        $forum_data = getSupportForumDetail($value['forum_category_id']);
                                                        foreach ($forum_data as $val) {
                                                            ?>
                                                            <option <?php if ($forum_id == $val['forum_id']) echo "selected='true'" ?> value="<?php echo $val['forum_id'] ?>">
                                                                <?php echo $val['forum_title'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                        <?php echo form_error('ticket_description'); ?>
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
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="organisation_notes">Tags
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="forum_type_tags" data-role="tagsinput" id="forum_type_tags"/>  

                                    </div>
                                </div>
                                <div class="item form-group">

                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_locked"><input type="checkbox" value="1" name="forum_post_locked" id="forum_post_locked"> <label for="entry_is_locked">Disable comments?</label> <span class="sub">do not allow users to add comments</span>
                                    </div>
                                </div>
                                <div class="item form-group">

                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_pinned"><input type="checkbox" value="1" name="forum_post_pinned" id="forum_post_pinned"> <label for="forum_is_pinned">Pin to home page?</label> <span class="sub">pin topic to the home page of your CRM</span>
                                    </div>
                                </div>
                                <div class="item form-group">

                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_highlighted"><input type="checkbox" value="1" name="forum_post_highlighted" id="forum_post_highlighted"> <label for="forum_is_highlighted">Highlight in forum?</label> <span class="sub">highlight topic in forum</span>
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
                                            if (!empty($forum_detail)) {
                                                $posttype = posttype($forum_detail[0]['forum_type']);
                                                echo $posttype['text'];
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