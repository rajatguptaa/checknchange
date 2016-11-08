<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class App extends CI_Controller{
     
     function __construct() {
	  parent::__construct();
     }
     public function index() {
	  $this->load->view('app/applogin');
	  
     }
     public function register() {
	  $this->load->view('app/appregister');
	  
     }
     public function booking() {
	  $this->load->view('app/appbooking');
	  
     }
}
