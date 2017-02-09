<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function access_check($module_name, $module_action) {

    $access_column = "access_view";

    $CI = & get_instance();

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

    $module_check = $CI->crm->getData("module", "module_id", array("module_name" => $module_name));

    if (!empty($module_check)) {
        $module_id = $module_check[0]['module_id'];
        $user = $CI->session->userdata('logged_in');

        if ($CI->crm->getRowCount("access", "access_id", array("access_level_id" => $user['user_access_level'], $access_column => "1", "access_module_id" => $module_id)) == 0) {
//            echo $CI->db->last_query();
            
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}
