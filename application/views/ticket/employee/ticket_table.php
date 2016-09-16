    <?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="x_panel">
    <h3><?php echo $mainHeading; ?></h3>


    <!--New Open OR Pending-->
    <?php if ($ticketType == 1) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Type</th>
            <th>Priority</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (!empty($ticketData)) {
                    foreach ($ticketData as $key => $val) {
                        ?>
                       
                        <tr >
                            <td>
                            <input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="<?php echo $val['ticket_status']; ?> popover-anchor ticket_edit"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo getUserName($val['user_id']); ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_type']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php }
                } else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
        <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
    <!--New Open OR Pending-->



    <!--Unassigned tickets-->
<?php if ($ticketType == 2) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table id="table1" class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th data-hide="phone,tablet">Ticket Number</th>
            <th data-hide="phone,tablet">Requester</th>
            <th data-hide="phone,tablet">Requested</th>
            <th data-hide="phone,tablet">Priority</th>
           
            <th data-hide="phone,tablet">Action</th>
            </thead>
            <tbody>
                <?php
                if (!empty($ticketData)) {
                    foreach ($ticketData as $key => $val) {
                        ?>
                        <tr>
                            <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a href="#" data-id="<?php echo $val['ticket_id']; ?>" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                           
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    } else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?> 
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
    <?php } ?>
    <!--Unassigned tickets-->


    <!--All unsolved tickets-->
<?php if ($ticketType == 3) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Updated</th>
            <th>Action</th>
            </thead>
            <tbody>
                            <?php
                            if (!empty($ticketData)) {
                                foreach ($ticketData as $key => $val) {
                                    ?>
                        <tr><td colspan="7" class="text-capitalize"> <b>Assignee :
                                    <?php
                                    $ticketAssignData = TicketController::getTicketAssignee($val['ticket_id']);
                                    if (!empty($ticketAssignData)) {
//                                              var_dump($ticketAssignData);
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                            $str .= ', ' . implode(',', $assigneeData);
                                        }
//                                              echo $str;
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>     

                                </b></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a href="#" data-id="<?php echo $val['ticket_id']; ?>" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?>
                                </a> 
            <?php echo $val['ticket_subject']; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_created']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize">
                               <?php echo dateFormate($val['ticket_updated']); ?>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
            <?php }
        }  else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
    <?php }?> 
    <!--All unsolved tickets-->



    <!--Recently updated tickets-->
<?php if ($ticketType == 4) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
    <!--                                    <th>Priority</th>-->
            <th>Updated By</th>
            <th>Updated At</th>
            <th>Action</th>
            </thead>
            <tbody>

                        <?php
                        if (!empty($ticketData)) {
                            foreach ($ticketData as $key => $val) {
                                ?>
                        <tr>
                             
                            <td class="text-capitalize">
                                <a href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>"class="ticket_edit <?php echo $val['ticket_history_status']; ?> popover-anchor"><?php echo substr($val['ticket_history_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
            <!--                                          <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>-->
                            <td class="text-capitalize"><?php echo $val['ticket_updater']; ?></td>
                            <td><?php echo dateFormate($val['updated_date']); ?></td>
                            <td class="text-capitalize col-pad">
                                 <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    }  else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php }  ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
    <!--Recently updated tickets-->


    <!--New ticket in your group-->
<?php if ($ticketType == 5) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>    
            <th>Subject</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Assignee</th>
            <th>Action</th>
            </thead>
            <tbody>
                        <?php
                        if (!empty($ticketData)) {
                            foreach ($ticketData as $key => $val) {
                                ?>
                        <tr><td colspan="6" class="text-capitalize"> <b>Group : <?php echo $key; ?></b></td></tr>
                        <tr >
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize col-pad">
                               <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    } else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php }  ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
    <!--New ticket in your group-->



    <!--Pending tickets-->
<?php if ($ticketType == 6) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Action</th>
            </thead>
            <tbody>
                        <?php
                        if (!empty($ticketData)) {
                            foreach ($ticketData as $key => $val) {
                                ?>
                        <tr>
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?>
                                </a>
                            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>

            <!--<td class="text-capitalize">Test Group</td>-->
            <!--                                          <td class="text-capitalize">
            <?php
            $ticketAssignData = TicketController::getTicketAssignee($val['ticket_id']);
            if (!empty($ticketAssignData)) {
                echo $ticketAssignData['assignee'];
            } else {
                echo '-';
            }
            ?>

            </td>-->
                            <td class="text-capitalize col-pad">
                               <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    }  ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
    <!--Pending tickets-->


    <!--Recently solved tickets-->
<?php if ($ticketType == 7) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Solved</th>
            <th>Priority</th>
            <th>Solved By</th>
            <th>Action</th>
            </thead>
            <tbody>

    <?php
    if (!empty($ticketData)) {
        foreach ($ticketData as $key => $val) {
            ?>
                        <tr>
                            
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
                                <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td class=""><?php
                                $date_a = new DateTime(date("Y-m-d H:i:s"));
                                $date_b = new DateTime($val['updated_date']);
                                $interval = date_diff($date_a, $date_b);
                                $time = explode(':', $interval->format('%H:%i:%s'));
                                if ($time[0] < 1) {
                                    echo $time[1] . ' min ago';
                                } elseif ($time[0] < 24 && $time[0] > 1) {
                                    echo 'Today ' . $time[1] . ':' . $time[0];
                                } else {
                                    echo dateFormate($val['updated_date']);
                                }
                                ?>




                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_updater']; ?></td>
                            <td class="text-capitalize col-pad" style="padding: 11px 0px">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    } else{?>
                        <tr><td colspan="7" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
    <!--Recently solved tickets-->


    <!--Unsolved tickets in your groups-->
<?php if ($ticketType == 8) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Action</th>
            </thead>
            <tbody>
                        <?php
                        if (!empty($ticketData)) {
                            foreach ($ticketData as $key => $val) {
                                ?>
                        <tr><td colspan="5" class="text-capitalize"> <b>Group : <?php echo $key; ?></b></td></tr>
                        <tr >
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>

                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
            <?php }
        } else { ?>
                        <tr><td colspan="8" style="text-align:center">Ticket not found</td></tr>
    <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>

    <!--Suspended tickets-->
<?php if ($ticketType == 9) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Action</th>
            </thead>
            <tbody>
    <?php
    if (!empty($ticketData)) {
        foreach ($ticketData as $key => $val) {
            ?>
                        <tr><td colspan="5" class="text-capitalize"> <b>Group : <?php echo $key; ?></b></td></tr>
                        <tr >
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket']['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content='<?php echo '<span class=' . $val['ticket']['ticket_status'] . '>' . $val['ticket']['ticket_status'] . '</span> ' . $val['ticket']['ticket_type'] . ' ' . $val['ticket']['ticket_number'] . '<br><br><b>' . $val['ticket']['ticket_subject'] . '</b><br>' . $val['ticket']['ticket_description']; ?>' class="ticket_edit <?php echo $val['ticket']['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket']['ticket_status'], 0, 1); ?></a>
                        <?php echo $val['ticket']['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket']['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket']['ticket_creater']; ?></td>

                            <td class="text-capitalize"><?php echo $val['ticket']['ticket_priority']; ?></td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    }else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
        
        
       <?php if ($ticketType == 10) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Type</th>
            <th>Priority</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (!empty($ticketData)) {
                    foreach ($ticketData as $key => $val) {
                        ?>
                        <tr><td colspan="7" class="text-capitalize"><b>Status : <?php echo $val['ticket_status']; ?></b></td></tr>
                        <tr>
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a data-id="<?php echo $val['ticket_id']; ?>" href="#" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="<?php echo $val['ticket_status']; ?> popover-anchor ticket_edit"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_type']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
<?php } ?>
        
            <!--assigned tickets-->
<?php if ($ticketType == 11) { ?>
        <h6><?php echo count($ticketData); ?> ticket</h6>
        <?php if($access_level==3){?>
        <table id="table1" class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th data-hide="phone,tablet">Ticket Number</th>
            <th data-hide="phone,tablet">Requester</th>
            <th data-hide="phone,tablet">Requested</th>
            <th data-hide="phone,tablet">Priority</th>
            <th data-hide="phone,tablet">Group</th>
            <th data-hide="phone,tablet">Action</th>
            </thead>
            <tbody>
                <?php
                if (!empty($ticketData)) {
                    foreach ($ticketData as $key => $val) {
                        ?>
                        <tr>
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a href="#" data-id="<?php echo $val['ticket_id']; ?>" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?></a>
            <?php echo $val['ticket_subject']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize">Support</td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
        <?php }
    }else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?> 
            </tbody>
        </table>
        <?php }else{?>
            <table class="table table-hover table-responsive footable">
            <thead>
            <th></th>
            <th>Subject</th>
            <th>Ticket Number</th>
            <th>Requester</th>
            <th>Requested</th>
            <th>Priority</th>
            <th>Updated</th>
            <th>Action</th>
            </thead>
            <tbody>
                            <?php
                            if (!empty($ticketData)) {
                                foreach ($ticketData as $key => $val) {
                                    ?>
                        <tr><td colspan="8" class="text-capitalize"> <b>Assignee :
                                    <?php
                                    $ticketAssignData = TicketController::getTicketAssignee($val['ticket_id']);
                                    if (!empty($ticketAssignData)) {
//                                              var_dump($ticketAssignData);
                                        $str = '';
                                        foreach ($ticketAssignData as $assigneeData) {
                                            $str .= ', ' . implode(',', $assigneeData);
                                        }
//                                              echo $str;
                                        echo ltrim($str, ',');
                                    } else {
                                        echo '-';
                                    }
                                    ?>     

                                </b></td>
                        </tr>
                        <tr>
                             <td><input type="checkbox" class="select_id" value="<?php echo $val['ticket_id']; ?>"></td>
                            <td class="text-capitalize">
                                <a href="#" data-id="<?php echo $val['ticket_id']; ?>" data-popover="true" data-html="true" data-toggle="popover" data-content="<span class=<?= $val['ticket_status'] ?>><?= $val['ticket_status'] ?></span><?= $val['ticket_type'] . ' ' . $val['ticket_number']?><br><br><b><?= $val['ticket_subject']?></b><br><?= $val['ticket_description']; ?>" class="ticket_edit <?php echo $val['ticket_status']; ?> popover-anchor"><?php echo substr($val['ticket_status'], 0, 1); ?>
                                </a> 
            <?php echo $val['ticket_subject']; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $val['ticket_number']; ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_creater']; ?></td>
                            <td><?php echo dateFormate($val['ticket_updated']); ?></td>
                            <td class="text-capitalize"><?php echo $val['ticket_priority']; ?></td>
                            <td class="text-capitalize">
                                <?php
                                $ticket_history = TicketController::getTicketHistory($val['ticket_id']);
                                if (!empty($ticket_history)) {
                                    echo $ticket_history[0]['ticket_history_created_at'];
                                } else {
                                    echo 'NULL';
                                }
                                ?>
                            </td>
                            <td class="text-capitalize col-pad">
                                <?php if(access_check("ticket", "view")) :  ?>
                                <a  class='ticketview btn btn-primary btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; if(access_check("ticket", "edit")) :  ?>
                                <a  class='ticketedit btn btn-success btn-xs' href="javascript:void(0)" data-id="<?php echo $val['ticket_id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
            <?php }
        }  else{?>
                        <tr><td colspan="8" style="text-align: center">Ticket not found</td></tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="select_record" name="ticket_id">
         <input type="hidden" id="page_count" value="<?php echo $count;?>">
        <?php } ?>
    <?php } ?>
        

    <!--assigned tickets-->
</div>
<style>

    .table > tbody > tr {

        cursor: pointer;
    }


</style>
<script>
    $(document).ready(function () {
        
//        $("body").find("#table1").footable();
        
//        $("body").find(".table").dataTable({"oLanguage": {
//                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
//            },
//            "ordering": true,
//            "responsive": true,
//            "bDestroy": true
//        });
    });

</script>    