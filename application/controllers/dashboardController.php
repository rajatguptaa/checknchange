<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class DashboardController extends BaseController {

    public function index() {
        
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        } else {

            
              $data["style_to_load"] = array(
	      "assets/css/datatablenew/dataTables.responsive.css"
	  );

	  // Loading JS on view
	  $data['scripts_to_load'] = array(
	      
//	      "assets/js/modules/dashboard.js",
	      "assets/js/datatablenew/jquery.dataTables.js",
	      "assets/js/datatablenew/dataTables.responsive.min.js",
	      "assets/js/bootbox/bootbox.js"
	  );
            $this->load->template('/dashboard/index', $data);
        }
    }
    
    
      function getAmcService() {

	  $col_sort = array("amc_service`.`due_date", "amc_service`.`id", "amc`.`amc_name", "user`.`user_name", "user`.`address2", "user`.`address1", "user`.`user_mobile", "user`.`user_email", "amc_service`.`start_date", "user`.`user_type");
	  $select = array("amc_service.id as service_id", "amc.id as amc_id","amc_rel", "amc.amc_name", "user.user_name", "user.first_name", "user.address1", "user.user_mobile", 'user.user_email', "amc_service.user_id", "amc_service.start_date", "amc_service.due_date", "amc_service.reference_by", "amc_service.amc_note", "user.last_name", 'user.user_mobile', 'user.dob', 'amc_note', 'user.user_type');

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

	  if (isset($_GET['sSearch_2']) && $_GET['sSearch_2'] != "") {


	       $words = $_GET['sSearch_2'];
	       $where .=" and ( amc.id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_3']) && $_GET['sSearch_3'] != "") {

	       $words = $_GET['sSearch_3'];
	       $where .=" and ( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_6']) && $_GET['sSearch_6'] != "") {

	       $words = $_GET['sSearch_6'];
	       $where .=" and ( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_7']) && $_GET['sSearch_7'] != "") {

	       $words = $_GET['sSearch_7'];
	       $where .=" and ( amc_service.due_date REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_8']) && $_GET['sSearch_8'] != "") {

	       $words = $_GET['sSearch_8'];
	       $where .=" and ( user.user_type REGEXP '$words'
                         ) ";
	  }
	  $group_by = 'amc_service.id';
	  $data = $this->crm->getData('amc_service', $select, $where, $join, $order_by, $order, 5, $str_point, $search_array);
//	  echo $this->db->last_query();
	  $rowCount = $this->crm->getRowCount('amc_service', $select, $where, $join, $order_by, $order);


	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => 5,
	      "iTotalDisplayRecords" => 5,
	      "aaData" => []
	  );

	  $edit_acccess = access_check("service", "edit");
	  $delete_acccess = access_check("service", "delete");

	  foreach ($data as $val) {
	       $link = "";
	       $due = '';
	       $date = new DateTime($val['due_date']);
	       $now = new DateTime();
//	       echo $now.'==='.$val['due_date'];
	       $diff = date_diff($date,$now);
//	       echo $diff->format("%a");
	       if ($diff->format("%a")>=3) {
		    $due = 'due-cls';
	       }
	       if ($edit_acccess) {

//		    $link .= '<a data-toggle="modal" data-target="#completeModel" id="completeCheck" class="btn btn-success btn-xs completeCheck ' . $due . '"  title="Complete" data_id="' . $val['user_id'] . '" data_name="' . $val['amc_name'] . '" data_due="' . dateFormateOnly($val['due_date']) . '"  referenceby= "' . $val['reference_by'] . '"  userid="' . $val['user_id'] . '" amc_id="' . $val['amc_id'] . '" start_date="' . $val['start_date'] . '" notes="' . $val['amc_note'] . '" amc_sevice_id="' . $val['service_id'] . '" amc_rel_id="' . $val['amc_rel'] . '" ><i class="fa fa-list-alt"></i>Complete</a>&nbsp;&nbsp;';
	       }

	       if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs ticket" title="Ticket" data-id="' . $val['service_id'] . '" href="'.base_url().'request/employee/add/'.$val['service_id'].'"><i class="fa fa-bug"></i> Ticket</a>';
	       }
	       $output['aaData'][] = array(
		   "DT_RowId" => $val['service_id'],
		   $val['amc_name'],
		   $val['user_name'],
		   $val['user_mobile'],
		   dateFormateOnly($val['due_date']),
		   $link
	       );
	  }


	  echo json_encode($output);
	  die;
     }
     function history_amc(){
	  
	  
	    $col_sort = array("amc_service_history`.`due_date", "amc_service_history`.`id", "amc`.`amc_name", "user`.`user_name", "user`.`address2", "user`.`address1", "user`.`user_mobile", "user`.`user_email", "amc_service_history`.`start_date", "user`.`user_type");
	  $select = array("amc_service_history.id as service_id", "amc.id as amc_id", "amc.amc_name", "user.user_name", "user.first_name", "user.address1", "user.user_mobile", 'user.user_email', "amc_service_history.user_id", "amc_service_history.start_date", "amc_service_history.due_date", "amc_service_history.reference_by", "amc_service_history.notes", "user.last_name", 'user.user_mobile', 'user.dob','complete_notes', 'notes', 'user.user_type');

	  $order_by = "amc_service_history.due_date";
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

	  $where .= "";
	  $join = array(
	      array('table' => 'user',
		  'on' => 'user.user_id=amc_service_history.user_id'),
	      array('table' => 'user as u',
		  'on' => 'u.user_id=amc_service_history.reference_by'),
	      array('table' => 'amc',
		  'on' => 'amc.id=amc_service_history.amc_id')
	  );
	  if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	       $str_point = intval($_GET['iDisplayStart']);
	       $lenght = intval($_GET['iDisplayLength']);
	  }

	  if (isset($_GET['sSearch_2']) && $_GET['sSearch_2'] != "") {

	       if($where!=""){
		    $where .= ' and ';
	       }
	       $words = $_GET['sSearch_2'];
	       $where .="( amc.id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_3']) && $_GET['sSearch_3'] != "") {
	       if($where!=""){
		    $where .= ' and ';
	       }
	       $words = $_GET['sSearch_3'];
	       $where .="( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_6']) && $_GET['sSearch_6'] != "") {
	       if($where!=""){
		    $where .= ' and ';
	       }
	       $words = $_GET['sSearch_6'];
	       $where .="( user.user_id REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_7']) && $_GET['sSearch_7'] != "") {
	       if($where!=""){
		    $where .= ' and ';
	       }
	       $words = $_GET['sSearch_7'];
	       $where .="( amc_service_history.due_date REGEXP '$words'
                         ) ";
	  }
	  if (isset($_GET['sSearch_8']) && $_GET['sSearch_8'] != "") {
	       if($where!=""){
		    $where .= ' and ';
	       }
	       
	       $words = $_GET['sSearch_8'];
	       $where .="( user.user_type REGEXP '$words'
                         ) ";
	  }
	  $group_by = 'amc_service_history.id';
	  $data = $this->crm->getData('amc_service_history', $select, $where, $join, $order_by, $order, 5, $str_point, $search_array);
//	  echo $this->db->last_query();
	  $rowCount = $this->crm->getRowCount('amc_service_history', $select, $where, $join, $order_by, $order);


	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => 5,
	      "iTotalDisplayRecords" => 5,
	      "aaData" => []
	  );

	  $edit_acccess = access_check("service", "edit");
	  $delete_acccess = access_check("service", "delete");

	  foreach ($data as $val) {
	       $link = "";
	       $due = '';
	      
	       if ($edit_acccess) {

		    $link .= '<a data-toggle="modal" data-target="#viewModel" id="viewCheck" class="btn btn-success btn-xs viewCheck ' . $due . '"  title="View" data_id="' . $val['user_id'] . '" data_name="' . $val['amc_name'] . '" data_due="' . dateFormateOnly($val['due_date']) . '"  referenceby= "' . $val['reference_by'] . '"  userid="' . $val['user_id'] . '" amc_id="' . $val['amc_id'] . '" start_date="' . $val['start_date'] . '" notes="' . $val['notes'] . '" amc_sevice_id="' . $val['service_id'] . '" complete_note="' . $val['complete_notes'] . '"><i class="fa fa-list-alt"></i>View</a>&nbsp;&nbsp;';
	       }

	     
	       $output['aaData'][] = array(
		   "DT_RowId" => $val['service_id'],
		   $val['amc_name'],
		   $val['user_name'],
		   $val['user_mobile'],
		   dateFormateOnly($val['due_date']),
		   $link
	       );
	  }


	  echo json_encode($output);
	  die;
	  
     }
}

?>
