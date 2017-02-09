<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class AccessController extends BaseController {

    private $tabelename;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }

        $this->tabelename = "access";
    }

    public function index() {

        $pagedata['mainHeading'] = 'Permission';

        // Loading CSS on view
        $pagedata["style_to_load"] = array(
            "assets/css/datatablenew/dataTables.responsive.css"
        );

        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/datatablenew/jquery.dataTables.js",
            "assets/js/datatablenew/dataTables.responsive.min.js",
            "assets/js/jquery.form.min.js",
            "assets/js/noty/packaged/jquery.noty.packaged.js"
        );

        $pagedata['access_level'] = $this->crm->getData('access_level', '*', array("access_level_id !=" => 1));

        echo $this->load->ajaxtemplate('/access/index', $pagedata, true);
    }

    public function getTableData() {

        $select = array("access.access_level_id", "access.access_module_id", "module.module_name", "access.access_view", "access.access_insert", "access.access_update", "access.access_delete");

        $access_level = $this->input->get("access_level");

//        $select = array("*");
        $where = array("access.access_level_id" => $access_level);
        $join = array(array(
                "table" => "access",
                "on" => "access.access_module_id = module.module_id"
        ));


        $data = $this->crm->getData("module", $select, $where, $join, "module_order", " ASC");

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => $data,
            "aaData" => []
        );


        foreach ($data as $key => $val) {
            if ($val['module_name'] != "access" || $access_level != 1) {

                $view = $val['access_view'] ? "checked" : "";
                $insert = $val['access_insert'] ? "checked" : "";
                $update = $val['access_update'] ? "checked" : "";
                $delete = $val['access_delete'] ? "checked" : "";
                if ($val['module_name'] != "support portal") {
                    $output['aaData'][] = array(
                        "DT_RowId" => $val['access_module_id'],
                        '<input value="' . $val['access_level_id'] . '" type="hidden"  ' . $view . ' class="tableflat" name="access[' . $key . '][access_level_id]">'
                        . '<input value="' . $val['access_module_id'] . '" type="hidden"  ' . $view . ' class="tableflat" name="access[' . $key . '][access_module_id]">' . ucfirst($val['module_name']),
                        '<input value="0" type="hidden" name="access[' . $key . '][access_view]">'
                        . '<input value="1" type="checkbox"  ' . $view . ' class="tableflat" name="access[' . $key . '][access_view]">',
                        '<input value="0" type="hidden" name="access[' . $key . '][access_insert]">'
                        . '<input value="1" type="checkbox"  ' . $insert . ' class="tableflat" name="access[' . $key . '][access_insert]">',
                        '<input value="0" type="hidden" name="access[' . $key . '][access_update]">'
                        . '<input value="1" type="checkbox"  ' . $update . ' class="tableflat" name="access[' . $key . '][access_update]">',
                        '<input value="0" type="hidden" name="access[' . $key . '][access_delete]">'
                        . '<input value="1" type="checkbox"  ' . $delete . ' class="tableflat" name="access[' . $key . '][access_delete]">'
                    );
                }
            }
        }

        echo json_encode($output);
    }

    public
            function edit() {
        $data = $this->input->post();

        if (!empty($data['access'])) {
            foreach ($data['access'] as $value) {
                $where = array(
                    "access_level_id" => $value['access_level_id'],
                    "access_module_id" => $value['access_module_id']
                );

                unset($value['access_level_id']);
                unset($value['access_module_id']);

                $this->crm->rowUpdate($this->tabelename, $value, $where);
            }
            echo json_encode(array("type" => "success", "message" => 'Access updated successfully.'));
        } else {
            echo json_encode(array("type" => "warning", "message" => 'Please select a access level.'));
        }
    }

}
