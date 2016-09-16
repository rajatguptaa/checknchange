<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>

<div class="right_col" role="main">

    <div class="container">

        <br>
        <div class="row" id="custom_message">
            <?php if ($this->session->flashdata('support_forum_danger')) : ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('support_forum_danger'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('support_forum_success')) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('support_forum_success'); ?>
                </div>
            <?php endif; ?>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="forum-nav-recent">
                        <a url="/forums" id="overview" href="javascript:void(0)" class="recentchange active">Overview</a>
                        <span class="delim">|</span>
                        <a url="/recent_entries" id="recent" href="javascript:void(0)" class="recentchange">Recent</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="x_panel main-bg">
            <div class="page-title">
                <?php $form_data = getSupportForumDetailId($forum_id);
                ?>
                <div class="col-md-11 col-sm-10 col-xs-9">
                    <input type="hidden" name="forum_id" id="forum_id" value="<?php echo $form_data[0]['forum_id']; ?>"/>
                    <?php
                    $category_name = getCategoryName($form_data[0]['category_id']);
                    ?>
                    <h4><a href="<?php echo base_url('support') ?>"><?php echo $mainHeading; ?></a><span class="delim">/</span><a title="<?php echo $category_name[0]['forum_category_name']; ?>" href="<?php echo base_url('support/forumcategoryview') . '/' . $form_data[0]['category_id']; ?>"><?php echo word_limiter($category_name[0]['forum_category_name'], 4); ?></a><span class="delim">/</span><?php echo word_limiter($form_data[0]['forum_title'], 3); ?></h4>
                </div>
                <div class="">
                    <?php if ($access_level != 2) {
                        ?>
                        <a href="<?php echo base_url('support/editsupportforum') . '/' . $forum_id; ?>" class="forumalign edit_this" id="edit" >edit</a>
                    <?php }
                    ?>
                </div>
            </div>


            <div class="row">

                <div class="col-md-9 supportarticle">

                </div>
                <div class="col-md-3">
                    <div class="side-box-content panel">
                        <h3 class="panel-heading"><?php echo $form_data[0]['forum_title']; ?></h3>
                        <div class="panel-body">
                            <p><?php echo $form_data[0]['forum_desc']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div align='center' class="wait">
        <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
    </div>
</div>
<style>
    .icone .fa {
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
    .panel{
        background: #F6F6F6;
        border: 1px solid #eeeeee;
    }
    .panel ul{
        margin: 0;
        padding: 0;
        list-style-position: inside
    }
    .highlight{
        background-color: #fff1a9;
    }
    .delim {
        padding: 6px;
    }
    .bg-white-box {
        background: #ffffff none repeat scroll 0 0;
        padding: 20px;
    }
    .main-bg {
        background: #f0f0f0 none repeat scroll 0 0;
    }
    .forumalign {
        margin-left: 65px;


    }
    .scrollers{
        margin-bottom: 20px;
        max-height: 600px !important;
        width: 100%;
    }
    .wait{
        display:none;
        z-index: 9999;
    }
    .wait img {
        left: 0;
        margin: 0 auto;
        position: fixed;
        right: 0;
        top: 45%;
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
    .edit_this {
        color: #008000;
        font-weight: bold;
    }
    .forum-nav-recent .active{
        color: #008000;
        cursor:auto;
        text-decoration: underline;
    }
</style>
<script>

    $(document).ajaxStart(function () {
        $(".wait").css("display", "block");
    });

    $(document).ajaxComplete(function () {
        $(".wait").css("display", "none");
    });
    $(document).ready(function () {
        $('body').find(".scrollers").niceScroll({cursorcolor: "#DBDBDB"});
        var forum_id = $('#forum_id').val();

        categoryorg(forum_id);
        $('body').on('click', '.recentchange', function () {

            var recentid = this.id;
            if (recentid == 'overview') {
                categoryorg(forum_id);
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
                recentview(forum_id);
            }

        });

    });
    function categoryorg(forum_id) {
        var base_url = $("#base_url").val();
        var url = base_url + "supportController/forumpostajax/";
        var method = "POST";
        var data = {forum_id: forum_id};
        ajaxRequest(url, method, data, function (data) {
            $('.supportarticle').html(data);
        });
    }

    function recentview(forum_id) {

        var base_url = $("#base_url").val();
        var url = base_url + "support/recentpost";
        var method = "POST";
        var data = {forum_id: forum_id};
        ajaxRequest(url, method, data, function (data) {

            $('.supportarticle').html(data);
        });

    }
</script>