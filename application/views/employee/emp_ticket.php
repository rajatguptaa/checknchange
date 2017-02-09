<ul class="messages">
<?php 
if(!empty($ticket_data)){
foreach($ticket_data as $key=>$val){ 
    if($val['user_profile'] == ''){
        $user_profile = 'assets/images/default_avatar_male.jpg';
    }else{
        $user_profile=$val['user_profile'];
    }
    
    ?>                                                    
    <li class="list-unstyled">
                                                            <img src="<?php echo base_url()."/".$user_profile."";?>" class="avatar" alt="Avatar">
                                                            <div class="message_date">
                                                                <h3 class="date text-info"><?php echo date('d',strtotime($val['ticket_updated'])); ?></h3>
                                                                <p class="month"><?php echo date('F',strtotime($val['ticket_updated'])); ?></p>
                                                            </div>
                                                            <div class="message_wrapper">
                                                                <h4 class="heading"><?php echo $val['ticket_subject']; ?></h4>
                                                                <blockquote class="message"><?php echo $val['ticket_description']; ?></blockquote>
                                                                <br />
                                                                
                                                                <!--call function for get all attachment..-->
                                                               <?php  $attahment_data = EmployeeController::getTicketattachment($val['ticket_id']); 
                                                               foreach($attahment_data as $attachment){
                                                               ?>
                                                                <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                                    <a target="_blank" href="<?php echo base_url('common/download/'.$attachment['attachment_id'].'')   ?>"><i class="fa fa-paperclip"></i> <?php echo $attachment['attachment_name'] ?></a>
                                                                </p>
                                                               <?php } ?>
                                                            </div>
                                                             <a href="<?php echo base_url('request/ticket/view/'.$val['ticket_id'].''); ?>" class="btn btn-sm btn-success pull-right">More Detail</a>
                                                             <div class="clearfix"></div>
                                                        </li>
<?php }}else{ ?>
                                                        <li class="list-unstyled">
                                                            <div class="text-center"><h4>No ticket found here..!!</h4></div>
                                                        </li>
    <?php } ?>
                                                        
                                                    </ul>
                                                    <!-- end recent activity -->