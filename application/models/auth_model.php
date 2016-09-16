<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_login($email, $password) {
        $array = array('user_email' => $email, 'user_password' => $password,'user_status' => 1);
        $this->db->where($array);
        $this->db->select('user_id,user_access_level,user_status');
        $query = $this->db->get('user');
        $row = $query->result_array();
        return $row;
    }

    public function getUserDetails($user_id) {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');
        if($query->num_rows() > 0){
            $row = $query->result_array();
            return $row[0];
        }
        else{
            return 0;
        }
    }
    public function getOrganisationDetails($org_id) {
        $this->db->select('*');
        $this->db->where('organisation_id', $org_id);
        $query = $this->db->get('organisation');
        $row = $query->result_array();
        return $row[0];
    }
    public function getAmcDetails($amc_id) {
        $this->db->select('*');
        $this->db->where('id', $amc_id);
        $query = $this->db->get('amc');
        $row = $query->result_array();
        return $row[0];
    }
    public function getAdminDetails() {
        $this->db->select('*');
        $this->db->where('user_access_level', 1);
        $query = $this->db->get('user');
        $row = $query->result_array();
        return $row[0];
    }

}

?>
