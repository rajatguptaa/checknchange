<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function upload_attachment() {

    $CI = & get_instance();
    $uploaddir = './assets/attachment/';
    $time = time();

    if ($_FILES['file']['name'] != '') {
        $type = checktype($_FILES['file']['name']);

        if (!file_exists($uploaddir . $type)) {
            mkdir($uploaddir . $type, 0777, true);
        }

        $uploadfile = $uploaddir . $type . '/' . $time . '_' . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {




            $data = array(
                'attachment_name' => $_FILES['file']['name'],
                'attachment_path' => "assets/attachment/$type" . '/' . $time . '_' . $_FILES['file']['name'],
                'attachment_name' => $_FILES['file']['name'],
                'attachment_type' =>$type,
                'attachment_update' => date("Y-m-d H:i:s")
            );
            $data['attchment_id'] = $CI->crm->rowInsert('attachment', $data);
            echo json_encode($data);
        }
    }
}

function delete_attachment() {

    $CI = & get_instance();

    if ($CI->input->post('id')) {
        $attch_id = $CI->input->post('id');
    }


    if (strpos($attch_id, ',') != FALSE) {
        $attch_data = explode(',', $attch_id);
    } else {
        $attch_data[] = $CI->input->post('id');
    }


    foreach ($attch_data as $val) {
        $ticket_attachment = $CI->crm->getData("attachment", 'attachment_path', array('attachment_id' => $val));
        if (!empty($ticket_attachment)) {
            $res = image_delete($ticket_attachment[0]['attachment_path']);
            if ($res) {
                $CI->crm->rowsDelete('attachment', array('attachment_id' => $val));
            }
        }
    }


    echo TRUE;
}

function get_preview($get_attachment) {

    if (!empty($get_attachment)) {
        foreach ($get_attachment as $key => $attch_value) {
            switch ($attch_value['attachment_type']) {
                case 'image':
                    $attch_data[] = '<img width="auto" height="160" src="' . base_url() . $attch_value['attachment_path'] . '"/>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;

                case 'video':
                    $attch_data[] = '<video width="auto" height="160" controls> <source src="' . base_url() . $attch_value['attachment_path'] . '"></video>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;
                case 'audio':

                    $attch_data[] = '<audio controls width="auto"> <source src="' . base_url() . $attch_value['attachment_path'] . '"></audio>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;
                default:
                case 'doc':
                    $string1 = "";
                    $myfile = fopen($attch_value['attachment_path'], "r");
                    while (!feof($myfile)) {
                        $string = trim(preg_replace('/\s\s+/', '\r\n', fgets($myfile)));
                        ;
                        $string1 .= str_replace("'", "\'", $string) . '\r\n';
                    }
                    fclose($myfile);


                    $attch_data[] = '<div class="file-preview-other-frame" width="auto" height="160" style="width:160px"><pre style="width:auto;height:160px;" title="Dump20140627.sql" class="file-preview-text"><code>' . $string1 . '</code></pre><button data-type="doc" title="View details: Dump20140627.sql" class="btn btn-default btn-xs btn-block btn-preview" type="button" data-id="' . $attch_value['attachment_id'] . '"><i class="glyphicon glyphicon-zoom-in" ></i></button></div>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;
                case 'object':
                   

                    $attch_data[] = '<object data="' . base_url() . $attch_value['attachment_path'] . '" type="pdf" width="210" height="132"></object><button data-value="' . base_url() . $attch_value['attachment_path'] . '" data-type="object" title="View details: Dump20140627.sql" class="btn btn-default btn-xs btn-block btn-preview" type="button" data-id="' . $attch_value['attachment_id'] . '"><i class="glyphicon glyphicon-zoom-in"></i></button>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;
                default:
                    $attch_data[] = '<div class="file-object"><div width="160" height="160" class="file-preview-other"><span class="file-icon-4x"><i class="glyphicon glyphicon-file"></i></span></div></div>';
                    $attch_info[] = array(
                        'caption' => $attch_value['attachment_name'],
                        'width' => '120px',
                        'url' => base_url() . 'ticketController/delete_attachment_relation/' . $attch_value['attachment_id'],
                        'key' => $attch_value['attachment_id']
                    );
                    break;
            }
        }

        if (!empty($attch_data)) {
            $pagedata['attachment'] = $attch_data;
        } else {
            $pagedata['attachment'] = array();
        }
        if (!empty($attch_data)) {
            $pagedata['attachment_info'] = json_encode($attch_info);
        } else {
            $pagedata['attachment_info'] = false;
        }

        return $pagedata;
    } else {
        return false;
    }
}

function checktype($str) {
    if ($str != '') {
        $type = explode('.', $str);

        $extenstion = $type[count($type) - 1];
        
        $return_var = 'extra';

        if ($extenstion == 'gif' || $extenstion == 'jpg'|| $extenstion == 'jpeg' || $extenstion == 'png' || $extenstion == 'bmp') {
            $return_var = 'image';
        }
        if ($extenstion == 'mp3' || $extenstion == 'wav' || $extenstion == 'cdfs' || $extenstion == 'mpeg') {
            $return_var = 'audio';
        }if ($extenstion == 'avi' || $extenstion == 'mp4' || $extenstion == 'mov') {
            $return_var = 'video';
        } if ($extenstion == 'txt' || $extenstion == 'sql' || $extenstion == 'js' || $extenstion == 'css') {
            $return_var = 'doc';
        } if ($extenstion == 'pdf') {
            $return_var = 'object';
        }
        
        
        return  $return_var;
    }
}
