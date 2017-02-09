<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('crm_model', 'crm');

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $module_name = $this->uri->segment(1);
        $access_column = "access_view";
        $module_action = $this->uri->segment(2);
    
        if ($this->uri->segment(2)) {
            switch ($module_action) {
                case "add":
                    $access_column = "access_insert";
                    break;
                case "edit":
                    $access_column = "access_update";
                    break;
                case "delete":
                    $access_column = "access_delete";
                    break;
            }
        }

        $module_check = $this->crm->getData("module", "module_id", array("module_name" => $module_name));

        if (!empty($module_check)) {
            $module_id = $module_check[0]['module_id'];
            $user = $this->session->userdata('logged_in');

            if ($this->crm->getRowCount("access", "access_id", array("access_level_id" => $user['user_access_level'], $access_column => 1, "access_module_id" => $module_id)) == 0) {
                redirect("extra/accessdenied", true);
            }
        }
    }

}
