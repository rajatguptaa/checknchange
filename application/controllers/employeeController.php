<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class EmployeeController extends BaseController {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }
    }

    public function index() {
        $pagedata['mainHeading'] = 'Employee';
        $pagedata['scripts_to_load'] = array('assets/js/modules/employee.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/pagination/simplePagination.js', "assets/js/bootbox/bootbox.js");
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/pagination/simplePagination.css');
        $pagedata['organisation'] = $this->crm->getData('user');
        $this->load->template('/employee/index', $pagedata);
    }

    public function createEmployee() {
        $pagedata['mainHeading'] = 'Employee';
        $pagedata['subHeading'] = 'create';
//        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css');

      
        if ($this->input->post()) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
            
            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('user_code', 'Name', 'required');
            $this->form_validation->set_rules('address1', 'Address-1', 'required');
            $this->form_validation->set_rules('user_city', 'City', 'required');
            $this->form_validation->set_rules('user_country', 'Country', 'required');
            $this->form_validation->set_rules('user_postcode', 'Post Code', 'required');
            //|regex_match[/^[0-9]{10}$/]
            $this->form_validation->set_rules('user_phone', 'Phone Number ', 'numeric');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('document', 'Document', 'callback_document_validate');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 10 digits');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/employee/create', $pagedata);
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
              
                unset($data['passconf']);
                unset($data['orginasation_type']);
                unset($data['group']);
                
                $data['user_status'] = 1;
                $data['user_password'] = md5($this->input->post('user_password'));
                $data['user_access_level'] = 3;
                $data['user_update'] = date("Y-m-d H:i:s");
//                $org_id = $this->input->post('orginasation_type');
                $user_id = $this->crm->rowInsert('user', $data);
               
                $user_details = getUserDetails($user_id);
                $maildata['user_detail'] = $user_details;
                $password = $this->input->post('user_password');
                if ($user_id != NULL) {
                   

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
                        $this->session->set_flashdata('employee_success', 'Employee Added Successfully');
                        redirect('employee', 'refresh');
//                    }
                }else{
                    
                $this->load->template('/employee/create', $pagedata);
                }
            }
        } else {
            $this->load->template('/employee/create', $pagedata);
        }
    }

    public function editEmployee($user_id) {
        $pagedata['mainHeading'] = 'Employee';
        $pagedata['subHeading'] = 'edit';
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', 'assets/js/chosen/custom_chosen.js', 'assets/js/switchery/bootstrap-switch.min.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/switchery/bootstrap-switch.css');
//        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['access_level'] = $this->crm->getData('access_level');

        $pagedata['form_data'] = getUserDetails($user_id);
//        $pagedata['get_belong_organisation'] = getUserOrginasationDetails($user_id);
//        $pagedata['get_belong_group'] = getUserGroupDetails($user_id);
        $pagedata['method'] = 'get';


        if ($this->input->post()) {


            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('user_code', 'Name', 'required');
            $this->form_validation->set_rules('address1', 'Address-1', 'required');
            $this->form_validation->set_rules('user_city', 'City', 'required');
            $this->form_validation->set_rules('user_country', 'Country', 'required');
            $this->form_validation->set_rules('user_postcode', 'Post Code', 'required');
            //|regex_match[/^[0-9]{10}$/]
            $this->form_validation->set_rules('user_phone', 'Phone Number ', 'numeric');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
//            $this->form_validation->set_rules('document', 'Document', 'callback_document_validate');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 10 digits');
            $pagedata['method'] = 'post';
            
            if($this->input->post('password')!=""){
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            }
            if($this->input->post('old_email')!=$this->input->post('user_email')){
                $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/employee/edit', $pagedata);
            } else {
                $data = $this->input->post();
                
                
                
                   if (array_key_exists('document', $_FILES) && ($_FILES['document']['size'] > 0)) {
                    $filename1 = document_upload('document', 'employee');
                    if (is_array($filename1)) {
                        $data['document'] = 'assets/attachment/employee/' . $filename1['file_name'];
                    }
                    if (is_array($filename1)) {
                        
                        image_delete($this->input->post('old_document'),FALSE);
                    }
                }
                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    
                    $filename = image_upload('image', 'employee');
                  
//                    var_dump($filename);
                    $data['user_profile'] = 'assets/img/employee/' . $filename['file_name'];
                    
                    if (is_array($filename)) {
                        
                        image_delete($this->input->post('old_image'),"small");
                    }
                }
                if($data['user_password']!=''){
                    $data['user_password'] = md5($data['user_password']);
                }
                else{
                    unset($data['user_password']);
                }
               
                unset($data['user_id']);
                unset($data['old_email']);
                unset($data['passconf']);
                unset($data['old_image']);
                unset($data['old_document']);
                if ($this->input->post('user_status')) {
                    $data['user_status'] = 1;
                } else {
                    $data['user_status'] = 0;
                }
                $data['user_update'] = date("Y-m-d H:i:s");

//                var_dump($data);die;
                $res = $this->crm->rowUpdate('user', $data, array('user_id' => $user_id));
                
                        $this->session->set_flashdata('employee_success', 'Employee Edit Successfully');
                        redirect('employee', 'refresh');
            }
        } else {
            $this->load->template('/employee/edit', $pagedata);
        }
    }

    public function showEmployee($user_id) {
        $pagedata['mainHeading'] = 'Employee Profile';
        $pagedata['subHeading'] = 'show';
        $pagedata['scripts_to_load'] = array('assets/js/moris/raphael-min.js', 'assets/js/moris/morris.js');

        $pagedata['user_detail'] = getUserDetails($user_id);
        $pagedata['get_belong_organisation'] = getUserOrginasationDetails($user_id);
        $pagedata['get_belong_group'] = getUserGroupDetails($user_id);
        $pagedata['user_access'] = getUserAccessDetails($user_id);


        $this->load->template('/employee/view', $pagedata);
    }

    public function deleteEmployee($id) {
       $user_id[]=$id;
        $this->load->model("employee_model", "emp");
        $this->emp->delete_user($user_id);
        
        $this->session->set_flashdata('employee_success', 'Employee Deleted Successfully');
        redirect('employee', 'refresh');
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
    
    public function document_validate() {
        if ($_FILES['document']['size'] > 0) {


           
                return TRUE;
        } else {
                $this->form_validation->set_message('document_validate', 'Document is required');
                return false;
        }
    }

    public function getGroup() {
    
            $group_data = array();
            $group_data = $this->crm->getData('group', '');


            echo json_encode($group_data);
    
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

    public function search() {
        $word = $this->input->post('input');
//        $org_id = $this->input->post('org_id');
        $offset = $this->input->post('offset');
        $limit = 9;

        $search_array = array(
            'user_email' => $word,
            'user_phone' => $word,
            'user_name' => $word
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

        $where['user_access_level'] = 3;
//        if ($org_id != '') {
//            $where['user_organisation_rel.organisation_id'] = $org_id;
//        }

        $pagedata['user_detail'] = $this->crm->getData('user', 'user.*', $where, $join, 'user.user_update', 'desc', $limit, ($limit * ($offset - 1)), $search_array);

        $pagedata['count'] = $this->crm->getRowCount('user', 'user.*', $where, $join, 'user.user_update', 'desc', $search_array);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/employee/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }

        echo $html;
    }

    public function filter() {
        $org_id = $this->input->post('input');
        $limit = 9;
        $offset = 0;
        $join = array(
            array('table' => 'access_level',
                'on' => 'user.user_access_level=access_level.access_level_id'),
            array('table' => 'user_organisation_rel',
                'on' => 'user_organisation_rel.user_id=user.user_id'),
        );
        $where['user_access_level'] = 3;
        if ($org_id != '') {
            $where['user_organisation_rel.organisation_id'] = $org_id;
        }
        $pagedata['count'] = $this->crm->getRowCount('user', '', $where, $join, 'user.user_update', 'DESC');
        $pagedata['user_detail'] = $this->crm->getData('user', '', $where, $join, 'user.user_update', 'DESC', $limit, $offset);
        if (!empty($pagedata['user_detail'])) {
            $html = $this->load->view('/employee/search_view', $pagedata, TRUE);
        } else {
            $html = "<H2 align='center'><b>Sorry! No results found</b></h2>";
        }
        echo $html;
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
         $join = array(
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket_assign.ticket_id=ticket.ticket_id'),
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id')
        );

        $where = array('ticket_status' => $type, 'ticket_assign.user_id' => $user_id);
        $pagedata['ticket_data'] = $this->crm->getData('ticket', 'ticket.*,ticket_assign.assigned_by,ticket_assign.ticket_assign_at,ucr.user_name as ticket_creater,ucr.user_profile', $where, $join, FALSE, FALSE);

       $this->load->view('/employee/emp_ticket', $pagedata);
       
       
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
 function upload_attachement(){

    $file_element_name = 'image1';

   
        $config['upload_path'] = './assets/attachment/employee';
        $config['allowed_types'] = 'doc|txt|pdf|docx|jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            

                $status = "success";
                $msg = "File successfully uploaded";
                
                
        }
//        @unlink($_FILES[$file_element_name]);
    
    echo json_encode(array('status' => $status, 'msg' => $msg,'filepath'=>$data['file_name']));
     die;
     
 }
}

?>
