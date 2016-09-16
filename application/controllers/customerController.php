<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class CustomerController extends BaseController {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }
    }

    public function index($type = FALSE) {

        $pagedata['scripts_to_load'] = array('assets/js/modules/customer.js', 'assets/js/chosen/chosen.jquery.js', 'assets/js/pagination/simplePagination.js', "assets/js/bootbox/bootbox.js");
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css', 'assets/css/pagination/simplePagination.css');
        $pagedata['customer_type'] = 'approved';
        $pagedata['organisation'] = $this->crm->getData('organisation');
        if ($type != '') {
            $pagedata['customer_type'] = 0;
            $pagedata['mainHeading'] = 'Unapproved Customer';
        } else {
            $pagedata['mainHeading'] = 'Approved Customer';
            $pagedata['customer_type'] = 1;
        }
        $this->load->template('/customer/index', $pagedata);
    }

    public function createCustomer() {
        $pagedata['mainHeading'] = 'Customer';
        $pagedata['subHeading'] = 'create';
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css');


        if ($this->input->post()) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('orginasation_type', 'Orginasation', 'required');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('user_phone', 'Phone Number ', 'numeric|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 11 digits');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/customer/create', $pagedata);
            } else {
                $data = $this->input->post();
                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    $filename = image_upload('image', 'user');


                    if (is_array($filename)) {
                        $data['user_profile'] = 'assets/img/user/' . $filename['file_name'];
                    }
                }
              
                unset($data['orginasation_type']);
                unset($data['group']);

                $data['user_status'] = 1;
                
                $data['user_access_level'] = 2;
                $data['user_update'] = date("Y-m-d H:i:s");
                $org_id = $this->input->post('orginasation_type');
                $user_id = $this->crm->rowInsert('user', $data);
                $user_detail = getUserDetails($user_id);
                $maildata['user_detail'] = $user_detail;
                
               if ($user_id != NULL) {

                    $org_data = array('user_id' => $user_id, 'organisation_id' => $org_id);
                    //Add Organisation 
                    $org_rel_id = $this->crm->rowInsert('user_organisation_rel', $org_data);
                  
                    if ($org_rel_id) {
                       
                       $org = getUserOrginasationDetails($user_detail['user_id']);
                       $unique_id = uniqid();
                        $forget_data = array(
                            'user_id' => $user_id,
                            'forget_token' => $unique_id,
                            'forget_update' => date("Y-m-d H:i:s"),
                         );
                      
                       
                         $forget_id = $this->crm->rowInsert('forget_password', $forget_data);
                       if ($forget_id > 0) {
                         $hrf = base_url().'create_password/'.$unique_id;
                         $maildata['content'] = sprintf(CUSTOMER_SIGNUP,getUserName($user_detail['user_id']),$user_detail['user_email']);
                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
                      $maildata['link'] =$hrf;
                      $maildata['btntitle'] ='Create Password';
                      $message ='';
                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
                      
                       
                       $org = getUserOrginasationDetails($user_id);
                       $mailResponse = mymail($user_detail['user_email'], sprintf(WELCOME_SUB, $org['organisation_name']), $message);
                    if ($mailResponse) {
                       $this->session->set_flashdata('customer_success', 'Customer Added Successfully');
                        redirect('customer', 'refresh');
                     
                    } else {
                        $this->session->set_flashdata('invalid', 'Something went wrong');
                        redirect('customer', 'refresh');
                    }
                }
                
                       
                    }
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
            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|callback_email__unique_validate');
            $this->form_validation->set_rules('user_phone', 'Phone Number ', 'numeric|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_message('regex_match', 'Phone number only cantain 11 digits');
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

    public function deleteCustomer($id, $type) {
        if (userExist($id)) {
            $user_id[] = $id;
            $this->load->model("employee_model", "emp");
            $this->emp->delete_user($user_id);
            if ($type == 1)
                $this->session->set_flashdata('customer_success', 'Customer Deleted Successfully');
            if ($type == 1) {
                redirect('customer', 'refresh');
            } else {
                redirect('customer/unapproved', 'refresh');
            }
        } else {
            $this->session->set_flashdata('customer_danger', 'Customer Not Exist');
            redirect('customer/unapproved', 'refresh');
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
