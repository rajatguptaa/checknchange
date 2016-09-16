<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Extra extends CI_Controller {

    public function accessdenied() {
        $this->load->template('/extra/noaccess');
    }

    public function test() {

                $headers = "From: ankit@24x7ibuilder.com\n";
          $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/calendar; method=REQUEST;\n";
        $headers .= 'charset="UTF-8"';
         $headers .= "\n";
          $headers .= "Content-Transfer-Encoding: 7bit";
        echo mail("ankit@24x7ibuilder.com","asdf","asdf",$headers);
        die;
        $ical = "BEGIN:VCALENDAR
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
UID:116256c5ae8948bf5@ahmadamin.com
DTSTART:20160219T173000Z
DTEND:20160219T174000Z
DTSTAMP:20160219T173000Z
ORGANIZER;CN=John Doe:mailto:john@doe.com
ATTENDEE;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=Ahmad Amin;X-NUM-GUESTS=0:mailto:ankit@24x7ibuilder.com
CREATED:
DESCRIPTION:The is a test invite for you to see how this thing actually works
LAST-MODIFIED:20160218T173000Z
LOCATION:Queens, New York
SUMMARY:Test Demo Invite
SEQUENCE:0
STATUS:NEEDS-ACTION
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR";

        /*        $ical = 'BEGIN:VCALENDAR' . "\r\n" .
          'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
          'VERSION:2.0' . "\r\n" .
          'METHOD:REQUEST' . "\r\n" .
          'BEGIN:VTIMEZONE' . "\r\n" .
          'TZID:Eastern Time' . "\r\n" .
          'BEGIN:STANDARD' . "\r\n" .
          'DTSTART:20091101T020000' . "\r\n" .
          'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
          'TZOFFSETFROM:-0400' . "\r\n" .
          'TZOFFSETTO:-0500' . "\r\n" .
          'TZNAME:EST' . "\r\n" .
          'END:STANDARD' . "\r\n" .
          'BEGIN:DAYLIGHT' . "\r\n" .
          'DTSTART:20090301T020000' . "\r\n" .
          'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
          'TZOFFSETFROM:-0500' . "\r\n" .
          'TZOFFSETTO:-0400' . "\r\n" .
          'TZNAME:EDST' . "\r\n" .
          'END:DAYLIGHT' . "\r\n" .
          'END:VTIMEZONE' . "\r\n" .
          'BEGIN:VEVENT' . "\r\n" .
          'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
          'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
          'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
          'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
          'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
          'DTSTART;TZID="Eastern Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
          'DTEND;TZID="Eastern Time":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
          'TRANSP:OPAQUE'. "\r\n" .
          'SEQUENCE:1'. "\r\n" .
          'SUMMARY:' . $subject . "\r\n" .
          'LOCATION:' . $location . "\r\n" .
          'CLASS:PUBLIC'. "\r\n" .
          'PRIORITY:5'. "\r\n" .
          'BEGIN:VALARM' . "\r\n" .
          'TRIGGER:-PT15M' . "\r\n" .
          'ACTION:DISPLAY' . "\r\n" .
          'DESCRIPTION:Reminder' . "\r\n" .
          'END:VALARM' . "\r\n" .
          'END:VEVENT'. "\r\n" .
          'END:VCALENDAR'. "\r\n";
         * 
         */
        //  $message = 'Content-Type: text/calendar;name="assets/invite.ics";method=REQUEST'."\n";
        //  $message .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = $ical;


        /* Setting the header part, this is important */
        $headers = ""; //From: ankit@24x7ibuilder.com\n";
        //  $headers .= "MIME-Version: 1.0\n";
        //$headers .= "Content-Type: text/calendar; method=REQUEST;\n";
        //$headers .= "        charset="UTF-8"';
        // $headers .= "\n";
        //  $headers .= "Content-Transfer-Encoding: 7bit";
//        echo file_get_contents("assets/invite.ics");
        /* mail content , attaching the ics detail in the mail as content */
        $subject = "Meeting Subject";
        $subject = html_entity_decode($subject, ENT_QUOTES, 'UTF-8');
//$description = str_replace("\r\n", "\\n", $description);
        /* mail send */
        if (mymail("ankit@24x7ibuilder.com", $subject, $message, $headers, "ankit@24x7ibuilder.com", "assets/invite.ics")) {

            echo "sent";
        } else {
            echo "error";
        }
    }

    public function test1() {
        $to = 'ankit@24x7ibuilder.com';
        $subject = "Millennium Falcon";

        $organizer = 'Darth Vader';
        $organizer_email = 'ankit@ignisitsolutions.com';

        $participant_name_1 = 'ankit';
        $participant_email_1 = 'ankit@ignisitsolutions.com';

        $participant_name_2 = 'sandeep';
        $participant_email_2 = 'sandeep@ignisitsolutions.com';

        $location = "Stardestroyer-013";
        $date = '20160219';
        $startTime = '1200';
        $endTime = '1300';
        $subject = 'Millennium Falcon';
        $desc = 'The purpose of the meeting is to discuss the capture of Millennium Falcon and its crew.';

        $headers = 'Content-Type:text/calendar; Content-Disposition: inline; charset=utf-8;\r\n';
        $headers .= "Content-Type: text/plain;charset=\"utf-8\"\r\n"; #EDIT: TYPO

        $message = "BEGIN:VCALENDAR\r\n
    VERSION:2.0\r\n
    PRODID:-//Deathstar-mailer//theforce/NONSGML v1.0//EN\r\n
    METHOD:REQUEST\r\n
    BEGIN:VEVENT\r\n
    UID:" . md5(uniqid(mt_rand(), true)) . "example.com\r\n
    DTSTAMP:" . gmdate('Ymd') . 'T' . gmdate('His') . "Z\r\n
    DTSTART:" . $date . "T" . $startTime . "00Z\r\n
    DTEND:" . $date . "T" . $endTime . "00Z\r\n
    SUMMARY:" . $subject . "\r\n
    ORGANIZER;CN=" . $organizer . ":mailto:" . $organizer_email . "\r\n
    LOCATION:" . $location . "\r\n
    DESCRIPTION:" . $desc . "\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN" . $participant_name_1 . ";X-NUM-GUESTS=0:MAILTO:" . $participant_email_1 . "\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN" . $participant_name_2 . ";X-NUM-GUESTS=0:MAILTO:" . $participant_email_2 . "\r\n
    END:VEVENT\r\n
    END:VCALENDAR\r\n";

        $headers .= $message;
        mail($to, $subject, $message, $headers);
    }
    
    
      public function autoClosed($org_id,$index) {
        $this->load->model('crm_model','crm');  
       
        if(count($org_id)<$index){
           return FALSE;
        }
        else{
        $where = "(ticket.ticket_status = 'Solved') AND (ticket.organisation_id = '$org_id[$index]]')";
        $ticketData = $this->crm->getData('ticket', '*', $where, $join, 'ticket_updated', 'DESC', '', '', '');


        foreach ($ticketData as $val) {
            $future_date = strtotime(date('Y-m-d H:i:s', strtotime($val["ticket_updated"] . " +48 hours")));
            $ticket_time = strtotime($val["ticket_updated"]);
            $current_time = time();


            if ($current_time >= $future_date) {
                $response = $this->crm->rowUpdate('ticket', array('ticket_status' => 'Closed', 'ticket_updated' => date('Y-m-d H:i:s')), array('ticket_id' => $val["ticket_id"]));
                if ($response) {
                    $update_by = getRecentUpdateUser($val["ticket_id"], $val['ticket_updated']);
                    $history_response = $this->crm->rowInsert('ticket_history', array('ticket_id' => $val["ticket_id"], 'ticket_history_status' => 'Closed', 'ticket_history_created_at' => date('Y-m-d H:i:s'), 'ticket_updated_by' => $update_by));
                    if($history_response){
                        $customer_details = getUserDetails($val['user_id']);
                        $status_html = getStatus($val['ticket_status']);
                        $condition = "(`ticket_history`.`ticket_id` = $val[ticket_id]) AND (`ticket_history_status` = 'Closed')";
                        $closed_date =  $this->crm->getData('ticket_history', '*',$condition);
                        $maildata['content'] = sprintf(TICKET_CLOSED_STATUS, $status_html, $ticket_detail['ticket_number'], dateFormate($closed_date[0]['ticket_history_created_at']));

                        $maildata['ticket_detail'] = $ticket_detail;
                        $maildata['link'] = base_url('request/feedback/' .$val['user_id'].'/'.$val['ticket_id']);
                        $maildata['btntitle'] = 'Feedback';
                        $message='';
                        $message .= $this->load->view('/email_template/email_header', FALSE, TRUE);
                        $message .= $this->load->view('/email_template/email_view', $maildata, TRUE);
                        $message .= $this->load->view('/email_template/email_footer', FALSE, TRUE);
                        mymail($customer_details['user_email'], TICKET_CLOSED_SUB, $message);
                        
                    }
                    
                    
                }
            }
        }  
       $index = $index+1;
        return $this->autoClosed($org_id,$index);
        }  

        
    }
    
    
     public function cron_for_close(){
       $this->load->model('crm_model','crm');  
       $org_data = $this->crm->getData('organisation'); 
       $org_id =array();
       $index=0;
       if(!empty($org_data)){
       foreach($org_data as $val){
          $org_id[] =  $val['organisation_id'];
       }
       }
     echo  $this->autoClosed($org_id,$index);
    }

}
