<?php

function image_upload($field_name, $upload_directory) {
    $CI = & get_instance();

    $upload_dir = "./assets/img/$upload_directory";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }
    $config['upload_path'] = $upload_dir;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['file_name'] = 'userimage_' . substr(md5(rand()), 0, 7);
    $config['overwrite'] = false;


    $CI->load->library('upload', $config);



    if (!$CI->upload->do_upload($field_name)) {
        return $CI->upload->display_errors();
    } else {
        $CI->upload_data['file'] = $CI->upload->data();
        $source_path = $upload_dir . '/' . $CI->upload_data['file']['file_name'];
        $target_path = $upload_dir . '/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => FALSE,
            'create_thumb' => TRUE,
            'thumb_marker' => '_small',
            'width' => 150,
            'height' => 150
        );
        $CI->load->library('image_lib', $config_manip);
        if (!$CI->image_lib->resize()) {
            echo $CI->image_lib->display_errors();
        }
        // clear //
        $CI->image_lib->clear();
        return $CI->upload_data['file'];
    }
}

function image_delete($filename, $small = false) {

    if ($filename != './') {

        if (file_exists($filename)) {

            if ($small == 'small') {

                $explode_file = explode('/', $filename);

                $name = $explode_file[count($explode_file) - 1];

                $explod_name = explode('.', $name);

                $small_name = $explod_name[0] . '_' . $small . '.' . $explod_name[1];

                unset($explode_file[count($explode_file) - 1]);
                $explode_file[] = $small_name;

                $smallPath = implode("/", $explode_file);

                if (file_exists($smallPath))
                    unlink($smallPath);
            }

            if (file_exists($filename)) {
                unlink($filename);
            }

            return true;
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function getOrganiasationImage($org_id = NULL, $small = FALSE) {
    if ($org_id != NULL) {
        $CI = & get_instance();
        $CI->load->model("auth_model");


        $orgDetails = $CI->auth_model->getOrganisationDetails($org_id);


        if ($orgDetails['organisation_logo'] != NULL && $orgDetails['organisation_logo'] != "" && file_exists($orgDetails['organisation_logo'])) {

            $explod_name = explode('.', $orgDetails['organisation_logo']);

            if ($small == 'small') {
                if (file_exists($explod_name[0] . '_' . $small . '.' . $explod_name[1])) {
                    $orgDetails['organisation_logo'] = $explod_name[0] . '_' . $small . '.' . $explod_name[1];
                }
            }

            return $orgDetails['organisation_logo'];
        } else {
            return 'assets/images/organisation_default.png';
        }
    } else
        return "";
}
function getAmcImage($amc_id = NULL, $small = FALSE) {
    if ($amc_id != NULL) {
        $CI = & get_instance();
        $CI->load->model("auth_model");


        $orgDetails = $CI->auth_model->getAmcDetails($amc_id);


        if ($orgDetails['package_logo'] != NULL && $orgDetails['package_logo'] != "" && file_exists($orgDetails['package_logo'])) {

            $explod_name = explode('.', $orgDetails['package_logo']);

            if ($small == 'small') {
                if (file_exists($explod_name[0] . '_' . $small . '.' . $explod_name[1])) {
                    $orgDetails['package_logo'] = $explod_name[0] . '_' . $small . '.' . $explod_name[1];
                }
            }

            return $orgDetails['package_logo'];
        } else {
            return 'assets/images/user.png';
        }
    } else
        return "";
}

function getUsersImage($user_id = NULL, $small = FALSE) {
    if ($user_id != NULL) {
        $CI = & get_instance();
        $CI->load->model("auth_model");


        $orgDetails = $CI->auth_model->getUserDetails($user_id);


        if ($orgDetails['user_profile'] != NULL && $orgDetails['user_profile'] != "" && file_exists($orgDetails['user_profile'])) {

            $explod_name = explode('.', $orgDetails['user_profile']);

            if ($small == 'small') {
                if (file_exists($explod_name[0] . '_' . $small . '.' . $explod_name[1])) {
                    $orgDetails['user_profile'] = $explod_name[0] . '_' . $small . '.' . $explod_name[1];
                }
            }

            return $orgDetails['user_profile'];
        } else {
            return 'assets/images/user.png';
        }
    } else
        return "";
}
function getOrganiasationName($org_id = NULL) {
    if ($org_id != NULL) {
        $CI = & get_instance();
        $CI->load->model("auth_model");


        $orgDetails = $CI->auth_model->getOrganisationDetails($org_id);
        if(!empty($orgDetails)){
         return $orgDetails['organisation_name'];
        }
    } 
}
function getOrganiasationTitle($org_id = NULL) {
    if ($org_id != NULL) {
        $CI = & get_instance();
        $CI->load->model("auth_model");


        $orgDetails = $CI->auth_model->getOrganisationDetails($org_id);
        if(!empty($orgDetails)){
         $data = array('title' => $orgDetails['organisation_title'],
                       'text'=>$orgDetails['organisation_text'],
                       'org_id'=>$orgDetails['organisation_id'],
                        );
         return $data;
        }
    } 
}

?>
