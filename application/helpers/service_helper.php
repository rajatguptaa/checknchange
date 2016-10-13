<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function amc_date_create($str_date, $amc_id) {
     $end_date = '';
     switch ($amc_id) {
	  case '1':
	       $end_date = date('Y-m-d H:i:s', strtotime("+1 years", strtotime($str_date)));
	       return $end_date;
	       break;

	  default:
	       $end_date = date('Y-m-d H:i:s', strtotime("+1 years", strtotime($str_date)));
	       return $end_date;
	       break;
     }
}

function amc_service_create($start_date, $amc_id) {

     $end_date = '';
     switch ($amc_id) {
	  case '1':
	       $end_date = date('Y-m-d H:i:s', strtotime("+1 month", strtotime($start_date)));
	       $start_date = date('Y-m-d H:i:s', strtotime("-5 day", strtotime($end_date)));
	       return array('start_date' => $start_date, 'end_date' => $end_date);
	       break;

	  default:
	       $end_date = date('Y-m-d H:i:s', strtotime("+1 month", strtotime($start_date)));
	       $start_date = date('Y-m-d H:i:s', strtotime("-5 day", strtotime($end_date)));
	       return array('start_date' => $start_date, 'end_date' => $end_date);
	       break;
     }

    
}
 
function getEmail($user_type=4){
      $CI = & get_instance();
	  $user_email_data = $CI->crm->getData('user', '*', array('user_access_level' => $user_type,'user_status'=>1));

	  if (!empty($user_email_data)) {
	       return $user_email_data;
	  } else {
	       return FALSE;
	  }
}
function getServiceDate(){
      $CI = & get_instance();
	  $due_date = $CI->crm->getData('amc_service', 'due_date', array('amc_service.start_date >=' => date('Y-m-d')));

	  if (!empty($due_date)) {
	       return $due_date;
	  } else {
	       return FALSE;
	  }
}
