<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class CustomerController extends BaseController {

     private $tablename;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tablename = "user";
    }

    public function index() {
        $data['mainHeading'] = "Customer";

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
        $this->load->template('/customer/index', $data);
    }
    
     public function getTableData() {

          $col_sort = array("user.user_code","user.user_profile", "user.first_name", "user.user_mobile",'user.dob','u.first_name','user.user_type' );
        $select = array("user.user_id","user.user_code", "user.user_name", "u.first_name as reffirst_name","u.last_name as reflast_name","user.first_name","user.last_name",'user.user_mobile','user.dob','user.user_type');
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
        $where = array('user.user_access_level'=>4,'user.user_status'=>1);
        $join = array(
            array('table' => 'user as u',
                'on' => 'u.user_id=user.reference_by'),
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

        $edit_acccess = access_check("customer", "edit");
        $delete_acccess = access_check("customer", "delete");

        foreach ($data as $val) {
//	     var_dump($val);
            $link = "";

            if ($edit_acccess) {
                $link .= '<a id="editOrganisation" class="btn btn-success btn-xs" href="' . base_url('customer/edit/' . $val['user_id']) . '" title="Edit" data_id="' . $val['user_id'] . '" ><i class="fa fa-edit"></i> Edit</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['user_id'] . '"><i class="fa fa-trash-o"></i> Delete</a>';
            }
	    $user_type = "<label class='btn btn-success'>".$val['user_type']."</label>";
            $output['aaData'][] = array(
                "DT_RowId" => $val['user_id'],
                $val['user_id'],
                '<img src="' . base_url() . getUsersImage($val['user_id']) . '" class="img-responsive" alt="Cinque Terre" style="max-width:100px"> ',
                $val['first_name'].' '.$val['last_name'],
                $val['user_mobile'],
                dateFormate($val['dob']),
                $val['reffirst_name'].' '.$val['reflast_name'],
                $user_type,
                $link
            );
        }

        echo json_encode($output);
        die;
    }
    
    
    
    public function createCustomer() {
        $pagedata['mainHeading'] = 'Customer';
        $pagedata['subHeading'] = 'create';
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js','assets/js/datepicker/moment.js', 'assets/js/datepicker/bootstrap-datetimepicker.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css','assets/css/datepicker/bootstrap-datetimepicker.css');

	$pagedata['userdata'] = getUserByAccessLevel(3);
	$pagedata['amcdata'] = getAMC(1);
         if ($this->input->post()) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
            
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'LastName', 'required');
            $this->form_validation->set_rules('user_code', 'Name', 'required');
            $this->form_validation->set_rules('address1', 'Address-1', 'required');
            $this->form_validation->set_rules('user_city', 'City', 'required');
            $this->form_validation->set_rules('user_country', 'Country', 'required');
            $this->form_validation->set_rules('user_postcode', 'Post Code', 'required');
            $this->form_validation->set_rules('user_mobile', 'Mobile Number ', 'numeric|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('document', 'Document', 'callback_document_validate');
            $this->form_validation->set_rules('user_amc[]', 'User Amc', 'required');
            $this->form_validation->set_rules('user_type', 'User Type', 'required');
            $this->form_validation->set_rules('reference_by', 'Reference By', 'required');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 10 digits');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/customer/create', $pagedata);
            } else {
                $data = $this->input->post();
                  if (array_key_exists('document', $_FILES) && ($_FILES['document']['size'] > 0)) {
                    $filename1 = document_upload('document', 'employee');
                    if (is_array($filename1)) {
                        $data['document'] = 'assets/attachment/employee/' . $filename1['file_name'];
                    }
                }
                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    $filename = image_upload('image', 'employee');
                    if (is_array($filename)) {
                        $data['user_profile'] = 'assets/img/employee/' . $filename['file_name'];
                    }
                }
		$amc = $data['user_amc'];
		$dob = $data['dob'];
		$annivery = $data['annivery'];
                unset($data['passconf']);
                unset($data['user_amc']);
                unset($data['annivery']);
                unset($data['dob']);
		$data['dob'] = date('Y-m-d',  strtotime($dob));
		$data['user_name'] = $data['first_name'].' '.$data['last_name'];
		$data['annivery'] = date('Y-m-d',  strtotime($annivery));
                $data['user_status'] = 1;
                $data['user_password'] = md5($this->input->post('user_password'));
                $data['user_access_level'] = 4;
                $data['user_update'] = date("Y-m-d H:i:s");
                $user_id = $this->crm->rowInsert('user', $data);
               $user_amc = array();		
                $user_details = getUserDetails($user_id);
                $maildata['user_detail'] = $user_details;
                $password = $this->input->post('user_password');
                if ($user_id != NULL && $user_id) {
			 if(!empty($amc)){
			      foreach ($amc as $key=>$amc_value) {
			      $user_amc['user_id'] = $user_id;
			      $user_amc['amc_id'] = $amc_value;
			      $user_amc['amc_start_date'] = date('Y-m-d H:i:s');
			      $user_amc['amc_end_date'] = date('Y-m-d H:i:s');
			      $user_amc['reference_by'] = $data['reference_by'];
			      $user_amc['created_at'] = date('Y-m-d H:i:s');
			      $user_amc['amc_user_status'] = 1;
			      $user_amc_rel = $this->crm->rowInsert('user_amc_rel', $user_amc);
			      }
			 }
//                      $message ='';
//           
//                      $org =  getUserOrginasationDetails($user_details['user_id']);
//                      $maildata['content'] = sprintf(EMPLOYEE_SIGNUP,getUserName($user_id),$user_details['user_email'],$password);
//                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
//                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
//                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
//                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
//                      
//                    mymail($user_details['user_email'],sprintf(WELCOME_SUB,$org['organisation_name']),$message);
                        $this->session->set_flashdata('customer_success', 'Customer Added Successfully');
                        redirect('customer', 'refresh');
//                    }
                }else{
                $this->load->template('/customer/create', $pagedata);
                }
            }
        } else {
            $this->load->template('/customer/create', $pagedata);
        }
    }

    public function editCustomer($user_id) {
        $pagedata['mainHeading'] = 'Customer';
        $pagedata['subHeading'] = 'edit';
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', 'assets/js/switchery/bootstrap-switch.min.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/switchery/bootstrap-switch.css');
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['access_level'] = $this->crm->getData('access_level');

        $pagedata['user_detail'] = getUserDetails($user_id);
        $pagedata['get_belong_organisation'] = getUserOrginasationDetails($user_id);
        $pagedata['get_belong_group'] = getUserGroupDetails($user_id);
        $pagedata['method'] = 'get';


        if ($this->input->post()) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
             $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'LastName', 'required');
            $this->form_validation->set_rules('user_code', 'Name', 'required');
            $this->form_validation->set_rules('address1', 'Address-1', 'required');
            $this->form_validation->set_rules('user_city', 'City', 'required');
            $this->form_validation->set_rules('user_country', 'Country', 'required');
            $this->form_validation->set_rules('user_postcode', 'Post Code', 'required');
            //|regex_match[/^[0-9]{10}$/]
            $this->form_validation->set_rules('user_mobile', 'Mobile Number ', 'numeric');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('document', 'Document', 'callback_document_validate');
            $this->form_validation->set_rules('user_amc[]', 'User Amc', 'required');
            $this->form_validation->set_rules('user_type', 'User Type', 'required');
            $this->form_validation->set_rules('reference_by', 'Reference By', 'required');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 10 digits');
            $pagedata['method'] = 'post';

            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/customer/edit', $pagedata);
            } else {
                $data = $this->input->post();

                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    $filename = image_upload('image', 'user');


                    if (is_array($filename)) {
                        $data['user_profile'] = 'assets/img/user/' . $filename['file_name'];
                        $this->delete_user_image($this->input->post('old_image'));
                    }
                }
                if ($data['user_password'] != '') {
                    $data['user_password'] = md5($data['user_password']);
                } else {
                    unset($data['user_password']);
                }
                unset($data['orginasation_type']);
                unset($data['group']);
                unset($data['old_image']);
                unset($data['user_id']);
//                unset($data['old_image']);
                if ($this->input->post('user_status')) {
                    $data['user_status'] = 1;
                } else {
                    $data['user_status'] = 0;
                }
                $data['user_update'] = date("Y-m-d H:i:s");

                $org_id = $this->input->post('orginasation_type');
                $res = $this->crm->rowUpdate('user', $data, array('user_id' => $user_id));
                if ($res) {

                    // delete relation 
                    $this->crm->rowsDelete('user_organisation_rel', array('user_id' => $user_id));
                    $org_data = array('user_id' => $user_id, 'organisation_id' => $org_id);
                    $org_rel_id = $this->crm->rowInsert('user_organisation_rel', $org_data);
                    if ($org_rel_id) {
                        $this->session->set_flashdata('customer_success', 'Customer Edit Successfully');
                        redirect('customer', 'refresh');
                    }
                }
            }
        } else {
            $this->load->template('/customer/edit', $pagedata);
        }
    }

    public function showCustomer($user_id) {
        if (userExist($user_id)) {
            $pagedata['mainHeading'] = 'Customer Profile';
            $pagedata['subHeading'] = 'show';
            $pagedata['scripts_to_load'] = array('assets/js/moris/raphael-min.js', 'assets/js/moris/morris.js');

            $pagedata['user_detail'] = getUserDetails($user_id);
            $pagedata['get_belong_organisation'] = getUserOrginasationDetails($user_id);
            $pagedata['get_belong_group'] = getUserGroupDetails($user_id);
            $pagedata['user_access'] = getUserAccessDetails($user_id);
            $this->load->template('/customer/view', $pagedata);
        } else {
            $this->session->set_flashdata('customer_danger', 'Customer Not Exist');
            redirect('customer/unapproved', 'refresh');
        }
    }

    public function deleteCustomer($id) {
        if (userExist($id)) {
          $result =   $this->crm->rowUpdate($this->tablename,array('user_status'=>0),array('user_id'=>$id));
	    if ($result){
                $this->session->set_flashdata('customer_success', 'Customer Deleted Successfully');
                redirect('customer', 'refresh');
	    }else{
                $this->session->set_flashdata('customer_success', 'Customer Not Deleted Successfully');
                redirect('customer', 'refresh');
	    }
             
        } else {
            $this->session->set_flashdata('customer_danger', 'Customer Not Exist');
            redirect('customer', 'refresh');
        }
    }

    public function image_validate() {
        if ($_FILES['image']['size'] > 0) {

            if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpg') {

                return true;
            } else {
                $this->form_validation->set_message('image_validate', 'Image type must me jpeg,png or jpg ');
                return false;
            }
        } else {
            return TRUE;
        }
    }

    public function getGroup() {
        if ($this->input->post('organisation_id')) {
            $group_data = array();
            $group_data = $this->crm->getData('group', '', array('organisation_id' => $this->input->post('organisation_id')));


            echo json_encode($group_data);
        }
    }

    public function email__unique_validate($user_id) {


        $check_email = array(
            'user_id !=' => $this->input->post('user_id'),
            'user_email' => $this->input->post('user_email')
        );
        $check = $this->crm->getRowCount('user', '', $check_email);
        if ($check > 0) {
            $this->form_validation->set_message('email__unique_validate', 'The Email field must contain a unique value.');
            return false;
        } else {
            return TRUE;
        }
    }

    public function delete_user_image($path) {
        if (file_exists($path)) {
            unlink($path);
            return TRUE;
        }
    }

    public function search() {
        $word = $this->input->post('input');
        $org_id = $this->input->post('org_id');
        $offset = $this->input->post('offset');
        $status = $this->input->post('customer_type');
        $limit = 9;
        $pagedata['customer_type'] = $status;
        $search_array = array(
            'user_email' => $word,
            'user_phone' => $word,
            'user_name' => $word,
            'organisation_name' => $word
        );
        $join = array();
        $join[] = array(
            'table' => 'access_level',
            'on' => 'user.user_access_level=access_level.access_level_id'
        );
//        if ($org_id != '') {
        $join[] = array('table' => 'user_organisation_rel',
            'on' => 'user_organisation_rel.user_id=user.user_id');
        $join[] = array('table' => 'organisation',
            'on' => 'organisation.organisation_id=user_organisation_rel.organisation_id');
//        }

        $where['user_access_level'] = 2;
        if ($status == '1') {
            $where['user_status !='] = '2';
        } else {
            $where['user_status'] = '2';
        }

        if ($org_id != '') {
            $where['user_organisation_rel.organisation_id'] = $org_id;
        }

        $pagedata['user_detail'] = $this->crm->getData('user', '', $where, $join, 'user.user_update', 'desc', $limit, ($limit * ($offset - 1)), $search_array);

        $pagedata['count'] = $this->crm->getRowCount('user', '', $where, $join, 'user.user_update', 'desc', $search_array);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/customer/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }

        echo $html;
    }

    public function filter() {
        $org_id = $this->input->post('input');
        $customer_type = $this->input->post('customer_type');
        $limit = 9;
        $offset = 0;
        $pagedata['customer_type'] = $customer_type;
        $join = array(
            array('table' => 'access_level',
                'on' => 'user.user_access_level=access_level.access_level_id'),
            array('table' => 'user_organisation_rel',
                'on' => 'user_organisation_rel.user_id=user.user_id'),
        );
        $where['user_access_level'] = 2;
        if ($customer_type == '1') {
            $where['user_status !='] = '2';
        } else {
            $where['user_status'] = '2';
        }
        if ($org_id != '') {
            $where['user_organisation_rel.organisation_id'] = $org_id;
        }
        $pagedata['count'] = $this->crm->getRowCount('user', '', $where, $join, 'user.user_update', 'DESC');
        $pagedata['user_detail'] = $this->crm->getData('user', '', $where, $join, 'user.user_update', 'DESC', $limit, $offset);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/customer/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }
        echo $html;
    }

    public function approveCustomer($user_id) {

        if (userExist($user_id)) {
            $data['user_status'] = 1;
            $this->crm->rowUpdate('user', $data, array('user_id' => $user_id));
            $this->session->set_flashdata('customer_success', 'Customer Approve Successfully');
            redirect('customer', 'refresh');
        } else {
            $this->session->set_flashdata('customer_danger', 'Customer Not Exist');
            redirect('customer/unapproved', 'refresh');
        }
    }

    public function approveAll() {

        $data['user_status'] = 1;
        $this->crm->rowUpdate('user', $data, array('user_status' => 2, 'user_access_level' => 2));
        $this->session->set_flashdata('customer_success', 'All Customer Approve Successfully');
        redirect('customer', 'refresh');
    }

    public function approveSelected() {
        $id_array = $this->input->post();

        $ids = $id_array['id'];


        if (!empty($ids)) {
            foreach ($ids as $val) {
                $data['user_status'] = 1;
                $this->crm->rowUpdate('user', $data, array('user_status' => 2, 'user_id' => $val));
            }
            $this->session->set_flashdata('customer_success', 'Selected Customer Approve Successfully');
            echo 1;
        } else {
            echo FALSE;
        }
    }

    public function createCustomerByEmployee() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

        $this->form_validation->set_rules('user_name', 'Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');

        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $error = $this->form_validation->error_array();
            $result['result'] = false;
            $result['error'] = $error;
            echo json_encode($result);
        } else {
            $data = $this->input->post();
            
            
            $org_id = $this->input->post('org_id');;
            
            $data['user_status'] = 1;
            $data['user_access_level'] = 2;
            $data['user_update'] = date("Y-m-d H:i:s");
            unset($data['org_id']);
           
            $last_user_id = $this->crm->rowInsert('user', $data);
            if ($last_user_id) {
                 $user_detail = getUserDetails($last_user_id);
              
               
                $org_data = array('user_id' => $last_user_id, 'organisation_id' => $org_id);
                //Add Organisation 
                $org_rel_id = $this->crm->rowInsert('user_organisation_rel', $org_data);
                if ($org_rel_id) {
                     $org = getUserOrginasationDetails($user_detail['user_id']);
                       $unique_id = uniqid();
                        $forget_data = array(
                            'user_id' => $user_detail['user_id'],
                            'forget_token' => $unique_id,
                            'forget_update' => date("Y-m-d H:i:s"),
                         );
                      
                       
                         $forget_id = $this->crm->rowInsert('forget_password', $forget_data);
                       if ($forget_id > 0) {
                          $org = getUserOrginasationDetails($last_user_id);  
                         $hrf = base_url().'create_password/'.$unique_id;
                         $maildata['content'] = sprintf(CUSTOMER_SIGNUP,getUserName($user_detail['user_id']),$user_detail['user_email']);
                      $maildata['link'] =$hrf;
                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
                      $maildata['btntitle'] ='Create Password';
                      $message ='';
                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
                      
                       
                      
                       $mailResponse = mymail($user_detail['user_email'], sprintf(WELCOME_SUB, $org['organisation_name']), $message);
                       }

                    $result['result'] = TRUE;
                    $result['msg'] = "Customer Added Successfully";
                    $result['type'] = "success";
                    $result['detail'] = $user_detail;
                  
                     echo json_encode($result);
                }
            }
        }
    }
    
    
    public function getEmployeeTicket($ticket_type,$user_id){
       if($ticket_type == 1){
           $type = 'Open';
       }
       if($ticket_type == 2){
           $type = 'Doing';
       }
       if($ticket_type == 3){
           $type = 'Solved';
       }
        

        $where = array('ticket_status' => $type, 'ticket.user_id' => $user_id);
        $pagedata['ticket_data'] = $this->crm->getData('ticket', 'ticket.*', $where, FALSE, FALSE, FALSE);
        
       $this->load->view('/customer/emp_ticket', $pagedata);
       
       
   } 
   
   public function getTicketattachment($ticket_id){
         $join = array(
            array(
                'table' => 'attachment',
                'on' => 'ticket_attachment_rel.attachment_id=attachment.attachment_id'),
        );

        $where = array('ticket_attachment_rel.ticket_id' => $ticket_id);
        $attachmentData = $this->crm->getData('ticket_attachment_rel','attachment.attachment_id,attachment.attachment_name', $where, $join, FALSE, FALSE);

      return $attachmentData;
       
       
 }  

}

?>
