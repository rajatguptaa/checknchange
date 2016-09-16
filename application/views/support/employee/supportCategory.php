<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
if (!empty($categroy_detail)) {
    foreach ($categroy_detail as $value) {
        ?>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 test">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 inVentry">
                <?php if ($value['forum_category_name'] != 'None') {
                    ?><h2 class="support-portal"> 
                        <a href="<?php echo base_url('support/forumcategoryview') . '/' . $value['forum_category_id']; ?>"><?php echo word_limiter($value['forum_category_name'], 5) . " »"; ?></a>
                    </h2>
                    <?php
                } else {
                    ?>
                    <?php
                    echo "<h2 class='support-portal' style='color:#b7b7b7'>No Category »</h2>";
                }
                ?>
                <?php
                if ($user['user_access_level'] != 2) {

                    if ($pagetype != 'dashboard') {
                        ?>
                        <ul class="nav navbar-right panel_toolbox top">
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-caret-down"></i> <span class="edit_this">actions</span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo base_url('support/addforum') . '/' . $value['forum_category_id'] . '/' . $value['organisation_id'] ?>">Add Forum </a>
                                    </li>
                                    <?php if ($value['forum_category_name'] != 'None') { ?>
                                        <li><a href="<?php echo base_url('support/editcategory') . '/' . $value['forum_category_id']; ?>" id="edit" >Edit Category</a>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
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
                                        foreach ($forumarticle as $forumvalue) {
                                            ?>
                                            <li>
                                                <img src="<?php echo getforumtypeicon($forum_value['forum_type']); ?>">

                                                <a href="<?php echo base_url('support/postview') . '/' . $forumvalue['forum_article_id']; ?>" title="<?php echo $forumvalue['forum_article_title'] ?>" ><?php echo word_limiter($forumvalue['forum_article_title'], 5); ?>
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
                    <div class="">No Forum Found 
                        <?php if ($user['user_access_level'] != 2) {
                            ?>
                            - <a href="<?php echo base_url('support/addforum') . '/' . $value['forum_category_id'] . '/' . $value['organisation_id'] ?>">Add Forum »</a>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
        </div>


        <?php
    }
} else {
    ?>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  inVentry">
        <h2 class="support-portal">No Category Found</h2>
        <div class="">No Forum Found 
            <?php
            if ($user['user_access_level'] != 2) {
                if (!empty($categroy_detail)) {
                    
                        ?>
                        - <a href="<?php echo base_url('support/addforum') . '/' . $categroy_detail[0]['forum_category_id'] . '/' . $categroy_detail[0]['organisation_id'] ?>">Add Forum �</a>
                    </div>

                    <?php
                
            }
        }
        ?>

    </div>
    <?php
}
?>


<style>
    .options{
        position: absolute;
        right: 0;
        top:0;
    }
    .inVentry {
        padding-bottom: 25px;
        box-shadow: 0px 0px 1px 0px #ddd;
        margin-top: 10px;
        background-color: #FFFFFF;

    }
    .hilight {
        padding-top: 10px;
        padding-bottom: 12px;
    }
    h2.hilight-text {
        width: 100%;
        font-size: 14px;
        color: #1a6690;
        font-weight: 600;
        border-bottom: 1px solid #ddd;
    }
    .hilight ul li{
        display: block;
    }
    ul, ol {
        padding: 0px;
        margin-top: 0;
        margin-bottom: 10px;
    }
    .panel_toolbox>li {
        float: left;
        margin-top: -33px;
    }
    .support-section {
        background: #F4F4F4;
    }
    .top{
        margin-top: -5px !important;
    }


</style>