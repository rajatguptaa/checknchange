<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">
    <div class="container">
        <div class="">
           
             <br>
            <div class="row" id="custom_message">
                <?php if ($this->session->flashdata('support_forum_post_danger')) : ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('support_forum_post_danger'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('support_forum_post_success')) : ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('support_forum_post_success'); ?>
                    </div>
                <?php endif; ?>
            </div><br>
            <div class="row">
                <div class="<?php echo ($access_level==1)?'col-md-9 col-sm-9':'col-md-12 col-sm-12'?>">
                    <div class="x_panel main-bg">
                         <div class="title_left">
                    <?php
                    $forum_name = getSupportForumDetailId($forum_post_detail[0]['forum_id']);
                    $category_name = getCategoryName($forum_post_detail[0]['forum_category_id']);
                    ?>
                    <h4><a href="<?php echo  base_url('support') ?>"><?php echo $mainHeading; ?></a><span class="delim"> &nbsp;/&nbsp; </span><a href="<?php echo base_url('support/forumcategoryview') . '/' . $forum_post_detail[0]['forum_category_id'] ?>"><?php echo $category_name[0]['forum_category_name']; ?></a><span class="delim">&nbsp; /&nbsp; </span><a href="<?php echo  base_url('support/viewForum') . '/' . $forum_post_detail[0]['forum_id'] ?>"><?php echo $forum_name[0]['forum_title'] ?></a>
                    </h4>
                </div>
                        <div class="x_content bg-white-box">
                            <div class="x_title">
                            <h2><?php
                                if (!empty($forum_post_detail)) {
                                    $forum_name = getSupportForumDetailId($forum_post_detail[0]['forum_id']);
                                    echo $forum_name[0]['forum_title'];
                                }
                                ?></h2>
                            <div class="nav navbar-right panel_toolbox">
                           
                            <?php
                            $whocreate = checkwhocreateforumpost($forum_post_id);
                            if ($access_level == 2 && $whocreate[0]['forum_article_created_by'] == $user['user_id']) {
                                ?>
                                <a href="<?php echo base_url('support/editpost') . '/' . $forum_post_id; ?>" class="edit_this" id="edit" >edit</a>
                                <?php
                            } else {
                                if ($access_level != 2) {
                                    ?>
                                    <a href="<?php echo base_url('support/editpost') . '/' . $forum_post_id; ?>" class="edit_this" id="edit" >edit</a>
                                    <?php
                                }
                            }
                            ?>
                                     </div>
                            <input type="hidden" name="forumpostid" id="forumpostid" value="<?php echo $forum_post_id ?>"/>
                            <div class="clearfix"></div>
                        </div>
                            <article class="media event">
                                <a class="pull-left date">
                                    <img alt="Avatar" class="img-responsive" src="<?php echo base_url() . getUserImage($forum_post_detail[0]['user_id'], TRUE) ?>">
                                </a>
                                <div class="media-body">
                                    <a href="javascript:void(0)" class="title"><?php echo $forum_post_detail[0]['forum_article_title'] ?></a>
                                    <?php if($forum_name[0]['forum_type']=='Questions'){
                                    $ans_count = getAnswerCount($forum_post_id);?>
                                    <div class="ans_span">
                                    <?php if($ans_count>0){?>
                                     <span class="status_res answer">
                                         <b>Answered</b>
                                     </span>    
                                     <?php }?>
                                    
                                    </div>
                                    <?php } ?>
                                    <?php if($forum_name[0]['forum_type']=='Ideas'){
                                    $idea_type = getIdeaStatus($forum_post_id);
                                    $class = getIdeaStatus($forum_post_id);?>
                                    <div class="ans_span">
                                    <?php if($idea_type!=FALSE && $idea_type!='None'){
                                       if($class=='Not planned'){
                                          $class = 'not_planned' ;
                                       } 
                                        ?>
                                     <span class="status_res <?php echo $class;?> dy_status">
                                         <b><?php echo $idea_type;?></b>
                                     </span>    
                                     <?php }?>
                                    
                                    </div>
                                    <?php } ?>
                                   
                                    <p><?php echo $forum_post_detail[0]['user_name'] . ' ' . date('M d,Y', strtotime($forum_post_detail[0]['forum_article_cretaed_at'])); ?></p>
                                </div>
                              
                            </article>
                            
                             <span class="message"><div class="col-md-12"><?php echo $forum_post_detail[0]['forum_article_desc'] ?><?php
                                if (!empty($forum_post_attach)) {
                                    foreach ($forum_post_attach as $value) {
                                        $attachment_detail = getattachement($value['attachment_id']);

                                        foreach ($attachment_detail as $attach_value) {
                                            ?>
                                            <p class="url">
                                                <span data-icon="" aria-hidden="true" class="fs1 text-info"></span>
                                                <a href="<?php echo base_url('common/download/' . $attach_value['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $attach_value['attachment_name']; ?></a>
                                            </p>
                                            <?php
                                        }
                                    }
                                }
                                ?></div></span>
                       
                       
                        <?php 
                        $user_id = getLoginUser();
                        $check_like = checkLikeStatus($forum_post_id,$user_id );
                        if($check_like){?>
                       <div class="col-md-12 bg-white-box">
                        <?php echo getLikeContent($forum_name[0]['forum_type']);?>
                       </div>   
                   <?php }else{
                        ?>
                        <div class="col-md-12 bg-white-box" id="like_div"> <span><?php $count =countLike($forum_post_id); echo $count.' '.getLikeContent($forum_name[0]['forum_type'],1);?></span>&nbsp;&nbsp;<a post_id="<?php echo $forum_post_id;?>"  user_id="<?php echo $user_id;?>"href="javascript:void(0)" class="btn btn-success btn-xs" id="like_btn"><i class="fa fa-thumbs-o-up"></i>&nbsp;<?php echo ($count>0)?'Me too':'Be the first!'; ?></a>
</div>
                        <?php }
                        
                        ?>
                    </div> </div>
                    <div class="clearfix"></div>
                    <?php
            
                        if (!empty($forum_post_detail)) {
                            ?>
                    <input type="hidden" id="comment_status" value="<?php echo $forum_post_detail[0]['forum_article_comment_status']?>">
                              <?php   ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 x_panel main-bg" id='comment_view'>

                                    </div>
                                <?php
                           
                        }
                        ?>

                </div>
                <?php if($access_level==1){?>
                <div class="col-md-3">
                <div id="moderator_box">
                  <h3>You are a moderator</h3>
                 
                   <p>Visible to <strong><?php echo $forum_name[0]['forum_topic_view']?></strong>.</p>
                   <?php if($forum_name[0]['forum_type']=='Ideas'){
                       $planed = "";
                       $not_planed = "";
                       $done = "";
                      $idea_type = getIdeaStatus($forum_post_id);
                      if($idea_type!=FALSE && $idea_type!='None'){
                          
                      $class = getIdeaStatus($forum_post_id); 
                      if($class=='Not planned'){
                      $not_planed = 'not_planned';
                      }else{
                      $not_planed = 'default_idea';
                      }
                      if($class=='Planned'){
                      $planed = 'Planned';    
                      }else{
                       $planed = 'default_idea';   
                      }
                      if($class=='Done'){
                      $done = 'Done';    
                      }
                      else{
                      $done = 'default_idea';      
                      } 
                      }else{
                      $default='default_idea';     
                      }
                    ?>
                   <div class="idea_span">
                   <a href="javascript:void(0)" class="idea_status" type="Planned" article_id="<?php echo $forum_post_id;?>"><span class="<?php echo ($planed=='')?$default:$planed;?> status_res"><b>Planned</b></span></a>
                   <a href="javascript:void(0)" class="idea_status" type="Done" article_id="<?php echo $forum_post_id;?>"><span class="<?php echo ($done=='')?$default:$done;?> status_res"><b>Done</b></span></a>
                   <a href="javascript:void(0)" class="idea_status" type="Not planned" article_id="<?php echo $forum_post_id;?>"><span class="<?php echo ($not_planed=='')?$default:$not_planed;?> status_res"><b>Not Planned</b></span></a>
                   </div>
                   <?php } ?>
                   <ul class="list-inline widget_tally">
                   <li><a class="restrict <?php echo ($forum_post_detail[0]['forum_article_highlight_status']==1)?'restrict_commnet':''?>" title="Visually highlight this topic within your forums. Click again to toggle." data-type="highlight" article_id="<?php echo $forum_post_id;?>" href="javascript:void(0)"><i class="fa fa-check fa-2x "></i><b>&nbsp;&nbsp;Highlight in forum?</b></a></li>
                   
                   <li><a class="restrict <?php echo ($forum_post_detail[0]['forum_article_homepage_status']==1)?'restrict_commnet':''?>" title="Click to attach this to your Zendesk home page. Click again to toggle." data-type="pin" article_id="<?php echo $forum_post_id;?>" href="javascript:void(0)"><i class="fa fa-check fa-2x "></i><b>&nbsp;&nbsp;Pin to home?</b></a></li>
                   
                   <li><a  class="restrict <?php echo ($forum_post_detail[0]['forum_article_comment_status']==1)?'restrict_commnet':''?>" title="Click to prevent further comments from being made on this topic. Click again to toggle."  data-type="close" article_id="<?php echo $forum_post_id;?>" href="javascript:void(0)"><i class="fa fa-check fa-2x"></i><b>&nbsp;&nbsp;Closed for comments?</b></a></li></ul>
                     <div class="links">
                         <a class="postTypeDelete" href="javascript:void(0)" id="<?php echo $forum_post_id;?>" forum_id="<?php echo $forum_name[0]['forum_id']?>">Delete</a>
         </div>
                </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class='clone_div' hidden="">
<span>
<?php $count =countLike($forum_post_id); echo '<span id="count">'.$count.'</span>'.' '.getLikeContent($forum_name[0]['forum_type'],1);?>
</span>&nbsp;&nbsp;<a post_id="<?php echo $forum_post_id;?>"  user_id="<?php echo $user_id;?>"href="javascript:void(0)" class="btn btn-success btn-xs" id="like_btn"><i class="fa fa-thumbs-o-up"></i>&nbsp;<?php echo ($count>0)?'Me too':'Be the first!'; ?>
</a>
</div>
<style>
    .message {
    border-bottom: 1px solid #eee;
    display: block;
    float: left;
    width: 100%;
    padding: 10px 0;
}
    #like_div{
    padding-top: 10px;
    padding-bottom: 10px;
}
    .main-bg{
        background: #f0f0f0;
    }
    .bg-white-box{
        background: #fff;
            padding: 20px;
    }
    .comment_box{
        margin-bottom: 1%;
        height: available !important;
        max-height: 100%;
        overflow: visible !important

    }
        a.edit_this{
    color: green;
    font-weight: bold;
}

 
 span.status_res{
    background: #7eab38 none repeat scroll 0 0;
    color: #fff;
    border-radius: 4px;
    font-weight: bold;
    padding: 2px 4px;
    font-size: 13px;
    margin-top: 11px;
    padding: 2px 8px;
}
.ans_span{
    float: right;
    font-size: 13px;
    margin-right: 30px;
    margin-top:4px;

}
.idea_span{
    float: none !important;
    font-size: 13px;
    margin-top: 11px;
    margin-bottom: 11px;
    

}
.ans_span a:hover{
    text-decoration: none;
}
.idea_span a:hover{
    text-decoration: none;
}
.Done{
    background: #7EAB38 none repeat scroll 0 0 !important;  
    margin-top: 0px !important;
    padding: 5px 9px !important;
}
.Planned{
    background: #EA7A18 none repeat scroll 0 0 !important; 
    margin-top: 0px !important;
    padding: 5px 9px !important;
}
.not_planned{
    background: #BBBBBB none repeat scroll 0 0 !important;
    margin-top: 0px !important;
    padding: 5px 9px !important;
}
.default_idea{
    background: #F0F0F0 none repeat scroll 0 0 !important;
    color: black !important;
    margin-top: 0px !important;
    padding: 5px 9px !important;
}
.answer{
    background: #7EAB38 none repeat scroll 0 0 !important;
    color: #fff !important;
    margin-top: 0px !important;
    padding: 5px 9px !important;
}

.right_div{
    border:2px solid #DBDBDB !important;
}
div#moderator_box {
    background-color: #fff;
    border: 3px solid #ddd;
    border-radius: 8px;
    padding: 12px 22px 20px;
    width: 100%;
}
div#moderator_box div.links {
    display: block;
    overflow: auto;
    
}
div#moderator_box div.links a:hover {
    background-color:#B65151 !important;
    color:white !important     
}
div#moderator_box div.links a{
    color:#B65151 !important;
    
}

  .restrict_commnet i,.restrict_highlight i,.restrict_pin i{
     	color:#7EAB38 !important;
     }
     
  .restrict:hover{
    text-decoration: none;     
    }
 .restrict > b {
    font-size: 1.2em;
}

</style>
<script>
$(document).ready(function(){
 
 

//          $('body').find("#innercommentdiv").niceScroll({cursorcolor:"#DBDBDB"});

});
</script>