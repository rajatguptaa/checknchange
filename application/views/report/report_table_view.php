    <?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>

<div class="x_panel">
<?php if ($reportType == 1115) { ?>
            <table id="table1" class="table table-striped responsive-utilities jambo_table report">
            <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Priority</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($reportData)) {
                    $i=1;
                    foreach ($reportData as $key => $val) {
                        ?>
                        <tr class="<?php echo ($i/2==0)?'even pointer':'odd pointer';?>">
                              <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            
                        </tr>
        <?php $i++; } ?><tr><td colspan="6"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr>
   <?php  } else{?>
                        <tr><td colspan="6" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?> 
            </tbody>
        </table>
        <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
    <?php } ?>
 
        

            <!--assigned tickets-->
<?php if ($reportType == 1116) { ?>
    
           <table id="table3" class="table table-striped responsive-utilities jambo_table report">
            <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Priority</th>
            <th>Group</th>
            <th>Assignee</th></tr>
            </thead>
            <tbody>
                
                    
                     
                           
                            <?php
                            if (!empty($reportData)) {
                                 $i=1;
                                foreach ($reportData as $key => $val) {
                       
                                    ?>
                      
                          <tr>
                               <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                                
                              <?php echo $val['ticket_subject']; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                           
                            
                                <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                          
                           
                            <td class="text-capitalize">  <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                            $grp = getUserGroupDetails($assigneeData);
                                            foreach($grp as $grp_val){
                                              $str .= ',' . $grp_val['group_title'];
                                            }
    
                                        }
                                        if($str!=''){
                                        $gro_arr = array_unique(explode(',', ltrim($str, ',')));
                                        echo implode(',',$gro_arr);
                                        }
                               
                                    } else {
                                        echo '-';
                                    }
                                    ?>   </td>
                            <td class="text-capitalize col-pad">
                                <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                       
                                            $str .= ',' . getUserName($assigneeData);
                                        }
                                           
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>    
                            </td>
                        </tr>
                     
            <?php $i++; }
            ?>
                        <tr><td colspan="8"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr>
       <?php }  else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
                        
            </tbody>
        </table>
              <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
   
    <?php } ?>
    
         
                     <!--assigned tickets-->
<?php if ($reportType == 1117) { ?>
    
             <table id="table2" class="table table-striped responsive-utilities jambo_table report">
           <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Last update</th>
            <th>Assignee</th></tr>
            </thead>
            <tbody>
                
                    
                     
                           
                            <?php
                            if (!empty($reportData)) {
                                 $i=1;
                                foreach ($reportData as $key => $val) {
                                    ?>
                      
                          <tr>
                               <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                                
                              <?php echo $val['ticket_subject']; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                           
                            <td class="text-capitalize">
                               <?php echo dateFormate($val['ticket_updated']); ?>
                            </td>
                            <td class="text-capitalize col-pad">
                                <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                       
                                            $str .= ',' . getUserName($assigneeData);
                                        }
                                           
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>    
                            </td>
                        </tr>
            <?php $i++;}?>
                        <tr><td colspan="7"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr><?php
        }  else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
                <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
   
    <?php } ?>
         
         
<?php if ($reportType == 1120) { ?>
    
             <table id="table2" class="table table-striped responsive-utilities jambo_table report">
           <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Last update</th>
            <th>Assignee</th></tr>
            </thead>
            <tbody>
                
                    
                     
                           
                            <?php
                            if (!empty($reportData)) {
                                 $i=1;
                                foreach ($reportData as $key => $val) {
                                    ?>
                      
                          <tr>
                               <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                                
                              <?php echo $val['ticket_subject']; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                           
                            <td class="text-capitalize">
                            <?php
                                    echo dateFormate($val['ticket_updated']);
                               
                                ?>
                            </td>
                            <td class="text-capitalize col-pad">
                                <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                       
                                            $str .= ',' . getUserName($assigneeData);
                                        }
                                           
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>    
                            </td>
                        </tr>
            <?php           $i++;}
            ?><tr><td colspan="7"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr><?php
        }  else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
               <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
   
    <?php } ?>

    <!--assigned tickets-->

<?php if ($reportType == 1121) { ?>
            <table class="table table-striped responsive-utilities jambo_table report">
            <thead>
            <tr class="headings">
            <th>Ticket #</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Solved</th>
            <th>Priority</th>
            <th>Solved By</th></tr>
            
            </thead>
            <tbody>

    <?php
    if (!empty($reportData)) {
        $i=1;
        foreach ($reportData as $key => $val) {
            ?>
                        <tr>
                             <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                 
                            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo getUserName($val['user_id']); ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                            <td class=""><?php
                                $date_a = new DateTime(date("Y-m-d H:i:s"));
                                $date_b = new DateTime($val['ticket_updated']);
                                $interval = date_diff($date_a, $date_b);
                               
                                
                                $days = $interval->format('%d');
                                $months = $interval->format('%m');
                                $time = explode(':', $interval->format('%H:%i:%s'));
                                if($days==0){
                                if ($time[0] < 1) {
                                    echo $time[1] . ' min ago';
                                } elseif ($time[0] < 24 && $time[0] > 1) {
                                    echo 'Today ' . $time[1] . ':' . $time[0];
                                }
                                }else{
                                  if($days<=10){  
                                  echo $days.' days ago';
                                  }else{
                                 echo dateFormate($val['updated_date']);   
                                  }
                                }
                                ?>




                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize"><?php echo getUserName($val['ticket_updated_by']); ?></td>
                          
                        </tr>
        <?php $i++; } ?>
        <tr><td colspan="8"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr>
   <?php  } else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
               <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
<?php } ?>

         <?php if ($reportType == 1118) { ?>
            <table id="table1" class="table table-striped responsive-utilities jambo_table report">
            <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Satisfaction</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Assignee</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($reportData)) {
                    $i=1;
                    foreach ($reportData as $key => $val) {
                        ?>
                        <tr class="<?php echo ($i/2==0)?'even pointer':'odd pointer';?>">
                            <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                            <?php echo $val['feedback_comment']; ?></td>
                            <td class="text-capitalize">
                            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo getUserName($val['user_id']); ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                             <td class="text-capitalize col-pad">
                                <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                       
                                            $str .= ',' . getUserName($assigneeData);
                                        }
                                           
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>    
                            </td>
                            
                        </tr>
        <?php $i++; } ?><tr><td colspan="7"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr>
   <?php  } else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?> 
            </tbody>
        </table>
               <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
    <?php } ?>
         
         <?php if ($reportType == 1119) { ?>
            <table id="table1" class="table table-striped responsive-utilities jambo_table report">
            <thead><tr class="headings">
            <th>Ticket #</th>
            <th>Satisfaction</th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Request date</th>
            <th>Assignee</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($reportData)) {
                    $i=1;
                    foreach ($reportData as $key => $val) {
                        ?>
                        <tr class="<?php echo ($i/2==0)?'even pointer':'odd pointer';?>">
                            <td class="text-capitalize"><?php echo $i;?></td>
                            <td class="text-capitalize">
                            <?php echo $val['feedback_comment']; ?></td>
                            <td class="text-capitalize">
                            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo getUserName($val['user_id']); ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                             <td class="text-capitalize col-pad">
                                <?php
                                    $ticketAssignData = getTicketAssignee($val['ticket_id']);
                                                                   
                                    if (!empty($ticketAssignData)) {
                                            
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                       
                                            $str .= ',' . getUserName($assigneeData);
                                        }
                                           
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>    
                            </td>
                            
                        </tr>
        <?php $i++; } ?><tr><td colspan="7"><b>Total:</b>&nbsp;&nbsp;<?php echo count($reportData);?></td></tr>
   <?php  } else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?> 
            </tbody>
        </table>
               <input type="hidden" id="page_count" value="<?php echo count($reportData);?>">
    <?php } ?>
</div>