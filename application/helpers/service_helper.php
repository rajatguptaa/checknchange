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
	       $end_date = date('d-m-Y H:i:s', strtotime("+1 years", strtotime($str_date)));
	       return $end_date;
	       break;

	  default:
	       $end_date = date('d-m-Y H:i:s', strtotime("+1 years", strtotime($str_date)));
	       return $end_date;
	       break;
     }
}

function amc_service_create($start_date, $amc_id, $user_id) {
     $CI = & get_instance();
     $amc = $CI->crm->getData('amc', 'amc_duration,amc_visit', array('id' => $amc_id));
     $amc_count = $CI->crm->getData('user_amc_rel', 'amc_count', array('amc_id' => $amc_id, 'user_id' => $user_id));

     if ($amc_count != $amc[0]['amc_visit']) {
	  $amc = (int) ceil(($amc[0]['amc_duration'] * 12) / $amc[0]['amc_visit']);
	  $duration = $amc[0]['amc_duration'] * 5;
	  $end_date = date('Y-m-d H:i:s', strtotime("+$amc month", strtotime($start_date)));
	  $start_date = date('Y-m-d H:i:s', strtotime("-$duration day", strtotime($end_date)));
	  return array('start_date' => $start_date, 'end_date' => $end_date);
     } else {
	  return FALSE;
     }
}






function first_time() {


      $start_date = date('Y-m-d H:i:s');
     $end_date = $start_date;
     return array('start_date' => $start_date, 'end_date' => $end_date);
}

function getEmail($user_type = 4) {
     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service',
	     'on' => 'amc_service.user_id=user.user_id'
	 )
     );
     $user_email_data = $CI->crm->getData('user', 'user.user_email,user.user_id', array('user.user_access_level' => $user_type, 'user_status' => 1, 'amc_service.start_date <=' => date('Y-m-d H:i:s')), $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'user.user_email');
//     echo $this->crm->db->last_query();die;
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getEmailHistory($user_type = 4) {
     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service_history',
	     'on' => 'amc_service_history.user_id=user.user_id',
	     'join' => 'inner'
	 )
     );
     $user_email_data = $CI->crm->getData('user', 'user.user_email,user.user_id', array('user.user_access_level' => $user_type, 'user_status' => 1), $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'user.user_email');
//     echo $this->crm->db->last_query();die;
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getServiceDate() {
     $CI = & get_instance();
     $due_date = $CI->crm->getData('amc_service', 'due_date', array('amc_service.start_date <=' => date('Y-m-d H:i:s')), FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, 'amc_service.due_date');

     if (!empty($due_date)) {
	  return $due_date;
     } else {
	  return FALSE;
     }
}

function getServiceDateHistory() {
     $CI = & get_instance();
     $due_date = $CI->crm->getData('amc_service_history', 'due_date', FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, 'amc_service_history.due_date');

     if (!empty($due_date)) {
	  return $due_date;
     } else {
	  return FALSE;
     }
}

function getAMCByFilter() {
     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service',
	     'on' => 'amc.id=amc_service.amc_id'
	 )
     );
     $user_email_data = $CI->crm->getData('amc', 'amc.id,amc.amc_name', array('amc.amc_type' => 'primary', 'amc_status' => 1, 'amc_service.start_date <=' => date('Y-m-d H:i:s')), $join, 'amc.amc_name', 'ASC', FALSE, FALSE, FALSE, 'amc.id');
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getAMCByFilterHistory() {
     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service_history',
	     'on' => 'amc.id=amc_service_history.amc_id',
	     'join' => 'inner'
	 )
     );
     $user_email_data = $CI->crm->getData('amc', 'amc.id,amc.amc_name', array('amc.amc_type' => 'primary', 'amc_status' => 1), $join, 'amc.amc_name', 'ASC', FALSE, FALSE, FALSE, 'amc.id');
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getUserByAccess($access_level = 3) {

     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service',
	     'on' => 'amc_service.user_id=user.user_id',
	     'join' => 'inner'
	 )
     );
     $user_email_data = $CI->crm->getData('user', 'user.first_name,user.last_name,user.user_id', array('user.user_access_level' => $access_level, 'user_status' => 1, 'amc_service.start_date <=' => date('Y-m-d Y-m-d H:i:s')), $join, 'user.first_name', 'ASC', FALSE, FALSE, FALSE, 'user.user_id');
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getUserByAccessHistory($access_level = 3) {

     $CI = & get_instance();
     $join = array(
	 array(
	     'table' => 'amc_service_history',
	     'on' => 'amc_service_history.user_id=user.user_id',
	     'join' => 'inner'
	 )
     );
     $user_email_data = $CI->crm->getData('user', 'user.first_name,user.last_name,user.user_id', array('user.user_access_level' => $access_level, 'user_status' => 1), $join, 'user.first_name', 'ASC', FALSE, FALSE, FALSE, 'user.user_id');
     if (!empty($user_email_data)) {
	  return $user_email_data;
     } else {
	  return FALSE;
     }
}

function getAmcDetail($amc_id) {

     $CI = & get_instance();
     $where = array('amc_service.id' => $amc_id);
     $join = array(
	 array(
	     'table' => 'amc',
	     'on' => 'amc.id=amc_service.amc_id'
	 ),
	 array(
	     'table' => 'user',
	     'on' => 'user.user_id=amc_service.user_id'
	 )
     );
     $user_email_data = $CI->crm->getData('amc_service', 'user.user_id,amc.id as service_id,amc.amc_name,user.first_name,last_name,amc_type,amc_service.due_date', $where, $join);
     if (!empty($user_email_data)) {
	  return $user_email_data[0];
     } else {
	  return FALSE;
     }
}
