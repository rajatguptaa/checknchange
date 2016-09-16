<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('crm_model', 'crm');
    }

    public function index() {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|md5|required|xss_clean|callback_check');

        if ($this->form_validation->run() == FALSE && $this->session->userdata('logged_in') == FALSE) {

            $this->load->view('/_layouts/header.php');
            $this->load->view('/auth/login.php');
            $this->load->view('/_layouts/footer.php');
        } else {
            $this->session->set_flashdata('success', 'User Login Successfully');
            redirect('dashboard', 'refresh');
        }
    }

    public function check($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $email = $this->input->post('email');
        //query the database


        $result = $this->auth->check_login($email, $password);
        if (!empty($result)) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = $row;
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->session->set_flashdata('invalid', 'Invalid username or password');
            redirect('login', 'refresh');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }

    public function forget_password() {

        if ($this->input->post()) {

            $this->form_validation->set_rules('user_email', 'Email', 'valid_email|trim|required|xss_clean|callback_email_exist');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('/_layouts/header.php');
                $this->load->view('/auth/forget_password.php');
                $this->load->view('/_layouts/footer.php');
            } else {
                $where['user_email'] = $this->input->post('user_email');
                $get_user_detail = $this->crm->getData('user', '', $where);
                $user_detail = $get_user_detail[0];
                $unique_id = uniqid();
                $forget_data = array(
                    'user_id' => $user_detail['user_id'],
                    'forget_token' => $unique_id,
                    'forget_update' => date("Y-m-d H:i:s"),
                );

                $Pagedata['user_detail'] = $user_detail;
                $message ='';
                $forget_id = $this->crm->rowInsert('forget_password', $forget_data);
                if ($forget_id > 0) {
                    $hrf = base_url().'reset_password/'.$unique_id;
                    $maildata['content'] = sprintf(FORGET_PASSWORD,getUserName($user_detail['user_id']));
                    $maildata['link'] =$hrf;
                    $maildata['btntitle'] ='Reset Now';
                    $maildata['note'] =' This link expire after 12 hour.';
                    
                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
                     
                    $org = getUserOrginasationDetails($user_detail['user_id']);
                    $mailResponse = mymail($user_detail['user_email'], sprintf(FORGOT_PASSWORD_SUB, $org['organisation_name']), $message);
                    
                    if ($mailResponse) {
                        $this->session->set_flashdata('login_success', 'Next step please check your email');
                        redirect('login', 'refresh');
                    } else {
                        $this->session->set_flashdata('invalid', 'Something went wrong');
                        redirect('forget_password', 'refresh');
                    }
                }
            }
        } else {
            $this->load->view('/_layouts/header.php');
            $this->load->view('/auth/forget_password.php');
            $this->load->view('/_layouts/footer.php');
        }
    }

    public function email_exist() {
        $check_email = array(
            'user_email' => $this->input->post('user_email')
        );

        $check = $this->crm->getRowCount('user', '', $check_email);
        if ($check == 0) {
            $this->form_validation->set_message('email_exist', 'Entered email not exist in system.');
            return false;
        } else {
            return TRUE;
        }
    }

    public function reset_password($token = false) {
      

        $method = $this->input->server('REQUEST_METHOD');

        if ($token != null && $method == "GET") {
            $where['forget_token'] = $token;
            $get_token = $this->crm->getData('forget_password', '', $where);
         
            if (!empty($get_token)) {
           
                $Pagedata['token_detail'] = $get_token[0];
                $time2 = $get_token[0]['forget_update'];
                $time1 = date("Y-m-d H:i:s");
                $diff = strtotime($time1) - strtotime($time2);
                $diff_in_hrs = round($diff / 3600);
                if ($diff_in_hrs <= 12) {
                  
                    $this->load->view('/_layouts/header.php');
                    $this->load->view('/auth/reset_password.php', $Pagedata);
                    $this->load->view('/_layouts/footer.php');
                }else{
                   
               $this->session->set_flashdata('invalid', 'Your token has been expired');
                redirect('login', 'refresh'); 
            
                }
            }
            else{
               $this->session->set_flashdata('invalid', 'Your token has been expired');
                redirect('login', 'refresh'); 
            }
        } else {
            $where['forget_token'] = $this->input->post('forget_token');
            $get_token = $this->crm->getData('forget_password', '', $where);
            $Pagedata['token_detail'] = $get_token[0];
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]|md5');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('/_layouts/header.php');
                $this->load->view('/auth/reset_password.php', $Pagedata);
                $this->load->view('/_layouts/footer.php');
            } else {


                $password = $this->input->post('user_password');
                $data = array(
                    'user_password' => $password
                );
                $this->crm->rowUpdate('user', $data, array('user_id' => $get_token[0]['user_id']));
                $this->crm->rowsDelete('forget_password', array('user_id' => $get_token[0]['user_id']));
                $this->session->set_flashdata('login_success', 'Your password reset successfully please login with new password');
                redirect('login', 'refresh');
            }
        }
    }
    public function create_password($token = false) {
      

        $method = $this->input->server('REQUEST_METHOD');

        if ($token != null && $method == "GET") {
            $where['forget_token'] = $token;
            $get_token = $this->crm->getData('forget_password', '', $where);
         
            if (!empty($get_token)) {
           
                $Pagedata['token_detail'] = $get_token[0];
                $time2 = $get_token[0]['forget_update'];
                $time1 = date("Y-m-d H:i:s");
                $diff = strtotime($time1) - strtotime($time2);
                $diff_in_hrs = round($diff / 3600);
                $this->load->view('/_layouts/header.php');
                $this->load->view('/auth/change_password.php', $Pagedata);
                $this->load->view('/_layouts/footer.php');
                
            }
            else{
               $this->session->set_flashdata('invalid', 'Your token has been expired');
               $this->session->unset_userdata('logged_in');
               
                redirect('login', 'refresh'); 
            }
        } else {
            $where['forget_token'] = $this->input->post('forget_token');
            $get_token = $this->crm->getData('forget_password', '', $where);
            $Pagedata['token_detail'] = $get_token[0];
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]|md5');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('/_layouts/header.php');
                $this->load->view('/auth/change_password.php', $Pagedata);
                $this->load->view('/_layouts/footer.php');
            } else {


                $password = $this->input->post('user_password');
                $data = array(
                    'user_password' => $password
                );
                $this->crm->rowUpdate('user', $data, array('user_id' => $get_token[0]['user_id']));
                $this->crm->rowsDelete('forget_password', array('user_id' => $get_token[0]['user_id']));
                $this->session->set_flashdata('login_success', 'Your password create successfully please login with created password');
                $this->session->unset_userdata('logged_in');
                redirect('login', 'refresh');
            }
        }
    }

//    public function change_password() {
//        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]|md5');
//        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
//        if ($this->form_validation->run() == FALSE) {
//            $this->load->view('/_layouts/header.php');
//            $this->load->view('/auth/reset_password.php', $Pagedata);
//            $this->load->view('/_layouts/footer.php');
//        } else {
//
//            $user = $this->session->userdata('logged_in');
//            $password = $this->input->post('user_password');
//            $data = array(
//                'user_password' => $password
//            );
//            $this->crm->rowUpdate('user', $data, array('user_id' => $user['user_id']));
//            $this->session->set_flashdata('login_success', 'Your password change successfully');
//            redirect('login', 'refresh');
//        }
//    }

    public function signup() {
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css');
        
        if($this->input->post()){
         
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('orginasation_type', 'Orginasation', 'required');

            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_message('matches', 'password does not match');
            $this->form_validation->set_rules('user_email', 'Email', 'required|email|is_unique[user.user_email]');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('user_phone', 'Phone Number ', 'numeric|regex_match[/^[0-9]{11}$/]');
            $this->form_validation->set_message('regex_match', 'Phone number only camtain 10 digits');
            if ($this->form_validation->run() == FALSE) {
                 $this->load->view('/_layouts/header.php',$pagedata);
                 $this->load->view('/auth/signup.php',$pagedata);
                 $this->load->view('/_layouts/footer.php');
            } else {
                $data = $this->input->post();
                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    $filename = image_upload('image', 'user');


                    if (is_array($filename)) {
                        $data['user_profile'] = 'assets/img/user/' . $filename['file_name'];
                    }
                }
                unset($data['passconf']);
                unset($data['orginasation_type']);
                unset($data['group']);

                $data['user_status'] = 2;
                $data['user_password'] = md5($this->input->post('user_password'));
                $data['user_access_level'] = 2;
                $data['user_update'] = date("Y-m-d H:i:s");
                $org_id = $this->input->post('orginasation_type');
                $user_id = $this->crm->rowInsert('user', $data);
                $user_details = getUserDetails($user_id);
                $maildata['user_detail'] = $user_details;
                $password = $this->input->post('user_password');
                if ($user_id != NULL) {
                   
                    $org_data = array('user_id' => $user_id, 'organisation_id' => $org_id);
                   
                    $org_rel_id = $this->crm->rowInsert('user_organisation_rel', $org_data);
                    if ($org_rel_id) {
                      $org =  getUserOrginasationDetails($user_details['user_id']);  
                      $maildata['content'] = sprintf(CUSTOMER_SIGNUP_OUT,getUserName($user_id),$user_details['user_email'],$password);
                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
                      $message='';
                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
                      
                    mymail($user_details['user_email'],sprintf(WELCOME_SUB,$org['organisation_name']),$message);
                   
                        $this->session->set_flashdata('login_success', 'Your Account Added Successfully Please wait for approval');
                        redirect('login', 'refresh');
                    }
                }
            }   
        }
        else{
        $this->load->view('/_layouts/header.php',$pagedata);
        $this->load->view('/auth/signup.php',$pagedata);
        $this->load->view('/_layouts/footer.php');
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

}
