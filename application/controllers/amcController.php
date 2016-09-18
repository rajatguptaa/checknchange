<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class AmcController extends BaseController {

    private $tabelename;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tabelename = "amc";
    }

    public function index() {
        $data['mainHeading'] = "AMC";

        // Loading CSS on view
//        $data["style_to_load"] = array(
//            "assets/css/datatablenew/dataTables.responsive.css"
//        );
//
//        // Loading JS on view
//        $data['scripts_to_load'] = array(
//            "assets/js/datatablenew/jquery.dataTables.js",
//            "assets/js/datatablenew/dataTables.responsive.min.js",
//            "assets/js/bootbox/bootbox.js",
//        );
        $pagedata['scripts_to_load'] = array('assets/js/modules/amc.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/pagination/simplePagination.js', "assets/js/bootbox/bootbox.js");
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/pagination/simplePagination.css');
        $this->load->template('/amc/index', $pagedata);
    }

    public function createAmc() {

        $data['mainHeading'] = "Amc";
        $data['subHeading'] = "Create";
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('amc_name', 'Name', 'required|is_unique[organisation.organisation_name]');
            $this->form_validation->set_rules('amc_code', 'Title', 'required');
            $this->form_validation->set_rules('amc_duration', 'Duration', 'required');
            $this->form_validation->set_rules('amc_visit', 'Phone', 'required');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('amc_criteria', 'Amc Criteria', 'required');
            $this->form_validation->set_rules('amc_description', 'Notes', 'trim');
            $this->form_validation->set_rules('amc_notes', 'Notes', 'trim');
//            $this->form_validation->set_rules('amc_status', 'Extra', 'trim');
//            $this->form_validation->set_rules('organisation_address2', 'Address2', 'trim');
//            $this->form_validation->set_rules('organisation_address1', 'Address1', 'trim|required');
//            $this->form_validation->set_rules('city', 'City', 'trim|required');
//            $this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
//            $this->form_validation->set_rules('country', 'Country', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/amc/create', $data);
//                var_dump(validation_errors());
                
            } else {
                $insertdata = $this->input->post();
                $filename = image_upload('image', 'package');
                if (is_array($filename)) {
                    $insertdata['package_logo'] = 'assets/img/package/' . $filename['file_name'];
                }
                
                $insertdata['package_update'] = date("Y-m-d H:i:s");
                $org_id = $this->crm->rowInsert($this->tabelename, $insertdata);
                if ($org_id != NULL) {
//                    $category_data = array(
//                        'forum_category_name' => 'None',
//                        'forum_category_description' => 'Default Category',
//                        'organisation_id' => $org_id,
//                        'forum_created_by' => getLoginUser(),
//                        'forum_created_at' => date("Y-m-d H:i:s")
//                    );
//                    $this->crm->rowInsert('forum_category', $category_data);
//                    $this->session->set_flashdata('organisation_success', 'Organisation Created Successfully');
                    redirect('amc', 'refresh');
                }
            }
        } else {
            $this->load->template('/amc/create', $data);
        }
    }

    public function editAmc($amc_id) {
        $form_data = $this->crm->getData($this->tabelename, "*", array("id" => $amc_id));


        if (empty($form_data) && is_array($form_data)) {
            $this->session->set_flashdata('organisation_danger', '<b>Amc</b> does not exist.');
            redirect('amc', 'refresh');
        }

        $form_data[0]['pacakge_old_logo'] = $form_data[0]['package_logo'];
        $data['form_data'] = $form_data[0];
        $data['method'] = "get";
        $data['mainHeading'] = "Amc";
        $data['subHeading'] = "Edit";
        $data['method'] = "get";

        $this->load->helper(array('form', 'url'));

        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" id="parsley-id-10"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('amc_name', 'Name', 'required|is_unique[organisation.organisation_name]');
            $this->form_validation->set_rules('amc_code', 'Title', 'required');
            $this->form_validation->set_rules('amc_duration', 'Duration', 'required');
            $this->form_validation->set_rules('amc_visit', 'Phone', 'required');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('amc_criteria', 'Amc Criteria', 'required');
            $this->form_validation->set_rules('amc_description', 'Notes', 'trim');
            $this->form_validation->set_rules('amc_notes', 'Notes', 'trim');
            $data['method'] = "post";
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/amc/edit', $data);
            } else {
                $data['method'] = "post";
                $updatedata = $this->input->post();


                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    image_delete("./" . $updatedata['package_old_logo']);
                    $filename = image_upload('image', 'organisation');
                    $updatedata['package_logo'] = 'assets/img/package/' . $filename['file_name'];
                } else {
                    $updatedata['package_logo'] = $updatedata['package_old_logo'];
                }
                $updatedata['package_update'] = date("Y-m-d H:i:s");
                unset($updatedata['package_old_logo']);

                $org_id = $this->crm->rowUpdate($this->tabelename, $updatedata, array("id" => $amc_id));

                if ($org_id != NULL) {
                    $this->session->set_flashdata('organisation_success', 'Amc Updated Successfully');
                    redirect('amc', 'refresh');
                }
            }
        } else {
            $this->load->template('/amc/edit', $data);
        }
    }

    public function showOrganisation() {
        
    }

    public function deleteAmc($id) {

        $this->load->model("employee_model", "emp");
    
        $this->crm->rowsDelete($this->tabelename,array('id'=>$id));

        $this->session->set_flashdata('organisation_success', 'Amc Deleted Successfully');
        redirect('amc', 'refresh');
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
    
    
     public function filter() {
//        $org_id = $this->input->post('input');
        $limit = 9;
        $offset = 0;
//        $join = array(
//            array('table' => 'access_level',
//                'on' => 'user.user_access_level=access_level.access_level_id'),
//            array('table' => 'user_organisation_rel',
//                'on' => 'user_organisation_rel.user_id=user.user_id'),
//        );
//        $where['user_access_level'] = 3;
//        if ($org_id != '') {
//            $where['user_organisation_rel.organisation_id'] = $org_id;
//        }
        $pagedata['count'] = $this->crm->getRowCount('amc', '', FALSE, FALSE, 'amc.id', 'DESC');
        $pagedata['user_detail'] = $this->crm->getData('amc', '', FALSE, FALSE, 'amc.id', 'DESC', $limit, $offset);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/amc/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }
        echo $html;
    }
    
      public function search() {
        $word = $this->input->post('input');
//        $org_id = $this->input->post('org_id');
        $offset = $this->input->post('offset');
        $limit = 9;

        $search_array = array(
            'amc_name' => $word,
            'amc_description' => $word,
            'amc_code' => $word
        );
        $join = array();
//        $join[] = array(
//            'table' => 'access_level',
//            'on' => 'user.user_access_level=access_level.access_level_id'
//        );
//        if ($org_id != '') {
//            $join[] = array('table' => 'user_organisation_rel',
//                'on' => 'user_organisation_rel.user_id=user.user_id');
//        $join[] = array('table' => 'organisation',
//            'on' => 'organisation.organisation_id=user_organisation_rel.organisation_id');
//        }

//        $where['user_access_level'] = 3;
        if ($org_id != '') {
//            $where['user_organisation_rel.organisation_id'] = $org_id;
        }

        $pagedata['user_detail'] = $this->crm->getData('amc', '', FALSE, FALSE, 'amc.id', 'desc', $limit, ($limit * ($offset - 1)), $search_array);

        $pagedata['count'] = $this->crm->getRowCount('amc', '', FALSE, FALSE, 'amc.id', 'desc', $search_array);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/amc/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }

        echo $html;
    }
    
      public function showAmc($amc_id) {
        $pagedata['mainHeading'] = 'Amc Detail';
        $pagedata['subHeading'] = 'show';
        $pagedata['scripts_to_load'] = array('assets/js/moris/raphael-min.js', 'assets/js/moris/morris.js');

        $amc_detail = $this->crm->getData('amc','*',array('id'=>$amc_id));
        $pagedata['amc_detail'] = $amc_detail[0];
        $this->load->template('/amc/view', $pagedata);
    }
}

?>
