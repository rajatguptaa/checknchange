<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>

<div class="x_panel">
    <div class="x_title">
        <?php
        $form_data = getSupportForumDetailId($forum_id);
        if (!empty($form_data)) {
            foreach ($form_data as $value) {
                ?>
                <h2><?php echo word_limiter($value['forum_title'], 5); ?></h2>
                <div class="nav navbar-right panel_toolbox">


                    <?php
                    if ($user['user_access_level'] != 2 || $value['forum_topic_create'] != 'Unrestricted agents and moderators only') {
                        ?>

                        <a class="edit_this" href="<?php echo base_url() . 'support/forumEntries/' . $value['forum_id'] ?>"><?php
                            $text = posttype($value['forum_type']);
                            echo $text['text'];
                            ?>
                        </a>
                    <?php }
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content scrollers">
                <?php
                $article_detail = array();
                if ($value['forum_type'] != NULL) {
                    $article_detail = getforumarticleall($value['forum_id'], $value['forum_order_by']);
                } else {
                    $article_detail = getforumarticleall($value['forum_id']);
                }
                if (!empty($article_detail)) {
                    foreach ($article_detail as $article_value) {
                        ?>

                        <article class="media event">
                            <a class="pull-left icone">
                                <img src="<?php echo getforumtypeicon($value['forum_type'],TRUE); ?>"></a>
                            <div class="media-body">
                                <span class="<?php if ($article_value['forum_article_highlight_status'] == 1) echo 'highlight'; ?>"><a title="<?php echo $article_value['forum_article_title']; ?>" href="<?php echo base_url('support/postview') . '/' . $article_value['forum_article_id'] ?>" class="title"><?php echo word_limiter($article_value['forum_article_title'], 5); ?>
                                    </a>
                                </span>
                                <p><?php echo $article_value['user_name'] . ' ' . date('M d,Y', strtotime($article_value['forum_article_cretaed_at'])); ?></p>

                                <?php if (getAnswerCount($article_value['forum_article_id']) > 0) {
                                    ?>
                                    <div class="ans_span"><span class="status_res"><b>Answer</b></span></div>
                                    <?php
                                }

                                $idea_type = getIdeaStatus($article_value['forum_article_id']);
                                $class = getIdeaStatus($article_value['forum_article_id']);
                                ?>
                                <div class="ans_span">
                                    <?php
                                    if ($idea_type != FALSE && $idea_type != 'None') {
                                        if ($class == 'Not planned') {
                                            $class = 'not_planned';
                                        }
                                        ?>
                                        <span class="status_res <?php echo $class; ?> dy_status">
                                            <b><?php echo $idea_type; ?></b>
                                        </span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </article>

                        <?php
                    }
                } else {
                    ?>
                    <div class="media-body">
                        <span>No Topics Found </span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="media-body">
        <h3>No Found </h3>
    </div>
    <?php
}
?>
<style>
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

</style>
<script>

    $(document).ready(function () {
        $('body').find(".scrollers").niceScroll({cursorcolor: "#DBDBDB"});
    });
</script>