<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'baseController.php';

class FollowupController extends BaseController {
     private $tablename;

     public function __construct() {
	  parent::__construct();
	  if ($this->session->userdata('logged_in') == FALSE) {
	       redirect('login');
	  }

	  $this->tablename = "followup";
     }
      public function index() {
	  $data['mainHeading'] = "Followup";

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
	  $this->load->template('/followup/index', $data);
     }

     function import(){
	  
	 ini_set('auto_detect_line_endings', TRUE);
	       $f = fopen($_FILES['import_file']['tmp_name'], "r");
            $count = 0;
            $full_data = array();

            while (($line = fgetcsv($f)) !== false) {
                $full_data[] = $line;
            }
	    $key = array();
            foreach ($full_data as $data) {
                if ($count == 0) {

                    $key = $data;
                }
                $count++;
            }
	    unset($full_data[0]);

            foreach ($full_data as $val) {
		 
                $main_array[] = array_combine($key, $val);
            }
	    
	    $db_array = array();
	    
	    foreach ($main_array as $key => $value) {
		if($value['Customer Name']!="" && $value['Address']!=""){
		 $bool =  $this->crm->getRowCount('followup','*',array('mobile'=>$value['Mobile']));
		if($bool==0){ 
		
		$db_array[$key]['name'] = $value['Customer Name'];
		$db_array[$key]['address'] = $value['Address'];
		$db_array[$key]['email'] = $value['Email'];
		$db_array[$key]['mobile'] = $value['Mobile'];
		$db_array[$key]['work_requirement'] = $value['Work Requirement'];
		$db_array[$key]['status'] = $value['Followup Number'];
		$db_array[$key]['notes'] = $value['Notes'];
		 }else{
//		     echo 'test<br>';
		}
		}
		
	    }
	    
	    if(!empty($db_array)){
		 
	    $this->db->insert_batch('followup',$db_array);
	    }
	    redirect('followup');
	    }
     
     
     public function getTableData() {

	  $col_sort = array("followup`.`id", "followup`.`name", "followup`.`address",  "followup`.`email", "followup`.`mobile", "followup`.`work_requirement","followup`.`status" ,"followup`.`notes");
	  $select = array("followup`.`id", "followup`.`name", "followup`.`address",  "followup`.`email", "followup`.`mobile", "followup`.`work_requirement","followup`.`status" ,"followup`.`notes");
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
//	  $where = array('user.user_access_level' => 4, 'user.user_status' => 1);
	  
	  if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	       $str_point = intval($_GET['iDisplayStart']);
	       $lenght = intval($_GET['iDisplayLength']);
	  }

	  $data = $this->crm->getData($this->tablename, $select, FALSE, FALSE, $order_by, $order, $lenght, $str_point, $search_array);
//	var_dump($this->crm->db->last_query());
	  $rowCount = $this->crm->getRowCount($this->tablename, $select, FALSE, FALSE, $order_by, $order, $search_array);
//	var_dump($this->crm->db->last_query());

	  $output = array(
	      "sEcho" => intval($_GET['sEcho']),
	      "iTotalRecords" => $rowCount,
	      "iTotalDisplayRecords" => $rowCount,
	      "aaData" => []
	  );

	  $change_acccess = access_check("followup", "edit");
	  $delete_acccess = access_check("followup", "delete");

	  foreach ($data as $val) {
//	     var_dump($val);
	       $link = "";

//	       if ($change_acccess) {
		    $color = '';
		    if($val['status']=='1'){
			 $color='red';
		    }elseif($val['status']=='2'){
			 $color='green';
			 
		    }elseif($val['status']=='3'){
			 $color='yellow';
			 
		    }
		    if($change_acccess){
		    $link .= '<button type="button" data_id="'.$val['id'].'" data-name="'.$val['name'].'" data-address="'.$val['address'].'" data-email="'.$val['email'].'" data-mobile="'.$val['mobile'].'" data-work="'.$val['work_requirement'].'" data-notes="'.$val['notes'].'"    class="'.$color.' btn  btn-xs change-status"  data-toggle="modal" data-target="#followstatus"><i class="fa fa-edit"></i> change</button>'
			    . '&nbsp;&nbsp;';
	       }

//	       if ($delete_acccess) {
//		    $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id=""><i class="fa fa-trash-o"></i> Delete</a>';
//	       }
	       $dob = 'N/A';
//	       if($val['dob']!=NULL && $val['dob']!='0000-00-00'){
//		$dob =     dateFormateOnly($val['dob']);
//	       }
//	       $user_type = "<span class='label label-info'>" . strtoupper($val['user_type']) . "</span>";
	       $output['aaData'][] = array(
		   "DT_RowId" => $val['id'],
		   $val['id'],
		   $val['name'],
		   $val['address'],
		   $val['email'],
		   $val['mobile'],
		   $val['work_requirement'],
		   $val['status'],
		   $val['notes'],
		   $link
	       );
//	 echo '<img src="' . base_url() . getUsersImage($val['user_id'], 'small') . '" class="img-responsive" alt="Cinque Terre" style="max-width:100px">';
	       }
	  

	  echo json_encode($output);
	  die;
     }
     
     public function change(){
	  
	$status =   $this->input->post('status');
	$id =   $this->input->post('id');
     
	$this->crm->rowUpdate('followup',array('status'=>$status),array('id'=>$id));
     
	$data['result'] = TRUE;
     
	echo json_encode($data);die;
     }
     
     public function getCsv() {

        $data = array('Customer Name', 'Address', 'Email','Mobile','Work Requirement','Followup Number','Notes');

        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="followup-import.csv"');

        $file = fopen("php://output", 'w');


        fputcsv($file, $data);
        fclose($file);

//            force_download($filename, $data)
    }
     
     
}