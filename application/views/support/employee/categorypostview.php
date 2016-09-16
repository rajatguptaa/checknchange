<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?> 
<h2 class="support-portal">
     <?php $category_name =  getCategoryName($category_id);
 
     ?>
                                <a href="<?php echo base_url('support/forumcategoryview') . '/' . $category_name[0]['forum_category_id']; ?>"><?php
                                    echo word_limiter($category_name[0]['forum_category_name'], 5);
                                    ;
                                    ?></a>


                            </h2>
                            <?php
                            if ($user['user_access_level'] != 2) {
                                ?>
                                <ul class="nav navbar-right panel_toolbox top">
                                    <li class="dropdown">
                                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-caret-down"></i> <span class="edit_this">actions</span></a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="<?php echo base_url('support/addforum') . '/' . $category_name[0]['forum_category_id'] . '/' . $category_name[0]['organisation_id'] ?>">Add Forum </a>
                                            </li>
                                            <?php if ($category_name[0]['forum_category_name'] != 'None') { ?>
                                                <li><a href="<?php echo base_url('support/editcategory') . '/' . $category_name[0]['forum_category_id']; ?>" id="edit" >Edit Category</a>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            <?php } ?>

                            <?php
                            $forum_detail = array();
                            $forum_detail = getSupportForumDetail($category_name[0]['forum_category_id']);
                            if (!empty($forum_detail)) {

                                foreach ($forum_detail as $forum_value) {

                                    if ($user['user_access_level'] != 2 || $forum_value['forum_topic_view'] != 'Agents only') {
                                        ?>  

                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 hilight">
                                            <h2 class="hilight-text">
                                                <a href="<?php echo base_url('support/viewForum') . '/' . $forum_value['forum_id']; ?>"><strong class=""><?php echo word_limiter($forum_value['forum_title'], 5) ?></strong><?php echo '  (' . getforumarticleCount($forum_value['forum_id']) . ')  ' ?></a>
                                                <?php
                                                if ($user['user_access_level'] != 2) {
                                                    echo getLockedRestriction($forum_value['forum_topic_view']);
                                                }
                                                ?> 
                                            </h2>
                                            <ul class="forul">
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
                            } else {
                                ?>
                                <div class="">No Forum Found 
                                    <?php if ($user['user_access_level'] != 2) {
                                        ?>
                                        - <a href="<?php echo base_url('support/addforum') . '/' . $category_name[0]['forum_category_id'] . '/' . $category_name[0]['organisation_id'] ?>">Add Forum »</a>
                                    </div>

                                    <?php
                                }
                            }
                            ?>