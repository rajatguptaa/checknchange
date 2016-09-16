<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= $mainHeading ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                    <a class="btn btn-success btn-sm pull-right" href="javascript:void(0);" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-xs-12" style="border-right: 15px solid white;">
                                <div class="item form-group">
                                    <h2 class="col-md-12 col-sm-12 col-xs-12" for="support_forum">Forum title *
                                    </h2>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input  required="required" id="support_forum_title" placeholder="Enter forum title" name="support_forum_title" data-parsley-error-message="The forum title field is required." value="<?= ( $method == "post") ? set_value('support_forum_title') : $forumdetail[0]['forum_title']; ?>" type="text" class="form-control col-md-7 col-xs-12"><?php echo form_error('support_forum_title'); ?>
                                    </div>     
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="item form-group">
                                    <label class=" col-md-3 col-sm-3 col-xs-12" for="support_category_desc">Description *
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">

                                        <textarea rows="4" required="required" id="forum_description" placeholder="Enter category description" name="forum_description" class="form-control col-md-7 col-xs-12" data-parsley-error-message="The forum description field is required."><?= ( $method == "post") ? set_value('forum_description') : $forumdetail[0]['forum_desc']; ?></textarea>
                                        <?php echo form_error('forum_description'); ?>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="form-group col-md-9 col-sm-9 col-xs-12">A brief description of topics relevant for this forum. Basic HTML allowed.</div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="item form-group">

                                    <label class="col-md-3 col-sm-3 col-xs-12" for="phone">Category <span class="required">*</span>
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">

                                        <select data-parsley-error-message="The Category field is required."  required="required" id="category_type" name="category_type" tabindex="-1" class="chosen category_type form-control col-md-7 col-xs-12 <?= (strlen(form_error('select_content')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('select_content'); ?>">
                                            <?php
                                            if (!empty($category_detail)) {
                                                foreach ($category_detail as $value) {
                                                    ?>
                                                    <option <?php
                                                    if ($forumdetail[0]['category_id'] == $value['forum_category_id'])
                                                        echo "selected='true'";
                                                    else
                                                        echo "";
                                                    ?> value="<?php echo $value['forum_category_id'] ?>"><?php echo $value['forum_category_name']; ?></option>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">No category</option>
                                            <?php }
                                            ?>
                                        </select>   
                                        <?php echo form_error('category_type'); ?>
                                    </div>

                                </div>
                                <div class="item form-group">

                                    <label class="col-md-3 col-sm-3 col-xs-12" for="phone">Content <span class="required">*</span>
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select data-parsley-error-message="The Content field is required."  required="required" id="content_type" name="content_type" tabindex="-1" class="chosen select_content form-control col-md-7 col-xs-12 <?= (strlen(form_error('select_content')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('content_type'); ?>">
                                            <option <?php if ($forumdetail[0]['forum_type'] == "Articles") echo 'selected="true"' ?>  value="Articles">Articles - users can vote for the most helpful articles</option>
                                            <option <?php if ($forumdetail[0]['forum_type'] == "Ideas") echo 'selected="true"' ?> value="Ideas">Ideas - users vote for the best ideas, and you can mark ideas as planned or done</option>
                                            <option <?php if ($forumdetail[0]['forum_type'] == "Questions") echo 'selected="true"' ?> value="Questions">Questions - users vote for questions, and you can mark the answer</option>
                                        </select>   
                                        <?php echo form_error('content_type'); ?>
                                    </div>

                                </div>
                                <div class="content_order_div item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="order_by">
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <label class="" for="order">Order by <span class="required">*</span>
                                        </label>
                                        <select data-parsley-error-message="The Order by field is required."  required="required" id="category_type" name="content_order_by" tabindex="-1" class="chosen content_order_by form-control col-md-7 col-xs-12 <?= (strlen(form_error('content_order_by')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('content_order_by'); ?>">
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_highlight_status DESC, forum_article.updated_by DESC">Highlighted first, then latest activity</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_highlight_status DESC, forum_article.forum_article_cretaed_at DESC, forum_article.forum_article_id DESC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_highlight_status DESC, forum_article.forum_article_cretaed_at DESC, forum_article.forum_article_id DESC">Highlighted first, then submit date (latest first)</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_highlight_status DESC, forum_article.forum_article_cretaed_at ASC, forum_article.forum_article_id ASC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_highlight_status DESC, forum_article.forum_article_cretaed_at ASC, forum_article.forum_article_id ASC">Highlighted first, then submit date (latest last)</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_highlight_status DESC, forum_article.forum_article_title ASC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_highlight_status DESC, forum_article.forum_article_title ASC">Highlighted first, then alphabetically</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.updated_by DESC' ? 'selected="true"' : ''); ?> value="forum_article.updated_by DESC">Latest activity</option>
                                            <option <?php echo ($forumdetail[0]['forum_topic_view'] == 'forum_article.forum_article_cretaed_at DESC, forum_article.forum_article_id DESC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_cretaed_at DESC, forum_article.forum_article_id DESC">Submit date, latest first</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_cretaed_at ASC, forum_article.forum_article_id ASC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_cretaed_at ASC, forum_article.forum_article_id ASC">Submit date, latest last</option>
                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'forum_article.forum_article_title ASC' ? 'selected="true"' : ''); ?> value="forum_article.forum_article_title ASC">Alphabetically by title</option>

                                            <option <?php echo ($forumdetail[0]['forum_order_by'] == 'article_comment_rel.forum_article_id DESC' ? 'selected="true"' : ''); ?> value="article_comment_rel.forum_article_id DESC">Most comments</option>

                                        </select>   
                                        <?php echo form_error('content_order_by'); ?>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label  class="col-md-3 col-sm-3 col-xs-12" for="Role_restrictions">Role restrictions</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 ">
                                        <h4>Who can view topics in this forum?</h4>
                                        <input type="radio" <?php echo ($forumdetail[0]['forum_topic_view'] == 'Everybody' ? 'checked="true"' : ''); ?> value="Everybody" name="visibility_restriction_id" id="forum_visibility_restriction_id_1" class="radio" checked="checked">
                                        <label for="forum_visibility_restriction_id_1" class="option">Everybody</label>
                                        <input type="radio" <?php echo ($forumdetail[0]['forum_topic_view'] == 'Signed-in users' ? 'checked="true"' : ''); ?> value="Signed-in users" name="visibility_restriction_id" id="forum_visibility_restriction_id_2" class="radio">
                                        <label for="forum_visibility_restriction_id_2" class="option">Signed-in users</label>
                                        <input type="radio" <?php echo ($forumdetail[0]['forum_topic_view'] == 'Agents only' ? 'checked="true"' : ''); ?> value="Agents only" name="visibility_restriction_id" id="forum_visibility_restriction_id_3" class="radio">
                                        <label for="forum_visibility_restriction_id_3" class="option">Agents only</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                        <h4>Who can create topics in this forum?</h4>
                                        <input type="radio" value="'Logged-in users" <?php echo ($forumdetail[0]['forum_topic_create'] == 'Logged-in users' ? 'checked="true"' : ''); ?>  name="forum_create_topic" id="forum_is_locked_false" class="radio" checked="checked">
                                        <label for="forum_is_locked_false" class="option">Logged-in users</label>

                                        <input type="radio" <?php echo ($forumdetail[0]['forum_topic_create'] == 'Unrestricted agents and moderators only' ? 'checked="true"' : ''); ?> value="Unrestricted agents and moderators only" name="forum_create_topic" id="forum_is_locked_true" class="radio">
                                        <label for="forum_is_locked_true" class="option">Unrestricted Employees and moderators only</label>
                                    </div>   
                                    <div class="col-md-5 col-sm-5 col-xs-12">

                                    </div>
                                </div>


                                <input type="hidden" name="forum_id" id="forum_id" value="<?php echo $forumdetail[0]['forum_id']; ?>"/>
                                <div class="clearfix"></div>
                                <div class="row">&nbsp;</div>
                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                                <div class="form-group  pull-right">

                                    <div class="links_delete">
                                        <?php if (access_check("support portal", "delete")) {
                                            ?>
                                            <a id="<?= $forumdetail[0]['forum_id']; ?>"  href="javascript:void(0)" class="delete">Delete</a>&nbsp;or&nbsp;
                                        <?php } ?>
                                        <button id="send" type="submit" class="btn btn-success btn-xs">Update Forum</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-12 pull-right" style="background-color: #F6F6F6">
                                <div class="side-box-content"><h3><strong>Forums</strong></h3>
                                    <p><p>Keep everybody up-to-date and encourage users to participate in the conversation with forums.
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .item .radio {
        float: left;
    }
    .option {
        float: left;
        margin: 6px 20px 6px 6px;
    }
    div#moderator_box div.links a:hover {
        background-color: #b65151 !important;
        color: #ffffff !important;
    }
    div#moderator_box div.links a {
        color: #b65151 !important;
    }
</style>