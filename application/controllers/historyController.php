<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HistoryController extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    
        $this->load->model('crm_model','crm');
         if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tabelename = "amc_history";
    }
    function index(){
        $pagedata['mainHeading'] = "AMC Service History";
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
        $this->load->template('/history/index', $pagedata);
    }
    
}