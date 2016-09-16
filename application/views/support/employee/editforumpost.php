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
                                            echo $posttype['edit'];
                                        }
                                        ?>

                                    </h2>
                                    <input type="hidden" name="category_id" id="category_id" value="<?php echo $forum_detail[0]['category_id']; ?>"/>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input  required="required" id="forum_type_title" placeholder="Enter title" name="forum_type_title" value="<?= ($method == "post") ? set_value('forum_type_title') : $forum_post_detail[0]['forum_article_title']; ?>" type="text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The title  field is required."><?php echo form_error('forum_type_title'); ?>
                                    </div>     
                                </div>
                                <div class="item form-group">
                                    <h4 class="col-md-12 col-sm-12 col-xs-12" for="forum_topic">Which forum does this topic belong to? *
                                    </h4>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <?php ?>
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
                                                            <option <?php if ($forum_detail[0]['forum_id'] == $val['forum_id']) echo "selected='true'" ?> value="<?php echo $val['forum_id'] ?>">
                                                                <?php echo $val['forum_title'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
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
                                        <textarea required="required" id="forum_type_text" placeholder="Enter forum text" name="forum_type_text" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The Forum typetext field is required."><?= ( $method == "post") ? set_value('forum_type_text') : $forum_post_detail[0]['forum_article_desc']; ?></textarea><?php echo form_error('forum_type_text'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class=" col-md-12 col-sm-12 col-xs-12" for="organisation_notes">Tags
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                        if (!empty($forum_post_tags)) {
                                            $tag_val = array();
                                            foreach ($forum_post_tags as $tag) {
                                                $tag_val[] = $tag['tags_name'];
                                            }
                                            $tag_string = implode(',', $tag_val);
                                            ?>
                                            <input type="text" name="forum_type_tags" data-role="tagsinput" id="forum_type_tags" value="<?= ( $method == "post") ? set_value('forum_type_tags') : $tag_string; ?>"/>  
                                            <?php
                                        }else{
                                            ?>
                                            <input type="text" name="forum_type_tags" data-role="tagsinput" id="forum_type_tags" value="<?= set_value('forum_type_tags') ;?>"/>  
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_locked"><input type="checkbox" <?php if ($forum_detail[0]['forum_article_comment_status'] == 1) echo 'checked' ?> value="1" name="forum_post_locked" id="forum_post_locked"> <label for="entry_is_locked">Disable comments?</label> <span class="sub">do not allow users to add comments</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_pinned"><input type="checkbox" <?php if ($forum_detail[0]['forum_article_homepage_status'] == 1) echo 'checked' ?> value="1" name="forum_post_pinned" id="forum_post_pinned"> <label for="forum_is_pinned">Pin to home page?</label> <span class="sub">pin topic to the home page of your CRM</span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="hidden" value="0" name="forum_post_highlighted"><input type="checkbox" <?php if ($forum_detail[0]['forum_article_highlight_status'] == 1) echo 'checked' ?> value="1" name="forum_post_highlighted" id="forum_post_highlighted"> <label for="forum_is_highlighted">Highlight in forum?</label> <span class="sub">highlight topic in forum</span>
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
                                        <?php
                                        if (!empty($forum_post_attach)) {
                                            $attachment_detail = array();
                                            foreach ($forum_post_attach as $value) {
                                                $attachment_detail = getattachement($value['attachment_id']);
                                                foreach ($attachment_detail as $attach_value) {
                                                    ?>
                                                    <div class="col-md-12">
                                                        <span data-icon="" aria-hidden="true" class="fs1 text-info">
                                                        </span>

                                                        <a href="<?php echo base_url('common/download/' . $attach_value['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $attach_value['attachment_name']; ?></a><span style="font-weight:normal;"><a data-attachment="<?php echo $attach_value['attachment_id']; ?>" id="remove_file" class="text-danger" href="javascript:void(0)">&nbsp;<i class="fa fa-remove"></i></a></span>
                                                        <input type="hidden" value="<?php echo $attach_value['attachment_id']; ?>" name="attachment_id[]">
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">&nbsp;</div>
                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                                <div class="form-group  pull-right">

                                    <div class="links_delete">
                                        <?php if ($forum_post_detail)  ?>

                                       <a id="<?php echo $forum_post_detail[0]['forum_article_id'] ?>" href="javascript:void(0)" class="postTypeDelete" forum_id="<?php echo $forum_detail[0]['forum_id'] ?>">Delete</a>
                                        <button id="send" type="submit" class="btn btn-success btn-xs">Update</button>

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
<style>
 div.links_delete a:hover {
    background-color:#B65151 !important;
    color:white !important     
}
 div.links_delete a{
    color:#B65151 !important;
    
}
div#moderator_box div.links a:hover {
    background-color: #b65151 !important;
    color: #ffffff !important;
}
div#moderator_box div.links a {
    color: #b65151 !important;
}
</style>