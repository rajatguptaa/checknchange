<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?><div role="main">
    <div class="container">
        <br>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel main-bg">

                <div class="col-md-10">
                    <h4>
                        <?php $category_name = getCategoryName($category_id); ?>
                        <a href="<?php echo base_url('support') ?>" ><?= $mainHeading ?></a><span class="delim">/</span> <?php echo $category_name[0]['forum_category_name']; ?>
                    </h4>
                    <input type="hidden" name="category" id="category" value="<?php echo $category_id; ?>"/>
                </div>

                <div class="col-md-2">
                    <?php
                    if ($access_level != 2) {

                        if (access_check("support portal", "edit")) {
                            ?>
                            <a class="forumalign edit_this" href="<?php echo base_url('support/addforum') . '/' . $category_name[0]['forum_category_id'] . '/' . $category_name[0]['organisation_id'] ?>">add forum </a>
                            <?php
                        }
                        if ($category_id) {
                            if ($category_name[0]['forum_category_name'] != 'None') {
                                ?>
                                <a class="edit_this"  href="<?= base_url('support/editcategory') . '/' . $category_id; ?>">edit</a>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="clearfix"></div>


                <div class="x_content bg-white-box">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                        <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9 inVentry supportcategory">

                        </div>


                        <div class="col-md-3">
                            <div class="side-box-content panel sidebox">
                                <h3 class="panel-heading"><?php echo $category_name[0]['forum_category_name']; ?></h3>
                                <div class="panel-body">
                                    <p><?php echo $category_name[0]['forum_category_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div align='center' class="wait">
        <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'>
        </div>
    </div>
</div>
<style>
    .bg-white-box {
        background: #ffffff none repeat scroll 0 0;
        padding: 20px;
    }
    .main-bg {
        background: #f0f0f0 none repeat scroll 0 0;
    }
    .forumalign {
        padding-right: 27px;
    }
    .delim {
        padding: 6px;
    }
    .sidebox{
        padding: 1px;
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
    .forum-nav-recent .active{
        color: #008000;
        cursor:auto;
        text-decoration: underline;
    }
</style>
<script>
    $(document).ready(function () {
        $(document).ajaxStart(function () {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function () {
            $(".wait").css("display", "none");
        });
    });
    $(document).ready(function () {

        var category_id = $('#category').val();
        categoryorg(category_id)
        $('body').on('click', '.recentchange', function () {
            var recentid = this.id;
            if (recentid == 'overview') {
                categoryorg(category_id);
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
                recentview(category_id);
            }

        });
    });
    function categoryorg(category_id) {
        var base_url = $("#base_url").val();

        var url = base_url + "supportController/categorypostview/";
        var method = "POST";
        var data = {category_id: category_id};
        ajaxRequest(url, method, data, function (data) {

            $('.supportcategory').html(data);
            $('.supportcategory').addClass('inVentry');
        });
    }
    function recentview(category_id) {

        var base_url = $("#base_url").val();
        var url = base_url + "support/recentpost";
        var method = "POST";
        var data = {category_id: category_id};
        ajaxRequest(url, method, data, function (data) {

            $('.supportcategory').html(data);
            $('.supportcategory').removeClass('inVentry');
        });

    }
</script>