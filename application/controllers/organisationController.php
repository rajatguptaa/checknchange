<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class OrganisationController extends BaseController {

    private $tabelename;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tabelename = "organisation";
    }

    public function index() {
        $data['mainHeading'] = "Organisation";

        // Loading CSS on view
        $data["style_to_load"] = array(
            "assets/css/datatablenew/dataTables.responsive.css"
        );

        // Loading JS on view
        $data['scripts_to_load'] = array(
            "assets/js/datatablenew/jquery.dataTables.js",
            "assets/js/datatablenew/dataTables.responsive.min.js",
            "assets/js/bootbox/bootbox.js"
        );
        $this->load->template('/organisation/index', $data);
    }

    public function createOrganisation() {

        $data['mainHeading'] = "Organisation";
        $data['subHeading'] = "Create";
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('organisation_name', 'Name', 'required|is_unique[organisation.organisation_name]');
            $this->form_validation->set_rules('organisation_title', 'Title', 'required');
            $this->form_validation->set_rules('organisation_address', 'Address', 'required');
            $this->form_validation->set_rules('organisation_phone', 'Phone', 'required|numeric|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('organisation_customer_type', 'Customer Type', 'required');
            $this->form_validation->set_rules('organisation_notes', 'Notes', 'trim');
            $this->form_validation->set_rules('organisation_extra', 'Extra', 'trim');
            $this->form_validation->set_rules('organisation_address2', 'Address2', 'trim');
//            $this->form_validation->set_rules('organisation_address1', 'Address1', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/organisation/create', $data);
            } else {
                $insertdata = $this->input->post();
                $filename = image_upload('image', 'organisation');
                if (is_array($filename)) {
                    $insertdata['organisation_logo'] = 'assets/img/organisation/' . $filename['file_name'];
                }
                $insertdata['organisation_update'] = date("Y-m-d H:i:s");
                $org_id = $this->crm->rowInsert($this->tabelename, $insertdata);
                if ($org_id != NULL) {
                    $category_data = array(
                        'forum_category_name' => 'None',
                        'forum_category_description' => 'Default Category',
                        'organisation_id' => $org_id,
                        'forum_created_by' => getLoginUser(),
                        'forum_created_at' => date("Y-m-d H:i:s")
                    );
                    $this->crm->rowInsert('forum_category', $category_data);
                    $this->session->set_flashdata('organisation_success', 'Organisation Created Successfully');
                    redirect('organisation', 'refresh');
                }
            }
        } else {
            $this->load->template('/organisation/create', $data);
        }
    }

    public function editOrganisation($organisation_id) {
        $form_data = $this->crm->getData($this->tabelename, "*", array("organisation_id" => $organisation_id));


        if (empty($form_data) && is_array($form_data)) {
            $this->session->set_flashdata('organisation_danger', '<b>Organisation</b> does not exist.');
            redirect('organisation', 'refresh');
        }

        $form_data[0]['organisation_old_logo'] = $form_data[0]['organisation_logo'];
        $data['form_data'] = $form_data[0];
        $data['method'] = "get";
        $data['mainHeading'] = "Organisation";
        $data['subHeading'] = "Edit";
        $data['method'] = "get";

        $this->load->helper(array('form', 'url'));

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('organisation_name', 'Name', 'required|callback_organisationuniqe_validation');
            $this->form_validation->set_rules('organisation_address', 'Address', 'required');
            $this->form_validation->set_rules('organisation_phone', 'Phone', 'required');
            $this->form_validation->set_rules('image', 'Image', 'callback_updateimage_validate');
            $this->form_validation->set_rules('organisation_customer_type', 'Customer Type', 'required');
            $this->form_validation->set_rules('organisation_notes', 'Notes', 'trim');
            $this->form_validation->set_rules('organisation_extra', 'Extra', 'trim');
            $data['method'] = "post";
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/organisation/edit', $data);
            } else {
                $data['method'] = "post";
                $updatedata = $this->input->post();


                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    image_delete("./" . $updatedata['organisation_old_logo']);
                    $filename = image_upload('image', 'organisation');
                    $updatedata['organisation_logo'] = 'assets/img/organisation/' . $filename['file_name'];
                } else {
                    $updatedata['organisation_logo'] = $updatedata['organisation_old_logo'];
                }
                $updatedata['organisation_update'] = date("Y-m-d H:i:s");
                unset($updatedata['organisation_old_logo']);

                $org_id = $this->crm->rowUpdate($this->tabelename, $updatedata, array("organisation_id" => $organisation_id));

                if ($org_id != NULL) {
                    $this->session->set_flashdata('organisation_success', 'Organisation Updated Successfully');
                    redirect('organisation', 'refresh');
                }
            }
        } else {
            $this->load->template('/organisation/edit', $data);
        }
    }

    public function showOrganisation() {
        
    }

    public function deleteOrganisation($organisation_id) {

        $this->load->model("employee_model", "emp");

        $this->db->trans_begin();

        // Delete Organisation Details
        $organisation_data = $this->crm->getData($this->tabelename, array("organisation_logo"), array("organisation_id" => $organisation_id));
        if (!empty($organisation_data)) {
            image_delete("./" . $organisation_data[0]['organisation_logo']);
            $org_id = $this->crm->rowsDelete($this->tabelename, array("organisation_id" => $organisation_id));
//            $this->crm->rowsDelete("group", array("organisation_id" => $organisation_id));
        }
        if ($org_id) {

            $category_data = $this->crm->getData('forum_category', 'forum_category_id', array("organisation_id" => $organisation_id));
            $this->crm->rowsDelete('forum_category', array("organisation_id" => $organisation_id));

            if (!empty($category_data)) {
                $this->crm->rowsDelete('forum', array("category_id" => $category_data[0]['forum_category_id']));
                $article_data = array();
                $article_data = $this->crm->getData('forum_article', 'forum_article_id', array("forum_category_id" => $category_data[0]['forum_category_id']));

                if (!empty($article_data)) {
                    $forumarticleids = array();
                    foreach ($article_data as $value) {
                        $forumarticleids[] = $value['forum_article_id'];
                    }
                    if (!empty($forumarticleids)) {

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
                        }
                        if (!empty($comment_ids)) {
                            $this->crm->rowsDeleteWhereIn("comment_attachment_rel", $comment_ids, "comment_id");
                            $this->crm->rowsDeleteWhereIn("comment", $comment_ids, "comment_id");
                        }
                    }
                }
            }
        }
        //Organisation User and employe delete
        $organisation_user_ids = $this->crm->getData("user", array("user.user_id"), array("organisation_id" => $organisation_id), array(array("table" => "user_organisation_rel", "on" => "user_organisation_rel.user_id = user.user_id")));

        $this->db->trans_complete();

        if (!empty($organisation_user_ids)) {
            $user_ids = array();
            foreach ($organisation_user_ids as $val) {
                $user_ids[] = $val["user_id"];
            }
            $this->emp->delete_user($user_ids);
        }

        $this->session->set_flashdata('organisation_success', 'Organisation Deleted Successfully');
        redirect('organisation', 'refresh');
    }

    public function getTableData() {

        $col_sort = array("organisation_id", "organisation_logo", "organisation_name", "organisation_phone", "organisation_customer_type", "organisation_update","postcode");
        $select = array("organisation_id", "organisation_logo", "organisation_name", "organisation_phone", "organisation_customer_type", "organisation_update");

        $order_by = "organisation_id";
        $order = 'DESC';

        $str_point = FALSE;
        $lenght = 10;

        $search_array = FALSE;

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            $search_array = array();
            for ($i = 0; $i < count($col_sort); $i++) {
                $search_array[$col_sort[$i]] = $words;
            }
        }

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
        }

        $data = $this->crm->getData($this->tabelename, $select, FALSE, FALSE, $order_by, $order, $lenght, $str_point, $search_array);
        $rowCount = $this->crm->getRowCount($this->tabelename, $select, FALSE, FALSE, $order_by, $order, $search_array);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $rowCount,
            "iTotalDisplayRecords" => $rowCount,
            "aaData" => []
        );

        $edit_acccess = access_check("organisation", "edit");
        $delete_acccess = access_check("organisation", "delete");

        foreach ($data as $val) {

            $link = "";

            if ($edit_acccess) {
                $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('organisation/edit/' . $val['organisation_id']) . '" title="Edit" data_id="' . $val['organisation_id'] . '" ><i class="fa fa-edit"></i> Edit</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['organisation_id'] . '"><i class="fa fa-trash-o"></i> Delete</a>';
            }

            $output['aaData'][] = array(
                "DT_RowId" => $val['organisation_id'],
                $val['organisation_id'],
                '<img src="' . base_url() . getOrganiasationImage($val['organisation_id']) . '" class="img-responsive" alt="Cinque Terre" style="max-width:100px"> ',
                $val['organisation_name'],
                $val['organisation_phone'],
                $val['organisation_customer_type'],
                dateFormate($val['organisation_update']),
                $link
            );
        }

        echo json_encode($output);
        die;
    }

    // Callback validation functions

    public function image_validate() {
        if (($_FILES['image']['size'] > 0)) {

            if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpg') {
                return true;
            } else {
                $this->form_validation->set_message('image_validate', 'Organisation logo type must be jpeg,png or jpg ');
                return false;
            }
        } else {
            return TRUE;
        }
    }

    public function updateimage_validate() {
        if ($_FILES['image']['size'] > 0) {

            if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpg') {
                return true;
            } else {
                $this->form_validation->set_message('updateimage_validate', 'Image type must me jpeg,png or jpg ');
                return false;
            }
        } else {
            return TRUE;
        }
    }

    public function organisationuniqe_validation($organisation_name) {

        $organisation_id = $this->input->post("organisation_id");

        $data = $this->crm->getRowCount($this->tabelename, "*", array("organisation_id !=" => $organisation_id, "organisation_name" => $organisation_name));

        if ($data > 0) {
            $this->form_validation->set_message('organisationuniqe_validation', 'The Name field must contain a unique value.');
            return false;
        } else {
            return true;
        }
    }

}

?>
