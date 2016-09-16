<?php 
function getTicketDetails($ticket_id = NULL) {
    if ($ticket_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

         $join = array(
            array(
                'table' => 'user as ucr',
                'on' => 'ucr.user_id=ticket.user_id'),
        );

        $where = array('ticket.ticket_id' => $ticket_id);
        $ticketData = $CI->crm->getData('ticket', 'ticket.*,ucr.user_name as ticket_creater', $where, $join, FALSE, FALSE);
        return $ticketData[0];
    }
    else
        return false;
}

 function getTicketAssignee($ticket_id = NULL){
          $CI = & get_instance();

        $CI->load->model("crm_model");
       $where = array('ticket_id' => $ticket_id);
        $ticketAssignData = $CI->crm->getData('ticket_assign', 'user_id', $where, FALSE, FALSE, FALSE);
        if(!empty($ticketAssignData)){
        foreach ($ticketAssignData as $value){
                         $assignee_user[]= $value['user_id'];
                     }
                     
        return $assignee_user;
        }
        else{
            return FALSE;
        } 
 }
 
 function getTicketAppointment($ticket_id,$comment_id){
     $CI = & get_instance();
     $CI->load->model("crm_model");  
     $join[] = array(
       'table'=>'appointment_relation',
       'on' => 'appointment.appointment_Id=appointment_relation.appointment_id',  
     );
     
     $where = array('appointment_relation.ticket_id'=>$ticket_id,'appointment_relation.comment_id'=>$comment_id);
     
     $select = "appointment_date,appointment_start_time,appointment_end_time,appointment_relation.assignee_id,appointment_relation.assigned_by,appointment_relation.ticket_id,appointment_relation.comment_id";
     
    $appointment_data = $CI->crm->getData('appointment', $select, $where, $join);
    if(!empty($appointment_data)){
     foreach($appointment_data as $val){
       $assign[] =  $val['assignee_id'];
       $data = $val;                    
      }  
      $data['assign'] = $assign;
      return $data;
    }else{
        return FALSE;
    }

 }
 
 function getRecentUpdateUser($ticket_id,$date){
      $CI = & get_instance();
      $CI->load->model("crm_model");
      $where = array('ticket_id' => $ticket_id,'ticket_history_created_at'=>$date,'ticket_history_status'=>'Solved');
      $result = $CI->crm->getData('ticket_history', 'ticket_updated_by', $where, FALSE, FALSE, FALSE);  
      if(!empty($result)){
         return $result[0]['ticket_updated_by']; 
      }else{
          return 1;
      }
 }
 
 function getPriority($ticket_priority){
     
         switch ($ticket_priority) {
                            case 'low':
                                $priority_html = "<span style='background-color: #1a82c3; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;float: right'>" . ucfirst($ticket_priority) . "</span>";
                                break;
                            case 'high':
                                $priority_html = "<span style='background-color: #f0ad4e; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;float: right'>" . ucfirst($ticket_priority) . "</span>";
                                break;
                            case 'normal':
                                $priority_html = "<span style='background-color: #26b99a; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;float: right'>" . ucfirst($ticket_priority) . "</span>";
                                break;
                            case 'urgent':
                                $priority_html = "<span style='background-color: #d9534f; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;float: right'>" . ucfirst($ticket_priority) . "</span>";
                                break;
                            default:
                                break;
                        }
                            return $priority_html;
     
 }
 function getStatus($ticket_status){
     
         switch ($ticket_status) {
                            case 'Open':
                                $status_html = "<span style='background-color: #ed5565; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;'>" . substr($ticket_status, 0, 1) . "</span>";
                                break;
                            case 'Doing':
                                $status_html = "<span style='background-color: #fb7d25; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;'>" . substr($ticket_status, 0, 1) . "</span>";
                                break;
                            case 'Pending':
                                $status_html = "<span style='background-color: #59bbe0; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;'>" . substr($ticket_status, 0, 1) . "</span>";
                            case 'Solved':
                                $status_html = "<span style='background-color: #4FB5D3; border-radius: 0.25em;color: #ffffff;display: inline;font-size: 75%;font-weight: bold;line-height: 1;padding: 0.2em 0.6em 0.3em;text-align: center;vertical-align: baseline;white-space: nowrap;'>" . substr($ticket_status, 0, 1) . "</span>";
                                break;
                            default:
                                break;
                        }
                        return $status_html;
 }

 
  function getTicketHistory($ticket_id) {
 $CI = & get_instance();
      $CI->load->model("crm_model");
        //get data for update ticket..
        $where = array('ticket_history.ticket_id' => $ticket_id);
        $ticket_history = $CI->crm->getData('ticket_history', 'ticket_history.ticket_history_created_at', $where, FALSE, 'ticket_history.ticket_history_created_at', 'DESC', 1);
        return $ticket_history;
    }
    
    function getTicketCC($ticket_id){
   
      $CI = & get_instance();
      $CI->load->model("crm_model");
        //get data for update ticket..
        $where ="ticket_cc.ticket_id = $ticket_id";
        $ticket_cc = $CI->crm->getData('ticket_cc','',$where);
        $email_array=array();                   
        if(!empty($ticket_cc)){
        foreach($ticket_cc as $val){
          $email_array[] =  $val['ticket_cc_email'] ;
        }    
        return $email_array;
        }else{
            return FALSE;
        }
    }
    
    function getPreviousStatus($ticket_id){
        $CI = & get_instance();
      $CI->load->model("crm_model");
        //get data for update ticket..
        $where ="ticket.ticket_id = $ticket_id";
        $ticket_status = $CI->crm->getData('ticket','ticket_status',$where);
                          
        if(!empty($ticket_status)){    
        return $ticket_status[0]['ticket_status'];
        }
        else{
            return FALSE;
        } 
    }

   

?>