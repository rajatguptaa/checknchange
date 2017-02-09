<?php
$user_data = $this->session->userdata('logged_in');
$user_detail = getUserDetails($user_data['user_id']);

$param = checkCommentStatus($user_data['user_id'], $ticket_id);


?> 
<div class="x_panel">
    <div class="x_title">
        <h2>Comments</h2>
        
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 mail_list_column comment_section">
                <?php if($user_detail['user_access_level'] != 2 ){ ?>
                <div class="col-md-12">
                    <button class="btn btn-xs btn-default active" id='public_comment' style="margin-left: 9.3%;cursor:pointer;">public reply</button>
                  
                    <button class="btn btn-xs btn-default" id='private_comment' style='cursor:pointer;'>internal note</button>
                    <?php } ?>
                    &nbsp;<span class='comment_option text-right'>your comment is sent to the ticket requester</span>
                </div>
               
                <div class="mail_list" style="margin-top: 1%;">
                    <form id='comment_form' action="" method="post">
                        <input type="hidden" name="comment_type" id='comment_type' value="public">
                        <input type="hidden" name="comment_by" value="<?php echo $user_data['user_id']; ?>">
                        <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                        <div class="left image">
                            <img alt="Avatar" class="img-responsive" src="<?php echo base_url().getUserImage($user_data['user_id'],TRUE) ?>">
                        </div>
                        <div class="right">
                            <textarea class="form-control comment_box" name="comments" id="comments" placeholder="type here....."></textarea>
                            <ul class="parsley-errors-list filled comments"><li class="parsley-custom-error-message "></li></ul>
                            <div class="clearfix"></div>
                               <div class='col-md-12' style="padding-top: 3px;">
                                  
                                        <a href='javascript:void(0)' class='' id='attach_file'><i class="fa fa-paperclip"></i>  Attach file</a>
                                   
                                    <input type='file' name='attachments' class='hidden' id='attachment' multiple="">
                                </div>
                             <div id='attchment_list' class='col-md-12 col-xs-12'>

                                </div>
                            <?php  $assignee = getTicketAssignee($ticket_id);
                            if($user_detail['user_access_level'] != 2 ){ ?>
                       
                            <div class='pull-left appointment_main_div' style="display:none">
                             
                                  <?php if(!empty($param)&& !empty($assignee)){
                                  $style="'display:none'";    
                                      
                                  ?>
                                <div class="col-md-12"><input type="checkbox" name="aptchk" class="chk"/>Add Appointment</div>
                                  <?php }else{
                                      $style = "'display:block'";
                                      ?>
                                   <input type="hidden" class="chk" name="aptchk" value="on">  
                                    
                                  <?php } ?>
                                <div class="col-md-12 nopadding appointment_div" style=<?php echo $style;?>>
                                <div class="row">
                                    <div class="col-md-3 col-xs-12">
                                        <label>Date*</label>
                                      <input class="form-control apt_input apt_date" data-format="dd/MM/yyyy hh:mm:ss" type="text" name="date">
                                     <ul class="parsley-errors-list date"><li class="parsley-custom-error-message "></li></ul>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label>Start Time*</label>
                                        <input type="text" value="" class="form-control apt_input apt_start_time" name="start_time"/>
                                   <ul class="parsley-errors-list filled start_time"><li class="parsley-custom-error-message "></li></ul>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label>End Time</label>
                                        <input type="text"  value="" class="form-control apt_input apt_end_time" disabled="" name="end_time"/>
                                        <ul class="parsley-errors-list filled end_time"><li class="parsley-custom-error-message "></li></ul>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label>Assignee</label>
                                              <select data-choosen-extra="false"  id="appointment_user_sel" name="appointment_user[]" tabindex="-1" class="customer_div form-control col-md-7 col-xs-12" multiple="">                                                                  <?php
                                           if(!empty($employee_details)){
                                           foreach ($employee_details as $employee_details_data) {
                                                if(in_array($employee_details_data['user_id'],$assignee)){   
                                                $selectd = "selected";
                                        }
                                        else
                                            {
                                               $selectd = "";   
                                            }
                                               ?>
                                               <option <?php echo $selectd;?> value="<?php echo $employee_details_data['user_id']; ?>">
                                               <?php 
                                               echo getUserName($employee_details_data['user_id']);?>
                                               </option>
                                           <?php } }
                                           ?>
                                             </select>
                                        <ul class="parsley-errors-list filled appointment_user"><li class="parsley-custom-error-message "></li></ul>
                                    </div>
                                    
                                </div>
                                </div>
                            </div><?php } ?>
                         
                            <div class="submit_comment pull-right">
                                <button class="btn btn-primary btn-sm pull-left" id='send_comment' type="button" >Submit</button>
                                <img class="small_loader pull-right" src="<?php echo base_url().'assets/images/ajax-small_loader.gif';?>" />
                            </div>

                        </div>
                    </form>
        <?php if($user_detail['user_access_level'] != 2 ){ ?>               
     <p class="forum-nav-recent pull-right">
     <a id="comment_link" data-type="comment_div" href="javascript:void(0)" class="edit_this innertab">Comment</a>
     <span class="delim">|</span>
     <a id="appointment_link" data-type="appointment_div" href="javascript:void(0)" class="innertab">Appointment</a>
     </p>
        <?php } ?>   </div>
       
                <div id="comment_div">
                <?php
                if (!empty($comment_data)) {
                     $ticket_assignee=  CommentController::getTicketAssignee($ticket_id);
                   
                     
                    foreach ($comment_data as $key => $val) {
                        if ($val['user_profile'] == '') {
                            $user_profile = 'assets/images/default_avatar_male.jpg';
                        } else {
                            $user_profile = $val['user_profile'];
                        }
                        if($val['comment_type'] == 'private'){
                            
                            if(in_array($user_data['user_id'],  $ticket_assignee)|| $user_detail['user_access_level']==1){
                        
                        ?>
              
                        <div class="mail_list">
                            <div class="left image">
                                <img alt="Avatar" class=" img-responsive" src="<?php echo base_url().getUserImage($user_data['user_id'])  ?>">     
                                <small ><?php echo ucfirst($val['user_name']); ?> </small>
                                <small ><b><?php echo $val['organisation_name']; ?> </b></small>
                            </div>
                            <div class="right">
                                <h3> <?php
                                    if($user_detail['user_access_level'] != 2){
                                ?> 
                                    <label class="label label-danger"><?php echo $val['comment_type']; ?></label>
                                    <?php } ?>
                                    <small ><?php echo dateFormate($val['comment_update']); ?></small></h3>
                                <p><?php echo nl2br($val['comment_message']); ?></p>

                                <!--attachment-->


                                <?php
                                $comment_attchment = CommentController::getCommentAttachRel($val['comment_id']);
                                if (!empty($comment_attchment)) {

                                    foreach ($comment_attchment as $key1 => $val1) {
                                        ?> 

                                        <p class="url">
                                            <span data-icon="" aria-hidden="true" class="fs1 text-info"></span>
                                            <a href="<?php echo base_url('common/download/' . $val1['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $val1['attachment_name']; ?></a>
                                        </p>
                                    <?php } 
                                } ?>
                            </div>
                        </div>

                        <?php } }
                          
                        
                        
                        
                           else{ ?>
                             <div class="mail_list">
                            <div class="left image">
                                <img alt="Avatar" class=" img-responsive" src="<?php echo base_url().getUserImage($user_data['user_id'])  ?>">
                                 <small ><?php echo ucfirst($val['user_name']); ?> </small>
                                 <small ><b><?php echo $val['organisation_name']; ?> </b></small>
                            </div>
                            <div class="right">
                                <h3> <?php
                                if($user_detail['user_access_level'] != 2){
                                ?> 
                                    <label class="label label-success"><?php echo $val['comment_type']; ?></label>
                                <?php  } ?>
                                <small ><?php echo dateFormate($val['comment_update']); ?></small></h3>
                                <p><?php echo nl2br($val['comment_message']); ?></p>

                                <!--attachment-->


                                <?php
                                $comment_attchment = CommentController::getCommentAttachRel($val['comment_id']);
                                if (!empty($comment_attchment)) {

                                    foreach ($comment_attchment as $key1 => $val1) {
                                        ?> 

                                        <p class="url">
                                            <span data-icon="" aria-hidden="true" class="fs1 text-info"></span>
                                            <a href="<?php echo base_url('common/download/' . $val1['attachment_id'] . ''); ?>"><i class="fa fa-paperclip"></i> <?php echo $val1['attachment_name']; ?></a>
                                        </p>
                                    <?php } 
                                } ?>

                            </div>
                        </div>
                    <?php }
               
// var_dump(getTicketAppointment($ticket_id,$val['comment_id']));
                    
                                    }
                } else { ?>


                    <div class="mail_list" style="text-align:center;border-bottom:none;">No comment found for this ticket.</div>

<?php } ?>

            </div>
                <div id="appointment_div" class="content_text">
                   <?php
                   
                if (!empty($appointment_data)) {
                   foreach ($appointment_data as $key => $appval) {
                        if ($appval['user_profile'] == '') {
                            $user_profile = 'assets/images/default_avatar_male.jpg';
                        } else {
                            $user_profile = $appval['user_profile'];
                        }
                       
                          
                        
                        
                        
                        ?>
                             <div class="mail_list">
                            <div class="left image">
                                <img alt="Avatar" class=" img-responsive" src="<?php echo base_url().getUserImage($user_data['user_id'])  ?>">
                                 <small ><?php echo ucfirst($appval['user_name']); ?> </small>
                                 <small ><b><?php echo $appval['organisation_name']; ?> </b></small>
                            </div>
                            <div class="right">
                                <h3> <?php
                                if($user_detail['user_access_level'] != 2){
                                ?> 
                                    <label class="label label-primary"><?php echo $appval['comment_type']; ?></label>
                                <?php  } ?>
                                <small ><?php echo dateFormate($appval['comment_update']); ?></small></h3>
                                <p><?php echo nl2br($appval['comment_message']); ?></p>

                       
                        <?php $appointment =getTicketAppointment($ticket_id,$appval['comment_id']);
                            if(!empty($appointment)){
                              
                                 
                                 ?>
                              <div class="file-details">
                                            <div class="show-users"><i class="fa fa-user"></i><?php count($appointment['assign']); ?>
                                                <div id="all-users">
                                                    <?php foreach($appointment['assign'] as $apt_user){?>
                                                    <span><?php echo getUserName($apt_user);?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                  <?php 
                                  $starttime = $appointment['appointment_start_time'].''.$appointment['appointment_date']; 
                                  $start_time =  date('h:i a ', strtotime($starttime));
                                  $endttime = $appointment['appointment_end_time'].''.$appointment['appointment_date']; 
                                  $end_time =  date('h:i a ', strtotime($endttime));
                                  
                                  ?>
                                            <div class="show-time"><i class="fa fa-clock-o"></i> <?php echo $start_time;?> to <?php echo $end_time;?></div>
                                            <div class="show-date"><i class="fa fa-calendar"></i> <?php echo $appointment['appointment_date'];?></div>
                              </div></div> </div>
                                <?php } ?>
 
                        
               

                    
                   <?php                 }
                } else { ?>


                    <div class="mail_list" style="text-align:center;border-bottom:none;">No comment found for this ticket.</div>

<?php } ?>   
                    
                    
                </div>
        </div>

    </div>
    </div></div>
<script>
$(document).ready(function(){
    $("#appointment_user_sel").chosen({width: "95%", include_group_label_in_selected: true,placeholder:"Select User"}); 
});


</script>
<style type="">
    .small_loader.pull-right {
        margin-left: 10px;
        margin-top: 10px;
        display:none;
    }
    .chk{
        margin-right:5px!important;
            margin-top:5px!important;
        position: relative;
    }
    .content_text{
        display: none;
    }
    #send_comment{
        margin-bottom:10%;
    }
    .forum-nav-recent.pull-right {
    margin-bottom: 0;
    margin-top: 4%;
}
    @media all and (max-width:640px){
        .comment_section .mail_list .right{
            width: 100%
        }
    }
</style>