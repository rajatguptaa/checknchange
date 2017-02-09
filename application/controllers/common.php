<?php

ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class Common extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function upload_attachment() {
        upload_attachment();
    }

    public function delete_attachment() {
        delete_attachment();
    }

    public function download($id) {

        $data = $this->crm->getData("attachment", "*", array("attachment_id" => $id));

        if ($data) {
            
            $filename = $data[0]['attachment_path'];
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header('Content-disposition: attachment;filename=' . basename($filename));
            header("Content-Transfer-Encoding: binary");
            header('Content-Length: ' . filesize($filename));
            readfile("$filename");
            
        }
    }

}
