<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';

class DashboardController extends BaseController {

    public function index() {
        
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        } else {

            $data['scripts_to_load'] = array(
                'assets/js/chosen/chosen.jquery.js', 'assets/js/modules/dashboard.js'
            );
            $data['style_to_load'] = array('assets/css/chosen/chosen.css');
            $data['organisation'] = $this->crm->getData('organisation');
            $this->load->template('/dashboard/index', $data);
        }
    }

    public function createDashboard() {

        $this->load->template('/dashboard/create', $data);
    }

//    public function supportForum() {
//    
//        $organisation_id = $this->input->post('organisation_id');
//        $where = array('organisation_id' => $organisation_id);
//        $data['category_detail'] = $this->crm->getData('forum_category', '*', $where);
//        $data['title'] = getOrganiasationTitle($organisation_id);
//        $data['org_name'] = getOrganiasationName($organisation_id);
//      
//        
//        
//         if (getLoginUser() <= 1) {
//             $data['open_ticket'] = $this->openTicket($organisation_id);
//             $data['group_open_ticket']=$this->openGroupTicket($organisation_id);
//             $data['good_ticket']=$this->goodticket($organisation_id);
//             $data['bad_ticket']=$this->badticket($organisation_id);
//             $data['solved_ticket']=$this->solvedTicket($organisation_id);
//             $data['name'] = getOrganiasationName($organisation_id);
//             $data['image'] = getOrganiasationImage($organisation_id,TRUE);
//            } else {
//                $user_id = (int)getLoginUser();
//                $data['open_ticket'] = $this->openTicket($organisation_id,$user_id);   
//                $data['group_open_ticket']=$this->openGroupTicket($organisation_id,$user_id);
//                 $data['good_ticket']=$this->goodticket($organisation_id,$user_id);
//                $data['bad_ticket']=$this->badticket($organisation_id,$user_id);
//                $data['solved_ticket']=$this->solvedTicket($organisation_id,$user_id);
//                $data['name'] = getUserName($user_id);
//                $data['image'] = getUserImage($user_id,TRUE);
//            }
//            
//    
//        echo $this->load->view('dashboard/viewsupport', $data, true);
//    }
//
//    public function unpinforumpost() {
//
//        $postid = $this->input->post('postid');
//        $where = array('forum_article_id' => $postid);
//        $insertdata = array('forum_article_homepage_status' => 0);
//        $update_post = $this->crm->rowUpdate('forum_article', $insertdata, $where);
//
//        echo $update_post;
//    }
//
//    public function openTicket($organisation_id,$user_id=NULL) {
//       ;
//               
//                if ($user_id != '') {
//                     $join = array(
//                  array(
//                        'table' => 'ticket_assign',
//                        'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
//                );
//                    $where = "(`ticket`.`organisation_id` = $organisation_id) AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_status` = 'Open')";
//                } else {
//                  $join=array();  
//                  $where = "(`ticket`.`organisation_id` = $organisation_id) AND (`ticket`.`ticket_status` = 'Open')";
//                }
//             
//                $get = $this->crm->getData('ticket', 'ticket.*', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE);
//               return count($get); 
//    }
//
//    public function openGroupTicket($organisation_id,$user_id=NULL) {
//        if ($user_id == '') {
//            
//            $group = getAllGroupDetails();
// 
//            $group_arr = array();
//            $grp_id = array();
//            foreach ($group as $grp_val) {
//                $group_arr[$grp_val['group_id']] = $grp_val;
//                $grp_id[] = $grp_val['group_id'];
//            }
//
//            $join = array(
//                array(
//                    'table' => 'ticket_group_rel',
//                    'on' => 'ticket_group_rel.ticket_id=ticket.ticket_id'));
//            $where = array('ticket.organisation_id' => $organisation_id,'ticket.ticket_status' => 'Open','ticket_group_rel.group_id !=' => 'null');
//            $get = $this->crm->getData('ticket', 'ticket.*', $where, $join, FALSE, FALSE);
//            $grp_count = count($get);
//        } else {
//            $group = getUserGroupDetails($user_id);
//           
//
//            $group_arr = array();
//            $grp_id = array();
//            foreach ($group as $grp_val) {
//                $group_arr[$grp_val['group_id']] = $grp_val;
//                $grp_id[] = $grp_val['group_id'];
//            }
//
//            $join = array(
//                array(
//                    'table' => 'user as ucr',
//                    'on' => 'ucr.user_id=ticket.user_id'),
//                array(
//                    'table' => 'ticket_assign',
//                    'on' => 'ticket.ticket_id=ticket_assign.ticket_id'),
//            );
//
//
//            $where = array('ticket.organisation_id' => $organisation_id,'ticket_assign.user_id' => $user_id,'ticket.ticket_status' => 'Open');
//          
//            $get = $this->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater,ticket_assign.group_id', $where, $join, FALSE, FALSE);
//            $grp_count = count($get);
//        }
//        
//       
//        return $grp_count;
//    }
//
//    public function goodticket($organisation_id,$user_id=NULL) {
//     $start_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). "  -7 days"));
//     $end_date = date('Y-m-d H:i:s');
//     
//        $join = array(
//                        array(
//                            'table' => 'feedback',
//                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
//                        array(
//                            'table' => 'ticket_history',
//                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
//                    );
//
//                   $where = "(`ticket`.`organisation_id` = $organisation_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'good')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
//                     $good_detail = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment',$where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
//                     return count($good_detail);
//    }
//    public function badticket($organisation_id,$user_id=NULL) {
//     $start_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). "  -7 days"));
//     $end_date = date('Y-m-d H:i:s');
//     
//        $join = array(
//                        array(
//                            'table' => 'feedback',
//                            'on' => 'feedback.ticket_id = ticket.ticket_id'),
//                        array(
//                            'table' => 'ticket_history',
//                            'on' => 'ticket_history.ticket_id = ticket.ticket_id')
//                    );
//
//                   $where = "(`ticket`.`organisation_id` = $organisation_id) AND (`ticket`.`ticket_status` = 'Closed') AND (`feedback_type` = 'bad')  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
//                     $bad_ticket = $this->crm->getData('ticket', 'ticket.*,ticket_history.ticket_updated_by,feedback_comment',$where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
//                     return count($bad_ticket);
//    }
//    
//    public function solvedTicket($organisation_id,$user_id=NULL){
//          $start_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). "  -7 days"));
//         $end_date = date('Y-m-d H:i:s');
//           $join = array(
//                        array(
//                            'table' => 'ticket_history',
//                            'on' => 'ticket_history.ticket_id=ticket.ticket_id'
//                        ),
//                         array(
//                            'table' => 'ticket_assign',
//                            'on' => 'ticket.ticket_id = ticket_assign.ticket_id')
//                    );
//                    if ($user_id == '') {
//                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved')   AND (ticket.organisation_id = '$organisation_id')  AND (`ticket_assign`.`current_working_user` = 1) AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
//                    } else {
//                        $where = "(ticket_history_status = 'Solved') AND (ticket.ticket_status = 'Solved') AND (ticket.organisation_id = '$organisation_id')  AND (`ticket_assign`.`current_working_user` = 1)  AND (`ticket_assign`.`user_id` = $user_id)  AND (`ticket`.`ticket_updated` BETWEEN '$start_date'  AND '$end_date')";
//                    }
//                    $reportData = $this->crm->getData('ticket', 'ticket.*,ticket_history_status as ticket_status,ticket_history.ticket_updated_by', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'ticket.ticket_id');
//                     return count($reportData);
//    }
//
//
//
// public function updateOrgansationTitle() {
//        if ($this->input->post()) {
//            $data = $this->input->post();
//            if ($data['organisation_title'] == '') {
//                $return_data['msg'] = "Organisation Title Required";
//                $return_data['result'] = "False";
//            } else {
//                $this->crm->rowUpdate('organisation', array('organisation_title' => $data['organisation_title'],'organisation_text' => $data['organisation_text']), array('organisation_id' => $data['organisation_id']));
//                $result = array(
//                 'organisation_title' =>$data['organisation_title'],
//                 'organisation_text' =>$data['organisation_text'],
//                 );
//                $return_data['msg'] =$result;
//                $return_data['result'] = "True";
//            }
//
//            echo json_encode($return_data);
//        }
//    }
//    
}

?>
