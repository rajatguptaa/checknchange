<?php

ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class TicketController extends BaseController {

    public function index() {


        $user = $this->session->userdata('logged_in');
        if ($user['user_access_level'] == 2) {
            $this->getCompactCustomerIndex();
        } else {
            $this->getEmployeeIndex();
        }
    }

    public function createEmployeeTicket($org_id) {
        $user = $this->session->userdata('logged_in');
        if ($user['user_access_level'] != 2) {

            $pagedata["style_to_load"] = array(
                "assets/css/datatablenew/dataTables.responsive.css",
                "assets/css/chosen/chosen.css",
                "assets/css/tags/bootstrap-tagsinput.css",
            );

            $pagedata['scripts_to_load'] = array(
                "assets/js/datatablenew/jquery.dataTables.js",
                "assets/js/datatablenew/dataTables.responsive.min.js",
                "assets/js/bootbox/bootbox.js",
                "assets/js/chosen/chosen.jquery.js",
                "assets/js/chosen/custom_chosen.js",
                "assets/js/modules/attchment.js",
                "assets/js/tags/bootstrap-tagsinput.js",
                "assets/js/jquery.form.min.js",
                "assets/js/noty/packaged/jquery.noty.packaged.js",
                "assets/js/modules/singleselect.js",
            );
            $pagedata['mainHeading'] = "Ticket";
            $user_id = getLoginUser();





            $pagedata['mainHeading'] = "Ticket";

            $pagedata['organisation'] = $this->crm->getData('organisation');


            $join = array(
                array('table' => 'user_organisation_rel',
                    'on' => 'user_organisation_rel.user_id=user.user_id'),
            );
            $where['user_access_level'] = 2;
            $where['user_status'] = 1;
            $where['user_organisation_rel.organisation_id'] = $org_id;
        
            $pagedata['customer_details'] = $this->crm->getData('user', 'user.user_id,user_name,user_email', $where, $join, 'user.user_update', 'DESC');
          

            $group = $this->crm->getData('group', '');


            $group_ids = array();
            $group_arr = array();
            foreach ($group as $key => $grp_val) {
                $group_arr[$grp_val['group_id']] = $grp_val;
                $group_ids[] = $grp_val['group_id'];
            }
            $where = array();
            $where['user_access_level'] = 3;
            $where['user_status'] = 1;
            $where['user_organisation_rel.organisation_id'] = $org_id;
            $select = 'user.user_id,user_name';
            $employee_details = $this->crm->getData('user', $select, $where, $join, 'user.user_update', 'DESC');


            $emp_arr = array();
            foreach ($employee_details as $key => $emp_val) {
                $emp_arr[$emp_val['user_id']] = $emp_val;
            }
            $finalEmpArray = array();
            if (!empty($group_ids)) {
                $user_group_rel = $this->crm->getWhereInData('user_group_rel', "*", $group_ids, "group_id");
                foreach ($user_group_rel as $value) {
                    if (isset($group_arr[$value['group_id']]) && isset($emp_arr[$value['user_id']]))
                        $finalEmpArray[$group_arr[$value['group_id']]['group_title'] . '_' . $value['group_id']][$value['user_id']] = $emp_arr[$value['user_id']];
                }
            }










            $pagedata['organisation_id'] = $org_id;
            $join = array(
                array('table' => 'user_organisation_rel',
                    'on' => 'user_organisation_rel.user_id=user.user_id'),
            );
            $where['user_access_level'] = 2;
            $where['user_status'] = 1;
            $where['user_organisation_rel.organisation_id'] = $org_id;
              $select = 'user.user_id,user_name,user_email';
            $pagedata['customer_details'] = $this->crm->getData('user', $select, $where, $join, 'user.user_update', 'DESC');


            $group = $this->crm->getData('group', '');


            $group_ids = array();
            $group_arr = array();
            foreach ($group as $key => $grp_val) {
                $group_arr[$grp_val['group_id']] = $grp_val;
                $group_ids[] = $grp_val['group_id'];
            }

            $where['user_access_level'] = 3;
            $where['user_status'] = 1;
            $where['user_organisation_rel.organisation_id'] = $org_id;
            $select = 'user.user_id,user_name';
            $employee_details = $this->crm->getData('user', $select, $where, $join, 'user.user_update', 'DESC');
            foreach ($employee_details as $key => $emp_val) {
                $emp_arr[$emp_val['user_id']] = $emp_val;
            }
            $finalEmpArray = array();
            if (!empty($group_ids)) {
                $user_group_rel = $this->crm->getWhereInData('user_group_rel', "*", $group_ids, "group_id");
                foreach ($user_group_rel as $value) {
                    if (isset($group_arr[$value['group_id']]) && isset($emp_arr[$value['user_id']]))
                        $finalEmpArray[$group_arr[$value['group_id']]['group_title'] . '_' . $value['group_id']][$value['user_id']] = $emp_arr[$value['user_id']];
                }
            }









            $pagedata['group'] = $finalEmpArray;
            if ($this->input->post()) {

                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

                $this->form_validation->set_rules('ticket_subject', 'Ticket Subject', 'required');
                $this->form_validation->set_rules('user_id', 'User', 'required');
                $this->form_validation->set_rules('ticket_type', 'Ticket Type', 'required');
                $this->form_validation->set_rules('ticket_priority', 'Ticket Priority', 'required');
                $this->form_validation->set_rules('ticket_description', 'Ticket Description', 'required');


                if ($this->form_validation->run() == FALSE) {
                    $this->load->template('/ticket/employee/create', $pagedata);
                } else {

                    $data = $this->input->post();
                    $cc_user =array();
                    if($this->input->post('user_cc')){
                    $cc = $this->input->post('user_cc');
                    if(!empty($cc)){
                      $cc_user = $cc;  
                    }
                    }
                    unset($data['attachment_id']);
                    unset($data['tags']);
                    unset($data['assign_user']);
                    unset($data['orginasation_name']);
                    unset($data['user_cc']);
                    $assign_user = $this->input->post('assign_user');

                    $data['ticket_status'] = 'Open';

                    $data['ticket_updated'] = date("Y-m-d H:i:s");
                    $data['ticket_created'] = date("Y-m-d H:i:s");
                    $data['organisation_id'] = $org_id;
                    $data['ticket_number'] = '#TKT' . random_string('numeric');
                    $attch_ids = $this->input->post('attachment_id');
                    if (strpos($attch_ids, ',')) {
                        $attachment_id = explode(',', $attch_ids);
                    } else {
                        $attachment_id[] = $attch_ids;
                    }

                    $ticket_id = $this->crm->rowInsert('ticket', $data);


                    if ($ticket_id) {
                        if (!empty($attachment_id)) {
                            foreach ($attachment_id as $attch_val) {
                                $attch_data = array(
                                    'ticket_id' => $ticket_id,
                                    'attachment_id' => $attch_val
                                );
                                $attch_id = $this->crm->rowInsert('ticket_attachment_rel', $attch_data);
                            }
                        }
                        $assign_user = $this->input->post('assign_user');

                        if ($assign_user != '') {
                            $assign_details = $this->crm->getData('ticket_assign', '*', array('ticket_id' => $ticket_id, 'current_working_user' => 1));


                            if (!empty($assign_details)) {
                                $parent_user = $assign_details[0]['user_id'];
                            } else {
                                $parent_user = 0;
                            }



                            $assignee = explode('_', $assign_user);
                            if ($parent_user != $assignee[0]) {
                                $assign_data = array(
                                    'assigned_by' => getLoginUser(),
                                    'ticket_id' => $ticket_id,
                                    'user_id' => $assignee[0],
                                    'group_id' => $assignee[1],
                                    'parent_user_id' => $parent_user,
                                    'ticket_assign_at' => date("Y-m-d H:i:s"),
                                    'current_working_user' => 1
                                );
                                if (!empty($assign_details)) {
                                    $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_assign_id' => $assign_details[0]['ticket_assign_id']));
                                }
                                $attch_id = $this->crm->rowInsert('ticket_assign', $assign_data);
                                $group_data = array(
                                    'ticket_id' => $ticket_id,
                                    'group_id' => $assignee[1],
                                    'ticket_group_update' => date("Y-m-d H:i:s")
                                );
                                $this->crm->rowsDelete('ticket_group_rel', array('ticket_id' => $ticket_id));
                                $grp_id = $this->crm->rowInsert('ticket_group_rel', $group_data);
                            }

                            $message = '';
                            $assign_at = '';
                            $assign_by = '';


                            // Email Content When Assign Ticket
                            $user_id = $assignee[0];
                            $user_details = getUserDetails($user_id);
                            $adminDetails = getAdminDetails();

                            $ticket_detail = $this->getTicketData($ticket_id, $org_id);

                            foreach ($ticket_detail['assign_user'] as $tkt) {
                                if ($tkt['current_working_user'] == 1) {
                                    $assign_at = $tkt['ticket_assign_at'];
                                    $assign_by = getUserName($tkt['assigned_by']);
                                }
                            }


                            $status_html = getStatus($ticket_detail['ticket_status']);
                            $priority_html = getPriority($ticket_detail['ticket_priority']);

                            $maildata['content'] = sprintf(TICKET_ASSIGN, $status_html, $ticket_detail['ticket_subject'], $ticket_detail['ticket_number'], $priority_html, $ticket_detail['ticket_description'], $assign_by, dateFormate($assign_at));

                            $maildata['ticket_detail'] = $ticket_detail;
                            $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                            $maildata['btntitle'] = 'View Ticket';
                            $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                            $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                            $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                            mymail($user_details['user_email'], TICKET_ASSIGN_SUB, $message,False,FALSE,FALSE);



                            // email for customer when ticket create   
                            $maildata = array();
                            $message = '';
                            $user_id = $data['user_id'];
                            $user_details = getUserDetails($user_id);
                            $adminDetails = getAdminDetails();
                            $maildata['content'] = sprintf(CUSTOMER_TICKET_CREATION, getUserName($user_id), $data['ticket_number']);
//                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
                            $maildata['ticket_detail'] = array();
                            $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                            $maildata['btntitle'] = 'View Ticket';
                            $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                            $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                            $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                            mymail($user_details['user_email'], TICKET_CREATE_SUB, $message,False,FALSE,FALSE);
                            // Admin Mail
//                        $message = '';
//                       $maildata['content'] = sprintf(ADMIN_TICKET_CREATION,getUserName($user_id),$data['ticket_number']);
////                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
////                      $maildata['ticket_detail'] = $ticket_detail;
//                      $maildata['link'] =base_url('request/ticket/view/'.$ticket_id);
//                      $maildata['btntitle'] ='View Ticket';
//                      $message .= $this->load->view('/email_template/email_header',FALSE,TRUE);
//                      $message .= $this->load->view('/email_template/email_view',$maildata,TRUE);
//                      $message .= $this->load->view('/email_template/email_footer',FALSE,TRUE);
//                      mymail($adminDetails['user_email'],TICKET_CREATE_SUB,$message);
                            $history_response = $this->crm->rowInsert('ticket_history', array('ticket_id' => $ticket_id, 'ticket_updated_by' => getLoginUser(), 'ticket_history_status' => $data['ticket_status'], 'ticket_history_created_at' => date('Y-m-d H:i:s')));
                        } else {
                            $count = $this->crm->getRowCount('ticket_assign', '*', array('ticket_id' => $ticket_id));
                            if ($count > 0) {
                                $updatedata['current_working_user'] = 0;
                                $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_id' => $ticket_id));
                            }
                            $message = '';
                            // Email Content When Created Ticket
                            $user_id = $data['user_id'];
                            $user_details = getUserDetails($user_id);
                            $adminDetails = getAdminDetails();
                            $maildata['content'] = sprintf(CUSTOMER_TICKET_CREATION, getUserName($user_id), $data['ticket_number']);
//                      
                            $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                            $maildata['btntitle'] = 'View Ticket';
                            $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                            $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                            $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                            mymail($user_details['user_email'], TICKET_CREATE_SUB, $message,False,FALSE,FALSE);
                            $maildata = array();
                            // Admin Mail
                            $message = '';
                            $maildata['content'] = sprintf(ADMIN_TICKET_CREATION, getUserName($user_id), $data['ticket_number']);
//                    
                            $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                            $maildata['btntitle'] = 'View Ticket';
                            $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                            $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                            $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                           
                            if(!empty($cc_user)){
                            mymail($adminDetails['user_email'], TICKET_CREATE_SUB, $message,False,FALSE,FALSE,FALSE);
                           }else{
                            mymail($adminDetails['user_email'], TICKET_CREATE_SUB, $message,False,FALSE,FALSE,$cc_user);
                           }
                        }





                        $tags = $this->input->post('tags');
                        if (!empty($tags)) {
                            foreach ($tags as $tag_val) {
                                // get group data 
                                if (is_numeric($tag_val)) {
                                    $tag_data = array(
                                        'tag_heading' => $tag_val,
                                        'organisation_id' => $org_id,
                                        'tag_created_at' => date("Y-m-d H:i:s")
                                    );
                                    // add group user detail 
                                    $last_tag_id = $this->crm->rowInsert('ticket_tag', $tag_data);
                                } else {
                                    $tag_id = explode('_', $tag_val);
                                    $create_tag = array(
                                        'tag_heading' => $tag_id[1],
                                        'organisation_id' => $org_id,
                                        'tag_created_at' => date("Y-m-d H:i:s")
                                    );
                                    $last_tag_id = $this->crm->rowInsert('ticket_tag', $create_tag);
                                    $ticket_tag_rel = array(
                                        'tag_id' => $last_tag_id,
                                        'ticket_id' => $ticket_id,
                                        'ticket_tag_update' => date("Y-m-d H:i:s")
                                    );
                                    // add group user detail 
                                    $tag_rel_id = $this->crm->rowInsert('ticket_tag_rel', $ticket_tag_rel);
                                }
                            }
                        }
                        
                        if(!empty($cc_user)){
                          foreach ($cc_user as $cc_data) {
                               
                                    $cc_data = array(
                                        'ticket_cc_email' => $cc_data,
                                        'ticket_id' => $ticket_id,
                                        'ticket_cc_created_at' => date("Y-m-d H:i:s")
                                    );
                                    // add group user detail 
                                    $last_tag_id = $this->crm->rowInsert('ticket_cc', $cc_data);
                               
                            }   
                            
                        }

                        $this->session->set_flashdata('ticket_success', 'Ticket Added Successfully');
                     redirect('request', 'refresh');
                    } else {
                        $this->session->set_flashdata('ticket_warning', 'Something went wrong');
                       redirect('request', 'refresh');
                    }
                }
            } else {
                $this->load->template('/ticket/employee/create', $pagedata);
            }
        } else {
            redirect('request', 'refresh');
        }
    }

    public function getCustomerIndex() {
        $pagedata["style_to_load"] = array(
            "assets/css/datatablenew/dataTables.responsive.css"
        );

        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/datatablenew/jquery.dataTables.js",
            "assets/js/datatablenew/dataTables.responsive.min.js",
            "assets/js/bootbox/bootbox.js"
        );
        $pagedata['mainHeading'] = "Ticket";
        $this->load->template('/ticket/customer/index', $pagedata);
    }

    public function getCompactCustomerIndex() {
        $pagedata["style_to_load"] = array(
            "assets/css/datatablenew/dataTables.responsive.css"
        );

        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/datatablenew/jquery.dataTables.js",
            "assets/js/datatablenew/dataTables.responsive.min.js",
            "assets/js/bootbox/bootbox.js"
        );
        $pagedata['mainHeading'] = "Ticket";
        $this->load->template('/ticket/customer/compactindex', $pagedata);
    }

//    public function getAdminIndex() {
//        $pagedata['mainHeading'] = "Ticket";
//        $pagedata["style_to_load"] = array(
//            "assets/css/common/style_grid.css", "assets/css/chosen/chosen.css"
//        );
//        // Loading JS on view
//        $pagedata['scripts_to_load'] = array(
//            "assets/js/jquery-ui-1.11.2.js", "assets/js/chosen/chosen.jquery.js", "assets/js/noty/packaged/jquery.noty.packaged.js"
//        );
//        $pagedata['organisation'] = $this->crm->getData('organisation');
//        $this->load->template('/ticket/employee/index', $pagedata);
//    }

    public function getEmployeeGridView($org_id) {
        $pagedata['mainHeading'] = "Ticket";
        $pagedata["style_to_load"] = array(
            "assets/css/common/style_grid.css", "assets/css/chosen/chosen.css",
        );
        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/jquery-ui-1.11.2.js", "assets/js/chosen/chosen.jquery.js", "assets/js/noty/packaged/jquery.noty.packaged.js", "assets/js/bootbox/bootbox.js", "assets/js/jquery.form.min.js",
        );
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['organisation_id'] = $org_id;
        $this->load->template('/ticket/employee/index', $pagedata);
    }

    public function createCustomerTicket() {
        $user = getLoginUser();
        $pagedata['mainHeading'] = "Ticket";
        $pagedata['subHeading'] = "Create";


        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/ckeditor/ckeditor.js"
        );

        $user_id = getLoginUser();
        $organisation_details = getUserOrginasationDetails($user_id);
        $org_id = $organisation_details['organisation_id'];
        if ($this->input->post()) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

            $this->form_validation->set_rules('ticket_subject', 'Ticket Subject', 'required');
            $this->form_validation->set_rules('ticket_description', 'Ticket Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/ticket/customer/create', $pagedata);
            } else {
                $data = $this->input->post();
                unset($data['attachment_id']);
                $data['user_id'] = $user;
                $data['ticket_status'] = 'Open';
                $data['ticket_updated'] = date("Y-m-d H:i:s");
                $data['ticket_created'] = date("Y-m-d H:i:s");
                $data['organisation_id'] = $org_id;
                $data['ticket_number'] = '#TKT' . random_string('numeric');
                $attch_ids = $this->input->post('attachment_id');
                if (strpos($attch_ids, ',')) {
                    $attachment_id = explode(',', $attch_ids);
                } else {
                    $attachment_id[] = $attch_ids;
                }

                $ticket_id = $this->crm->rowInsert('ticket', $data);
                if ($ticket_id) {
                    foreach ($attachment_id as $attch_val) {
                        $attch_data = array(
                            'ticket_id' => $ticket_id,
                            'attachment_id' => $attch_val
                        );
                        $attch_id = $this->crm->rowInsert('ticket_attachment_rel', $attch_data);
                    }

                    $ticket_detail = $this->getTicketData($ticket_id, $org_id);

                    $message = '';

                    $org = getUserOrginasationDetails($user_id);

                    $user_details = getUserDetails($user_id);
                    $adminDetails = getAdminDetails();
                    $maildata['content'] = sprintf(CUSTOMER_TICKET_CREATION, getUserName($user_id), $ticket_detail['ticket_number']);
//                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
//                      $maildata['ticket_detail'] = $ticket_detail;
                    $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                    $maildata['btntitle'] = 'View Ticket';
                    $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                    $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                    $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                    mymail($user_details['user_email'], TICKET_CREATE_SUB, $message);

                    // Admin Mail
                    $message = '';
                    $maildata = array();
                    $maildata['content'] = sprintf(ADMIN_TICKET_CREATION, getUserName($user_id), $ticket_detail['ticket_number']);
//                      $maildata['email_heading'] = sprintf(EMAILHEADING,$org['organisation_name']);
//                      $maildata['ticket_detail'] = $ticket_detail;
                    $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                    $maildata['btntitle'] = 'View Ticket';
                    $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                    $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                    $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                    mymail($adminDetails['user_email'], TICKET_CREATE_SUB, $message);
                    $this->session->set_flashdata('ticket_success', 'Ticket Added Successfully');
                    redirect('request', 'refresh');
                } else {
                    $this->session->set_flashdata('ticket_warning', 'Something went wrong');
                    redirect('request', 'refresh');
                }
            }
        } else {
            $this->load->template('/ticket/customer/create', $pagedata);
        }
    }

    public function editCustomerTicket($ticket_id) {
        $pagedata['mainHeading'] = "Ticket";
        $pagedata['subHeading'] = "Edit";
        $get_data = $this->crm->getData('ticket', "*", array("ticket_id" => $ticket_id));
        if (!empty($get_data)) {
            $pagedata['form_data'] = $get_data[0];
        }
        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/ckeditor/ckeditor.js"
        );

        $pagedata['method'] = 'get';

        $join[] = array(
            'table' => 'ticket_attachment_rel',
            'on' => 'ticket.ticket_id=ticket_attachment_rel.ticket_id',
            'join' => 'inner'
        );
        $join[] = array(
            'table' => 'attachment',
            'on' => 'ticket_attachment_rel.attachment_id=attachment.attachment_id',
            'join' => 'inner'
        );


        $select = 'ticket.ticket_id,attachment.attachment_id,attachment_path,attachment_name,attachment_type';
        $get_attachment = $this->crm->getData('ticket', $select, array("ticket.ticket_id" => $ticket_id,), $join);

        $preview_data = get_preview($get_attachment);
        $pagedata['attachment'] = $preview_data['attachment'];
        $pagedata['attachment_info'] = $preview_data['attachment_info'];

        if ($this->input->post()) {
            $pagedata['method'] = 'post';
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');

            $this->form_validation->set_rules('ticket_subject', 'Ticket Subject', 'required');
            $this->form_validation->set_rules('ticket_description', 'Ticket Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->template('/ticket/customer/edit', $pagedata);
            } else {
                $data = $this->input->post();

                unset($data['attachment_id']);
                unset($data['ticket_id']);

                $data['ticket_status'] = 'Open';
                $data['ticket_updated'] = date("Y-m-d H:i:s");
                $attch_ids = $this->input->post('attachment_id');
                $attachment_id = array();
                if (strpos($attch_ids, ',')) {
                    $attachment_id = explode(',', $attch_ids);
                } else {
                    if ($attch_ids != '') {
                        $attachment_id[] = $attch_ids;
                    }
                }

                $ticket_id = $this->input->post('ticket_id');
                $this->crm->rowUpdate('ticket', $data, array('ticket_id' => $ticket_id));
                if ($ticket_id) {
                    if (!empty($attachment_id)) {
                        foreach ($attachment_id as $attch_val) {
                            $attch_data = array(
                                'ticket_id' => $ticket_id,
                                'attachment_id' => $attch_val
                            );
                            $attch_id = $this->crm->rowInsert('ticket_attachment_rel', $attch_data);
                        }
                    }
                    $this->session->set_flashdata('ticket_success', 'Ticket Edit Successfully');
                    redirect('request', 'refresh');
                } else {
                    $this->session->set_flashdata('ticket_warning', 'Something went wrong');
                    redirect('request', 'refresh');
                }
            }
        } else {
            $this->load->template('/ticket/customer/edit', $pagedata);
        }
    }

    public function showTicket($ticket_id) {

        $pagedata['scripts_to_load'] = array(
            "assets/js/datepicker/moment.js",
            "assets/js/chosen/custom_chosen.js",
            "assets/js/chosen/custom_chosen.js",
            "assets/js/datepicker/bootstrap-datetimepicker.js",
            "assets/js/datepicker/jquery.timepicker.js",
            "assets/js/jquery.form.min.js",
            "assets/js/noty/packaged/jquery.noty.packaged.js",
           
        );
        $pagedata['style_to_load'] = array(
            "assets/css/chosen/chosen.css",
            "assets/css/datepicker/bootstrap-datetimepicker.css",
            "assets/css/datepicker/jquery.timepicker.css"
        );
        $pagedata['method'] = 'get';
        $pagedata['mainHeading'] = "Ticket";
        $pagedata['subHeading'] = "View";
        $user = $this->session->userdata('logged_in');
        $get_data = $this->crm->getData('ticket', "*", array("ticket_id" => $ticket_id));
        if (!empty($get_data)) {
            $pagedata['form_data'] = $get_data[0];
            $org_id = $get_data[0]['organisation_id'];
                 $join_new = array(
                array('table' => 'user_organisation_rel',
                    'on' => 'user_organisation_rel.user_id=user.user_id'),
            );
            $user_where['user_access_level'] = 2;
            $user_where['user_status'] = 1;
            $user_where['user_organisation_rel.organisation_id'] = $org_id;
        
            $pagedata['customer_details'] = $this->crm->getData('user', 'user.user_id,user_name,user_email', $user_where, $join_new, 'user.user_update', 'DESC');   
        }


        $join[] = array(
            'table' => 'ticket_attachment_rel',
            'on' => 'ticket.ticket_id=ticket_attachment_rel.ticket_id',
            'join' => 'inner'
        );
        $join[] = array(
            'table' => 'attachment',
            'on' => 'ticket_attachment_rel.attachment_id=attachment.attachment_id',
            'join' => 'inner'
        );


        $select = 'ticket.ticket_id,attachment.attachment_id,attachment_path,attachment_name,attachment_type';
        $get_attachment = $this->crm->getData('ticket', $select, array("ticket.ticket_id" => $ticket_id,), $join);

        $preview_data = get_preview($get_attachment);
        $pagedata['group'] = $this->crm->getData('group', '');
        $pagedata['attachment'] = $preview_data['attachment'];
        $pagedata['attachment_info'] = $preview_data['attachment_info'];
            

        // get Assign User Detail 
     





        if ($user['user_access_level'] != 2) {
            $join1 = array(
                array(
                    'table' => 'user',
                    'on' => 'user.user_id=ticket_assign.user_id'),
                array(
                    'table' => 'user as uasb',
                    'on' => 'uasb.user_id=ticket_assign.assigned_by'),
                array(
                    'table' => 'working_hour',
                    'on' => 'working_hour.user_id=ticket_assign.user_id AND working_hour.ticket_id = ticket_assign.ticket_id')
            );
            $where1 = array('ticket_assign.ticket_id' => $ticket_id);
            $ticketAssignData = array();
            $ticketAssignData = $this->crm->getData('ticket_assign', 'ticket_assign.group_id,ticket_assign.ticket_assign_id,ticket_assign.current_working_user,ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign.ticket_assign_at,user.user_name as assignee,uasb.user_name as assigned_by_user,working_hour.minutes,ticket_assign.user_id as assigni_id', $where1, $join1, 'ticket_assign.ticket_assign_at', FALSE, '', '', '');

            $pagedata['emplyeeTime'] = $ticketAssignData;

            // get tag
            $tag = $this->crm->getData('ticket_tag', '', array('organisation_id' => $org_id));
            $tag_ids = array();
            $tag_arr = array();
            if (!empty($tag)) {
                foreach ($tag as $key => $tag_val) {
                    $tag_arr[$tag_val['tag_id']] = $tag_val;
                    $tag_ids[] = $tag_val['tag_id'];
                }
            }
            $tag_array = array();
            if (!empty($tag_arr)) {
                $ticket_tag_rel = $this->crm->getData('ticket_tag_rel', "*", array('ticket_id' => $ticket_id));

                foreach ($ticket_tag_rel as $value) {
                    if (isset($tag_arr[$value['tag_id']]) && isset($value['tag_id']))
                        $tag_array[$value['tag_id']] = $tag_arr[$value['tag_id']];
                }
            }


            $pagedata['tag'] = $tag_array;
        }
        if ($this->input->post()) {
            
            $data = $this->input->post();
            $pagedata['method'] = 'post';
            unset($data['attachment_id']);
            unset($data['tags']);
            unset($data['assign_user']);
            unset($data['user_cc']);
            $data['ticket_updated'] = date("Y-m-d H:i:s");
            $attch_ids = $this->input->post('attachment_id');
            $attachment_id = array();
            if (strpos($attch_ids, ',')) {
                $attachment_id = explode(',', $attch_ids);
            } else {
                if ($attch_ids != '') {
                    $attachment_id[] = $attch_ids;
                }
            }

             $cc_user =array();
                    if($this->input->post('user_cc')){
                    $cc = $this->input->post('user_cc');
                    if(!empty($cc)){
                      $cc_user = $cc;  
                    }
             }

            if ($ticket_id) {
                $pre_staus = getPreviousStatus($ticket_id);
                $this->crm->rowUpdate('ticket', $data, array('ticket_id' => $ticket_id));


                if (!empty($attachment_id)) {
                    foreach ($attachment_id as $attch_val) {
                        $attch_data = array(
                            'ticket_id' => $ticket_id,
                            'attachment_id' => $attch_val
                        );
                        $attch_id = $this->crm->rowInsert('ticket_attachment_rel', $attch_data);
                    }
                }
                $assign_user = $this->input->post('assign_user');
             $ticket_detail = $this->getTicketData($ticket_id, $org_id);
                if ($assign_user != '') {
                    $assign_details = $this->crm->getData('ticket_assign', '*', array('ticket_id' => $ticket_id, 'current_working_user' => 1));


                    if (!empty($assign_details)) {
                        $parent_user = $assign_details[0]['user_id'];
                    } else {
                        $parent_user = 0;
                    }

                   
                    $assignee = explode('_', $assign_user);
                    if ($parent_user != $assignee[0]) {
                        $assign_data = array(
                            'assigned_by' => getLoginUser(),
                            'ticket_id' => $ticket_id,
                            'user_id' => $assignee[0],
                            'group_id' => $assignee[1],
                            'parent_user_id' => $parent_user,
                            'ticket_assign_at' => date("Y-m-d H:i:s"),
                            'current_working_user' => 1
                        );
                        if (!empty($assign_details)) {
                            $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_assign_id' => $assign_details[0]['ticket_assign_id']));
                        }
                        $attch_id = $this->crm->rowInsert('ticket_assign', $assign_data);
                        $group_data = array(
                            'ticket_id' => $ticket_id,
                            'group_id' => $assignee[1],
                            'ticket_group_update' => date("Y-m-d H:i:s")
                        );
                        $this->crm->rowsDelete('ticket_group_rel', array('ticket_id' => $ticket_id));
                        $grp_id = $this->crm->rowInsert('ticket_group_rel', $group_data);
                        $message = '';
                        $assign_at = '';
                        $assign_by = '';


                        // Email Content When Assign Ticket

                        $user_id = $assignee[0];
                        $user_details = getUserDetails($user_id);
                        $adminDetails = getAdminDetails();



                        if (!empty($ticket_detail['assign_user'])) {
                            foreach ($ticket_detail['assign_user'] as $tkt) {
                                if ($tkt['current_working_user'] == 1) {
                                    $assign_at = $tkt['ticket_assign_at'];
                                    $assign_by = getUserName($tkt['assigned_by']);
                                }
                            }
                        }
            
                        $status_html = getStatus($ticket_detail['ticket_status']);
                        
                        $priority_html = getPriority($ticket_detail['ticket_priority']);


                        $maildata['content'] = sprintf(TICKET_ASSIGN, $status_html, $ticket_detail['ticket_subject'], $ticket_detail['ticket_number'], $priority_html, $ticket_detail['ticket_description'], $assign_by, dateFormate($assign_at));
            
                        $maildata['ticket_detail'] = $ticket_detail;
                        $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                        $maildata['btntitle'] = 'View Ticket';
                        $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                        $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                        $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                  
                        mymail($user_details['user_email'], TICKET_ASSIGN_SUB, $message);
                    } else {
                        $message = '';
                        $ticket_detail = $this->getTicketData($ticket_id, $org_id);
                        if ($ticket_detail['ticket_status'] == 'Solved') {
                          
                        $user_details = getUserDetails($assignee[0]);
                        $customer_details = getUserDetails($ticket_detail['user_id']);
                        $status_html = getStatus($ticket_detail['ticket_status']);
                        $maildata['content'] = sprintf(TICKET_SOLVED_STATUS, $status_html, $ticket_detail['ticket_number'], dateFormate(date("Y-m-d H:i:s")));

                        $maildata['ticket_detail'] = $ticket_detail;
                        $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                        $maildata['btntitle'] = 'View Ticket';
                        $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                        $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                        $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                mymail($customer_details['user_email'], TICKET_SOLVED_SUB, $message,FALSE,FALSE,FALSE,$cc_user);
            } else {  
                            
                            $ticket_detail = $this->getTicketData($ticket_id, $org_id);
                            
                            
                            if($pre_staus != $ticket_detail['ticket_status']){
                            $message = '';
                            $maildata = array();

                            $customer_details = getUserDetails($ticket_detail['user_id']);
                            $status_html = getStatus($ticket_detail['ticket_status']);
                            $maildata['content'] = sprintf(TICKET_CHANGE_STATUS, $status_html, $ticket_detail['ticket_number'], $ticket_detail['ticket_status'], dateFormate(date("Y-m-d H:i:s")));

                            $maildata['ticket_detail'] = $ticket_detail;
                            $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                            $maildata['btntitle'] = 'View Ticket';
                            $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                            $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                            $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
            
                            mymail($customer_details['user_email'], TICKET_CHANGE_SUB, $message,FALSE,FALSE,FALSE,$cc_user);
                        }
                    }
                    }
                } else {
                    $count = $this->crm->getRowCount('ticket_assign', '*', array('ticket_id' => $ticket_id));
                    if ($count > 0) {

                        $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_id' => $ticket_id));
                    }
                }

                $history_response = $this->crm->rowInsert('ticket_history', array('ticket_id' => $ticket_id, 'ticket_updated_by' => getLoginUser(), 'ticket_history_status' => $ticket_detail['ticket_status'], 'ticket_history_created_at' => date('Y-m-d H:i:s')));
                $tags = $this->input->post('tags');
                $this->crm->rowsDelete('ticket_tag_rel', array('ticket_id' => $ticket_id));
                if (!empty($tags)) {
                    foreach ($tags as $tag_val) {
                        // get group data 
                        if (is_numeric($tag_val)) {
                            $tag_data = array(
                                'tag_id' => $tag_val,
                                'ticket_id' => $ticket_id,
                                'ticket_tag_update' => date("Y-m-d H:i:s")
                            );
                            // add group user detail 
                            $last_tag_id = $this->crm->rowInsert('ticket_tag_rel', $tag_data);
                        } else {
                            $tag_id = explode('_', $tag_val);
                            $create_tag = array(
                                'tag_heading' => $tag_id[1],
                                'organisation_id' => $org_id,
                                'tag_created_at' => date("Y-m-d H:i:s")
                            );
                            $last_tag_id = $this->crm->rowInsert('ticket_tag', $create_tag);
                            $ticket_tag_rel = array(
                                'tag_id' => $last_tag_id,
                                'ticket_id' => $ticket_id,
                                'ticket_tag_update' => date("Y-m-d H:i:s")
                            );
                            // add group user detail 
                            $tag_rel_id = $this->crm->rowInsert('ticket_tag_rel', $ticket_tag_rel);
                        }
                    }
                }
                    $this->crm->rowsDelete('ticket_cc',array('ticket_id'=>$ticket_id));
                if (!empty($cc_user)) {
                    foreach ($cc_user as $cc_val) {
                            $update_cc =  array(
                                        'ticket_cc_email' => $cc_val,
                                        'ticket_id' => $ticket_id,
                                        'ticket_cc_created_at' => date("Y-m-d H:i:s")
                                    );
                                 
                                    $last_tag_id = $this->crm->rowInsert('ticket_cc', $update_cc);
                        
                    }
                }

                $this->session->set_flashdata('ticket_success', 'Ticket Assign Successfully');
       
                redirect("request/ticket/view/$ticket_id", 'refresh');
            } else {
                $this->session->set_flashdata('ticket_warning', 'Something went wrong');
           
                redirect("request/ticket/view/$ticket_id");
            }
        } else {
            $this->load->template('/ticket/customer/view', $pagedata);
        }
    }

    public function deleteTicket($ticket_id) {
        if ($ticket_id) {
            $join[] = array(
                'table' => 'ticket_attachment_rel',
                'on' => 'ticket.ticket_id=ticket_attachment_rel.ticket_id');

            $select = 'ticket_attachment_rel.attachment_id';
            $get_attachment = $this->crm->getData('ticket', $select, array("ticket.ticket_id" => $ticket_id,), $join);

            if (!empty($get_attachment)) {
                foreach ($get_attachment as $val) {
                    $ticket_attachment = $this->crm->getData("attachment", 'attachment_path', array('attachment_id' => $val['attachment_id']));
                    if (!empty($ticket_attachment)) {
                        $res = image_delete($ticket_attachment[0]['attachment_path']);
                        if ($res) {
                            $this->crm->rowsDelete('attachment', array('attachment_id' => $val['attachment_id']));
                        }
                    }
                }

                $res = $this->crm->rowsDelete('ticket', array('ticket_id' => $ticket_id));
                if ($res) {
                    $this->crm->rowsDelete('ticket_attachment_rel', array('ticket_id' => $ticket_id));
                    $this->session->set_flashdata('ticket_success', 'Ticket Deleted Successfully');
                    redirect('request', 'refresh');
                } else {
                    $this->session->set_flashdata('ticket_warning', 'Something went wrong');
                    redirect('request', 'refresh');
                }
            } else {
                $this->session->set_flashdata('ticket_warning', 'Something went wrong');
                redirect('request', 'refresh');
            }
        }
    }

    public function delete_attachment_relation($id) {
        if (strpos($id, ',') != FALSE) {
            $attch_data = explode(',', $id);
        } else {
            $attch_data[] = $id;
        }

        foreach ($attch_data as $val) {
            $ticket_attachment = $this->crm->getData("attachment", 'attachment_path', array('attachment_id' => $val));
            if (!empty($ticket_attachment)) {
                $res = image_delete($ticket_attachment[0]['attachment_path']);
                if ($res) {
                    $this->crm->rowsDelete('attachment', array('attachment_id' => $val));
                    $this->crm->rowsDelete('ticket_attachment_rel', array('attachment_id' => $val));
                }
            }
        }

        echo TRUE;
    }

    public function getCustomerTicket() {

        $col_sort = array("ticket_id", "ticket_subject", "ticket_description", "ticket_status", "ticket_created");
        $select = array("ticket_id", "ticket_subject", "ticket_description", "ticket_status", "ticket_created", "ticket_updated");

        $order_by = "ticket_created";
        $order = 'DESC';

        $str_point = FALSE;
        $lenght = 10;

        $search_array = FALSE;

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            $search_array = array();
            for ($i = 0; $i < count($col_sort); $i++) {
                $search_array[$col_sort[$i]] = $words;
            }
        }

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
        }

        $user_id = getLoginUser();
        $data = $this->crm->getData('ticket', $select, array('user_id' => $user_id), FALSE, $order_by, $order, $lenght, $str_point, $search_array);
        $rowCount = $this->crm->getRowCount('ticket', $select, FALSE, FALSE, $order_by, $order, $search_array);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $rowCount,
            "iTotalDisplayRecords" => $rowCount,
            "aaData" => []
        );

        $edit_acccess = access_check("ticket", "edit");
        $delete_acccess = access_check("ticket", "delete");
        $view_acccess = access_check("ticket", "view");
        $i = 1;
        foreach ($data as $val) {

            $link = "";
            if ($view_acccess) {
                $link .= '<a id="editticket" class="btn btn-info btn-xs" href="' . base_url('request/ticket/view/' . $val['ticket_id']) . '" title="View" data_id="' . $val['ticket_id'] . '" ><i class="glyphicon glyphicon-zoom-in"></i> View</a>'
                        . '&nbsp;&nbsp;';
            }
// Code for delete and edit button 

            if ($edit_acccess) {
                $link .= '<a id="editticket" class="btn btn-success btn-xs" href="' . base_url('request/customer/edit/' . $val['ticket_id']) . '" title="Edit" data_id="' . $val['ticket_id'] . '" ><i class="fa fa-edit"></i> Edit</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['ticket_id'] . '"><i class="fa fa-trash-o"></i> Delete</a>';
            }

            if ($val['ticket_status'] == 'Solved') {
//               echo date('Y-m-d H:i:s', strtotime($val["ticket_updated"] . " +48 hours")).'<br>';
                $future_date = strtotime(date('Y-m-d H:i:s', strtotime($val["ticket_updated"] . " +48 hours")));
                $ticket_time = strtotime($val["ticket_updated"]);
                $current_time = time();
                if ($current_time < $future_date) {
                    $link .= '<a class="btn btn-warning btn-xs"  href="' . base_url('request/customer/reopen/' . $val['ticket_id']) . '" title="Reopen" data-id="' . $val['ticket_id'] . '"><i class="fa fa-undo"></i> Reopen</a>';
                }
            }


            $output['aaData'][] = array(
                "DT_RowId" => $val['ticket_id'],
                $i,
                $val['ticket_subject'],
                "<span class=$val[ticket_status]>" . ucfirst($val['ticket_status']) . '</span>',
                dateFormate($val['ticket_created']),
                $link
            );
            $i++;
        }

        echo json_encode($output);
        die;
    }

    public function getCompactCustomerTicket() {

        $col_sort = array("ticket_id", "ticket_number", "ticket_subject", "ticket_description", "ticket_status", "ticket_created");
        $select = array("ticket_id", "ticket_number", "ticket_subject", "ticket_description", "ticket_status", "ticket_created", "organisation_id", 'ticket_status');

        $order_by = "ticket_created";
        $order = 'DESC';

        $str_point = FALSE;
        $lenght = 10;

        $search_array = FALSE;

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            $search_array = array();
            for ($i = 0; $i < count($col_sort); $i++) {
                $search_array[$col_sort[$i]] = $words;
            }
        }

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
        }

        $user_id = getLoginUser();
        $data = $this->crm->getData('ticket', $select, array('user_id' => $user_id), FALSE, $order_by, $order, $lenght, $str_point, $search_array);
        $rowCount = $this->crm->getRowCount('ticket', $select, FALSE, FALSE, $order_by, $order, $search_array);

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $rowCount,
            "iTotalDisplayRecords" => $rowCount,
            "aaData" => []
        );

        $edit_acccess = access_check("ticket", "edit");
        $delete_acccess = access_check("ticket", "delete");
        $view_acccess = access_check("ticket", "view");
        $i = 1;
        $html = "";
        foreach ($data as $val) {

            $link = "";
            if ($view_acccess) {
                $link .= '<a id="editticket" class="btn btn-info btn-xs" href="' . base_url('request/ticket/view/' . $val['ticket_id']) . '" title="View" data_id="' . $val['ticket_id'] . '" ><i class="glyphicon glyphicon-zoom-in"></i> View</a>'
                        . '&nbsp;&nbsp;';
            }
// Code for delete and edit button 

            if ($edit_acccess) {
                $link .= '<a id="editticket" class="btn btn-success btn-xs" href="' . base_url('request/customer/edit/' . $val['ticket_id']) . '" title="Edit" data_id="' . $val['ticket_id'] . '" ><i class="fa fa-edit"></i> Edit</a>'
                        . '&nbsp;&nbsp;';
            }

            if ($delete_acccess) {
                $link .= '<a class="btn btn-danger btn-xs delete" title="Delete" data-id="' . $val['ticket_id'] . '"><i class="fa fa-trash-o"></i> Delete</a>';
            }

            $date_a = new DateTime(date("Y-m-d H:i:s"));
            $date_b = new DateTime($val['ticket_created']);
            $interval = date_diff($date_a, $date_b);
            $time = explode(':', $interval->format('%y:%m:%d'));
            $date_str = '';
            if ($time[0] >= 1) {
                $date_str .= $time[0] . ' year';
            }
            if ($time[1] >= 1) {
                $date_str .= $time[1] . ' month';
            }
            if ($time[2] >= 1) {
                $date_str .= $time[2] . ' day';
            }
            $ticketData = $this->getTicketData($val['ticket_id'], $val["organisation_id"]);

            $working_user = '';
            $assign_at = '';
            $assign_by = '';

            if (!empty($ticketData['assign_user'])) {

                foreach ($ticketData['assign_user'] as $value) {

                    if ($value['current_working_user'] == 1) {
                        $working_user = getUserName($value['user_id']);
                        $assign_at = dateFormate($value['ticket_assign_at']);
                        $assign_by = getUserName($value['assigned_by']);
                    }
                }
            }
            $html = '<div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-1 col-sm-1 hidden-xs">
                                                    <img class="img img-responsive" src="' . base_url('assets/images/add-ticket.png') . '">
                                                </div>
                                                <div class="col-md-11 col-sm-11">
                                                    <div class="row"><div class="col-md-9"><h3><a href="' . base_url('request/ticket/view/' . $val['ticket_id']) . '">' . $val['ticket_number'] . '</a></h3></div><div class="pull-right"><span class=' . $val['ticket_status'] . '>' . $val['ticket_status'] . '</span></div></div>
                                                    <div class="row">' . $val['ticket_description'] . '</div>
                                                    <div class="row">Submitted about ' . $date_str . ' ago</div>
                                                    <div class="row">';


            if (strlen($working_user) > 0) {
                $html .= '                                        <p class="bottom_div">
                                                            Ticket Assigne To ' . $working_user . ' <a href="' . base_url('request/ticket/view/' . $val['ticket_id']) . '"> View request history </a>
                                                        </p>';
            } else {
                $html .= '                                        <p class="bottom_div">
                                                            Awaiting assignment to a support agent <a href="' . base_url('request/ticket/view/' . $val['ticket_id']) . '"> View request history </a>
                                                        </p>';
            }
            $html .= ' </div>
                                                </div>
                                            </div>';


            $output['aaData'][] = array(
                "DT_RowId" => $val['ticket_id'],
                $html,
//                $val['ticket_subject'],
//                "<span class=$val[ticket_status]>" . ucfirst($val['ticket_status']) . '</span>',
//                dateFormate($val['ticket_update']),
//                $link
            );
            $i++;
        }

        echo json_encode($output);
        die;
    }

    // get all backlog task for organisation...

    public function getBacklogData($org_id, $user_id) {

        if ($org_id != 0) {
            $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status' => 'Pending');
        } else {

            $where = array('ticket.ticket_status' => 'Pending');
        }
        $backlogData = $this->crm->getData('ticket', 'ticket.*', $where, FALSE, FALSE, FALSE);

        if (!empty($backlogData)) {
            echo json_encode($backlogData);
            die;
        } else {
            echo 'No backlog';
            die;
        }
    }

    // get all pending task for organisation...
    public function getToDoData($org_id, $user_id = FALSE) {
        $join = array(
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket_assign.ticket_id=ticket.ticket_id'),
        );
        if ($user_id) {
            $where = "(organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND (current_working_user = 1) AND ((ticket_status = 'Open') OR (ticket_status = 'Pending'))";
//            $where = array('organisation_id' => $org_id, 'ticket_status' => 'Open', 'ticket_assign.user_id' => $user_id, 'current_working_user' => 1);
        } else {
            $where = "(organisation_id = $org_id) AND ((ticket_status = 'Open') OR (ticket_status = 'Pending'))";
        }
        $todoData = $this->crm->getData('ticket', 'ticket.*,ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign_at', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, array('ticket.ticket_id'));



        if (!empty($todoData)) {
            echo json_encode($todoData);
            die;
        } else {
            echo 'No Todo';
            die;
        }
    }

    // get all open task for organisation...
    public function getDoingData($org_id, $user_id = FALSE) {
        $join = array(
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket_assign.ticket_id=ticket.ticket_id'),
        );
        if ($user_id) {
            $where = array('organisation_id' => $org_id, 'ticket_status' => 'Doing', 'ticket_assign.user_id' => $user_id, 'current_working_user' => 1);
        } else {
            $where = array('organisation_id' => $org_id, 'ticket_status' => 'Doing');
        }
        $backlogData = $this->crm->getData('ticket', 'ticket.*,ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign_at', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, array('ticket_id'));

        if (!empty($backlogData)) {
            echo json_encode($backlogData);
            die;
        } else {
            echo 'No Doing';
            die;
        }
    }

    // get all done  task for organisation...
    public function getDoneData($org_id, $user_id = FALSE) {
        $join = array(
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket_assign.ticket_id=ticket.ticket_id'),
        );
        if ($user_id) {
            $where = array('organisation_id' => $org_id, 'ticket_status' => 'Solved', 'ticket_assign.user_id' => $user_id, 'current_working_user' => 1);
        } else {
            $where = array('organisation_id' => $org_id, 'ticket_status' => 'Solved');
        }
        $backlogData = $this->crm->getData('ticket', 'ticket.*,ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign_at', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, array('ticket_id'));

        if (!empty($backlogData)) {
            echo json_encode($backlogData);
            die;
        } else {
            echo 'No Done';
            die;
        }
    }

    //change ticket status...
    public function changeTicketStatus() {
        $ticket_id = $this->input->post('ticket_id');
        $response = $this->crm->rowUpdate('ticket', array('ticket_status' => $this->input->post('status'), 'ticket_updated' => date('Y-m-d H:i:s')), array('ticket_id' => $ticket_id));

        if ($response) {

            $user_id = $this->input->post('user_id');
            $ticket_detail = getTicketDetails($ticket_id);
            if ($this->input->post('status') == 'Solved') {


                $message = '';

                $org = getUserOrginasationDetails($user_id);

                $user_details = getUserDetails($user_id);
                $customer_details = getUserDetails($ticket_detail['user_id']);


                $status_html = getStatus($ticket_detail['ticket_status']);

                $maildata['content'] = sprintf(TICKET_SOLVED_STATUS, $status_html, $ticket_detail['ticket_number'], dateFormate(date("Y-m-d H:i:s")));

                $maildata['ticket_detail'] = $ticket_detail;
                $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                $maildata['btntitle'] = 'View Ticket';
                $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                mymail($customer_details['user_email'], TICKET_SOLVED_SUB, $message);
            } else {

                $message = '';

                $org = getUserOrginasationDetails($user_id);

                $user_details = getUserDetails($user_id);
                $customer_details = getUserDetails($ticket_detail['user_id']);


                $status_html = getStatus($ticket_detail['ticket_status']);

                $maildata['content'] = sprintf(TICKET_CHANGE_STATUS, $status_html, $ticket_detail['ticket_number'], $ticket_detail['ticket_status'], dateFormate(date("Y-m-d H:i:s")));

                $maildata['ticket_detail'] = $ticket_detail;
                $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                $maildata['btntitle'] = 'View Ticket';
                $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                mymail($customer_details['user_email'], TICKET_CHANGE_SUB, $message);
            }
            $history_response = $this->crm->rowInsert('ticket_history', array('ticket_id' => $this->input->post('ticket_id'), 'ticket_updated_by' => $this->input->post('user_id'), 'ticket_history_status' => $this->input->post('status'), 'ticket_history_created_at' => date('Y-m-d H:i:s')));
            if ($history_response) {
                echo '1';
                die;
            } else {
                echo '0';
                die;
            }
        } else {
            echo '0';
            die;
        }
    }

    // ajax call for get ticket details...
    public function getTicketDetail($ticket_id) {

        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
        );

        $where = array('ticket.ticket_id' => $ticket_id);
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater', $where, $join, FALSE, FALSE);


        $join1 = array(
            array(
                'table' => 'user',
                'on' => 'user.user_id=ticket_assign.user_id'),
            array(
                'table' => 'user as uasb',
                'on' => 'uasb.user_id=ticket_assign.assigned_by'),
            array(
                'table' => 'working_hour',
                'on' => 'working_hour.user_id=ticket_assign.user_id AND working_hour.ticket_id = ticket_assign.ticket_id')
        );

        $where1 = array('ticket_assign.ticket_id' => $ticket_id);
        $ticketAssignData = array();
        $ticketAssignData = $this->crm->getData('ticket_assign', 'ticket_assign.ticket_assign_id,ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign.ticket_assign_at,user.user_name as assignee,uasb.user_name as assigned_by_user,working_hour.minutes,ticket_assign.user_id as assigni_id', $where1, $join1, 'ticket_assign_at', 'DESC', '', '', '');
        $time_total = 0;

        $emplyeeTime = array();

        foreach ($ticketAssignData as $key => $assignee_info) {
            $assignee_info['user_image'] = base_url() . getUserImage($assignee_info['assigni_id']);
            $time_total += $assignee_info['minutes'];
            $min = $assignee_info['minutes'];
            unset($assignee_info['minutes']);
            if (!isset($emplyeeTime[$assignee_info['assigni_id']])) {
                $emplyeeTime[$assignee_info['assigni_id']] = $assignee_info;
                $emplyeeTime[$assignee_info['assigni_id']]['minutes'] = $min;
            } else {
                $emplyeeTime[$assignee_info['assigni_id']]['minutes'] += $min;
            }
        }
        $emplyeeTime = array_values($emplyeeTime);
        $join2 = array(
            array(
                'table' => 'ticket_history',
                'on' => 'ticket_history.ticket_updated_by=user.user_id')
        );

        $where2 = array('ticket_history.ticket_id' => $ticket_id);
        $ticket_history = $this->crm->getData('user', 'user.user_name as updated_by_user', $where2, $join2, 'ticket_history.ticket_history_created_at', 'DESC', 1);
        if (!empty($ticketData)) {
            $creater_detail = getUserAccessDetails($ticketData[0]['user_id']);
            $ticket_history['creater_level'] = $creater_detail['access_level_name'];
            if (isset($ticketAssignData[0])) {
                $emplyeeTime[0]['ticket_assign_at'] = dateFormate($ticketAssignData[0]['ticket_assign_at']);
            }
            $ticketData[0]['ticket_created'] = dateFormate($ticketData[0]['ticket_created']);
        }

        // get ticket working hour 



        if (!empty($ticketData)) {
            echo json_encode(array('ticket_detail' => $ticketData, 'ticket_assign_data' => $emplyeeTime, 'history' => $ticket_history, 'total_time' => $time_total));
            die;
        } else {
            echo '0';
            die;
        }
    }

    public function changePriority() {

        $response = $this->crm->rowUpdate('ticket', array('ticket_priority' => $this->input->post('priority'), 'ticket_updated' => date('Y-m-d H:i:s')), array('ticket_id' => $this->input->post('ticket_id')));
        if ($response) {

            echo '1';
            die;
        } else {
            echo '0';
            die;
        }
    }

    public function getTicketView($ticket_id) {
        $pagedata['mainHeading'] = "Ticket";
        $pagedata['subHeading'] = "View";
        $get_data = $this->crm->getData('ticket', "*", array("ticket_id" => $ticket_id));
        if (!empty($get_data)) {
            $pagedata['form_data'] = $get_data[0];
        }


        $join[] = array(
            'table' => 'ticket_attachment_rel',
            'on' => 'ticket.ticket_id=ticket_attachment_rel.ticket_id',
            'join' => 'inner'
        );
        $join[] = array(
            'table' => 'attachment',
            'on' => 'ticket_attachment_rel.attachment_id=attachment.attachment_id',
            'join' => 'inner'
        );


        $select = 'ticket.ticket_id,attachment.attachment_id,attachment_path,attachment_name,attachment_type';
        $get_attachment = $this->crm->getData('ticket', $select, array("ticket.ticket_id" => $ticket_id,), $join);

        $preview_data = get_preview($get_attachment);
        $pagedata['attachment'] = $preview_data['attachment'];
        $pagedata['attachment_info'] = $preview_data['attachment_info'];

        $this->load->template('/employee/ticket_view', $pagedata);
    }

    public function assignTicket() {
        $user = $this->session->userdata('logged_in');
        if ($user['user_access_level'] != 2) {
            if ($this->input->post()) {

                $data = $this->input->post();
                if ($data['ticket_id'] !== '') {
                    $ticket_id_arr = array();
                    if (strpos($data['ticket_id'], ',')) {
                        $ticket_id_arr = explode(',', $data['ticket_id']);
                    } else {
                        $ticket_id_arr[] = $data['ticket_id'];
                    }


                    $org_id = $data['org_id'];
                    foreach ($ticket_id_arr as $ticket_id_val) {
                        $ticket_id = $ticket_id_val;


                        if ($ticket_id) {
                            unset($data['assign_user']);
                            unset($data['ticket_id']);
                            unset($data['org_id']);
                            unset($data['tags']);
                            $data['ticket_updated'] = date("Y-m-d H:i:s");
                            $this->crm->rowUpdate('ticket', $data, array('ticket_id' => $ticket_id));


                            if (!empty($attachment_id)) {
                                foreach ($attachment_id as $attch_val) {
                                    $attch_data = array(
                                        'ticket_id' => $ticket_id,
                                        'attachment_id' => $attch_val
                                    );
                                    $attch_id = $this->crm->rowInsert('ticket_attachment_rel', $attch_data);
                                }
                            }
                            $assign_user = $this->input->post('assign_user');

                            if ($assign_user != '') {
                                $assign_details = $this->crm->getData('ticket_assign', '*', array('ticket_id' => $ticket_id, 'current_working_user' => 1));


                                if (!empty($assign_details)) {
                                    $parent_user = $assign_details[0]['user_id'];
                                } else {
                                    $parent_user = 0;
                                }


                                $ticket_detail = $this->getTicketData($ticket_id, $org_id);
                                $assignee = explode('_', $assign_user);
                                if ($parent_user != $assignee[0]) {
                                    $assign_data = array(
                                        'assigned_by' => getLoginUser(),
                                        'ticket_id' => $ticket_id,
                                        'user_id' => $assignee[0],
                                        'group_id' => $assignee[1],
                                        'parent_user_id' => $parent_user,
                                        'ticket_assign_at' => date("Y-m-d H:i:s"),
                                        'current_working_user' => 1
                                    );
                                    if (!empty($assign_details)) {
                                        $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_assign_id' => $assign_details[0]['ticket_assign_id']));
                                    }
                                    $attch_id = $this->crm->rowInsert('ticket_assign', $assign_data);
                                    $group_data = array(
                                        'ticket_id' => $ticket_id,
                                        'group_id' => $assignee[1],
                                        'ticket_group_update' => date("Y-m-d H:i:s")
                                    );
                                    $this->crm->rowsDelete('ticket_group_rel', array('ticket_id' => $ticket_id));
                                    $grp_id = $this->crm->rowInsert('ticket_group_rel', $group_data);
                                    $message = '';
                                    $assign_at = '';
                                    $assign_by = '';


                                    // Email Content When Assign Ticket

                                    $user_id = $assignee[0];
                                    $user_details = getUserDetails($user_id);
                                    $adminDetails = getAdminDetails();




                                    foreach ($ticket_detail['assign_user'] as $tkt) {
                                        if ($tkt['current_working_user'] == 1) {
                                            $assign_at = $tkt['ticket_assign_at'];
                                            $assign_by = getUserName($tkt['assigned_by']);
                                        }
                                    }
                                    $priority_html = getPriority($ticket_detail['ticket_priority']);
                                    $status_html = getStatus($ticket_detail['ticket_status']);



                                    $maildata['content'] = sprintf(TICKET_ASSIGN, $status_html, $ticket_detail['ticket_subject'], $ticket_detail['ticket_number'], $priority_html, $ticket_detail['ticket_description'], $assign_by, dateFormate($assign_at));

                                    $maildata['ticket_detail'] = $ticket_detail;
                                    $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                                    $maildata['btntitle'] = 'View Ticket';
                                    $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                                    $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                                    $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                                    mymail($user_details['user_email'], TICKET_ASSIGN_SUB, $message);
                                    $history_response = $this->crm->rowInsert('ticket_history', array('ticket_id' => $ticket_id, 'ticket_updated_by' => getLoginUser(), 'ticket_history_status' => $ticket_detail['ticket_status'], 'ticket_history_created_at' => date('Y-m-d H:i:s')));
                                } else {


                                    $message = '';
                                    $maildata = array();

                                    $ticket_detail = $this->getTicketData($ticket_id, $org_id);
                                    $customer_details = getUserDetails($ticket_detail['user_id']);
                                    $status_html = getStatus($ticket_detail['ticket_status']);
                                    $maildata['content'] = sprintf(TICKET_CHANGE_STATUS, $status_html, $ticket_detail['ticket_number'], $ticket_detail['ticket_status'], dateFormate(date("Y-m-d H:i:s")));

                                    $maildata['ticket_detail'] = $ticket_detail;
                                    $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                                    $maildata['btntitle'] = 'View Ticket';
                                    $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                                    $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                                    $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                                    mymail($customer_details['user_email'], TICKET_CHANGE_SUB, $message);
                                }
                            } else {
                                $count = $this->crm->getRowCount('ticket_assign', '*', array('ticket_id' => $ticket_id));
                                if ($count > 0) {

                                    $this->crm->rowUpdate('ticket_assign', array('current_working_user' => 0), array('ticket_id' => $ticket_id));
                                }
                            }



                            $tags = $this->input->post('tags');


                            $this->crm->rowsDelete('ticket_tag_rel', array('ticket_id' => $ticket_id));
                            if (!empty($tags)) {
                                foreach ($tags as $tag_val) {
                                    // get group data 
                                    if (is_numeric($tag_val)) {
                                        $tag_data = array(
                                            'tag_id' => $tag_val,
                                            'ticket_id' => $ticket_id,
                                            'ticket_tag_update' => date("Y-m-d H:i:s")
                                        );
                                        // add group user detail 
                                        $last_tag_id = $this->crm->rowInsert('ticket_tag_rel', $tag_data);
                                    } else {
                                        $tag_id = explode('_', $tag_val);
                                        $create_tag = array(
                                            'tag_heading' => $tag_id[1],
                                            'organisation_id' => $org_id,
                                            'tag_created_at' => date("Y-m-d H:i:s")
                                        );
                                        $last_tag_id = $this->crm->rowInsert('ticket_tag', $create_tag);
                                        $ticket_tag_rel = array(
                                            'tag_id' => $last_tag_id,
                                            'ticket_id' => $ticket_id,
                                            'ticket_tag_update' => date("Y-m-d H:i:s")
                                        );
                                        // add group user detail 
                                        $tag_rel_id = $this->crm->rowInsert('ticket_tag_rel', $ticket_tag_rel);
                                    }
                                }
                            }
                        }
                    }
                    $this->session->set_flashdata('ticket_success', 'Ticket Assign Successfully');
                    redirect("request", 'refresh');
                } else {
//                $this->session->set_flashdata('ticket_warning', 'First Select Ticket');
                    redirect("request", 'refresh');
                }
            }
        } else {
            
        }
    }

    public function getTicketData($ticket_id, $org_id) {
        $user_id = getLoginUser();

        $organisation_details = getUserOrginasationDetails($user_id);

        $join1 = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
        );

        $where = array('ticket.ticket_id' => $ticket_id);
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater', $where, $join1, FALSE, FALSE);
        if (!empty($ticketData)) {
            $ticketData = $ticketData[0];


            if ($ticketData['ticket_status'] == 'Pending') {
//        return $ticketData;
            }

            $user_join = array(
                array(
                    'table' => 'user',
                    'on' => 'user.user_id=ticket_assign.user_id'),
            );

            $employee_details = $this->crm->getData('ticket_assign', '*', array('ticket_id' => $ticket_id, 'current_working_user' => 1), $user_join);
            $emp_arr = array();
            if (!empty($employee_details)) {
                foreach ($employee_details as $key => $emp_val) {
                    $emp_arr[$emp_val['user_id'] . '_' . $emp_val['group_id']] = $emp_val;
                }
            }
            $ticketData['assign_user'] = $emp_arr;

            $attch_join = array(array(
                    'table' => 'ticket_attachment_rel',
                    'on' => 'ticket.ticket_id=ticket_attachment_rel.ticket_id',
                    'join' => 'inner'
                ), array(
                    'table' => 'attachment',
                    'on' => 'ticket_attachment_rel.attachment_id=attachment.attachment_id',
                    'join' => 'inner'
            ));



            $select = 'ticket.ticket_id,attachment.attachment_id,attachment_path,attachment_name,attachment_type';
            $get_attachment = $this->crm->getData('ticket', $select, array("ticket.ticket_id" => $ticket_id,), $attch_join);


            $ticketData['ticket_attachment'] = $get_attachment;

            $tag = $this->crm->getData('ticket_tag', '', array('organisation_id' => $org_id));
            $tag_ids = array();
            $tag_arr = array();
            if (!empty($tag)) {
                foreach ($tag as $key => $tag_val) {
                    $tag_arr[$tag_val['tag_id']] = $tag_val;
                    $tag_ids[] = $tag_val['tag_id'];
                }
            }
            $tag_array = array();
            if (!empty($tag_arr)) {
                $ticket_tag_rel = $this->crm->getData('ticket_tag_rel', "*", array('ticket_id' => $ticket_id));

                foreach ($ticket_tag_rel as $value) {
                    if (isset($tag_arr[$value['tag_id']]) && isset($value['tag_id']))
                        $tag_array[$value['tag_id']] = $tag_arr[$value['tag_id']];
                }
            }
            $ticketData['tag'] = $tag_array;
            return $ticketData;
        }
        else {
            return FALSE;
        }
    }

    public function getTag() {

        if ($this->input->post('organisation_id')) {
            $tag_data = array();
            $tag_data = $this->crm->getData('ticket_tag', '', array('organisation_id' => $this->input->post('organisation_id')));
            if (!empty($tag_data)) {
                echo json_encode($tag_data);
            } else {
                return false;
            }
        }
    }

    public function getEmployeeIndex() {
        $pagedata['mainHeading'] = "Ticket";
        $pagedata['subHeading'] = "View";
        $pagedata["style_to_load"] = array(
            "assets/css/common/style_grid.css", "assets/css/chosen/chosen.css", "assets/css/pagination/simplePagination.css"
        );
        // Loading JS on view
        $pagedata['scripts_to_load'] = array(
            "assets/js/jquery-ui-1.11.2.js", "assets/js/chosen/chosen.jquery.js", "assets/js/chosen/custom_chosen.js", "assets/js/noty/packaged/jquery.noty.packaged.js", "assets/js/pagination/simplePagination.js");



        $user_id = getLoginUser();
        $organisation_details = getUserOrginasationDetails($user_id);
        $pagedata['organisation_id'] = $organisation_details['organisation_id'];
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['user_id'] = $user_id;
        $pagedata['group'] = $this->crm->getData('group', '');
        $user = $this->session->userdata('logged_in');



//        if ($user['user_access_level'] == 3) {
//           $this->TicketCount($pagedata['organisation_id'],$user_id);
//        } else {
//           $this->TicketCount($pagedata['organisation_id'],FALSE);
//        }

        $this->load->template('/ticket/employee/ticket_table_view', $pagedata);
    }

    public function ticketTableView() {
        $ticket_type = $this->input->post('type');
        if ($this->input->post('user_id') <= 1) {
            $user_id = '';
        } else {
            $user_id = $this->input->post('user_id');
        }
        if ($this->input->post('offset') <= 1) {
            $offset = 1;
        } else {
            $offset = $this->input->post('offset');
        }
        $org_id = $this->input->post('org_id');


        $limit = 5;
        $ticketData = array();
        switch ($ticket_type) {

            #############################################################
            case '1':
                $heading = 'New,Open or Pending';
               
                if ($user_id != '') {
                     $join = array(
                  array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );
                    $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Open' OR `ticket`.`ticket_status` = 'Pending')";
                } else {
                  $join=array();  
                  $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open' OR `ticket`.`ticket_status` = 'Pending')";
                }
                $ticketData = $this->crm->getData('ticket', 'ticket.*', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)), FALSE);
                $get = $this->crm->getData('ticket', 'ticket.*', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE);
                $count = count($get);
                break;
            #############################################################
            #############################################################
            case '2': $heading = 'Unassigned tickets';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                );


                $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status' => 'Open', 'ticket_assign.ticket_id' => null);
                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)), FALSE, 'ticket.ticket_id');
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
                $count = count($get);

                break;





            #############################################################
            #############################################################
            case '3': $heading = 'All unsolved tickets';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id')
                );
                if ($user_id == '') {
                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.current_working_user = 1) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing') OR (ticket.ticket_status = 'Pending'))";
                } else {
                  
                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND (ticket_assign.current_working_user = 1) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing') OR (ticket.ticket_status = 'Pending'))";
              
                }
                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE);
                $count = count($get);

                break;
            #############################################################


            case '4': $heading = 'Recently updated tickets';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_history',
                        'on' => 'ticket_history.ticket_id=ticket.ticket_id'
                    ),
                    array(
                        'table' => 'user as uasb',
                        'on' => 'uasb.user_id=ticket_history.ticket_updated_by')
                );
                $time_stamp = date("Y-m-d H:i:s");
                $last_time_stamp = (date('Y-m-d h:i:s', strtotime('-1 hour')));
                if ($user_id == '') {
                    $where = "ticket.organisation_id = '$org_id' AND (ticket_history_created_at BETWEEN '$last_time_stamp'  AND '$time_stamp')";
                } else {
                    $where = "(ticket.organisation_id = '$org_id') AND (ticket_history.ticket_updated_by = '$user_id') AND (ticket_history_created_at BETWEEN '$last_time_stamp'  AND '$time_stamp')";
                }


                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status', $where, $join, FALSE, FALSE);
                $count = count($get);



                break;

            case '5': $heading = 'New ticket in your group';

                $group = getUserGroupDetails($user_id);


                $group_arr = array();
                $grp_id = array();
                foreach ($group as $grp_val) {
                    $group_arr[$grp_val['group_id']] = $grp_val;
                    $grp_id[] = $grp_val['group_id'];
                }

                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );


                $where = array('ticket.organisation_id' => $org_id, 'ticket_assign.user_id' => $user_id);
                $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
                $count = count($get);
                $ticketData = array();
                if (!empty($ticket_rel_Data)) {
                    foreach ($ticket_rel_Data as $key => $value) {
                        if (isset($group_arr[$value['group_id']]))
                            $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
                    }
                }
                break;



            #############################################################
            case '6': $heading = 'All tickets';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                );

//                if ($user_id == '') {
                    $where = array('ticket.organisation_id' => $org_id);
//                } else {
//                    $join[] = array(
//                        'table' => 'ticket_assign',
//                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id');
//
//                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND (ticket_assign.current_working_user = 1)";
//                }


                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE);
                $count = count($get);

                break;
            #############################################################


            case '7': $heading = 'Recently Closed';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_history',
                        'on' => 'ticket_history.ticket_id=ticket.ticket_id'
                    ),
                    array(
                        'table' => 'user as uasb',
                        'on' => 'uasb.user_id=ticket_history.ticket_updated_by')
                );
                $time_stamp = date("Y-m-d h:i:s");
                $last_time_stamp = (date('Y-m-d h:i:s', strtotime('-1 day')));
                if ($user_id == '') {
                    $where = "(ticket_history_status = 'Closed') AND (ticket.ticket_status = 'Closed')   AND (ticket.organisation_id = '$org_id') AND (ticket_updated BETWEEN '$last_time_stamp'  AND '$time_stamp')";
                } else {
                    $where = "(ticket_history_status = 'Closed') AND (ticket.ticket_status = 'Closed') AND (ticket.organisation_id = '$org_id') AND (ticket_history.ticket_updated_by = '$user_id') AND (ticket_updated BETWEEN '$last_time_stamp'  AND '$time_stamp')";
                }
                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status as ticket_status', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status as ticket_status', $where, $join, FALSE, FALSE);

                $count = count($get);
                break;

            case '8':
                $heading = 'Unsolved tickets in your groups';
                $group = getUserGroupDetails($user_id);
                $group_arr = array();
                $grp_id = array();
                if (!empty($group)) {
                    foreach ($group as $grp_val) {
                        $group_arr[$grp_val['group_id']] = $grp_val;
                        $grp_id[] = $grp_val['group_id'];
                    }
                }
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );

                $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing'))";
//                $where = array('ticket.organisation_id' => $org_id, 'ticket_assign.user_id' => $user_id, 'ticket.ticket_status != ' => 'Solved', 'ticket.ticket_status !=' => 'Pending');

                $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
                $count = count($get);
                foreach ($ticket_rel_Data as $key => $value) {
                    if (isset($group_arr[$value['group_id']]))
                        $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
                }


                break;
            case '9': $heading = 'New ticket in Group';
                $group = getOrganisationGroupDetails();
                $group_arr = array();
                $grp_id = array();
                if (!empty($group)) {
                    foreach ($group as $grp_val) {
                        $group_arr[$grp_val['group_id']] = $grp_val;
                        $grp_id[] = $grp_val['group_id'];
                    }
                }
                $join = array(
                    array(
                        'table' => 'ticket',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );
                $condition = array('ticket.ticket_status' => 'Open');
                $ticket = array();
                if (!empty($grp_id)) {
                    $ticket = $this->crm->getWhereInData('ticket_assign', "*", $grp_id, "group_id", $join, $condition);
                }

                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );

                $ticket_rel_Data = array();
                $ticket_arr = array();
                $ticketData = array();
                $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status != ' => 'Solved', 'ticket.ticket_status !=' => 'Pending');
                $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)));
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
                $count = count($get);
                if (!empty($ticket_rel_Data)) {
                    foreach ($ticket_rel_Data as $key => $tkt_val) {
                        $ticket_arr[$tkt_val['ticket_id']] = $tkt_val;
                    }



                    if (!empty($ticket)) {
                        foreach ($ticket as $key => $value) {
//                    var_dump($value);
                            $value['ticket'] = $ticket_arr[$value['ticket_id']];
                            if ($value['group_id'] > 0) {
                                $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
                            }
//                     $ticketData[$key][$value['ticket_id']] = $ticket_arr[$value['ticket_id']];
                        }
                    }
                }




                break;


            case '11': $heading = 'Assigned tickets';
                $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                );

                if ($user_id == '') {
                    $where = "(`ticket`.`organisation_id` = $org_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` != 'Closed')";
                } else {
                    $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` != 'Closed')";
                }
                $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, $limit, ($limit * ($offset - 1)), FALSE, 'ticket.ticket_id');
                $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
                $count = count($get);
                break;
        }

        $pagedata['mainHeading'] = $heading;
        $pagedata['subHeading'] = "View";
        $pagedata['ticketType'] = $ticket_type;
        $pagedata['ticketData'] = $ticketData;
        $pagedata['count'] = $count;


        $html = $this->load->view('/ticket/employee/ticket_table', $pagedata, TRUE);
        echo $html;
        die;
    }

    public function getTicketHistory($ticket_id) {

        //get data for update ticket..
        $where = array('ticket_history.ticket_id' => $ticket_id);
        $ticket_history = $this->crm->getData('ticket_history', 'ticket_history.ticket_history_created_at', $where, FALSE, 'ticket_history.ticket_history_created_at', 'DESC', 1);
        return $ticket_history;
    }

    public function getTicketAssignee($ticket_id) {
        $join = array(
            array(
                'table' => 'user',
                'on' => 'user.user_id=ticket_assign.user_id'),
            array(
                'table' => 'user as uasb',
                'on' => 'uasb.user_id=ticket_assign.assigned_by')
        );

        $where = array('ticket_assign.ticket_id' => $ticket_id);
        $ticketAssignData = $this->crm->getData('ticket_assign', 'user.user_name as assignee', $where, $join, FALSE, FALSE);
        return $ticketAssignData;
    }

    public function addHour() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');



        $data = $this->input->post();
        $input_hour = $this->input->post('hour');
        $input_min = $this->input->post('min');

        if (($input_hour == '' || $input_hour == 0 || $input_hour == 'undefined') && ($input_min == '' || $input_min == 0 || $input_min == 'undefined')) {
            $result['result'] = FALSE;
            $result['msg'] = "Please enter work duration";
            echo json_encode($result);
            die;
        } else {
            $min = 0;
            if ($data['hour'] > 0) {
                $min = $data['hour'] * 60;
            }


            $data['minutes'] = $min + $data['min'];
            $data['created_at'] = date("Y-m-d H:i:s");
            unset($data['min']);
            unset($data['hour']);
            $last_hour_id = $this->crm->rowInsert('working_hour', $data);
            if ($last_hour_id) {
                $result['result'] = TRUE;
                $result['msg'] = "Hour Added Successfully";
                $result['type'] = "success";

                echo json_encode($result);
            }
        }
    }

    public function getAssignUser() {
        $ticket_id = $this->input->post('ticket');

        if ($ticket_id > 0) {
            $join1 = array(
                array(
                    'table' => 'user',
                    'on' => 'user.user_id=ticket_assign.user_id'),
                array(
                    'table' => 'user as uasb',
                    'on' => 'uasb.user_id=ticket_assign.assigned_by'),
            );

            $where1 = array('ticket_assign.ticket_id' => $ticket_id);
            $ticketAssignData = array();
            $ticketAssignData = $this->crm->getData('ticket_assign', 'ticket_assign.assigned_by,ticket_assign.assigned_by,ticket_assign.ticket_assign_at,user.user_name as assignee,uasb.user_name as assigned_by_user,ticket_assign.user_id as assigni_id', $where1, $join1, FALSE, 'ASC', '', '', '', 'ticket_assign.user_id');
            if (!empty($ticketAssignData)) {
                echo json_encode($ticketAssignData);
                die;
            } else {
                echo '0';
            }
        }
    }

    public function TicketCount($org_id, $user_id = false) {
        $ticketData = array();
        $count = array();
        $access = getUserAccessDetails($user_id);
        if ($access['access_level_id'] == 1) {
            $user_id = FALSE;
        }
//      $org_id = 3;
        if ($user_id) {
            $unsolved_join = array(
                array(
                    'table' => 'user as ucr',
                    'on' => 'ucr.user_id=ticket.user_id'),
                array(
                    'table' => 'ticket_assign',
                    'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
            );

            $unsolvedwhere = array('ticket.organisation_id' => $org_id, 'ticket_assign.user_id' => $user_id, 'ticket.ticket_status != ' => 'Solved', 'ticket.ticket_status !=' => 'Pending');
            $unsolvedticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $unsolvedwhere, $unsolved_join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket_assign.ticket_id');
            $count['your_unsolved_tickets'] = count($unsolvedticketData);
        }



        ###########################################################

       
      
        
         if ($user_id != '') {
                     $join = array(
                  array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                );
                    $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Open' OR `ticket`.`ticket_status` = 'Pending')";
                } else {
                  $join=array();  
                  $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open' OR `ticket`.`ticket_status` = 'Pending')";
                }
        $ticketData = $this->crm->getData('ticket', 'ticket.*', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE);
        $count['new_open'] = count($ticketData);
        #############################################################

        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
        );

        if ($user_id == '') {
            $where = "(`ticket`.`organisation_id` = $org_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` != 'Closed')";
        } else {
            $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` != 'Closed')";
        }
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
        $count['assigned_tickets'] = count($ticketData);

        #############################################################

        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
        );


        $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status' => 'Open', 'ticket_assign.ticket_id' => null);
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
        $count['unassigned_tickets'] = count($ticketData);

        #############################################################
        #############################################################

       $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                    array(
                        'table' => 'ticket_assign',
                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id')
                );
                if ($user_id == '') {
                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.current_working_user = 1) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing') OR (ticket.ticket_status = 'Pending'))";
                } else {
                    
                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND (ticket_assign.current_working_user = 1) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing') OR (ticket.ticket_status = 'Pending'))";
      
        }
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE);
        $count['all_unsolved_tickets'] = count($ticketData);

        #############################################################



        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
            array(
                'table' => 'ticket_history',
                'on' => 'ticket_history.ticket_id=ticket.ticket_id'
            ),
            array(
                'table' => 'user as uasb',
                'on' => 'uasb.user_id=ticket_history.ticket_updated_by')
        );
        $time_stamp = date("Y-m-d H:i:s");
        $last_time_stamp = (date('Y-m-d h:i:s', strtotime('-1 hour')));
        if ($user_id == '') {
            $where = "ticket.organisation_id = '$org_id' AND (ticket_history_created_at BETWEEN '$last_time_stamp'  AND '$time_stamp')";
        } else {
            $where = "(ticket.organisation_id = '$org_id') AND (ticket_history.ticket_updated_by = '$user_id') AND (ticket_history_created_at BETWEEN '$last_time_stamp'  AND '$time_stamp')";
        }
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status', $where, $join, FALSE, FALSE);
        $count['recently_updated_tickets'] = count($ticketData);

        #############################################################

        if ($user_id) {
            $group = getUserGroupDetails($user_id);
            $group_arr = array();
            $grp_id = array();
            foreach ($group as $grp_val) {
                $group_arr[$grp_val['group_id']] = $grp_val;
                $grp_id[] = $grp_val['group_id'];
            }

            $join = array(
                array(
                    'table' => 'user as ucr',
                    'on' => 'ucr.user_id=ticket.user_id'),
                array(
                    'table' => 'ticket_assign',
                    'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
            );


            $where = array('ticket.organisation_id' => $org_id, 'ticket_assign.user_id' => $user_id);
            $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
            $ticketData = array();
            if (!empty($ticket_rel_Data)) {
                foreach ($ticket_rel_Data as $key => $value) {
                    if (isset($group_arr[$value['group_id']]))
                        $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
                }
            }
            $count['new_ticket_in_your_group'] = count($ticketData);
        }

        #############################################################

        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
        );
        $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status != ' => 'Solved', 'ticket.ticket_status !=' => 'Doing', 'ticket.ticket_status' => 'Pending');
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE);
        $count['pending_tickets'] = count($ticketData);

        #############################################################



        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
            array(
                'table' => 'ticket_history',
                'on' => 'ticket_history.ticket_id=ticket.ticket_id'
            ),
            array(
                'table' => 'user as uasb',
                'on' => 'uasb.user_id=ticket_history.ticket_updated_by')
        );
        $time_stamp = date("Y-m-d h:i:s");
        $last_time_stamp = (date('Y-m-d h:i:s', strtotime('-1 day')));
        if ($user_id == '') {
            $where = "(ticket_history_status = 'Closed')  AND (ticket.organisation_id = '$org_id') AND (ticket_updated BETWEEN '$last_time_stamp'  AND '$time_stamp')";
        } else {
            $where = "(ticket_history_status = 'Closed') AND (ticket.ticket_status = 'Closed') AND (ticket.organisation_id = '$org_id') AND (ticket_history.ticket_updated_by = '$user_id') AND (ticket_updated BETWEEN '$last_time_stamp'  AND '$time_stamp')";
        }
        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,uasb.user_name as ticket_updater,ticket_history_created_at as updated_date,ticket_history_status as ticket_status', $where, $join, FALSE, FALSE);


        $count['recently_solved_tickets'] = count($ticketData);

        #############################################################
        if ($user_id) {
            $group = getUserGroupDetails($user_id);
            $group_arr = array();
            $grp_id = array();
            if (!empty($group)) {
                foreach ($group as $grp_val) {
                    $group_arr[$grp_val['group_id']] = $grp_val;
                    $grp_id[] = $grp_val['group_id'];
                }
            }
            $join = array(
                array(
                    'table' => 'user as ucr',
                    'on' => 'ucr.user_id=ticket.user_id'),
                array(
                    'table' => 'ticket_assign',
                    'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
            );


            $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND ((ticket.ticket_status = 'Open') OR (ticket.ticket_status = 'Doing'))";

            $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
            foreach ($ticket_rel_Data as $key => $value) {
                if (isset($group_arr[$value['group_id']]))
                    $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
            }


            $count['unsolved_tickets_in_your_groups'] = count($ticketData);
        }

        $group = getOrganisationGroupDetails();
        $group_arr = array();
        $grp_id = array();
        if (!empty($group)) {
            foreach ($group as $grp_val) {
                $group_arr[$grp_val['group_id']] = $grp_val;
                $grp_id[] = $grp_val['group_id'];
            }
        }
        $join = array(
            array(
                'table' => 'ticket',
                'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
        );
        $condition = array('ticket.ticket_status' => 'Open');
        $ticket = array();
        if (!empty($grp_id)) {
            $ticket = $this->crm->getWhereInData('ticket_assign', "*", $grp_id, "group_id", $join, $condition);
        }
        $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
            array(
                'table' => 'ticket_assign',
                'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
        );

        $ticket_rel_Data = array();
        $ticket_arr = array();
        $ticketData = array();
        $where = array('ticket.organisation_id' => $org_id, 'ticket.ticket_status != ' => 'Solved', 'ticket.ticket_status !=' => 'Pending');
        $ticket_rel_Data = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);

        if (!empty($ticket_rel_Data)) {
            foreach ($ticket_rel_Data as $key => $tkt_val) {
                $ticket_arr[$tkt_val['ticket_id']] = $tkt_val;
            }


        
            if (!empty($ticket)) {
                foreach ($ticket as $key => $value) {

                    if(in_array($value['ticket_id'], $ticket_arr)){
                    $value['ticket'] = $ticket_arr[$value['ticket_id']];
                    }
                    if ($value['group_id'] > 0) {
                        $ticketData[$group_arr[$value['group_id']]['group_title']] = $value;
                    }
//                     $ticketData[$key][$value['ticket_id']] = $ticket_arr[$value['ticket_id']];
                }
            }
        }

        $count['new_ticket_in_Group'] = count($ticketData);


        $join = array(
                    array(
                        'table' => 'user as ucr',
                        'on' => 'ucr.user_id=ticket.user_id'),
                );

//                if ($user_id == '') {
                    $where = array('ticket.organisation_id' => $org_id);
//                } else {
//                    $join[] = array(
//                        'table' => 'ticket_assign',
//                        'on' => 'ticket_assign.ticket_id=ticket.ticket_id');
//
//                    $where = "(ticket.organisation_id = $org_id) AND (ticket_assign.user_id = $user_id) AND (ticket_assign.current_working_user = 1)";
//                }


        $ticketData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,', $where, $join, FALSE, FALSE);
        $count['all_tickets'] = count($ticketData);
        echo json_encode($count);
        die;
    }

    public function getAssineebygrp() {
        $grp_id = $this->input->post('grp_id');
        $org_id = $this->input->post('org_id');
        $join = array(
            array(
                'table' => 'user_group_rel',
                'on' => 'user.user_id=user_group_rel.user_id'),
            array(
                'table' => 'user_organisation_rel',
                'on' => 'user.user_id=user_organisation_rel.user_id'),
            array(
                'table' => 'group',
                'on' => 'group.group_id=user_group_rel.group_id'),
        );

        $select = 'group.group_id,user.user_id';
        $where = array('group.group_id' => $grp_id, 'user_organisation_rel.organisation_id' => $org_id);
        $assign_user = $this->crm->getData('user', $select, $where, $join, FALSE, FALSE);


        if (!empty($assign_user)) {
            foreach ($assign_user as $key => $value) {
                $assign_user[$key]['assignee_name'] = getUserName($value['user_id']);
            }
            echo json_encode($assign_user);
        } else {
            echo FALSE;
        }
    }

    public function updateUserNotes() {
        if ($this->input->post()) {
            $data = $this->input->post();
            if ($data['user_note'] == '') {
                $return_data['msg'] = "User Note Required";
                $return_data['result'] = "False";
            } else {
                $this->crm->rowUpdate('user', array('user_note' => $data['user_note']), array('user_id' => $data['user_id']));
                $return_data['msg'] = $data['user_note'];
                $return_data['result'] = "True";
            }

            echo json_encode($return_data);
        }
    }

    public function updateOrgansationNotes() {
        if ($this->input->post()) {
            $data = $this->input->post();
            if ($data['organisation_notes'] == '') {
                $return_data['msg'] = "Organisation Note Required";
                $return_data['result'] = "False";
            } else {
                $this->crm->rowUpdate('organisation', array('organisation_notes' => $data['organisation_notes']), array('organisation_id' => $data['organisation_id']));
                $return_data['msg'] = $data['organisation_notes'];
                $return_data['result'] = "True";
            }

            echo json_encode($return_data);
        }
    }

  

    public function reopenTicket($ticket_id) {
        if ($ticket_id > 0) {
            $this->crm->rowUpdate('ticket', array('ticket_status' => 'Open'), array('ticket_id' => $ticket_id));
            
            
                $ticket_detail = getTicketDetails($ticket_id);
                $assignee = getTicketAssignee($ticket_id);
              

            // Reopen mail for Customer
                $message = '';
                $customer_details = getUserDetails($ticket_detail['user_id']);
                $status_html = getStatus($ticket_detail['ticket_status']);
               $maildata['content'] = sprintf(TICKET_REOPEN, $status_html, $ticket_detail['ticket_number'], dateFormate(date("Y-m-d H:i:s")));

                $maildata['ticket_detail'] = $ticket_detail;
                $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                $maildata['btntitle'] = 'View Ticket';
                $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);

                mymail($customer_details['user_email'], TICKET_REOPEN_SUB, $message);
     
                // Reopen mail for assigniree
                if(!empty($assignee)){
                   
              
                $message = '';
                $customer_details = getUserDetails($ticket_detail['user_id']);
                $status_html = getStatus($ticket_detail['ticket_status']);
               $maildata['content'] = sprintf(TICKET_ASIGNEE_REOPEN, $status_html, $ticket_detail['ticket_number'], dateFormate(date("Y-m-d H:i:s")));

                $maildata['ticket_detail'] = $ticket_detail;
                $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                $maildata['btntitle'] = 'View Ticket';
                $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                foreach ($assignee as $assignee_val){
                $assignee_detail = getUserDetails($assignee_val);    
                mymail($assignee_detail['user_email'], TICKET_REOPEN_SUB, $message);
                }
                }
               
            $this->session->set_flashdata('ticket_success', 'Ticket Reopen Successfully');
            redirect("request/detail", 'refresh');
        }
    }
    
    public function feedback($customer_id,$ticket_id){
        $pagedata = array();
        $pagedata['mainHeading'] = 'Feedback';
        if($this->input->post()){
          
            $data = array(
            'feedback_comment' => $this->input->post('comment'),   
            'feedback_type' => $this->input->post('feedback_type'),  
            'ticket_id'=> $ticket_id,   
            'user_id'=> $customer_id, 
            'feedback_created_at'=>date("Y-m-d H:i:s")    
            );
           $feedback_id  = $this->crm->rowInsert('feedback', $data);
           $url = base_url('request/feedback/' .$customer_id.'/'.$ticket_id);
           
           if($feedback_id){
                   $this->session->set_flashdata('ticket_success', 'Thank you for feebback');
                   redirect("request/detail", 'refresh');  
           }
        }else{
        $this->load->template('/ticket/customer/feedback', $pagedata);
        }
    }
    
    public function getemployee(){
        $org_id = $this->input->post('organisation_id');
        $customer_details=array();
        if($org_id){
           $join = array(
                array('table' => 'user_organisation_rel',
                    'on' => 'user_organisation_rel.user_id=user.user_id'),
            );
            $where['user_access_level'] = 3;
            $where['user_status'] = 1;
            $where['user_organisation_rel.organisation_id'] = $org_id;
            $select = 'user.user_id,user_name,user_email';    
           $customer_details = $this->crm->getData('user', $select, $where, $join, 'user.user_update', 'DESC');
         
        if(!empty($customer_details)){
            foreach($customer_details as $key=>$val){
               $customer_details[$key]['user_name'] = getUserName($val['user_id']); 
            }
            echo json_encode($customer_details); 
        }else{
            echo json_encode($customer_details) ;
        }
        
        }
    }
    
    
    
   

}

?>
