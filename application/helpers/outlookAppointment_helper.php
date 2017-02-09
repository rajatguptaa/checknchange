<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cretaAppointment($mailid,$date,$startTime,$endTime,$subject,$desc,$location = FALSE){
    
  
    if($startTime!=''){
        $startTime = str_replace(":","", $startTime);
    }
    if($endTime!=''){
        $endTime = str_replace(":","", $endTime);
    }
    
    if($date!=''){
        $date_format = explode('-',$date);
        $date_str = $date_format[2].''.$date_format[1].''.$date_format[0];
    }

        
        $message = "BEGIN:VCALENDAR
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
DTSTART:" . $date . "T" . $startTime . "00Z
DTEND:" . $date . "T" . $endTime . "00Z
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
ORGANIZER;CN=Appointment:mailto:".$mailid."
UID:12345679
ATTENDEE;PARTSTAT=NEEDS-ACTION;RSVP= TRUE;CN=Sample:mailto:".$mailid."
DESCRIPTION:" . $desc . "
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:" . $subject . "
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR";

        /* Setting the header part, this is important */
        $headers = "From: support@ticketcrm.com.' \n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/calendar; method=REQUEST;\n";
        $headers .= '        charset="UTF-8"';
        $headers .= "\n";
        $headers .= "Content-Transfer-Encoding: 7bit";

        /* mail content , attaching the ics detail in the mail as content */
       
        $subject = html_entity_decode($subject, ENT_QUOTES, 'UTF-8');

        /* mail send */
        mail($mailid, $subject, $message, $headers);
       
    
}