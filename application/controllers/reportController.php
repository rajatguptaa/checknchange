<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class ReportController extends BaseController {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }
        $this->load->model('crm_model', 'crm');
        $this->load->library('Pdf');
    }

    public function index() {
        $pagedata['mainHeading'] = 'Report';
        $pagedata['scripts_to_load'] = array('assets/js/chosen/chosen.jquery.js', 'assets/js/modules/report.js');
        $pagedata['style_to_load'] = array('assets/css/chosen/chosen.css');

        $this->load->template('/report/index', $pagedata);
    }

    public function create($type) {

        $pagedata['scripts_to_load'] = array('assets/js/datepicker/moment.js', 'assets/js/datepicker/bootstrap-datetimepicker.js', 'assets/js/jquery.form.min.js', 'assets/js/chosen/chosen.jquery.js','assets/js/bootbox/bootbox.js');
        $pagedata['style_to_load'] = array('assets/css/datepicker/bootstrap-datetimepicker.css', 'assets/css/chosen/chosen.css');
        $report_type = $type;
        $pagedata['organisation'] = $this->crm->getData('organisation');
        $pagedata['report_type'] = $report_type;
        $pagedata['mainHeading'] = $this->input->post('report_heading');
        $pagedata['subHeading'] = "View";


        $this->load->template('/report/report_view', $pagedata);
    }

    public function genrate() {

        if ($this->input->post()) {
            $report = $this->input->post('report');
            $report_type = $report['report_type'];

            if ($report['is_relative_interval'] == 'true') {
                $interval = $report['relative_interval_in_days'];
                $start_date = date('Y-m-d H:i:s', strtotime($val["ticket_updated"] . "  -$interval days"));
                $end_date = date('Y-m-d H:i:s');
            } else {
                $start_date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($report['start_date'])));
                $end_date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($report['end_date'])));
            }



            if (getLoginUser() <= 1) {
                $user_id = '';
            } else {
                $user_id = getLoginUser();
            }

            $org_id = $this->input->post('org_id');

            $reportData = array();
            switch ($report_type) {

                #############################################################

                case '1115': $heading = 'All Unassigned tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                    );
                    $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket_assign`.`ticket_id` IS NULL) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";

                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');


                    break;





                #############################################################
                case '1117': $heading = ' All Open Assigned tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                    );
                    if ($user_id != '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as `ticket_creater`,', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket_assign.ticket_id');


                    break;





                #############################################################
                #############################################################
                case '1116': $heading = ' All Pending tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                    );
                    if ($user_id != '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Pending')AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Pending') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date') ";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as `ticket_creater`,', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket_assign.ticket_id');


                    break;
                #############################################################
                case '1120': $heading = ' Employee Open/Pending tickets';
                    if ($this->input->post('sets')) {
                        $set = $this->input->post('sets');
                        $condition = '';
                        if ($set['operator'] == 'is') {
                            if ($set[employee_id] == 'All') {
                                $condition = '';
                            } else {
                                $condition = "AND (`ticket_assign`.`user_id` = $set[employee_id])";
                            }
                        } elseif ($set['operator'] == 'is_not') {
                            $condition = "AND (`ticket_assign`.`user_id` != $set[employee_id])";
                        } else {
                            $condition = '';
                        }
                    }
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id)  AND (`ticket_assign`.`current_working_user` = 1) AND ((`ticket`.`ticket_status` = 'Open') OR (`ticket`.`ticket_status` = 'Pending'))AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')$condition";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND ((`ticket`.`ticket_status` = 'Open') OR (`ticket`.`ticket_status` = 'Pending')) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');



                    break;





                #############################################################
                #############################################################
                case '1121': $heading = 'Solved tickets';
                    if ($this->input->post('sets')) {
                        $set = $this->input->post('sets');
                        $condition = '';
                        if ($set['operator'] == 'is') {
                            if ($set[employee_id] == 'All') {
                                $condition = '';
                            } else {
                                $condition = "AND (`ticket_assign`.`user_id` = $set[employee_id])";
                            }
                        } elseif ($set['operator'] == 'is_not') {
                            $condition = "AND (`ticket_assign`.`user_id` != $set[employee_id])";
                        } else {
                            $condition = '';
                        }
                    }
                    $join = array(
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id=ticket.ticket_id'
                        ),
                         array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id')
                    );
                    if ($user_id == '') {
                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved')   AND (ticket.organisation_id = '$org_id')  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date') $condition";
                    } else {
                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved') AND (ticket.organisation_id = '$org_id')  AND (`ticket_assign`.`current_working_user` = 1)  AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history_status as ticket_status,ticket_history.ticket_updated_by', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');




                    break;
                #############################################################
                #############################################################
                case '1118': $heading = 'Bad tickets';

                    $join = array(
                        array(
                            'table' => 'feedback',
                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'bad') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'bad')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');


                    break;
                #############################################################
                #############################################################
                case '1119': $heading = 'Good tickets';

                    $join = array(
                        array(
                            'table' => 'feedback',
                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'good') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'good')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');


                    break;
            }

            $view['reportType'] = $report_type;
            $view['reportData'] = $reportData;

            $html = $this->load->view('/report/report_table_view', $view, TRUE);
            echo $html;
        }
    }

    public function genrateReport() {


        if ($this->input->post()) {
            $report = $this->input->post('report');
            $report_type = $report['report_type'];

            if ($report['is_relative_interval'] == 'true') {
                $interval = $report['relative_interval_in_days'];
                $start_date = date('Y-m-d H:i:s', strtotime($val["ticket_updated"] . "  -$interval days"));
                $end_date = date('Y-m-d H:i:s');
            } else {
                $start_date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($report['start_date'])));
                $end_date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($report['end_date'])));
            }



            if (getLoginUser() <= 1) {
                $user_id = '';
            } else {
                $user_id = getLoginUser();
            }

            $org_id = $this->input->post('org_id');

            $reportData = array();
            $header = array();
            switch ($report_type) {

                #############################################################

                case '1115': $heading = 'All Unassigned tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                    );
                    $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket_assign`.`ticket_id` IS NULL) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";

                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
                    $i = 1;
                    $final_array=array();
                    foreach ($reportData as $val) {
                        $final_array[] = array(
                            'ticket_count' => $i,
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                            'Priority' => $val['ticket_priority'],
                        );
                        $i++;
                    }

                    $header = array('Ticket #', 'Subject', 'Ticket Number', 'Requester', 'Request date', 'Priority');

                    break;





                #############################################################
                case '1117': $heading = ' All Open Assigned tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                    );
                    if ($user_id != '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Open') AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as `ticket_creater`,', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket_assign.ticket_id');
                    $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                            'last_update' => dateFormate($val['ticket_updated']),
                        );

                        $ticketAssignData = getTicketAssignee($val['ticket_id']);
                        if (!empty($ticketAssignData)) {
                            $str = '';
                            foreach ($ticketAssignData as $assigneeData) {
                                $str .= ',' . getUserName($assigneeData);
                            }
                            $final_array[$key]['assignee'] = ltrim($str, ',');
                        } else {
                            $final_array[$key]['assignee'] = '-';
                        }
                        $i++;
                    }
                   
                    $header = array('Ticket #', 'Subject', 'Ticket Number', 'Requester', 'Request date', 'Last update', 'Assignee');
                    break;





                #############################################################
                #############################################################
                case '1116': $heading = ' All Pending tickets';
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
                    );
                    if ($user_id != '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Pending')AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Pending') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date') ";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as `ticket_creater`,', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket_assign.ticket_id');


                    $header = array('Ticket #', 'Subject', 'Ticket Number', 'Requester', 'Request date', 'Priority', 'Group', 'Assignee');


                    $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                            'Priority' => $val['ticket_priority'],
                        );
                        $ticketAssignData = getTicketAssignee($val['ticket_id']);
                        if (!empty($ticketAssignData)) {
                            $str = '';
                            foreach ($ticketAssignData as $assigneeData) {
                                $grp = getUserGroupDetails($assigneeData);
                                foreach ($grp as $grp_val) {
                                    $str .= ',' . $grp_val['group_title'];
                                }
                                $str1 .= ',' . getUserName($assigneeData);
                            }
                            if ($str != '') {
                                $gro_arr = array_unique(explode(',', ltrim($str, ',')));
                                $final_array[$key]['group'] = implode(',', $gro_arr);
                            }
                            if ($str1 != '') {
                                $emp_arr = array_unique(explode(',', ltrim($str1, ',')));
                                $final_array[$key]['assignee'] = implode(',', $emp_arr);
                            }
                        } else {
                            $final_array[$key]['group'] = '-';
                            $final_array[$key]['assignee'] = '-';
                        }
                        $i++;
                    }



                    break;
                #############################################################
                case '1120': $heading = ' Employee Open/Pending tickets';
                    if ($this->input->post('sets')) {
                        $set = $this->input->post('sets');
                        $condition = '';
                        if ($set['operator'] == 'is') {
                            if ($set['employee_id'] == 'All') {
                                $condition = '';
                            } else {
                                $condition = "AND (`ticket_assign`.`user_id` = $set[employee_id])";
                            }
                        } elseif ($set['operator'] == 'is_not') {
                            $condition = "AND (`ticket_assign`.`user_id` != $set[employee_id])";
                        } else {
                            $condition = '';
                        }
                    }
                    $join = array(
                        array(
                            'table' => 'user as ucr',
                            'on' => 'ucr.user_id=ticket.user_id'),
                        array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id',)
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id)  AND (`ticket_assign`.`current_working_user` = 1) AND ((`ticket`.`ticket_status` = 'Open') OR (`ticket`.`ticket_status` = 'Pending'))AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')$condition";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND ((`ticket`.`ticket_status` = 'Open') OR (`ticket`.`ticket_status` = 'Pending')) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ucr.user_id,ucr.user_name as `ticket_creater`,ticket_assign.ticket_assign_id', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');

                 $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                            'update_date' => dateFormate($val['ticket_updated']),
                          );

                        $ticketAssignData = getTicketAssignee($val['ticket_id']);
                        if (!empty($ticketAssignData)) {
                            $str = '';
                            foreach ($ticketAssignData as $assigneeData) {
                                $str .= ',' . getUserName($assigneeData);
                            }
                            $final_array[$key]['assignee'] = ltrim($str, ',');
                        } else {
                            $final_array[$key]['assignee'] = '-';
                        }
                        $i++;
                    }
                    $header = array('Ticket #','Subject','Ticket Number','Requester', 'Request date','Last update','Assignee');

                    break;





                #############################################################
                #############################################################
                case '1121': $heading = 'Solved tickets';
                    if ($this->input->post('sets')) {
                        $set = $this->input->post('sets');
                        $condition = '';
                        if ($set['operator'] == 'is') {
                            if ($set[employee_id] == 'All') {
                                $condition = '';
                            } else {
                                $condition = "AND (`ticket_history`.`ticket_updated_by` = $set[employee_id])";
                            }
                        } elseif ($set['operator'] == 'is_not') {
                            $condition = "AND (`ticket_history`.`ticket_updated_by` != $set[employee_id])";
                        } else {
                            $condition = '';
                        }
                    }
                     $join = array(
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id=ticket.ticket_id'
                        ),
                         array(
                            'table' => 'ticket_assign',
                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id')
                    );
                    if ($user_id == '') {
                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved')   AND (ticket.organisation_id = '$org_id')  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date') $condition";
                    } else {
                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved') AND (ticket.organisation_id = '$org_id')  AND (`ticket_assign`.`current_working_user` = 1)  AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history_status as ticket_status,ticket_history.ticket_updated_by', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
                    
                    
                      $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                          );
                        
                                $date_a = new DateTime(date("Y-m-d H:i:s"));
                                $date_b = new DateTime($val['ticket_updated']);
                                $interval = date_diff($date_a, $date_b);
                                $days = $interval->format('%d');
                                $months = $interval->format('%m');
                                $time = explode(':', $interval->format('%H:%i:%s'));
                                if($days==0){
                                if ($time[0] < 1) {
                                   $final_array[$key]['solved'] = $time[1] . ' min ago';
                                } elseif ($time[0] < 24 && $time[0] > 1) {
                                     $final_array[$key]['solved'] = 'Today ' . $time[1] . ':' . $time[0];
                                }
                                }else{
                                  if($days<=10){  
                                   $final_array[$key]['solved'] =  $days.' days ago';
                                  }else{
                                  $final_array[$key]['solved'] = dateFormate($val['updated_date']);   
                                  }
                                }
                        $final_array[$key]['priority']=$val['ticket_priority'];
                        $final_array[$key]['solved_by']=getUserName($val['ticket_updated_by']);
                        $i++;
                    }
                    
                    
                    $header = array('Ticket #','Subject','Ticket Number','Requester', 'Request date','Solved','Priority','Solved By');
                    break;

                #############################################################
                case '1118': $heading = 'Bad tickets';

                    $join = array(
                        array(
                            'table' => 'feedback',
                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'bad') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'bad')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
                    
                      $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'Satisfaction' => $val['feedback_comment'],
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                          );

                        $ticketAssignData = getTicketAssignee($val['ticket_id']);
                        if (!empty($ticketAssignData)) {
                            $str = '';
                            foreach ($ticketAssignData as $assigneeData) {
                                $str .= ',' . getUserName($assigneeData);
                            }
                            $final_array[$key]['assignee'] = ltrim($str, ',');
                        } else {
                            $final_array[$key]['assignee'] = '-';
                        }
                        $i++;
                    }
                    
                    
                    $header = array('Ticket #','Satisfaction','Subject','Ticket Number','Requester', 'Request date','Assignee');
                    break;
                #############################################################
                case '1119': $heading = 'Good tickets';

                    $join = array(
                        array(
                            'table' => 'feedback',
                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
                        array(
                            'table' => 'ticket_history',
                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
                    );

                    if ($user_id == '') {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'good') AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    } else {
                        $where = "(`ticket`.`organisation_id` = $org_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'good')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
                    }
                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');

                    $i = 1;
                    $final_array=array();
                    foreach ($reportData as $key => $val) {
                        $final_array[$key] = array(
                            'ticket_count' => $i,
                            'Satisfaction' => $val['feedback_comment'],
                            'ticket_subject' => $val['ticket_subject'],
                            'ticket_number' => $val['ticket_number'],
                            'Requester' => getUserName($val['user_id']),
                            'Requeste_date' => dateFormate($val['ticket_created']),
                          );

                        $ticketAssignData = getTicketAssignee($val['ticket_id']);
                        if (!empty($ticketAssignData)) {
                            $str = '';
                            foreach ($ticketAssignData as $assigneeData) {
                                $str .= ',' . getUserName($assigneeData);
                            }
                            $final_array[$key]['assignee'] = ltrim($str, ',');
                        } else {
                            $final_array[$key]['assignee'] = '-';
                        }
                        $i++;
                    }
                    $header = array('Ticket #','Satisfaction','Subject','Ticket Number','Requester', 'Request date','Assignee');
                    break;
            }


            $view['reportType'] = $report_type;
            $view['reportData'] = $reportData;
            $html = $this->load->view('/report/report_table_view', $view, TRUE);
            if ($this->input->post('report_type') == 'pdf') {
                $pdf_data['html'] = $html;
                $pdf_data['org_logo'] = getOrganiasationImage($org_id, TRUE);
                $pdf_data['start_date'] = dateFormate($start_date);
                $pdf_data['end_date'] = dateFormate($end_date);
                $pdf_data['org_name'] = getOrganiasationName($org_id);
                $pdf_data['heading'] = $heading;
                $this->pdf->generate_report($pdf_data);
            } else {
                $this->getCsv($final_array, $header, $heading, $start_date, $end_date);
            }
        }
    }

    public function employeeDetail() {
        $org_id = $this->input->post('organisation_id');
        $employee = array();
        $employee = getEmployee($org_id);
        echo json_encode($employee);
    }

    public function getCsv($reportData, $header, $heading, $start_date, $end_date) {

        $count = count($reportData);
        $reportData['total_order'][] = 'Total:' . $count;

        array_unshift($reportData, $header);
        array_unshift($reportData, array());
        array_unshift($reportData, array($heading, '', '', 'Report Peried:' . $start_date . ' To ' . $end_date));




        $filename = $heading;
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv";');
        $delimiter = ",";
        $file = fopen('php://output', 'w');


        foreach ($reportData as $line) {
            fputcsv($file, $line, $delimiter);
        }
        fclose($file);
    }

}

?>
