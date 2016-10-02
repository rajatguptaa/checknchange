<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ServiceController extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('crm_model', 'crm');
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tablename = "amc_service";
    }

    function index() {

        $pagedata['mainHeading'] = "AMC Service";
        // Loading CSS on view
        $pagedata["style_to_load"] = array(
            "assets/css/datatablenew/dataTables.responsive.css"
        );

        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/datatablenew/jquery.dataTables.js",
            "assets/js/datatablenew/dataTables.responsive.min.js",
            "assets/js/bootbox/bootbox.js"
        );
        $this->load->template('/service/index', $pagedata);
    }

    public function getTableData() {

        $col_sort = array("amc_service.id", "user.first_name", "user.addres2", "user.address1", "user.user_mobile", 'user.user_email', "amc_service.start_date", 'user.user_type');
        $select = array("amc_service.id as service_id", "user.first_name", "user.address1", "user.user_mobile", 'user.user_email', "amc_service.user_id", "amc_service.start_date", "amc_service.due_date", "amc_service.reference_by", "amc_service.amc_note", "user.last_name", 'user.user_mobile', 'user.dob', 'user.user_type');
//, "last_name", "user_mobile","user_phone",'user_profile','user_status'
//            'user_amc','address1','address2','user_city','user_country','user_postcode'
        $order_by = "amc_service.id";
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
        $where = array('user.user_access_level' => 4, 'user.user_status' => 1);
        $join = array(
            array('table' => 'user',
                'on' => 'user.user_id=amc_service.user_id'),
            array('table' => 'user as u',
                'on' => 'u.user_id=amc_service.reference_by'),
        );
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
        }

        $data = $this->crm->getData($this->tablename, $select, $where, $join, $order_by, $order, $lenght, $str_point, $search_array);
//	var_dump($this->crm->db->last_query());
        $rowCount = $this->crm->getRowCount($this->tablename, $select, $where, $join, $order_by, $order, $search_array);
//	var_dump($this->crm->db->last_query());

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $rowCount,
            "iTotalDisplayRecords" => $rowCount,
            "aaData" => []
        );

        $edit_acccess = access_check("service", "edit");
        $delete_acccess = access_check("service", "delete");

        foreach ($data as $val) {
//	     var_dump($val);
            $link = "";

            if ($edit_acccess) {
                $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('service/view/' . $val['service_id']) . '" title="Edit" data_id="' . $val['user_id'] . '" ><i class="fa fa-edit"></i> Complete</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['service_id'] . '"><i class="fa fa-trash-o"></i> View</a>';
            }
            $user_type = "<label class='btn btn-success'>" . $val['user_type'] . "</label>";
            $output['aaData'][] = array(
                "DT_RowId" => $val['serive_id'],
                $val['serive_id'],
                '<input type="checkbox" class="form-control" value="' . $val['serive_id'] . '">',
                '<img src="' . base_url() . getUsersImage($val['user_id']) . '" class="img-responsive" alt="Cinque Terre" style="max-width:100px"> ',
                $val['first_name'] . ' ' . $val['last_name'],
                $val['user_mobile'],
                dateFormate($val['dob']),
                $val['reffirst_name'] . ' ' . $val['reflast_name'],
                $user_type,
                $link
            );
        }

        echo json_encode($output);
        die;
    }

}
