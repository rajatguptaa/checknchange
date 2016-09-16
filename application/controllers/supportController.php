<?php

include 'baseController.php';

class SupportController extends BaseController {

    private $tabelename;

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }
        $this->tabelename = "forum_category";
    }

    public function index() {
        $data['scripts_to_load'] = array(
            'assets/js/chosen/chosen.jquery.js'
        );
        $data['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/support.css');
        $data['mainHeading'] = "Support Forum";
        $data['organisation'] = $this->crm->getData('organisation');
        $this->load->template('/support/employee/index', $data);
    }

    public function categoryForum() {
        $organisation_id = $this->input->post('organisation_id');
        $data['pagetype'] = $this->input->post('pagetype');
        $where = array('organisation_id' => $organisation_id);
        $data['categroy_detail'] = $this->crm->getData('forum_category', '*', $where);
        echo $this->load->view('/support/employee/supportCategory', $data, true);
    }

    public function createSupport() {

        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Create";

        $data['organisation'] = $this->crm->getData('organisation');
        $data['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js');
        $data['style_to_load'] = array('assets/css/chosen/chosen.css');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('support_category', 'Category Name', 'required|callback_name_check');
            $this->form_validation->set_rules('category_description', 'Category Description', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('support/employee/create', $data);
            } else {
                $data = $this->input->post();

                $insertdata['forum_category_name'] = $data['support_category'];
                $insertdata['forum_category_description'] = $data['category_description'];
                $insertdata['organisation_id'] = $data['orginasation_type'];
                $insertdata['forum_created_by'] = getLoginUser();
                $insertdata['forum_created_at'] = date("Y-m-d H:i:s");
                $support_category_id = $this->crm->rowInsert($this->tabelename, $insertdata);
                if ($support_category_id != NULL) {
                    $this->session->set_flashdata('support_success', 'Support Category Created Successfully');
                    redirect('support', 'refresh');
                }
            }
        } else {
            $this->load->template('support/employee/create', $data);
        }
    }

    public function name_check($name) {
        $where = array('forum_category_name' => $name, 'organisation_id' => $this->input->post('orginasation_type'));
        $category_name = $this->crm->getRowCount('forum_category', 'forum_category_id', $where);
        if ($category_name > 0) {
            $this->form_validation->set_message('name_check', 'This category already exist in your organisation');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function forumcreateSupport($category_id = FALSE, $organisation_id = FALSE) {

        $user = $this->session->userdata('logged_in');
        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Forum Create";
        $data['organisation'] = $organisation_id;
        $where = array('organisation_id' => $organisation_id);
        $data['category_detail'] = $this->crm->getData('forum_category', '*', $where);
        $data['category_id'] = $category_id;
        $data['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', "assets/js/modules/support.js");
        $data['style_to_load'] = array('assets/css/chosen/chosen.css');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('support_forum_title', 'Forum title', 'required|callback_forumname_check');
            $this->form_validation->set_rules('forum_description', 'Category Description', 'required');
            $this->form_validation->set_rules('category_type', 'Category', 'required');
            $this->form_validation->set_rules('content_type', 'Content', 'required');
            $this->form_validation->set_rules('visibility_restriction_id', 'Visibility restriction', 'required');
            $this->form_validation->set_rules('forum_create_topic', 'Create topic', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/support/employee/createforum', $data);
            } else {
                $post_data = $data = $this->input->post();

                $insertdata = array(
                    'forum_title' => $post_data['support_forum_title'],
                    'forum_desc' => $post_data['forum_description'],
                    'category_id' => $post_data['category_type'],
                    'forum_type' => $post_data['content_type'],
                    'forum_topic_view' => $post_data['visibility_restriction_id'],
                    'forum_topic_create' => $post_data['forum_create_topic'],
                    'forum_created_at' => date("Y-m-d H:i:s"),
                    'forum_created_by' => getLoginUser()
                );
                if ($post_data['content_type'] == 'Articles') {
                    $insertdata['forum_order_by'] = $post_data['content_order_by'];
                }
                $support_forum_id = $this->crm->rowInsert('forum', $insertdata);
                if ($support_forum_id != NULL) {
                    $this->session->set_flashdata('support_forum_success', 'Support Forum Created Successfully');
                    redirect('support/viewForum/' . $support_forum_id, 'refresh');
                }
            }
        } else {

            $this->load->template('/support/employee/createforum', $data);
        }
    }

    public function forumname_check($name) {
        $org_id = $this->input->post('org_id');
        $where = array('forum.forum_title' => $name, 'forum_category.organisation_id' => $org_id);
        $join = array(
            array('table' => 'forum',
                'on' => 'forum_category.forum_category_id=forum.category_id')
        );
        $forum_name = $this->crm->getRowCount('forum_category', 'forum_category_id', $where, $join);
        if ($forum_name > 0) {
            $this->form_validation->set_message('forumname_check', 'This forum already exist in your organisation');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function viewForum($forum_id) {
        $data['scripts_to_load'] = array('assets/js/nicescroll/jquery.nicescroll.min.js');
        $data['mainHeading'] = "Support Forum";
        $data['forum_id'] = $forum_id;
        $data['organisation'] = $this->crm->getData('organisation');
        $this->load->template('/support/employee/forumview', $data);
    }

    public function forumEntries($forum_id = NULL) {
        $user = $this->session->userdata('logged_in');
        $access_level = $user['user_access_level'];
        if ($access_level == 2) {
            $this->customerforumEntries($forum_id);
        } else {
            $data['forum_detail'] = getSupportForumDetailId($forum_id);
            $data['mainHeading'] = "Support Forum";
            $data['subHeading'] = "Forum Create";
            $data['forum_id'] = $forum_id;

            $data['scripts_to_load'] = array('assets/js/tags/bootstrap-tagsinput.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/ckeditor/ckeditor.js', "assets/js/modules/support.js");
            $data['style_to_load'] = array("assets/css/tags/bootstrap-tagsinput.css", 'assets/css/chosen/chosen.css');

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->post()) {
                $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
                $this->form_validation->set_rules('forum_type_title', 'Forum post title', 'required|callback_articlename_check');
                $this->form_validation->set_rules('forum_type_text', 'Forum Post Description', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->template('support/employee/createforumtype', $data);
                } else {
                    $post_data = $data = $this->input->post();
                    $insertdata = array(
                        'forum_article_title' => $post_data['forum_type_title'],
                        'forum_article_desc' => $post_data['forum_type_text'],
                        'forum_id' => $post_data['forum_post_id'],
                        'forum_category_id' => $post_data['category_id'],
                        'forum_article_comment_status' => $post_data['forum_post_locked'],
                        'forum_article_homepage_status' => $post_data['forum_post_pinned'],
                        'forum_article_highlight_status' => $post_data['forum_post_highlighted'],
                        'forum_article_cretaed_at' => date("Y-m-d H:i:s"),
                        'updated_by' => date("Y-m-d H:i:s"),
                        'forum_article_created_by' => getLoginUser()
                    );
                    $tag_names = "";
                    if ($post_data['forum_type_tags'] != "") {
                        $tag_names = explode(',', $post_data['forum_type_tags']);
                    }
                    $forum_article_id = $this->crm->rowInsert('forum_article', $insertdata);
                    if ($forum_article_id != NULL) {
                        $insert_tag_data = array();
                        $insert_attach_data = array();
                        if (!empty($post_data['attachment_id'])) {
                            foreach ($post_data['attachment_id'] as $value) {
                                $insert_attach_data['forum_article_id'] = $forum_article_id;
                                $insert_attach_data['attachment_id'] = $value;

                                $forum_tag_id = $this->crm->rowInsert('forum_article_attachment_rel', $insert_attach_data);
                            }
                        }
                        if ($tag_names != "") {
                            foreach ($tag_names as $value) {
                                $insert_tag_data['forum_article_id'] = $forum_article_id;
                                $insert_tag_data['tags_name'] = $value;
                                $forum_tag_id = $this->crm->rowInsert('forum_tags', $insert_tag_data);
                            }
                        }
                        $this->session->set_flashdata('support_forum_post_success', 'forum post Created Successfully');
                        redirect('support/postview/' . $forum_article_id, 'refresh');
                    }
                }
            } else {

                $this->load->template('/support/employee/createforumtype', $data);
            }
        }
    }

    public function customerforumEntries($forum_id = NULL) {
        if ($forum_id != NULL) {
            $data['forum_detail'] = getSupportForumDetailId($forum_id);
            $data['mainHeading'] = "Support Forum";
            $data['subHeading'] = "Forum Create";
            $data['forum_id'] = $forum_id;
            $data['scripts_to_load'] = array('assets/js/tags/bootstrap-tagsinput.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/ckeditor/ckeditor.js', "assets/js/modules/support.js");
            $data['style_to_load'] = array("assets/css/tags/bootstrap-tagsinput.css", 'assets/css/chosen/chosen.css');

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->post()) {
                $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
                $this->form_validation->set_rules('forum_type_title', 'Forum post title', 'required|callback_articlename_check');
                $this->form_validation->set_rules('forum_type_text', 'Forum Post Description', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->template('/support/customer/createpostcustomer', $data);
                } else {
                    $post_data = $data = $this->input->post();
                    $insertdata = array(
                        'forum_article_title' => $post_data['forum_type_title'],
                        'forum_article_desc' => $post_data['forum_type_text'],
                        'forum_id' => $post_data['forum_id'],
                        'forum_category_id' => $post_data['category_id'],
                        'forum_article_cretaed_at' => date("Y-m-d H:i:s"),
                        'forum_article_created_by' => getLoginUser()
                    );
                    $forum_article_id = $this->crm->rowInsert('forum_article', $insertdata);
                    if ($forum_article_id != NULL) {
                        $insert_tag_data = array();
                        $insert_attach_data = array();
                        if (!empty($post_data['attachment_id'])) {
                            foreach ($post_data['attachment_id'] as $value) {
                                $insert_attach_data['forum_article_id'] = $forum_article_id;
                                $insert_attach_data['attachment_id'] = $value;

                                $forum_tag_id = $this->crm->rowInsert('forum_article_attachment_rel', $insert_attach_data);
                            }
                        }
                        $this->session->set_flashdata('support_success', 'Forum Post Created Successfully');
                        redirect('support/postview/' . $forum_article_id, 'refresh');
                    }
                }
            } else {

                $this->load->template('support/customer/createpostcustomer', $data);
            }
        }
    }

    public function articlename_check($name) {
        $category_id = $this->input->post('category_id');

        $cat_detail = getCategoryName($category_id);
        $where = array('forum_article_title' => $name, 'forum_category.organisation_id' => $cat_detail[0]['organisation_id']);
        $join = array(
            array('table' => 'forum_article',
                'on' => 'forum_category.forum_category_id=forum_article.forum_category_id')
        );
        $forum_name = $this->crm->getRowCount('forum_category', 'forum_category_id', $where, $join);
        if ($forum_name > 0) {
            $this->form_validation->set_message('articlename_check', 'This Post already exist in your organisation');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function forumarticlepostview($forum_post_id = 0) {
        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Forum Category";
        $data['scripts_to_load'] = array('assets/js/nicescroll/jquery.nicescroll.min.js', "assets/js/modules/supportforumpost.js", 'assets/js/ckeditor/ckeditor.js', 'assets/js/bootbox/bootbox.js');

        $where = array('forum_article_id' => $forum_post_id);
        $join = array(
            array('table' => 'user',
                'on' => 'user.user_id=forum_article.forum_article_created_by')
        );
        $data['forum_post_detail'] = $this->crm->getData('forum_article', '*', $where, $join);
        $data['forum_post_tags'] = $this->crm->getData('forum_tags', '*', $where);
        $data['forum_post_attach'] = $this->crm->getData('forum_article_attachment_rel', '*', $where);
        $data['forum_post_id'] = $forum_post_id;

        $this->load->template('support/employee/forumpostview', $data);
    }

    public function forumcategoryview($category_id) {
        $data['style_to_load'] = array('assets/css/support.css');
        $data['category_id'] = $category_id;
        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Forum Category";
        $data['forum_detail'] = getSupportForumDetail($category_id);
        $this->load->template('support/employee/viewforumcategory', $data);
    }

    public function editcategory($category_id) {

        $data['category_name'] = getCategoryName($category_id);
        $data['method'] = 'get';
        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Edit Forum Category";
        $data['organisation'] = $this->crm->getData('organisation');
        $data['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', "assets/js/bootbox/bootbox.js");
        $data['style_to_load'] = array('assets/css/chosen/chosen.css');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $data['method'] = 'post';
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('edit_support_category', 'Category Name', 'required');
            $this->form_validation->set_rules('edit_category_description', 'Category Description', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('support/employee/editCategory', $data);
            } else {
                $data = $this->input->post();

                $insertdata['forum_category_name'] = $data['edit_support_category'];
                $insertdata['forum_category_description'] = $data['edit_category_description'];
//                $insertdata['organisation_id'] = $data['orginasation_type'];
                $insertdata['forum_created_by'] = getLoginUser();
                $insertdata['forum_created_at'] = date("Y-m-d H:i:s");
                $where = array('forum_category_id' => $data['support_category_id']);
                $support_category_id = $this->crm->rowUpdate($this->tabelename, $insertdata, $where);
                if ($support_category_id != NULL) {
                    $this->session->set_flashdata('support_success', 'Support category Updated Successfully');
                    redirect('support', 'refresh');
                }
            }
        } else {
            $this->load->template('support/employee/editCategory', $data);
        }
    }

    public function deleteCateogry($category_id) {


        $org_id = getForumCategoryOrgid($category_id);
        $default_category = getDefaultCategoryId($org_id[0]['organisation_id']);
        $where = array('forum_category_id' => $category_id);
        $forum_detail = array();
        $forum_detail = getSupportForumDetail($category_id);
        $forum_post = $this->crm->getData('forum_article', 'forum_article_id', array('forum_category_id' => $category_id));
        if (!empty($forum_detail)) {
            foreach ($forum_detail as $value) {
                $where_id = array('forum_id' => $value['forum_id']);
                $data = array('category_id' => $default_category);
                $support_category_id = $this->crm->rowUpdate('forum', $data, $where_id);
            }
        }

        if (!empty($forum_post)) {
            foreach ($forum_post as $value) {
                $where_id = array('forum_article_id' => $value['forum_article_id']);
                $data = array('forum_category_id' => $default_category);
                $support_category_id = $this->crm->rowUpdate('forum_article', $data, $where_id);
            }
        }
        $support_category_id = $this->crm->rowsDelete($this->tabelename, $where);
        if ($support_category_id != NULL) {
            $this->session->set_flashdata('support_success', 'Support category Deleted Successfully');
            redirect('support', 'refresh');
        }
    }

    public function editSupportForum($forum_id) {

        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Forum Edit";
        $data['forumdetail'] = getSupportForumDetailId($forum_id);
        $data['method'] = 'get';
        $join = array(
            array('table' => 'forum',
                'on' => 'forum_category.forum_category_id=forum.category_id'),
        );
        $where = array('forum_id' => $forum_id);
        $organisation_id = $this->crm->getData('forum_category', 'forum_category.organisation_id', $where, $join);
        $where = array('organisation_id' => $organisation_id[0]['organisation_id']);
        $data['category_detail'] = $this->crm->getData('forum_category', '*', $where);
        $data['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', "assets/js/bootbox/bootbox.js", "assets/js/modules/support.js");
        $data['style_to_load'] = array('assets/css/chosen/chosen.css');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $data['method'] = 'post';
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('support_forum_title', 'Forum title', 'required');
            $this->form_validation->set_rules('forum_description', 'Category Description', 'required');
            $this->form_validation->set_rules('category_type', 'Category', 'required');
            $this->form_validation->set_rules('content_type', 'Content', 'required');
            $this->form_validation->set_rules('visibility_restriction_id', 'Visibility restriction', 'required');
            $this->form_validation->set_rules('forum_create_topic', 'Create topic', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/support/employee/editForum', $data);
            } else {
                $post_data = $data = $this->input->post();

                $insertdata = array(
                    'forum_title' => $post_data['support_forum_title'],
                    'forum_desc' => $post_data['forum_description'],
                    'category_id' => $post_data['category_type'],
                    'forum_type' => $post_data['content_type'],
                    'forum_topic_view' => $post_data['visibility_restriction_id'],
                    'forum_topic_create' => $post_data['forum_create_topic']
                );
                if ($post_data['content_type'] == 'Articles') {

                    $insertdata['forum_order_by'] = $post_data['content_order_by'];
                }

                $where = array('forum_id' => $post_data['forum_id']);

                $support_forum_id = $this->crm->rowUpdate('forum', $insertdata, $where);
                if ($support_forum_id != NULL) {
                    $forum_article = array();
                    $forum_article = getforumarticleall($forum_id);

                    if (!empty($forum_article)) {
                        foreach ($forum_article as $value) {
                            $whre = array('forum_article_id' => $value['forum_article_id']);
                            $data = array('forum_category_id' => $post_data['category_type']);
                            $this->crm->rowUpdate('forum_article', $data, $whre);
                        }
                    }
                    $this->session->set_flashdata('support_forum_success', 'Support forum Updated Successfully');
                    redirect('support/viewForum/' . $forum_id, 'refresh');
                }
            }
        } else {

            $this->load->template('/support/employee/editForum', $data);
        }
    }

    public function deletesupportforum($forum_id) {
        $where = array('forum_id' => $forum_id);
        $support_forum_id = $this->crm->rowsDelete('forum', $where);
//        if ($support_forum_id != NULL) {
        $comment_ids = array();
        $forumarticleids = array();
        $comment_ids = array();

        $forum_article = getforumarticleall($forum_id);
        foreach ($forum_article as $value) {
            $forumarticleids[] = $value['forum_article_id'];
        }
        if (!empty($forumarticleids)) {
            $this->crm->rowsDeleteWhereIn("forum_article", $forumarticleids, "forum_article_id");
            $this->crm->rowsDeleteWhereIn("forum_tags", $forumarticleids, "forum_article_id");
            $article_comment_rel = $this->crm->getWhereInData("article_comment_rel", array("comment_id"), $forumarticleids, "forum_article_id");




            if (!empty($article_comment_rel)) {
                foreach ($article_comment_rel as $val) {
                    $comment_ids[] = $val["comment_id"];
                }
            }
            // getting comment attachment ids
            $attachment_ids = array();
            if (!empty($comment_ids)) {
                $article_comm_attachment_rel = $this->crm->getWhereInData("comment_attachment_rel", array("attachment_id"), $comment_ids, "comment_id");
                if (!empty($article_comm_attachment_rel)) {
                    foreach ($article_comm_attachment_rel as $val) {
                        $attachment_ids[] = $val["attachment_id"];
                    }
                }
            }
            // getting ticket attachment ids

            $article_attachment_rel = $this->crm->getWhereInData("forum_article_attachment_rel", array("attachment_id"), $forumarticleids, "forum_article_id");

            if (!empty($article_attachment_rel)) {
                foreach ($article_attachment_rel as $val) {
                    $attachment_ids[] = $val["attachment_id"];
                }
            }
            if (!empty($attachment_ids)) {
                //Delete attachment file
                $attachment_path = $this->crm->getWhereInData("attachment", array("attachment_path"), $attachment_ids, "attachment_id");
                if (!empty($attachment_path)) {
                    foreach ($attachment_path as $val) {
                        image_delete("./" . $val['attachment_path']);
                    }
                }
            }

            if (!empty($attachment_ids)) {
                $this->crm->rowsDeleteWhereIn("attachment", $attachment_ids, "attachment_id");
            }
            if (!empty($forumarticleids)) {
                $this->crm->rowsDeleteWhereIn("article_comment_rel", $forumarticleids, "forum_article_id");
                $this->crm->rowsDeleteWhereIn("forum_article_attachment_rel", $forumarticleids, "forum_article_id");
                $this->crm->rowsDeleteWhereIn('article_idea_status', $forumarticleids, "forum_article_id");
                $this->crm->rowsDeleteWhereIn('forum_article_like', $forumarticleids, 'article_id');
                $this->crm->rowsDeleteWhereIn('article_idea_status', $forumarticleids, "forum_article_id");
            }
            if (!empty($comment_ids)) {
                $this->crm->rowsDeleteWhereIn("comment_attachment_rel", $comment_ids, "comment_id");
                $this->crm->rowsDeleteWhereIn("comment", $comment_ids, "comment_id");
            }
        }
        $this->session->set_flashdata('support_success', 'Support Forum Deleted Successfully');
        redirect('support', 'refresh');
    }

    public function editsupportforumpost($forum_post_id) {

        $user = $this->session->userdata('logged_in');
        $access_level = $user['user_access_level'];
        if ($access_level == 2) {
            $this->editcustomersupportforumpost($forum_post_id);
        } else {

            $where = array('forum_article_id' => $forum_post_id);
            $data['forum_detail'] = getForumDetailByPost($forum_post_id);
            $data['forum_post_detail'] = $this->crm->getData('forum_article', '*', $where);
            $data['forum_post_tags'] = $this->crm->getData('forum_tags', '*', $where);
            $data['forum_post_attach'] = $this->crm->getData('forum_article_attachment_rel', '*', $where);
            $data['mainHeading'] = "Support Forum";
            $data['subHeading'] = "Forum Edit";
            $data['scripts_to_load'] = array('assets/js/tags/bootstrap-tagsinput.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/ckeditor/ckeditor.js',  'assets/js/bootbox/bootbox.js', "assets/js/modules/support.js");
            $data['style_to_load'] = array("assets/css/tags/bootstrap-tagsinput.css", 'assets/css/chosen/chosen.css');
            $data['method'] = 'get';
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->post()) {
                $data['method'] = 'post';
                $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
                $this->form_validation->set_rules('forum_type_title', 'Forum post title', 'required');
                $this->form_validation->set_rules('forum_type_text', 'Forum Post Description', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->template('/support/employee/editforumpost', $data);
                } else {
                    $post_data = $data = $this->input->post();
                    $insertdata = array(
                        'forum_article_title' => $post_data['forum_type_title'],
                        'forum_article_desc' => $post_data['forum_type_text'],
                        'forum_id' => $post_data['forum_post_id'],
                        'forum_category_id' => $post_data['category_id'],
                        'forum_article_comment_status' => $post_data['forum_post_locked'],
                        'forum_article_homepage_status' => $post_data['forum_post_pinned'],
                        'forum_article_highlight_status' => $post_data['forum_post_highlighted'],
                        'updated_by' => date("Y-m-d H:i:s")
                    );
                    $tag_names = "";
                    if ($post_data['forum_type_tags'] != "") {
                        $tag_names = explode(',', $post_data['forum_type_tags']);
                    }

                    $forum_article_id = $this->crm->rowUpdate('forum_article', $insertdata, $where);

                    if ($forum_article_id) {
                        $insert_tag_data = array();
                        $insert_attach_data = array();


                        $delete_where = array('forum_article_id' => $forum_post_id);
                        $delete_attach = $this->crm->rowsDelete('forum_article_attachment_rel', $delete_where);
                        if (!empty($post_data['attachment_id'])) {

                            foreach ($post_data['attachment_id'] as $value) {
                                $insert_attach_data['forum_article_id'] = $forum_post_id;
                                $insert_attach_data['attachment_id'] = $value;
                                if ($delete_attach) {
                                    $this->crm->rowInsert('forum_article_attachment_rel', $insert_attach_data);
                                }
                            }
                        }
                        $delete_tags = $this->crm->rowsDelete('forum_tags', $delete_where);
                        if ($tag_names != "") {
                            foreach ($tag_names as $value) {
                                $insert_tag_data['forum_article_id'] = $forum_post_id;
                                $insert_tag_data['tags_name'] = $value;
                                if ($delete_tags) {
                                    $forum_tag_id = $this->crm->rowInsert('forum_tags', $insert_tag_data);
                                }
                            }
                        }
                        $this->session->set_flashdata('support_forum_post_success', 'Forum Post Update Successfully');
                        redirect('support/postview/' . $forum_post_id, 'refresh');
                    }
                }
            } else {

                $this->load->template('/support/employee/editforumpost', $data);
            }
        }
    }

    public function editcustomersupportforumpost($forum_post_id) {

        $data['forum_detail'] = getForumDetailByPost($forum_post_id);
        $data['mainHeading'] = "Support Forum";
        $data['subHeading'] = "Forum Edit";
        $where = array('forum_article_id' => $forum_post_id);
        $data['forum_post_detail'] = $this->crm->getData('forum_article', '*', $where);
        $data['forum_post_attach'] = $this->crm->getData('forum_article_attachment_rel', '*', $where);
        $data['scripts_to_load'] = array('assets/js/tags/bootstrap-tagsinput.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/ckeditor/ckeditor.js', 'assets/js/bootbox/bootbox.js', "assets/js/modules/support.js");
        $data['style_to_load'] = array("assets/css/tags/bootstrap-tagsinput.css", 'assets/css/chosen/chosen.css');
        $data['method'] = 'get';
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $data['method'] = 'post';
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('forum_type_title', 'Forum post title', 'required');
            $this->form_validation->set_rules('forum_type_text', 'Forum Post Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/support/customer/editpostcustomer', $data);
            } else {
                $post_data = $data = $this->input->post();
                $insertdata = array(
                    'forum_article_title' => $post_data['forum_type_title'],
                    'forum_article_desc' => $post_data['forum_type_text'],
                    'updated_by' => date("Y-m-d H:i:s"),
                );

                $forum_article_id = $this->crm->rowUpdate('forum_article', $insertdata, $where);
                if ($forum_article_id != NULL) {
                    $insert_tag_data = array();
                    $insert_attach_data = array();
                    if (!empty($post_data['attachment_id'])) {
                        foreach ($post_data['attachment_id'] as $value) {
                            $insert_attach_data['forum_article_id'] = $forum_article_id;
                            $insert_attach_data['attachment_id'] = $value;

                            $forum_tag_id = $this->crm->rowInsert('forum_article_attachment_rel', $insert_attach_data);
                        }
                    }
                    $this->session->set_flashdata('support_success', 'forum post Created Successfully');
                    redirect('support', 'refresh');
                }
            }
        } else {
            $this->load->template('support/customer/editpostcustomer', $data);
        }
    }

    public function deleteforumpost($forum_post_id, $form_id = FALSE) {
        $where = array('forum_article_id' => $forum_post_id);
        $id = $this->crm->rowsDelete('forum_article', $where);
        $this->crm->rowsDelete('article_idea_status', $where);
        if ($id != NULL) {
            $article_comment_rel = array();
            $article_attachment_rel = array();
            $article_comment_rel = $this->crm->getData("article_comment_rel", "comment_id", $where);
            if (!empty($article_comment_rel)) {
                foreach ($article_comment_rel as $val) {
                    $comment_ids[] = $val["comment_id"];
                }
            }
            // getting comment attachment ids
            $attachment_ids = array();
            if (!empty($comment_ids)) {
                $article_comm_attachment_rel = $this->crm->getWhereInData("comment_attachment_rel", array("attachment_id"), $comment_ids, "comment_id");
                if (!empty($article_comm_attachment_rel)) {
                    foreach ($article_comm_attachment_rel as $val) {
                        $attachment_ids[] = $val["attachment_id"];
                    }
                }
            }
            // getting  attachment ids

            $article_attachment_rel = $this->crm->getData("forum_article_attachment_rel", array("attachment_id"), $where);

            if (!empty($article_attachment_rel)) {
                foreach ($article_attachment_rel as $val) {
                    $attachment_ids[] = $val["attachment_id"];
                }
            }
            if (!empty($attachment_ids)) {
                //Delete attachment file
                $attachment_path = $this->crm->getWhereInData("attachment", array("attachment_path"), $attachment_ids, "attachment_id");
                if (!empty($attachment_path)) {
                    foreach ($attachment_path as $val) {
                        image_delete("./" . $val['attachment_path']);
                    }
                }
            }
            if (!empty($attachment_ids)) {
                $this->crm->rowsDeleteWhereIn("attachment", $attachment_ids, "attachment_id");
            }
            if (!empty($forum_post_id)) {
                $this->crm->rowsDeleteWhereIn("article_comment_rel", $where, "forum_article_id");
                $this->crm->rowsDeleteWhereIn("forum_article_attachment_rel", $where, "forum_article_id");
            }
            if (!empty($comment_ids)) {
                $this->crm->rowsDeleteWhereIn("comment_attachment_rel", $comment_ids, "comment_id");
                $this->crm->rowsDeleteWhereIn("comment", $comment_ids, "comment_id");
            }

            $this->crm->rowsDelete('forum_article_like', array('article_id' => $forum_post_id));
            $this->crm->rowsDelete('forum_article_attachment_rel', $where);
            $this->crm->rowsDelete('forum_tags', $where);

            $this->crm->rowsDelete('article_idea_status', $where);
            $this->session->set_flashdata('support_forum_success', 'Support Forum Post Deleted Successfully');
            redirect("support/viewForum/$form_id", 'refresh');
        }
    }

    public function comment($forumpostid = FALSE) {


        $data['forumpostid'] = $forumpostid;
        $join[] = array(
            'table' => 'article_comment_rel',
            'on' => 'comment.comment_id=article_comment_rel.comment_id'
        );


        if ($forumpostid) {
            $where = array("article_comment_rel.forum_article_id" => $forumpostid);
        }
        $select = 'comment.comment_message,comment.comment_id,comment.comment_update,comment.comment_by_id,article_comment_rel.article_status';
        $comment_data = $this->crm->getData('comment', $select, $where, $join, 'comment.comment_update');
        $data['comment_data'] = $comment_data;
        $this->load->view('support/comment/comment_view', $data);
    }

    public function createComment() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
        $attachments = $this->input->post('attachment_id');
        $this->form_validation->set_rules('comments', 'Comment', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $error = $this->form_validation->error_array();
            $result['result'] = false;
            $result['error'] = $error;
            echo json_encode($result);
        } else {
            $comment_id = $this->crm->rowInsert('comment', array('comment_message' => $this->input->post('comments'), 'comment_by_id' => $this->input->post('comment_by'), 'comment_update' => date("Y-m-d H:i:s")));
        }


        if ($comment_id) {

            $post_comment_id = $this->crm->rowInsert('article_comment_rel', array('forum_article_id' => $this->input->post('forumpostid'), 'comment_id' => $comment_id));


            if ($post_comment_id) {
                if ($attachments) {
                    foreach ($attachments as $key => $val) {
                        $this->crm->rowInsert('comment_attachment_rel', array('comment_id' => $comment_id, 'attachment_id' => $val));
                    }
                }
                $result['result'] = true;
                echo json_encode($result);
                die;
            } else {
                $result['result'] = false;
                echo json_encode($result);
            }
        }
    }

    public function updateComment() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
        $this->form_validation->set_rules('comment_message', 'Comment', 'required');
//        echo $this->form_validation->run();die;
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $error = $this->form_validation->error_array();
            $result['result'] = false;
            $result['error'] = $error;
            echo json_encode($result);
            die;
        } else {
            $uptime = date("Y-m-d H:i:s");
            $comment_id = $this->input->post('comment_id');
            $where = array('comment_id' => $comment_id);
            $comm_id = $this->crm->rowUpdate('comment', array('comment_message' => $this->input->post('comment_message'), 'comment_update' => $uptime), $where);
       
        $result['result'] = true;
        $result['msg'] = $this->input->post('comment_message');
        $result['uptime'] = dateFormate($uptime);
        echo json_encode($result);
        die;
        }
    }

    public function deletecomment() {
        $comment_id = $this->input->post('comment_id');
        $where = array('comment_id' => $comment_id);
        $com_id = $this->crm->rowsDelete('comment', $where);
        if ($com_id) {
            $this->crm->rowsDelete('comment_attachment_rel', $where);
            $this->crm->rowsDelete('article_comment_rel', $where);

            $result['result'] = TRUE;
            echo json_encode($result);
        } else {
            $result['result'] = FALSE;
            echo json_encode($result);
        }
    }

    public function getCommentAttachRel($comment_id) {

        $join = array(
            array(
                'table' => 'attachment',
                'on' => 'comment_attachment_rel.attachment_id=attachment.attachment_id'),
        );
        $commenttAttachmentData = $this->crm->getData('comment_attachment_rel', 'attachment.attachment_id,attachment.attachment_name', array('comment_attachment_rel.comment_id' => $comment_id), $join);
        return $commenttAttachmentData;
    }

    public function likePost() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $insertdata = array(
                'article_id' => $data['post_id'],
                'user_id' => $data['user_id'],
                'created_at' => date("Y-m-d H:i:s"),
            );
            $insert_id = $this->crm->rowInsert('forum_article_like', $insertdata);
            if ($insert_id) {
                $count = countLike($data['post_id']);
                echo $count;
            }
        }
    }

    public function unlikePost() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $where = array(
                'article_id' => $data['post_id'],
                'user_id' => $data['user_id'],
            );
            $insert_id = $this->crm->rowsDelete('forum_article_like', $where);
            if ($insert_id) {
                $count = countLike($data['post_id']);
                echo $count;
            }
        }
    }

    public function recentpost() {
        $org_id = $this->input->post('organisation_id');
        $forum_id = $this->input->post('forum_id');
        $category_id = $this->input->post('category_id');
        if ($org_id != FALSE) {
            $join = array(
                array(
                    'table' => 'forum_article',
                    'on' => 'forum_article.forum_category_id=forum_category.forum_category_id'
                ),
                array(
                    'table' => 'forum',
                    'on' => 'forum.forum_id=forum_article.forum_id'
                )
            );
            $where = array('organisation_id' => $org_id);
            $data['article_data'] = $this->crm->getData('forum_category', 'forum.forum_id,forum.forum_title,forum.forum_type,forum_category.forum_category_id,forum_category.forum_category_name,forum_article.*', $where, $join, 'forum_article.forum_article_cretaed_at');
            echo $this->load->view('/support/employee/recentview', $data, true);
        }

        if ($category_id != FALSE) {
            $join = array(
                array(
                    'table' => 'forum',
                    'on' => 'forum_article.forum_id=forum.forum_id'
                ),
                array(
                    'table' => 'forum_category',
                    'on' => 'forum_category.forum_category_id=forum.category_id'
                )
            );
            $where = array('forum_article.forum_category_id' => $category_id);
            $data['article_data'] = $this->crm->getData('forum_article', 'forum.forum_id,forum.forum_title,forum.forum_type,forum_category.forum_category_id,forum_category.forum_category_name,forum_article.*', $where, $join, 'forum_article.forum_article_cretaed_at DESC', FALSE);
            echo $this->load->view('/support/employee/recentview', $data, true);
        }

        if ($forum_id != FALSE) {
            $join = array(
                array(
                    'table' => 'forum_article',
                    'on' => 'forum_article.forum_id=forum.forum_id'
                ),
                array(
                    'table' => 'forum_category',
                    'on' => 'forum_category.forum_category_id=forum_article.forum_category_id'
                )
            );
            $where = array('forum.forum_id' => $forum_id);
            $data['article_data'] = $this->crm->getData('forum', 'forum.forum_id,forum.forum_title,forum.forum_type,forum_category.forum_category_id,forum_category.forum_category_name,forum_article.*', $where, $join, 'forum_article.forum_article_cretaed_at DESC', FALSE);
            echo $this->load->view('/support/employee/recentview', $data, true);
        }
    }

    public function postAnswer() {

        if ($this->input->post()) {
            $data = $this->input->post();
            $where = array(
                'forum_article_id' => $data['article_id'],
                'comment_id' => $data['comment_id'],
            );
            if ($data['status'] == 0) {
                $update_data['article_status'] = NULL;
            } else {
                $update_data['article_status'] = 'Answer';
            }
            $res = $this->crm->rowUpdate('article_comment_rel', $update_data, $where);
            if ($res) {
                $count = $this->crm->getRowCount('article_comment_rel', '', array('forum_article_id' => $data['article_id'], 'article_status' => 'Answer'));
                $result = array(
                    'count' => $count,
                    'status' => $data['status'],
                );
                echo json_encode($result);
            }
        }
    }

    public function articleSetting() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $where = array(
                'forum_article_id' => $data['article_id']
            );
            $data['updated_by'] = date("Y-m-d H:i:s");
            unset($data['article_id']);
            $res = $this->crm->rowUpdate('forum_article', $data, $where);
            echo 1;
        }
    }

    public function categorypostview() {
        $category_id = $this->input->post('category_id');
        $data['category_id'] = $category_id;
        echo $this->load->view('/support/employee/categorypostview', $data, true);
    }

    public function forumpostajax() {
        $forum_id = $this->input->post('forum_id');
        $data['forum_id'] = $forum_id;
        $data['form_data'] = getSupportForumDetailId($forum_id);
        echo $this->load->view('/support/employee/forumpostajax', $data, true);
    }

    public function changeIdeaStatus() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $where = array(
                'forum_article_id' => $data['article_id']
            );
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['forum_article_id'] = $data['article_id'];
            unset($data['article_id']);
            $count = $this->crm->getRowCount('article_idea_status', '*', $where);
            if ($count > 0) {
                $this->crm->rowUpdate('article_idea_status', $data, $where);
            } else {
                $this->crm->rowInsert('article_idea_status', $data);
            }
            echo $data['article_idea_status'];
        }
    }

}

?>
