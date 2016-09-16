<?php
$user_data = $this->session->userdata('logged_in');
$user_detail = getUserDetails($user_data['user_id']);
?> 


<div class="x_content">

    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12 bg-white mail_list_column comment_section">
            <div class="x_title">
                <h2>Comments</h2>

                <div class="clearfix"></div>
            </div>
            <div class="mail_list" style="margin-top: 1%;">
                <form id='comment_form' data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="forumpostid" id='forum_article_id' value="<?php echo $forumpostid; ?>">
                    <input type="hidden" name="comment_by" value="<?php echo $user_data['user_id']; ?>">

                    <div class="col-md-12">
                        <textarea required="required" class="form-control comment_box comment" name="comments" id="comments" placeholder="type here....." data-parsley-error-message="The Comment  text is required."></textarea>
                        <ul class="parsley-errors-list filled comments"><li class="parsley-custom-error-message "></li></ul>
                        <div class="clearfix"></div>
                        <div class='col-md-12' style="padding-top: 3px;">

                            <a href='javascript:void(0)' class='' id='attach_file'><i class="fa fa-paperclip"></i>  Attach file</a>

                            <input type='file' name='attachments' class='hidden' id='attachment'>
                        </div>
                        <div id='attchment_list' class='col-md-12 col-xs-12'>

                        </div>
                        <div class="submit_comment pull-right">
                            <button class="btn btn-primary btn-sm pull-left" id='send_comment' type="button" >Submit</button>
                            <img class="small_loader pull-right" src="<?php echo base_url() . 'assets/images/ajax-small_loader.gif'; ?>" />
                        </div>

                    </div>
                </form>

            </div>

            <div id="innercommentdiv">
                <?php
//var_dump($comment_data);

                if (!empty($comment_data)) {
                    foreach ($comment_data as $key => $val) {
                        ?>

                        <div class="mail_list_main">
                            <div class="mail_list">
                                <div class="left image">
                                    <img alt="Avatar" class=" img-responsive" src="<?php echo base_url() . getUserImage($val['comment_by_id']) ?>">
                                    <small ><?php echo getUserName($val['comment_by_id']); ?> </small>
                                    <small ><b><?php // echo $val['organisation_name'];     ?> </b></small>
                                </div>
                                <div class="right">
                                    <div class="media-body">
                                        <span class="content"><?php echo $val['comment_message']; ?></span>
                                        <p><small><?php echo dateFormate($val['comment_update']); ?></small></p>



                                        <?php
                                        $comment_attchment = supportController::getCommentAttachRel($val['comment_id']);
                                        if (!empty($comment_attchment)) {

                                            foreach ($comment_attchment as $key1 => $val1) {
                                                ?> 

                                                <p class="url">
                                                    <span data-icon="" aria-hidden="true" class="fs1 text-info"></span>
                                                    <a href="<?php echo base_url('common/download/' . $val1['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $val1['attachment_name']; ?></a>
                                                </p>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>           
                                </div>
                                <?php
                                $article_detail = getForumDetailByPost($forumpostid);
                                if ($article_detail[0]['forum_type'] == "Questions") {
                                    if ($val['article_status'] != null) {
                                        ?>  
                                        <a href="javascript:void(0)" article_id="<?php echo $forumpostid; ?>" comment_id="<?php echo $val['comment_id']; ?>" data-status="0"  class="active-ans ans_link"><i class="fa fa-check "></i><b>&nbsp;Answer</b></a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0)" article_id="<?php echo $forumpostid; ?>" comment_id="<?php echo $val['comment_id']; ?>" data-status="1"  class="ans ans_link"><i class="fa fa-check "></i><b>&nbsp;Answer</b></a>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="pull-right"><a class="edit_comment" href="javascript:void(0)" data-id="<?php echo $val['comment_id']; ?>" title="Edit">edit</a>

                                </div>  
                            </div>

                            <div class="col-md-12" id="<?php echo $val['comment_id']; ?>" style="display: none">
                                <form id='comment_form_<?php echo $val['comment_id'] ?>' data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                                    <textarea required="required" class="form-control comment" name="comment_message" id="comment_message_<?php echo $val['comment_id'] ?>" placeholder="type here....." data-parsley-error-message="The Comment  text is required."><?php echo $val['comment_message']; ?></textarea>
                                    <ul class="parsley-errors-list filled comment_message"><li class="parsley-custom-error-message "></li></ul>
                                    <div class="clearfix"></div>
                                    <div class="update_comment ">
                                        <a class="btn btn-primary btn-xs delete_comment pull-right" href="javascript:void(0)" data-id="<?php echo $val['comment_id']; ?>" title="Edit">Delete</a>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs pull-left cancel_update" data-id="<?php echo $val['comment_id']; ?>" id='cancel_update' type="button" >Cancel</a>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs pull-right update_comm" data-id="<?php echo $val['comment_id']; ?>" id='update_comm' type="button" >Save Comment </a>
                                    </div>
                                    <div class="row">&nbsp;</div>
                                    <input type="hidden" name="comment_id" id="comment_id" value="<?php echo $val['comment_id']; ?>"/>
                                </form>
                            </div>
                            <div class="row">&nbsp;</div>
                        </div>

                        <?php
                    }
                } else {
                    ?>

                </div>
                <div class="mail_list" style="text-align:center;border-bottom:none;">No comment found for this Article.</div>

            <?php } ?>

        </div>
    </div>

</div>

<style type="">
    .small_loader.pull-right {
        margin-left: 10px;
        margin-top: 10px;
        display:none;
    }
    .chk{
        margin-right:5px!important;
        margin-top:5px!important;
        position: relative;
    }
    .submit_comment{
        margin-top: 7px
    }
    @media all and (max-width:640px){
        .comment_section .mail_list .right{
            width: 100%
        }
    }
    #innercommentdiv{
        max-height: 600px !important;
        width: 100%;
        overflow: auto;
        margin-bottom:20px;
    }.mail_list{
        width: 99%
    }
    .event .media-body a.title {
        display: inline-block;
        margin-top: 8px !important;
    }.event .media-body p {
        color: #000;
        margin-top: 6px;
    }
    .comment_section .mail_list .right {
        width: 70% !important;
    }

    .ans{
        color:#999;
        text-decoration:none;

    }
    .ans:hover,.ans:hover i{
        color:#777;
        text-decoration:none;
    }
    .ans i{
        color:#ccc;
        font-size:16px;
        transition:all ease 300ms;
    }
    .active-ans,.active-ans i{
        color:#7EAB38 !important;

    }

    .active-ans:hover,.active-ans:hover i{
        color:  #63901d  !important;
        text-decoration:none;

    }
    .active-ans i{
        font-size:18px;
        transition:all ease 300ms;
    }


    .update_comment {
        margin-bottom: 20px;
    }


    /*    @media (min-width: 60em) and (orientation:landscape) {  ====== 
    
       .main-content {
         width: 70%;
         float: left;
       }
    
       .side-bar {
         width: 30%;
         float: left
       }
    
    } */
    .date{
        background: none !important;
    }
</style>
<script>
    $(document).ready(function () {
//        console.log("asdsad");

        $("body").find("#comments").filter(function () {
            CKEDITOR.replace('comments', {height: 150});
        });

//        tinymce.EditorManager.execCommand('mceRemoveEditor', false, ".comment");
        $('body').find("#innercommentdiv").niceScroll({cursorcolor: "#DBDBDB"});
    });
</script>