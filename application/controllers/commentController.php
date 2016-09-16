<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'baseController.php';
use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;
class CommentController extends BaseController {

    public function index($ticket_id = FALSE,$org_id =FALSE) {

        $pagedata['ticket_id'] = $ticket_id;
         

        $join[] = array(
            'table' => 'user',
            'on' => 'comment.comment_by_id=user.user_id',
            'join' => 'inner'
        );
        
        $join[] = array(
            'table' => 'organisation',
            'on' => 'organisation.organisation_id=user.user_id',
            'join' => 'left'
        );

        $join[] = array(
            'table' => 'ticket_comment_rel',
            'on' => 'comment.comment_id=ticket_comment_rel.comment_id',
            'join' => 'inner'
        );

        if ($ticket_id) {
            $where = array("ticket_comment_rel.ticket_id" => $ticket_id,'ticket_comment_rel.comment_type !='=>'appointment');
        }

        $select = 'organisation.organisation_name,comment.comment_message,comment.comment_id,comment.comment_update,user.user_name,user.user_profile,ticket_comment_rel.comment_type';
        $comment_data = $this->crm->getData('comment', $select, $where, $join,'comment.comment_update');
        $join2 = array(array(
            'table' => 'user',
            'on' => 'comment.comment_by_id=user.user_id',
            'join' => 'inner'
        ),array(
            'table' => 'organisation',
            'on' => 'organisation.organisation_id=user.user_id',
            'join' => 'left'
        ), array(
            'table' => 'ticket_comment_rel',
            'on' => 'comment.comment_id=ticket_comment_rel.comment_id',
            'join' => 'inner'
        ));
        

        if ($ticket_id) {
            $where2 = array("ticket_comment_rel.ticket_id" => $ticket_id,'ticket_comment_rel.comment_type'=>'appointment');
        }

        $select2 = 'organisation.organisation_name,comment.comment_message,comment.comment_id,comment.comment_update,user.user_name,user.user_profile,ticket_comment_rel.comment_type';
       $pagedata['appointment_data'] = $this->crm->getData('comment', $select2, $where2, $join2,'comment.comment_update');
           $join_user = array(
                array('table' => 'user_organisation_rel',
                    'on' => 'user_organisation_rel.user_id=user.user_id'),
            );
            $where_user['user_access_level'] = 3;
            $where_user['user_status'] = 1;
            $where_user['user_organisation_rel.organisation_id'] = $org_id;
            $select_user = 'user.user_id,user_name,user_email';
            $pagedata['employee_details'] = $this->crm->getData('user', $select_user, $where_user, $join_user, 'user.user_update', 'DESC');
        $pagedata['comment_data'] = $comment_data;
        $this->load->view('comment/comment_view', $pagedata);
    }

    public function createComment() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<ul class="parsley-errors-list filled server_message" data-parsley-id="6"><li class="parsley-required">', '</li></ul>');
        $this->load->helper('outlookAppointment');
        $attachments = $this->input->post('attachment_id');
        $ticket_id = $this->input->post('ticket_id');
        $appointment_id = FALSE;
       
       $this->form_validation->set_rules('comments', 'Comment', 'required');  
        if(($this->input->post('comment_type')=='private') && ($this->input->post('aptchk')=='on')){
         
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('start_time', 'Start time', 'required');
        $this->form_validation->set_rules('end_time', 'End time', 'required');
        $this->form_validation->set_rules('appointment_user', 'Assignee', 'required');
       
        
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $error = $this->form_validation->error_array();
            $result['result'] = false;
            $result['error'] = $error;
            echo json_encode($result);
        }else{
            $date = $this->input->post('date');
            $d = date('Y-m-d',  strtotime($date));
          
             $appointment_data = array(
             'appointment_date'=>$d,    
             'appointment_start_time'=>$this->input->post('start_time'),    
             'appointment_end_time'=>$this->input->post('end_time'),   
             'appointment_create'=>date("Y-m-d H:i:s"),    
             );   
          
            $appointment_id = $this->crm->rowInsert('appointment',$appointment_data);
            $comment_id = $this->crm->rowInsert('comment', array('comment_message' => $this->input->post('comments'), 'comment_by_id' => $this->input->post('comment_by'), 'comment_update' => date("Y-m-d H:i:s")));
          
        }
      }else{
       
           if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $error = $this->form_validation->error_array();
            $result['result'] = false;
            $result['error'] = $error;
            echo json_encode($result);
         }else{
       $comment_id = $this->crm->rowInsert('comment', array('comment_message' => $this->input->post('comments'), 'comment_by_id' => $this->input->post('comment_by'), 'comment_update' => date("Y-m-d H:i:s")));
         }
      }   
       
          
        if ($comment_id) {
            if(($this->input->post('comment_type')=='private') && ($this->input->post('aptchk')=='on')){
              $comment_type = 'appointment';  
            }else{
              $comment_type  =  $this->input->post('comment_type');
            }
            $ticket_comment_id = $this->crm->rowInsert('ticket_comment_rel', array('comment_id' => $comment_id, 'ticket_id' => $this->input->post('ticket_id'),'comment_type'=>$comment_type));
            

            if ($ticket_comment_id) { 
                if($attachments) 
                {
                    foreach ($attachments as $key => $val) {
                        $this->crm->rowInsert('comment_attachment_rel', array('comment_id' => $comment_id, 'attachment_id' => $val));
                    }
                }
                    $user_id = getLoginUser();
                    
                    if(!empty($this->input->post('appointment_user'))){
                    $assignee = $this->input->post('appointment_user');
                    }else{
                    $assignee  = getTicketAssignee($ticket_id);    
                    }
                    
                    
                    $message = '';
                    $org = getUserOrginasationDetails($user_id);
                    $ticket_detail = getTicketDetails($ticket_id);
                    $comment_detail['ticket_attachment'] = $this->getCommentAttachRel($comment_id);
                    $maildata['content'] = sprintf(TICKET_COMMENT_CREATION,getUserName($user_id),$ticket_detail['ticket_number'],$this->input->post('comments'),$ticket_detail['ticket_number']);
                    $maildata['ticket_detail'] = $comment_detail;
                    $maildata['link'] = base_url('request/ticket/view/' . $ticket_id);
                    $maildata['btntitle'] = 'View Ticket';
                    
              
                    $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                    $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                    $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                    if(!empty($assignee)){
                    $unique_array = array_unique($assignee);
                    foreach($unique_array as $assignee_val){
                    
                      $assignee_detail = getUserDetails($assignee_val);
                        if($comment_type != 'appointment'){  
                          mymail($assignee_detail['user_email'], TICKET_COMMENT_SUB, $message);
                        }
                        
                      else{
                        
                      if($appointment_id){
                       $appointment_relation = array(
                        'appointment_id'=>$appointment_id,
                        'ticket_id'=>$ticket_id,
                        'assignee_id'=>$assignee_val,
                        'assigned_by'=>getLoginUser(),
                        'comment_id'=>$comment_id,
                        'created_at'=>date("Y-m-d H:i:s")   
                       );   
                       $appointment_relation_id = $this->crm->rowInsert('appointment_relation',$appointment_relation); 
                       if($appointment_relation_id){
                        cretaAppointment($assignee_detail['user_email'],$appointment_data['appointment_date'],$appointment_data['appointment_start_time'],$appointment_data['appointment_end_time'],$ticket_detail['ticket_subject'],$this->input->post('comments'));   
                       }
                      }
                   }
                }
                    }
               $result['result'] = true;
               echo json_encode($result);
                die;
            } else {
                $result['result'] = false;
                echo json_encode($result);
            }
        }
       
    }

    public function editComment() {
        
    }

    public function updateComment() {
        
    }

    public function showComment() {
        
    }

    public function deleteComment() {
        
    }
    
    
    
    public function getCommentAttachRel($comment_id) {
      
         $join = array(
            array(
                'table' => 'attachment',
                'on' => 'comment_attachment_rel.attachment_id=attachment.attachment_id'),
        );
        $commenttAttachmentData = $this->crm->getData('comment_attachment_rel','attachment.attachment_id,attachment.attachment_name',array('comment_attachment_rel.comment_id'=>$comment_id),$join);
        return $commenttAttachmentData;
    }

public function getTicketAssignee($ticket_id) {
     

        $where = array('ticket_id' => $ticket_id);
        $ticketAssignData = $this->crm->getData('ticket_assign', 'user_id', $where, FALSE, FALSE, FALSE);
        if(!empty($ticketAssignData)){
        foreach ($ticketAssignData as $value){
                         $assignee_user[]= $value['user_id'];
                     }
                     
        return $assignee_user;
        }
        else{
            return $assignee_user=array();
        }
    }
   
    
    public function getReply(){

      $mailbox = new ImapMailbox;  
      $mailsIds = $mailbox->searchMailbox('ALL');

    
if(!$mailsIds) {
    die('Mailbox is empty');
}
else{
        
	rsort($mailsIds);
          
         $info = $mailbox->getMailsInfo($mailsIds);
         
         echo "<pre>";
         
         if(!empty($info)){
          foreach ($info as $key=>$mail_val){
            $current_time = date("Y-m-d H:i:s");
            $mail_time = date('Y-m-d H:i:s',$mail_val->udate);
            $diff = strtotime($current_time) - strtotime($mail_time);
            $diff_in_hrs = round($diff/3600);    
          
        
          if(array_key_exists('in_reply_to', $mail_val)) {
            
//           if($diff_in_hrs<=1){
           $ids[] = $mail_val->uid;
           $message[] = $mailbox->getMail($mail_val->uid);
   
//           }
          } 
        }
         }
      }
      
 
    if(!empty($message)){
     foreach($message as $message_val) {
    
     $full_text  = preg_replace('/(^\w.+:\n)?(^>.*(\n|$))+/mi','',$message_val->textPlain);
   
     $trim_string = preg_replace('/\s+/', ' ',$full_text);
    
        $pattern = "/On \b([0-9]{1,2}[\s]{1}[\w]*[\s]{1}[\d]{4}[\s]{1}[a]{1}[t]{1}[\s]{1}[0-9]{1,2}[:][0-9]{1,2}|[\d]{4}-[0-9]{1,2}-[0-9]{1,2}[\s]{1}[0-9]{1,2}[:][0-9]{1,2})\b/";
    $content  = preg_split($pattern,$trim_string);
      
     $ticket_number =   substr($message_val->textPlain,strpos($message_val->textPlain,"#TKT"),12);
      $comment_data[$ticket_number][] =array(
        'comment_message' =>$content[0],
        'comment_by'=>$message_val->fromAddress ,
        'comment_at'=>$message_val->date 
     );
 
      
     }

foreach($comment_data as $key=>$comment_val){
   $ticket = $this->crm->getData('ticket', 'ticket_id',array('ticket_number'=>$key),FALSE, FALSE, FALSE);
   foreach($comment_val as $comment_detail){
   $user = $this->crm->getData('user','user_id',array('user_email'=>$comment_detail['comment_by']));
   $input_data =array(
                     'comment_message'=>$comment_detail['comment_message'],
                     'comment_by_id'=>$user[0]['user_id'],
                     'comment_update'=>$comment_detail['comment_at']
       );
   
      $comment_id = $this->crm->rowInsert('comment',$input_data);
      if ($comment_id) {
     $this->crm->rowInsert('ticket_comment_rel', array('comment_id' => $comment_id, 'ticket_id' =>$ticket[0]['ticket_id'],'comment_type'=>'public'));
      }
}
}


    }
    
 
   die;

   
}  


    
    
}

?>
