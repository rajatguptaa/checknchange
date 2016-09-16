<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'baseController.php';

class SettingController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->session->userdata('logged_in');
        $data['mainHeading'] = "Settings";

        $data['user_detail'] = getUserDetails($user['user_id']);

        $data['method'] = "get";
        $data['activeTab'] = "profile";

        if ($this->input->post('changepassword')) {
            $data['activeTab'] = "change_password";
            $this->form_validation->set_rules('changepassword[old_user_password]', 'Old Password', 'trim|required|callback_check_password|md5');
            $this->form_validation->set_rules('changepassword[user_password]', 'New Password', 'trim|required|md5');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/setting/index', $data);
            } else {


                $changepassword_form = $this->input->post('changepassword');
                $password = $changepassword_form["user_password"];

                $data = array(
                    'user_password' => $password
                );
                $this->crm->rowUpdate('user', $data, array('user_id' => $user['user_id']));
                $this->session->set_flashdata('change_success', 'Your password change successfully');
                redirect('setting', 'refresh');
            }
        }

        if ($this->input->post('userdetail')) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $userdetail = $this->input->post('userdetail');
             
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
            $this->form_validation->set_rules('userdetail[user_name]', 'Name', 'required');
            $this->form_validation->set_rules('image', 'Image', 'callback_image_validate');
            $this->form_validation->set_rules('userdetail[user_email]', 'Email', 'required|email|callback_email__unique_validate');
            
            if($userdetail["user_phone"] != ""){
                $this->form_validation->set_rules('userdetail[user_phone]', 'Phone Number ', 'numeric|regex_match[/^[0-9]{11}$/]');
                $this->form_validation->set_message('regex_match', 'Phone number only cantain 10 digits');
            }
            
            $data['method'] = 'post';
            $data['activeTab'] = "profile";

            if ($this->form_validation->run() == TRUE) {
               

                if (array_key_exists('image', $_FILES) && ($_FILES['image']['size'] > 0)) {
                    $filename = image_upload('image', 'user');

                    if (is_array($filename)) {
                        $userdetail['user_profile'] = 'assets/img/user/' . $filename['file_name'];
                        image_delete($userdetail['old_image'],"small");
                    }
                }
                $user_id = $userdetail['user_id'];
                unset($userdetail['old_image']);
                unset($userdetail['user_id']);
                unset($userdetail['method']);
                unset($userdetail['activeTab']);
               
                $userdetail['user_update'] = date("Y-m-d H:i:s");

                $res = $this->crm->rowUpdate('user', $userdetail, array('user_id' => $user_id));
                $this->session->set_flashdata('change_success', 'Profile updated Successfully');
                redirect('setting', 'refresh');
            }
        }

        $this->load->template('/setting/index', $data);
    }

    public function check_password() {
        $user = $this->session->userdata('logged_in');
        $data = $this->input->post('changepassword');

        $check_password = array(
            'user_id' => $user['user_id'],
            'user_password' => md5($data["old_user_password"])
        );


        $check = $this->crm->getRowCount('user', '', $check_password);

        if ($check > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_password', 'Old Password is incorrect.');
            return false;
        }
    }

    // Callback functions
    public function email__unique_validate($user_id) {

        $userdetail = $this->input->post('userdetail');
        $check_email = array(
            'user_id !=' => $userdetail['user_id'],
            'user_email' => $userdetail['user_email']
        );
        $check = $this->crm->getRowCount('user', '', $check_email);
        if ($check > 0) {
            $this->form_validation->set_message('email__unique_validate', 'The Email field must contain a unique value.');
            return false;
        } else {
            return TRUE;
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
