<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menu_list($access_level, $postion) {

    $CI = & get_instance();

    $res = $CI->db->select('module.*')
            ->from('module')
            ->join('access', 'access_module_id = module_id')
            ->where('access.access_level_id', $access_level)
            ->where('access.access_view', 1)
            ->where('module.module_position', $postion)
            ->order_by("module_order", "asc")
            ->get();

    if ($res->num_rows() > 0) {

        $menu = $res->result_array();
        return $menu;
    } else {

        return array();
    }
}

function submenu_list($postion,$parent_menu_id) {
   
    
    $CI = & get_instance();

    $res = $CI->db->select('module.*')
            ->from('module')
//            ->join('access', 'access_module_id = module_id')
//            ->where('access.access_level_id', $access_level)
//            ->where('access.access_view', 1)
            ->where('module.module_position', $postion)
            ->where('module.module_parent', $parent_menu_id)
            ->order_by("module_order", "asc")
            ->get();
   
    if ($res->num_rows() > 0) {

        $menu = $res->result_array();
        return $menu;
    } else {

        return array();
    }
}

function dateFormate($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, DATE_FORMATE_CONSTANT);
}
function dateFormateOnly($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, DATE_FORMATE_CONSTANT_ONLY);
}

function getDay($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, GET_DAY_CONSTANT);
}
function getMonth($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, GET_MONTH_CONSTANT);
}
function getYear($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, GET_YEAR_CONSTANT);
}
function getTime($date) {
    $date_obj = date_create($date);
    return date_format($date_obj, GET_TIME_CONSTANT);
}









