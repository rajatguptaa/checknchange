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

	  $col_sort = array("amc_service`.`due_date", "amc_service`.`id", "amc`.`amc_name", "user`.`user_name", "user`.`address2", "user`.`address1", "user`.`user_mobile", "user`.`user_email", "amc_service`.`start_date", "user`.`user_type");
	  $select = array("amc_service.id as service_id", "amc.id as amc_id", "amc.amc_name", "user.user_name", "user.first_name", "user.address1", "user.user_mobile", 'user.user_email', "amc_service.user_id", "amc_service.start_date", "amc_service.due_date", "amc_service.reference_by", "amc_service.amc_note", "user.last_name", 'user.user_mobile', 'user.dob', 'amc_note', 'user.user_type');

	  $order_by = "amc_service.due_date";
	  $order = 'ASC';

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
	  $where = '';

	  $where .= "amc_service.start_date <= '" . date('Y-m-d H:i:s') . "' ";
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
	       $where .=" and ( amc.id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_4']) && $_GET['sSearch_4'] != "") {

	       $words = $_GET['sSearch_4'];
	       $where .=" and ( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_7']) && $_GET['sSearch_7'] != "") {

	       $words = $_GET['sSearch_7'];
	       $where .=" and ( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_8']) && $_GET['sSearch_8'] != "") {

	       $words = $_GET['sSearch_8'];
	       $where .=" and ( amc_service.due_date REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_9']) && $_GET['sSearch_9'] != "") {

	       $words = $_GET['sSearch_9'];
	       $where .=" and ( user.user_type REGEXP '$words'
                         ) ";
	  }
	  $group_by = 'amc_service.id';
	  $data = $this->crm->getData($this->tablename, $select, $where, $join, $order_by, $order, $lenght, $str_point, $search_array);
//	  echo $this->db->last_query();
	  $rowCount = $this->crm->getRowCount($this->tablename, $select, $where, $join, $order_by, $order);


	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => $rowCount,
	      "iTotalDisplayRecords" => $rowCount,
	      "aaData" => []
	  );

	  $edit_acccess = access_check("service", "edit");
	  $delete_acccess = access_check("service", "delete");

	  foreach ($data as $val) {
	       $link = "";
	       $due = '';
	       if ($val['due_date'] < date('Y-m-d H:i:s')) {
		    $due = 'due-cls';
	       }
	       if ($edit_acccess) {

		    $link .= '<a data-toggle="modal" data-target="#completeModel" id="completeCheck" class="btn btn-success btn-xs completeCheck ' . $due . '"  title="Complete" data_id="' . $val['user_id'] . '" data_name="' . $val['amc_name'] . '" data_due="' . dateFormateOnly($val['due_date']) . '"  referenceby= "' . $val['reference_by'] . '"  userid="' . $val['user_id'] . '" amc_id="' . $val['amc_id'] . '" start_date="' . $val['start_date'] . '" notes="' . $val['amc_note'] . '" amc_sevice_id="' . $val['service_id'] . '"><i class="fa fa-list-alt"></i>Complete</a>&nbsp;&nbsp;';
	       }

	       if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs ticket" title="Ticket" data-id="' . $val['service_id'] . '" href="'.  base_url().'request/'.$val['service_id'].'"><i class="fa fa-bug"></i> Ticket</a>';
	       }
	       $output['aaData'][] = array(
		   "DT_RowId" => $val['service_id'],
		   $val['service_id'],
		   $val['amc_name'],
		   $val['user_name'],
		   $val['address1'],
		   $val['user_mobile'],
		   $val['user_email'],
		   dateFormateOnly($val['due_date']),
		   strtoupper($val['user_type']),
		   $link
	       );
	  }


	  echo json_encode($output);
	  die;
     }

     function completeService() {

	  $post = $this->input->post();
	  $data = array(
	      'amc_id' => $post['amc_id'],
	      'amc_service_id' => $post['amc_sevice_id'],
	      'user_id' => $post['user_id'],
	      'start_date' => $post['start_date'],
	      'due_date' => $post['due_date'],
	      'reference_by' => $post['referenceby'],
	      'notes' => $post['notes'],
	      'complete_notes' => $post['user_note'],
	  );
	  $where = array('amc_service.id' => $post['amc_sevice_id'], 'user_id' => $post['user_id']);
	  $arr_data = $this->crm->getData($this->tablename, '*', $where);
//	  var_dump($arr_data);
	  $arr_data[0]['complete_notes'] = $post['user_note'];
	  $arr_data[0]['notes'] = $arr_data[0]['amc_note'];
	  $arr_data[0]['amc_service_id'] = $arr_data[0]['id'];
	  unset($arr_data[0]['create_date']);
	  unset($arr_data[0]['amc_note']);
	  unset($arr_data[0]['edited_at']);
	  unset($arr_data[0]['id']);
	  
	  $this->crm->rowInsert('amc_service_history', $arr_data[0]);
	  $date = amc_service_create($post['due_date'], $post['amc_id']);
	  $date_logic = array('start_date' => $date['start_date'], 'due_date' => $date['end_date']);
	  $res = $this->crm->rowUpdate('amc_service', $date_logic, array('amc_service.id' => $post['amc_sevice_id'], 'user_id' => $post['user_id']));
	  $data['result'] = $res;
	  echo json_encode($data);
     }

}
