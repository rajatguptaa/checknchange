<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<?php if ($access_level != 2) { ?>
    <div class="x_panel  support-section" >
        <div id="csr-dashboard">

            <div class="picture">
                <a href="#">
                    <img src="<?php echo base_url() . $image; ?>" height="100px;" width="100px;">
                </a>  
            </div>

            <div class="current-user">
                <h2><a href=""><?php echo $name; ?></a></h2>

                <div class="stats-group">
                    <h3>Open Tickets <span>(current)</span></h3>
                    <a class="dashboard_search_link" href="">      <span class="dashboard-stats small">
                            <span class="count"><?php echo $open_ticket; ?></span>
                            <span></span>
                            <span class="you">You</span>
                        </span>
                    </a>
                    <a class="dashboard_search_link" href="">      <span class="dashboard-stats small">
                            <span class="count"><?php echo $group_open_ticket; ?></span>
                            <span></span>
                            <span class="you">Groups</span>
                        </span>
                    </a>
                </div>

                <div class="stats-group">
                    <h3>Ticket Statistics <span>(this week)</span></h3>
                    <span class="dashboard-stats small">
                        <span class="count"><?php echo $good_ticket; ?></span>
                        <span></span>
                        <span class="you">Good</span>
                    </span>

                    <span class="dashboard-stats small">
                        <span class="count"><?php echo $bad_ticket; ?></span>
                        <span></span>
                        <span class="you">Bad</span>
                    </span>

                    <span class="dashboard-stats small">
                        <span class="count"><?php echo $solved_ticket; ?></span>
                        <span></span>
                        <span class="you">Solved</span>
                    </span>

                </div>

                <div class="stats-group">
                    <h3>Satisfaction Statistics <span>(60 days)</span></h3>
                    <span class="dashboard-stats small">
                        <span class="count">100%</span>
                        <span></span>
                        <span class="you">You</span>
                    </span>

                    <span class="dashboard-stats small">
                        <span class="count">97%</span>
                        <span></span>
                        <span class="you">Help desk</span>
                    </span>

                </div>


            </div>
            <div class="clear"></div>
        </div>




    </div>
<?php } ?>
<div class="x_panel  support-section " id="section_background">
    <div class=" col-md-12 col-sm-12 col-xs-12">
        <div class="search">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 ">
                <input type="text" class="form-control input-sm" maxlength="200px">
            </div>
            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12 ">
                <button type="submit" class="btn btn-primary search-btn">Search</button>
            </div>
        </div>
    </div>
</div>         




</div>
<div class="x_panel  support-section " id="section_background">
    <div class=" col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-11 col-sm-11 col-xs-11 view_data">
            <div id="home-r" class="tab-pane active">
                <p class="lead lead_div"><?php echo $title['title']; ?></p>
                <p class="text_div"><?php echo $title['text']; ?></p>    


            </div>
        </div>
        <div class="col-md-11 col-sm-11 col-xs-11 edit_data text_content">    

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 no-padding" style="margin-bottom:10px;">
                <input type="text" maxlength="200px" class="form-control input-sm" value="<?php echo $title['title']; ?>" id="organisation_title">
                <p id="organisation_error" class="error"></p>
            </div>

            <textarea  name="user_notes" id="organisation_text" class="form-control"><?php echo $title['text']; ?></textarea>
            <p class="error" id="user_error"></p>
            <button data_id="<?php echo $title['org_id']; ?>" type="button" id="add_button"  class="notes_button btn btn-success btn-xs">Save</button>&nbsp;<a href="javascript:void(0)" class="cancle">Cancel</a>

        </div>
        <?php if ($access_level == 1) { ?>
            <div class="col-md-1 col-sm-1 col-xs-1">
                <a href="javascript:void(0)" class="notes edit_this"><h6><b>edit</b></h6></a>
            </div>
        <?php } ?>
    </div>




</div>
<!--Home Page Pin Section-->
<div class="x_panel  support-section" id="section_background">

    <div class="support_view x_panel" id="postpinsection">

        <div class="x_title">
            <h2><?php echo $org_name; ?></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content" style="display: block;">
            <div class="dashboard-widget-content">

                <ul class="list-unstyled timeline widget">
                    <?php
                    if (!empty($category_detail)) {
                        $count = 0;
                        foreach ($category_detail as $value) {
                            $forumpost = getforumpostbycategory($value['forum_category_id']);
                            if (!empty($forumpost)) {
                                $count++;
                                foreach ($forumpost as $forum_article_value) {
                                    ?>
                                    <li class="article_pin">
                                        <div class="block">
                                            <div class="block_content">
                                                <h2 class="title">

                                                    <a href="<?php echo base_url('support/postview') . '/' . $forum_article_value['forum_article_id']; ?>" title="<?php echo word_limiter($forum_article_value['forum_article_title'], 5); ?>"><?php echo $forum_article_value['forum_article_title']; ?></a>
                                                </h2>
                                                <div class="byline">
                                                    <span><?php echo date(DATE_FORMATE_CONSTANT, strtotime($forum_article_value['forum_article_cretaed_at'])); ?></span> by <?php
                                                    echo getUserName($forum_article_value['forum_article_created_by']);
                                                    if ($user['user_access_level'] != 2) {
                                                        ?>
                                                        <a class="unpinpost" href="javascript:void(0)" id="<?php echo $forum_article_value['forum_article_id']; ?>">(Unpin)</a>
                                                    <?php }
                                                    ?>
                                                </div>
                                                <p class="excerpt"><?php echo word_limiter($forum_article_value['forum_article_desc'], 30); ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            } else {
                                
                            }
                        }
                        if ($count == 0) {
                            ?>
                            <li class="article_pin">
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">No Topic For Pin</h2>
                                    </div>
                                </div>
                            </li>

                            <?php
                        }
                    } else {
                        ?>
                        <li class="article_pin">
                            <div class="block">
                                <div class="block_content">
                                    <h2 class="title"><li>No Topic For Pin</li></h2>
                                </div>
                            </div> 
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

</div>
<!--Home Page Pin Section-->

<!--Support Section -->
<p class="forum-nav-recent">
    <a class="recentchange active" href="javascript:void(0)" id="overview" url="/forums">Overview</a>
    <span class="delim">|</span>
    <a class="recentchange" href="javascript:void(0)" id="recent" url="/recent_entries">Recent</a>
</p>
<div class="x_panel  support-section recentsection" id="section_background">

    <?php
    if (!empty($category_detail)) {
        foreach ($category_detail as $value) {
            ?>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 inVentry">
                <?php if ($value['forum_category_name'] != 'None') {
                    ?><h2 class="support-portal"> 
                        <a href="<?php echo base_url('support/forumcategoryview') . '/' . $value['forum_category_id']; ?>"><?php echo word_limiter($value['forum_category_name'], 5) . " »"; ?></a>
                    </h2>
                    <?php
                } else {
                    ?>
                    <?php
                    echo "<h2 class='support-portal'>No Category »</h2>";
                }
                ?>

                <?php
                $pos_count = 0;
                $forum_detail = array();
                $forum_detail = getSupportForumDetail($value['forum_category_id']);
                if (!empty($forum_detail)) {
                    foreach ($forum_detail as $forum_value) {


                        if ($user['user_access_level'] != 2 || $forum_value['forum_topic_view'] != 'Agents only') {
                            $pos_count++;
                            ?>  
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 hilight">
                                <h2 class="hilight-text">
                                    <a href="<?php echo base_url('support/viewForum') . '/' . $forum_value['forum_id']; ?>"><strong class=""><?php echo word_limiter($forum_value['forum_title'], 5); ?></strong><?php echo '  (' . getforumarticleCount($forum_value['forum_id']) . ')  » ' ?></a>
                                    <?php
                                    if ($user['user_access_level'] != 2) {
                                        echo getLockedRestriction($forum_value['forum_topic_view']);
                                    }
                                    ?> 
                                </h2>
                                <ul >
                                    <?php
                                    $forumarticle = getforumarticle($forum_value['forum_id']);
                                    if (!empty($forumarticle)) {
                                        foreach ($forumarticle as $value) {
                                            ?>
                                            <li>
                                                <img src="<?php echo getforumtypeicon($forum_value['forum_type']); ?>">
                                                <a href="<?php echo base_url('support/postview') . '/' . $value['forum_article_id']; ?>" title="<?php echo $value['forum_article_title'] ?>" ><?php echo word_limiter($value['forum_article_title'], 5); ?>
                                                </a> 
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            No topics found 
                                            <?php
                                            if ($user['user_access_level'] != 2 || $forum_value['forum_topic_create'] != 'Unrestricted agents and moderators only') {

                                                $forum_type = posttype($forum_value['forum_type']);
                                                ?>

                                                <a href="<?php echo base_url('support/forumEntries') . '/' . $forum_value['forum_id']; ?>" >- <?php echo $forum_type['text'] ?>
                                                </a> 
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                    if ($pos_count == 0) {
                        ?>
                        <span>No Topic for user</span> 
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 ">
                        No Forum Found
                        <?php if ($user['user_access_level'] != 2) {
                            ?>
                            - <a href="<?php echo base_url('support/addforum') . '/' . $value['forum_category_id'] . '/' . $value['organisation_id'] ?>">Add Forum »</a>

                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php
        }
    } else {
        ?>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  inVentry">
            <h2 class="support-portal"></h2>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 hilight">
                <h2 class="hilight-text">No Category Found</h2>
                <ul>
                    <li>No Forum Found</li>
                </ul>

            </div>
        </div>

        <?php
    }
    ?></div>
<style>
    div#csr-dashboard span.dashboard-stats.small span.count{
        font-size: 16px;
        font-weight: bold;
        display:block;
    }


    #csr-dashboard {
        /*background: #fafafa none repeat scroll 0 0;*/
        /*border: 1px solid #eeeeee;*/
        border-radius: 3px;
        box-sizing: border-box;
        display: block;
        float: left;
        font-size: 13px;
        padding: 10px;
        width: 100%;
    }
    div#csr-dashboard a{
        color: #1a6690;
    } 
    div#csr-dashboard div.picture{
        float: left;
        margin: 0 20px 0 0;
    }
    div#csr-dashboard div.current-user{
        float: left;
    }
    div#csr-dashboard div.picture img{
        border: 2px solid #bbbbbb;
    }
    div#csr-dashboard p.upload-link{
        color: inherit;
        font-size: 11px;
        margin: 0;
        text-align: center;
        text-decoration: underline;
    }
    div#csr-dashboard h2{
        font-size: 22px;
        margin: 0 0 5px;
    }
    div#csr-dashboard div.stats-group{
        float: left;
        margin: 0 30px 0 0;
    }
    div#csr-dashboard h3{
        font-size: 13px;
        margin: 0;
    }
    div#csr-dashboard h3 span{
        color: #b2b2b2;
        font-weight: normal;
    }
    div#csr-dashboard span.dashboard-stats.small{
        border-radius: 4px;
        margin: 6px 6px 0 0;
        min-width: 40px;
        padding: 5px 18px;
    }
    div#csr-dashboard span.dashboard-stats{
        background-color: #e9e9e9;
        float: left;
        text-align: center;
    }
    .text_content{
        display:none;
    }
     .forum-nav-recent .active{
        color: #008000;
        cursor:auto;
        text-decoration: underline;
    }
</style>