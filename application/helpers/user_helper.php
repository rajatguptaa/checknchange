<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getLoginUser() {
     $CI = & get_instance();
     $user_details = $CI->session->userdata('logged_in');
     return $user_details['user_id'];
}

function getUserDetails($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();

	  $CI->load->model("auth_model");

	  $userDetails = $CI->auth_model->getUserDetails($user_id);

	  return $userDetails;
     } else
	  return false;
}

function getAdminDetails() {

     $CI = & get_instance();

     $CI->load->model("auth_model");

     $adminDetails = $CI->auth_model->getAdminDetails();

     return $adminDetails;
}

function userExist($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();

	  $CI->load->model("auth_model");

	  $userDetails = $CI->auth_model->getUserDetails($user_id);
	  if (!empty($userDetails)) {
	       return TRUE;
	  } else {
	       return FALSE;
	  }
     } else
	  return false;
}

function getUserName($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();

	  $CI->load->model("auth_model");

	  $userDetails = $CI->auth_model->getUserDetails($user_id);

	  if ($userDetails['user_name'] != NULL && $userDetails['user_name'] != "") {
	       return ucwords($userDetails['user_name']);
	  } else {
	       return "Guest";
	  }
     } else
	  return "Guest";
}

function getUserImage($user_id = NULL, $small = FALSE) {
     if ($user_id != NULL) {
	  $CI = & get_instance();

	  $CI->load->model("auth_model");

	  $userDetails = $CI->auth_model->getUserDetails($user_id);
	  if ($userDetails['user_profile'] != NULL && $userDetails['user_profile'] != "" && file_exists($userDetails['user_profile'])) {

	       $explod_name = explode('.', $userDetails['user_profile']);

	       if ($small == 'small') {
		    if (file_exists($explod_name[0] . '_' . $small . '.' . $explod_name[1])) {
			 $userDetails['user_profile'] = $explod_name[0] . '_' . $small . '.' . $explod_name[1];
		    }
	       }

	       return $userDetails['user_profile'];
	  } else {
	       return 'assets/images/default_avatar_male.jpg';
	  }
     } else
	  return "";
}

function getUserAccessDetails($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();



	  $join = array
	      (
	      array('table' => 'access_level',
		  'on' => 'access_level.access_level_id=user.user_access_level'),
	  );
	  $select_field = array('access_level_id', 'access_level_name', 'access_level_description');
	  $user_access_data = $CI->crm->getData('user', $select_field, array('user.user_id' => $user_id), $join);
	  if (!empty($user_access_data)) {
	       return $user_access_data[0];
	  } else {
	       return FALSE;
	  }
     } else
	  return FALSE;
}

function getUserOrginasationDetails($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();



	  $join = array
	      (
	      array('table' => 'user_organisation_rel',
		  'on' => 'user.user_id=user_organisation_rel.user_id'),
	      array('table' => 'organisation',
		  'on' => 'organisation.organisation_id=user_organisation_rel.organisation_id'),
	  );
	  $select_field = array('organisation.organisation_id', 'organisation_name', 'organisation_address', 'organisation_phone', 'organisation_logo', 'organisation_address2', 'city', 'postcode', 'organisation_extra', 'organisation_notes');
	  $user_orginasation_data = $CI->crm->getData('user', $select_field, array('user.user_id' => $user_id), $join);


	  if (!empty($user_orginasation_data)) {
	       return $user_orginasation_data[0];
	  } else {
	       return FALSE;
	  }
     } else
	  return FALSE;
}

function getUserGroupDetails($user_id = NULL) {
     if ($user_id != NULL) {
	  $CI = & get_instance();



	  $join = array
	      (
	      array('table' => 'user_group_rel',
		  'on' => 'user.user_id=user_group_rel.user_id'),
	      array('table' => 'group',
		  'on' => 'group.group_id=user_group_rel.group_id'),
	  );
	  $select_field = array('group.group_id', 'group_title');
	  $user_group_data = $CI->crm->getData('user', $select_field, array('user.user_id' => $user_id), $join);


	  if (!empty($user_group_data)) {
	       return $user_group_data;
	  } else {
	       return FALSE;
	  }
     } else
	  return FALSE;
}

function getAllGroupDetails() {

     $CI = & get_instance();

     $select_field = array('group.group_id', 'group_title');
     $group_data = $CI->crm->getData('group', $select_field);


     if (!empty($group_data)) {
	  return $group_data;
     } else {
	  return FALSE;
     }
}

function getOrganisationGroupDetails() {

     $CI = & get_instance();




     $select_field = array('group.group_id', 'group_title');
     $org_group_data = $CI->crm->getData('group', $select_field);


     if (!empty($org_group_data)) {
	  return $org_group_data;
     } else {
	  return FALSE;
     }
}

function checkCommentStatus($user_id = FALSE, $ticket_id = FALSE) {

     if ($ticket_id && $user_id) {
	  $CI = & get_instance();

	  $result = $CI->crm->getData('user', 'user_access_level', array('user_id' => $user_id));
	  if ($result) {
	       $accel_level = $result[0]['user_access_level'];
	       if ($accel_level == 1) {
		    return TRUE;
	       }
	  }

	  $ticket = $CI->crm->getData('ticket', '*', array('user_id' => $user_id, 'ticket_id' => $ticket_id));
	  if ($ticket) {
	       return TRUE;
	  }

	  $ticket_assign = $CI->crm->getData('ticket_assign', '*', array('user_id' => $user_id, 'ticket_id' => $ticket_id));
	  if ($ticket_assign) {
	       return TRUE;
	  }

	  return FALSE;
     } else
	  return FALSE;
}

function getEmployee($org_id) {
     if ($org_id != NULL) {
	  $CI = & get_instance();



	  $join = array
	      (
	      array('table' => 'user_organisation_rel',
		  'on' => 'user.user_id=user_organisation_rel.user_id'),
	      array('table' => 'organisation',
		  'on' => 'organisation.organisation_id=user_organisation_rel.organisation_id'),
	  );
	  $select_field = 'user.user_id,user_name';
	  $user_orginasation_data = $CI->crm->getData('user', $select_field, array('organisation.organisation_id' => $org_id, 'user_access_level' => 3), $join);


	  if (!empty($user_orginasation_data)) {
	       return $user_orginasation_data;
	  } else {
	       return FALSE;
	  }
     }

   

}

  function getUserByAccessLevel($access_level = 3) {

	  $CI = & get_instance();
	  $user_emp_data = $CI->crm->getData('user', 'first_name,last_name,user_name,user_id', array('user_access_level' => $access_level));

	  if (!empty($user_emp_data)) {
	       return $user_emp_data;
	  } else {
	       return FALSE;
	  }
     }
     
     function getAMC(){
	   $CI = & get_instance();
	  $user_emp_data = $CI->crm->getData('amc', '*', array('amc_status' => 1));

	  if (!empty($user_emp_data)) {
	       return $user_emp_data;
	  } else {
	       return FALSE;
	  }
     }
