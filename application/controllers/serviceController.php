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
//	$this->index();
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

        $col_sort = array("amc_service`.`id","amc`.`amc_name","user`.`user_name","user`.`address2","user`.`address1","user`.`user_mobile","user`.`user_email","amc_service`.`start_date","user`.`user_type");
        $select = array("amc_service.id as service_id","amc.amc_name" ,"user.user_name", "user.first_name", "user.address1", "user.user_mobile", 'user.user_email', "amc_service.user_id", "amc_service.start_date", "amc_service.due_date", "amc_service.reference_by", "amc_service.amc_note", "user.last_name", 'user.user_mobile', 'user.dob', 'user.user_type');

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
        $where = array('amc_service.start_date >='=>date('Y-m-d'));
        $where1 = array('amc_service.due_date <='=>date('Y-m-d'));
        $join = array(
            array('table' => 'user',
                'on' => 'user.user_id=amc_service.user_id'),
            array('table' => 'user as u',
                'on' => 'u.user_id=amc_service.reference_by'),
            array('table' => 'amc',
                'on' => 'amc.id=amc_service.amc_id')
        );
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
        }
	if (isset($_GET['sSearch_3']) && $_GET['sSearch_3'] != "") {

            $words = $_GET['sSearch_3'];
            $where['amc.id'] = $words;
            $where1['amc.id'] = $words;
        }
	if (isset($_GET['sSearch_4']) && $_GET['sSearch_4'] != "") {

            $words = $_GET['sSearch_4'];
            $where['user.user_id'] = $words;
            $where1['user.user_id'] = $words;
        }
	if (isset($_GET['sSearch_7']) && $_GET['sSearch_7'] != "") {

            $words = $_GET['sSearch_7'];
            $where['user.user_id'] = $words;
            $where1['user.user_id'] = $words;
        }
	if (isset($_GET['sSearch_8']) && $_GET['sSearch_8'] != "") {

            $words = $_GET['sSearch_8'];
            $where['amc_service.due_date'] = $words;
            $where1['amc_service.due_date'] = $words;
        }
	if (isset($_GET['sSearch_9']) && $_GET['sSearch_9'] != "") {

            $words = $_GET['sSearch_9'];
            $where['user.user_type'] = $words;
            $where1['user.user_type'] = $words;
        }
        $data = $this->crm->getData($this->tablename, $select, $where, $join, $order_by, $order, $lenght, $str_point, $search_array);
        $data1 = $this->crm->getData($this->tablename, $select, $where1, $join, $order_by, $order, $lenght, $str_point, $search_array);
//	var_dump($this->db->last_query());
        $rowCount = $this->crm->getRowCount($this->tablename, $select, $where, $join, $order_by, $order, $search_array);
        $rowCount1 = $this->crm->getRowCount($this->tablename, $select, $where1, $join, $order_by, $order, $search_array);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $rowCount+$rowCount1,
            "iTotalDisplayRecords" => $rowCount+$rowCount1,
            "aaData" => []
        );

        $edit_acccess = access_check("service", "edit");
        $delete_acccess = access_check("service", "delete");

        foreach ($data1 as $val) {
            $link = "";
            if ($edit_acccess) {
                $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('service/view/' . $val['service_id']) . '" title="Edit" data_id="' . $val['user_id'] . '" ><i class="fa fa-edit"></i> Complete</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['service_id'] . '"><i class="fa fa-trash-o"></i> View</a>';
            }
            $user_type = "<label class='btn btn-success'>" . strtoupper($val['user_type']) . "</label>";
            $output['aaData'][] = array(
                "DT_RowId" => $val['service_id'],
                '<input type="checkbox" class="form-control due_date_color" value="' . $val['service_id'] . '">',
                $val['service_id'],
                $val['amc_name'],
                $val['user_name'] ,
                $val['address1'] ,
                $val['user_mobile'],
                $val['user_email'],
                dateFormateOnly($val['due_date']),
                $user_type,
                $link
            );
        }
	
	  foreach ($data as $val) {
            $link = "";
            if ($edit_acccess) {
                $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('service/view/' . $val['service_id']) . '" title="Edit" data_id="' . $val['user_id'] . '" ><i class="fa fa-edit"></i> Complete</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['service_id'] . '"><i class="fa fa-trash-o"></i> View</a>';
            }
            $user_type = "<label class='btn btn-success'>" . strtoupper($val['user_type']) . "</label>";
            $output['aaData'][] = array(
                "DT_RowId" => $val['service_id'],
                '<input type="checkbox" class="form-control " value="' . $val['service_id'] . '">',
                $val['service_id'],
                $val['amc_name'],
                $val['user_name'] ,
                $val['address1'] ,
                $val['user_mobile'],
                $val['user_email'],
                dateFormateOnly($val['due_date']),
                $user_type,
                $link
            );
        }
	

        echo json_encode($output);
        die;
    }

}
