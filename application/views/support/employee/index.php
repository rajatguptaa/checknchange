<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">  
    <div class="container" >
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo $mainHeading; ?></h3>
                </div>
                <div class="title_right">
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                        <div class="">
                            <?php if (access_check("organisation", "view")) : ?>
                                <select name="orginasation_search" id="orginasation_search" tabindex="-1" class="select_organisation form-control">    
                                    <?php foreach ($organisation as $org) { ?>
                                        <option value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                    <?php } ?>
                                </select>   
                            <?php else :
                                ?>
                                <input type="hidden" name="orginasation_search" class="select_organisation" id="orginasation_search_hidden" value="<?php
                                $org = getUserOrginasationDetails($user['user_id']);
                                echo $org['organisation_id'];
                                ?>">
                                   <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <?php if ($this->session->flashdata('support_danger')) : ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('support_danger'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('support_success')) : ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('support_success'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="forum-nav-recent">
                            <a class="recentchange active" href="javascript:void(0)" id="overview" url="/forums">Overview</a>
                            <span class="delim">|</span>
                            <a class="recentchange" href="javascript:void(0)" id="recent" url="/recent_entries">Recent</a>
                        </div>
                    </div>
                    
                    <?php
                    if (access_check("support portal", "add")) {
                        ?>
                        <a href="<?php echo base_url() . 'support/add'; ?>" type="button" class="btn btn-success btn-xs pull-right" data-toggle="tooltip" data-placement="right" title="Add Category"><i class="fa fa-plus-circle">
                            </i>&nbsp;&nbsp;Add Category</a>
                        <?php
                    }
                    ?>
                    </div>
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <div class="category_view support-section  col-md-12 col-sm-12 col-xs-12 x_panel" id="section_background">
                    </div>

                </div>
                
                <br />
                <br />
                <br />
                <input type="hidden" value="<?php echo base_url(); ?>" id="base_url" class="base_url"/>
            </div>
        </div>
    </div>
</div>
<div align='center' class="wait">
    <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'>
    </div>
</div>
<style>
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
        $("body").tooltip({selector: '[data-toggle=tooltip]'});
        var base_url = $("#base_url").val();
        $("#orginasation_search").chosen({width: "85%"});

        var organisation_id = $('.select_organisation').val();
        categoryorg(organisation_id);
        $('body').on('change', '#orginasation_search', function () {
            var organisation_id = $('.select_organisation').val();
            categoryorg(organisation_id);

        });

        $('body').on('click', '.recentchange', function () {
            var organisation_id = $('.select_organisation').val();
            var recentid = this.id;
            if (recentid == 'overview') {
                categoryorg(organisation_id);
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
                recentview(organisation_id);
            }
        });


    });
    function categoryorg(organisation_id) {
        var base_url = $("#base_url").val();
        var url = base_url + "support/categoryForum/";
        var method = "POST";

        var data = {organisation_id: organisation_id, pagetype: 'support'};

        ajaxRequest(url, method, data, function (data) {

            $('.category_view').html(data);
        });
    }

    function recentview(organisation_id) {

        var base_url = $("#base_url").val();
        var url = base_url + "support/recentpost";
        var method = "POST";
        var data = {organisation_id: organisation_id};
        ajaxRequest(url, method, data, function (data) {

            $('.category_view').html(data);
        });

    }
</script>

