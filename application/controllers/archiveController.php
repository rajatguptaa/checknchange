<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class archiveController extends BaseController {

     private $tabelename;

     public function __construct() {
	  parent::__construct();
	  if ($this->session->userdata('logged_in') == FALSE) {
	       redirect('login');
	  }

//        $this->tabelename = "amc";
     }

     public function index() {
	  $pagedata['mainHeading'] = "Archive";
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
	  $this->load->template('/archive/index', $pagedata);
     }

     function getArchiveamc() {       

	  $col_sort = array("amc`.`id", "amc`.`amc_name", "amc`.`amc_type");
	  $select = array("*");
	  $order_by = "id";
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
	  $where = array('amc.amc_status' => 0);

	  if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	       $str_point = intval($_GET['iDisplayStart']);
	       $lenght = intval($_GET['iDisplayLength']);
	  }

	  $data = $this->crm->getData('amc', $select, $where, FALSE, $order_by, $order, $lenght, $str_point, $search_array);
	  $rowCount = $this->crm->getRowCount('amc', $select, $where, FALSE, $order_by, $order, $search_array);
	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => $rowCount,
	      "iTotalDisplayRecords" => $rowCount,
	      "aaData" => []
	  );

	  
	  $count = 1;
	  
	  foreach ($data as $val) {
	       
	       $link = "";
	       $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" table-id="amc" data-id="' . $val['id'] . '"><i class="fa fa-archive" aria-hidden="true"></i>Restore</a>';
	       $output['aaData'][] = array(
		   "DT_RowId" => $val['id'],
		   $count,
		   $val['amc_name'],
		   strtoupper($val['amc_type']),
		   $link
	       );
	       $count++;
	  }
	  echo json_encode($output);
	  die;
     }

     function getArchivecus() {

	  $col_sort = array("user`.`user_code", "user`.`first_name", "user`.`user_mobile");
	  $select = array("*");
//, "last_name", "user_mobile","user_phone",'user_profile','user_status'
//            'user_amc','address1','address2','user_city','user_country','user_postcode'
	  $order_by = "user_id";
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
	  $where = array('user.user_access_level' => 4, 'user.user_status' => 0);

	  if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	       $str_point = intval($_GET['iDisplayStart']);
	       $lenght = intval($_GET['iDisplayLength']);
	  }

	  $data = $this->crm->getData('user', $select, $where, FALSE, $order_by, $order, $lenght, $str_point, $search_array);
//	var_dump($this->crm->db->last_query());
	  $rowCount = $this->crm->getRowCount('user', $select, $where, FALSE, $order_by, $order, $search_array);
//	var_dump($this->crm->db->last_query());

	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => $rowCount,
	      "iTotalDisplayRecords" => $rowCount,
	      "aaData" => []
	  );

	  $edit_acccess = access_check("customer", "edit");
	  $delete_acccess = access_check("customer", "delete");
	  $count = 1;
	  foreach ($data as $val) {
	       $link = "";
	       $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" table-id="user" data-id="' . $val['user_id'] . '"><i class="fa fa-archive" aria-hidden="true"></i>Restore</a>';
//	       }

	       $output['aaData'][] = array(
		   "DT_RowId" => $val['user_id'],
		   $count,
		   $val['first_name'] . ' ' . $val['last_name'],
		   $val['user_mobile'],
		   $link
	       );
	       $count++;
	  }
	  echo json_encode($output);
	  die;
     }

     function getArchiveEmp() {


	  $col_sort = array("user`.`user_code", "user`.`first_name", "user`.`user_mobile");
	  $select = array("*");
//, "last_name", "user_mobile","user_phone",'user_profile','user_status'
//            'user_amc','address1','address2','user_city','user_country','user_postcode'
	  $order_by = "user_id";
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
	  $where = array('user.user_access_level' => 3, 'user.user_status' => 0);

	  if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	       $str_point = intval($_GET['iDisplayStart']);
	       $lenght = intval($_GET['iDisplayLength']);
	  }

	  $data = $this->crm->getData('user', $select, $where, FALSE, $order_by, $order, $lenght, $str_point, $search_array);
//	var_dump($this->crm->db->last_query());
	  $rowCount = $this->crm->getRowCount('user', $select, $where, FALSE, $order_by, $order, $search_array);
//	var_dump($this->crm->db->last_query());

	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => $rowCount,
	      "iTotalDisplayRecords" => $rowCount,
	      "aaData" => []
	  );

	  $edit_acccess = access_check("customer", "edit");
	  $delete_acccess = access_check("customer", "delete");
	  $count = 1;
	  foreach ($data as $val) {
//	     var_dump($val);
	       $link = "";

//	       if ($edit_acccess) {
//		    $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('customer/edit/' . $val['user_id']) . '" title="Edit" data_id="' . $val['user_id'] . '" ><i class="fa fa-edit"></i> Edit</a>'
//			    . '&nbsp;&nbsp;';
//	       }
//	       if ($delete_acccess) {
	       $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" table-id="user" data-id="' . $val['user_id'] . '"><i class="fa fa-archive" aria-hidden="true"></i>Restore</a>';
//	       }

	       $output['aaData'][] = array(
		   "DT_RowId" => $val['user_id'],
		   $count,
		   $val['first_name'] . ' ' . $val['last_name'],
		   $val['user_mobile'],
		   $link
	       );
	       $count++;
	  }
	  echo json_encode($output);
	  die;
     }
     function restore($table,$id){
	  if($table=='user'){
	  $this->db->where('user_id',$id);
	      $data = array('user_status'=>1);
	  $this->session->set_flashdata('archive_success', 'User Restore Successfully');
	  }else{
	  $this->session->set_flashdata('archive_success', 'Amc Restore Successfully');
	      $data = array('amc_status'=>1);
	  $this->db->where('id',$id);
	  }
	  
	  $this->db->update($table,$data);
//	  echo $this->db->last_query();die;
	  redirect('archive');
     }
}

?>
