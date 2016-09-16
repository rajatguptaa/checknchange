<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
//var_dump($article_data);
?>

<div class="x_panel">
   
    <div class="x_content scroller">
     <?php
        if (!empty($article_data) && $article_data[0]['forum_article_id'] !=NULL) {
            foreach ($article_data as $article_value) {
                if ($article_value['forum_article_id'] != NULL) {
                    ?>
                    <article class="media event">
                        <a class="pull-left">
                           <img src="<?php echo getforumtypeicon($article_value['forum_type'],TRUE); ?>"><?php if(countLike($article_value['forum_article_id'])>0){ ?>
                        <span class="like_count">
                            <i class="fa fa-thumbs-up"></i><?php echo countLike($article_value['forum_article_id']);?></span>
                       <?php } ?></a>
                     
                        <div class="media-body">
                            <span class="<?php if ($article_value['forum_article_highlight_status'] == 1) echo 'highlight'; ?>"><a title="<?php echo $article_value['forum_article_title']; ?>" href="<?php echo base_url('support/postview') . '/' . $article_value['forum_article_id'] ?>" class="title"><?php echo word_limiter($article_value['forum_article_title'], 5); ?>
                                </a>
                                
                            </span>
                            <p><?php echo getUserName($article_value['forum_article_created_by']) . ' ' . date('M d Y', strtotime($article_value['forum_article_cretaed_at'])); ?><?php if(lastcommenttime($article_value['forum_article_id'])) echo '<span class="delim2">•</span>Latest comment over '.lastcommenttime($article_value['forum_article_id']); if(commentcount($article_value['forum_article_id'])>0) echo '<span class="delim2">•</span><i class="fa fa-commenting-o"></i><span>'.commentcount($article_value['forum_article_id']).'</span>';?></p>
                            <a title="<?php echo $article_value['forum_category_name'].'/'.$article_value['forum_title']?>"  href="<?php echo base_url('support/viewForum').'/'.$article_value['forum_id'];?>"><?php echo word_limiter($article_value['forum_category_name']).'/'.  word_limiter($article_value['forum_title'],3); ?></a>
                            <?php if(getAnswerCount($article_value['forum_article_id'])>0){
                                ?>
                            <div class="ans_span"><span class="status_res"><b>Answer</b></span></div>
                            <?php }
                           
                              $idea_type = getIdeaStatus($article_value['forum_article_id']);
                                    $class = getIdeaStatus($article_value['forum_article_id']);?>
                                    <div class="ans_span">
                                    <?php if($idea_type!=FALSE && $idea_type!='None'){
                                       if($class=='Not planned'){
                                          $class = 'not_planned' ;
                                       } 
                                        ?>
                                     <span class="status_res <?php echo $class;?> dy_status">
                                         <b><?php echo $idea_type;?></b>
                                     </span>
                                    <?php }
                                    ?>
                        </div>
                            
                        </div>
                    </article>
                    <?php
                }
            }
        } else {
            ?>
        <article class="media event">
            <div class="media-body">
                <h3>No Article Found  </h3>
            </div>
            <span>No description</span>
        </article>
            <?php
        }
        ?>

    </div>
</div>


<style>
    .icone {
        border: 1px solid #dbdbdb;
        border-radius: 2px;
        font-size: 25px;
        padding: 8px;
        color: #000;
    }
    article.media {
        border-bottom: 1px solid #eeeeee;
        margin-bottom: 8px;
        padding-bottom: 7px;
        width: 100%;
    }
/*    .panel{
        background: #F6F6F6;
        border: 1px solid #eeeeee;
    }
    .panel ul{
        margin: 0;
        padding: 0;
        list-style-position: inside
    }*/
    .highlight{
        background-color: #fff1a9;
    }
    .delim {
        padding: 6px;
    }
   
    fa fa-commenting-o{
        padding: 6px;
    }
    .scroller{
        margin-bottom: 20px;
        max-height: 600px !important;
        width: 100%;
    }
    span.status_res{
    background: #7eab38 none repeat scroll 0 0;
    color: #fff;
    border-radius: 4px;
    font-weight: bold;
    padding: 2px 4px;
    float: right;
    font-size: 13px;
    margin-top: -25px;
    padding: 2px 5px;
}
.ans_span{
    float: right;
    font-size: 13px;
    margin-right: 30px;

}
.delim2{
    padding-left: 10px;
    padding-right: 10px;
}
.Done{
    background: #7EAB38 none repeat scroll 0 0 !important;  
    
    padding: 5px 9px !important;
}
.Planned{
    background: #EA7A18 none repeat scroll 0 0 !important; 
    
   
}
.not_planned{
    background: #BBBBBB none repeat scroll 0 0 !important;
    
   
}
.default_idea{
    background: #F0F0F0 none repeat scroll 0 0 !important;
    color: black !important;
    margin-top: 0px !important;
    padding: 5px 9px !important;
}
</style>
<script>

    $(document).ready(function () {
        $('body').find(".scroller").niceScroll({cursorcolor: "#DBDBDB"});
    });
</script>