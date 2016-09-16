<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= $mainHeading ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="">

                            <div class="clearfix"></div>

                            <div class="row">
                                 <?php if ($access_level == 2) {?>
                                <div class="col-md-12 col-sm-12">
                               <?php  }else{ ?>
                                    <div class="col-md-9 col-sm-9"> 
                            <?php   } ?>
                                    <div class="x_panel">
                                        <div class="x_title">
          
                                            <span class="status_span <?php echo $form_data['ticket_status'];?>"><?php echo substr($form_data['ticket_status'], 0, 1);?></span><h2>Ticket No : <?= $form_data["ticket_number"] ?> </h2>
                                            <!--<h2><small><lable class="<?php echo $form_data['ticket_status']; ?>"><?php echo $form_data['ticket_status']; ?>&nbsp;<b id="total_time"></b></lable></small></h2>-->
                                            <a class="btn btn-success btn-sm pull-right" href="<?php echo base_url().'/request' ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php if ($access_level == 2) { ?>
                                            <div class="x_content">

                                                <div class="row">
    <!--<<<<<<< HEAD-->
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
         
                                                        <article class="media event">
                                                            <div class="col-md-2 col-sm-2">

                                                                <span class="pull-left date">
                                                                    <p class="month"><?php echo getMonth($form_data['ticket_updated']); ?></p>
                                                                    <p class="day"><?php echo getDay($form_data['ticket_updated']); ?></p>
                                                                </span></div>
                                                            <div class="col-md-10 col-sm-12" style="text-align:justify;">


                                                                <div class="message_wrapper">
                                                                    <h4 class="heading"><?php
                                                                        if (!empty($form_data)) {
                                                                            echo $form_data['ticket_subject'];
                                                                        }
                                                                        ?></h4>

                                                                    <p class="message"><?php
                                                                        if (!empty($form_data)) {
                                                                            echo $form_data['ticket_description'];
                                                                        }
                                                                        ?>.</p>
                                                                </div>
                                                                <!--<span id="tct_assigned_by"></span>-->
                                                            </div>



                                                    </div>

                                                    <div class="col-md-4 col-sm-4  pull-right">
                                                        <div class="x_panel ticket_data">

                                                            <div class="x_content ticket_box">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                                                    <div class="col-md-5 col-sm-6 col-xs-6">
                                                                        <label>Ticket Status:</label>
                                                                    </div>
                                                                    <div id="ticketStatus" class="col-md-5 col-sm-6 col-xs-12"><?php echo $form_data['ticket_status']; ?></div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                                                        <label>Ticket Priority:</label>
                                                                    </div>
                                                                    <div id="ticketStatus" class="col-md-5 col-sm-6 col-xs-12"><span class="<?php echo $form_data['ticket_priority'] . '_tag'; ?> label"><?php echo ucfirst($form_data['ticket_priority']); ?></span></div>
                                                                </div>

                                                            </div>
                                                        </div></div>
                                                </div>

                                            </div>
                                        <?php } else { ?>
                                        
     <!---------------------------------------------------ADMIN?EMP------------------------------------->
                                            <div class="x_content">

                                                <div class="row">
  
           <form data-parsley-validate id="employee_ticket"  class="form-horizontal form-label-left"   action="" method="post" enctype="multipart/form-data">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div id="requester_header col-md-12 col-sm-12 col-xs-12">
                                                    <?php $user_detail = getUserDetails($form_data['user_id']); ?>  
                                                        <span class="bullet person">
                                                          <?php $cc_data = getTicketCC($form_data['ticket_id']);
                                          
        ?>    
                                                         <b><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo getUserName($user_detail['user_id'])?></b> (<?php echo (!empty($cc_data))?count($cc_data):0;?> CC)</span>
                                                 <span id="edit_requester_link">
                                                    &ndash;
                                                    <a class="edit_this edit_cc" href="javascript:void(0)">edit</a>
                                                  </span>
                                                 <span class="separator">|</span>
                                                <span class="bullet calendar">
                                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo getMonth($form_data['ticket_created']).' '.  getTime($form_data['ticket_created']);?>
                                                </span>



                                            </div> <div class="ln_solid"></div>     
                        <div class="col-md-12 col-sm-12 col-xs-12 text_content" id="cc_div">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-2 col-sm-12 col-xs-4"><label for="filter"> Requester</label></div>
                            <div class="form-group col-md-10 col-sm-12 col-xs-8"><b><?php echo getUserName($user_detail['user_id'])?>&nbsp;&nbsp;&lt;<?php echo $user_detail['user_email'];?>&gt;</b> - <a href="javascript:void(0)" id="requester_change" class="edit_this">change</a>
        
                        </div></div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 text_content" id="requester_div">
                        <div class="form-group col-md-2 col-sm-12 col-xs-4">    
                        <label for="filter">Requester</label>
                        </div>
                        <div class="form-group col-md-10 col-sm-12 col-xs-8">    
                        <select class="form-control" id="user_select" name="user_id">
                                <?php
                                foreach ($customer_details as $customer_details_list) {
                                    ?>
                                    <option <?php echo ($customer_details_list['user_id']==$form_data['user_id'])?'selected':'' ?> value="<?php echo $customer_details_list['user_id']; ?>"><?php echo getUserName($customer_details_list['user_id']); ?></option>
                                <?php }
                                ?>
                       </select>
                       
                    <div class="pull-right">
                        <button type="button" class="btn btn-success  btn-xs btn-square active pull-right add_button" data-type="normal_user" data-toggle="modal" data-target="#addCustomer"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                         </div></div>
                     <div class="form-group col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group col-md-2 col-sm-12 col-xs-4"> <label for="filter"> CC</label> </div>
                              <div class="form-group col-md-10 col-sm-12 col-xs-8">  
                       <select data-choosen-extra="false"  id="user_cc" name="user_cc[]" tabindex="-1" class="customer_div form-control col-md-7 col-xs-12" multiple="">                                                                  <?php
                                if(!empty($customer_details)){
                                foreach ($customer_details as $customer_details_cc) {
                                    if(!empty($cc_data)){
                                     if(in_array($customer_details_cc['user_email'],$cc_data)){   
                                     $selectd = "selected";
                                    }else{
                                     $selectd = "";   
                                    }
                                }
                                    ?>
                                    <option <?php echo $selectd;?> value="<?php echo $customer_details_cc['user_email']; ?>">
                                    <?php 
                                    $email = $customer_details_cc['user_email']; 
                                    echo getUserName($customer_details_cc['user_id']).'&lt'.$email.'&gt;
';?>
                                    </option>
                                        <?php }}
                                ?>
                     </select>   
                       
                    <div class="pull-right">
                        <button type="button" class="btn btn-success  btn-xs btn-square active pull-right add_button" data-type="cc" data-toggle="modal" data-target="#addCustomer"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                              </div></div>
                        
                        </div> </div> 
                                                       
                                                  
                                                           
                                                        </div>


                                                   </div>
              
                       
                                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                                       
                                                           <div class="col-md-12 col-sm-12 col-xs-12">  
                                                     <div class="message_wrapper">
                                                                    <h4 class="heading"><?php
                                                                        if (!empty($form_data)) {
                                                                            echo $form_data['ticket_subject'];
                                                                        }
                                                                        ?></h4>

                                                                    <p class="message"><?php
                                                                        if (!empty($form_data)) {
                                                                            echo $form_data['ticket_description'];
                                                                        }
                                                                        ?>.</p>
                                                                </div> 
                                                           </div>  </div> 
                                              
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                       
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                              <div class="form-group col-md-6 col-md-6 col-sm-6 col-xs-12">
                                                           <label for="filter">Status </label>
                                                          
                                                            <select id="ticket_status" class="form-control chossen assign_field" name="ticket_status" required="" data-parsley-error-message="Priority  type field is required.">
                       
                                                               
                                                                <option value="Open" <?php echo($form_data['ticket_status'] == "Open" ) ? "selected" : ""; ?>>Open</option>
                                                                <option value="Pending" <?php echo($form_data['ticket_status'] == "Pending" ) ? "selected" : ""; ?>>Pending</option>
                                                                <option value="Doing" <?php echo  ($form_data['ticket_status'] == "Doing" ) ? "selected" : ""; ?>>Doing</option>
                                                                <option value="Solved" <?php echo  ($form_data['ticket_status'] == "Solved" ) ? "selected" : ""; ?>>Solved</option>
                                                              <?php if($form_data['ticket_status']=='Closed'){?><option <?php echo  ($form_data['ticket_status'] == "Closed" ) ? "selected" : ""; ?>>Closed</option>
                                                              <?php } ?>
                                                            </select>
                                                            <?php echo form_error('ticket_priority'); ?>
                                                        </div>
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                                                
                                                                <label for="filter">Type * </label>
                                                                <select class="form-control chossen assign_field" data-parsley-error-message="Ticket type field is required." name="ticket_type" required="">

                                                                    <option value="question" <?= ( $method == "post") ? (set_value('ticket_type') == "question") ? "selected" : "" : ($form_data['ticket_type'] == "question" ) ? "selected" : ""; ?>>Question</option>
                                                                    <option value="task" <?= ( $method == "post") ? (set_value('ticket_type') == "task") ? "selected" : "" : ($form_data['ticket_type'] == "task" ) ? "selected" : ""; ?>>Task</option>
                                                                    <option value="problem"  <?= ( $method == "post") ? (set_value('ticket_type') == "problem") ? "selected" : "" : ($form_data['ticket_type'] == "problem" ) ? "selected" : ""; ?>>Problem</option>
                                                                </select>
                                                                <?php echo form_error('ticket_type'); ?>
                                                            </div>
                                                            </div>

                                        </div>  
                                       <div class="col-md-4 col-sm-12 col-xs-12"> 
                                           <div class="row">
                                           <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                          <label for="filter">Priority </label>
                                           <select class="form-control chossen assign_field" name="ticket_priority" required="" data-parsley-error-message="Priority  type field is required.">

                                               <option value="normal" <?= ( $method == "post") ? (set_value('ticket_priority') == "normal") ? "selected" : "" : ($form_data['ticket_priority'] == "normal" ) ? "selected" : ""; ?>>Normal</option>
                                               <option value="high" <?= ( $method == "post") ? (set_value('ticket_priority') == "high") ? "selected" : "" : ($form_data['ticket_priority'] == "high" ) ? "selected" : ""; ?>>High</option>
                                               <option value="low" <?= ( $method == "post") ? (set_value('ticket_priority') == "low") ? "selected" : "" : ($form_data['ticket_priority'] == "low" ) ? "selected" : ""; ?>>Low</option>
                                               <option value="urgent" <?= ( $method == "post") ? (set_value('ticket_priority') == "urgent") ? "selected" : "" : ($form_data['ticket_priority'] == "urgent" ) ? "selected" : ""; ?>>Urgent</option>
                                           </select>
                                           <?php echo form_error('ticket_priority'); ?>
                                       </div>
                                           <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                          <label for="filter">Group </label>
                                          
                                           <select class="form-control chossen assign_field" id="group">
                                  
                                           <?php foreach($group as $grp_val){?>
                                          <option value="<?php echo $grp_val['group_id'];?>"><?php echo $grp_val['group_title'];?></option>
                                               
                                          <?php } 
                                          ?>
                                           </select>
                                               <?php 
                                          echo form_error('group'); ?>
                                         </div>
                                           </div>
                                        </div>  
                                       <div class="col-md-4 col-sm-12 col-xs-12"> 
                                           <div class="form-group">
                                          <label for="filter">Assignee * </label>
                                           <select id="assignee" class="form-control chossen assign_field" name="assign_user" required="" data-parsley-error-message="Assignee type field is required.">

                                           </select>
                                           <?php echo form_error('ticket_priority'); ?>
                                       </div>
                                           
                                        </div>  
                         

                                                    </div>
               
              
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="form-group col-md-12"> 
                                         <label for="filter">Tags </label>
                                     <select   name="tags[]" tabindex="-1" class="tags form-control col-md-7 col-xs-12 chosen-select assign_field" multiple="">                                          
                                     </select>           
                                         </div>
                                      
                                      <?php if(!empty($tag))
      {
        foreach($tag as $tag_detail){
        $sel[]=$tag_detail['tag_id'];
     }?>
     
        <?php }
        else{
           $sel=array(); 
        }
        ?>
   <input type='hidden' value='<?php echo json_encode($sel);?>' id='select_array'>      
                                  </div>
                                 
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button id="create_ticket" type="submit" class="btn btn-success pull-right btn-xs">Update</button>
                                   </div>
                                  
           </form>  </div>

                                            </div>  


<?php } ?>
                                                         <input type="hidden" id="org_id" value="<?php echo $form_data['organisation_id'];?>">
                                   
                                    <div class="col-md-12 col-sm-12 col-xs-12 no-border">
                                    <div class="row">
                                    <div class="x_panel">
                                        <div class="x_title collapse-link ">
                                            <h2>Attachment</h2>
                                            <ul class="nav navbar-right pull-right panel_toolbox">
                                                <li style="float: right"><a class="" href="javascript:void(0)"><i class="fa fa-chevron-down"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content" style="display: none;">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input  multiple id="image" name="file" type="file" class="file-loading"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($access_level != 2) { ?>
                                <div class="clearfix"></div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title collapse-link ">
                                                <h2>Assign Details</h2>
                                                <ul class="nav navbar-right pull-right panel_toolbox">
                                                    <li style="float: right"><a class="" href="javascript:void(0)"><i class="fa fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content"  style="display: none;">

                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12 col-xs-12">



                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Assigned By</th>
                                                                    <th>Assigned To</th>
                                                                    <th>Working Hour</th>
                                                                    <th>Assigned date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $total_hr = 0;
                                                                $working_user = '';
                                                                $assign_at = '';
                                                                $assign_by = '';
                                                                $group_id = '';
                                                                $assinee_id = '';
                                                                if (!empty($emplyeeTime)) {
                                                                    $i = 1;

                                                                    foreach ($emplyeeTime as $value) {
                                                                        $total_hr += $value['minutes'];
                                                                        ?> 

                                                                        <?php
                                                                        if ($value['current_working_user'] == 1) {
                                                                            $working_user = getUserName($value['assigni_id']);
                                                                            $assign_at = dateFormate($value['ticket_assign_at']);
                                                                            $assign_by = getUserName($value['assigned_by']);
                                                                            $group_id = $value['group_id'];
                                                                            $assinee_id = $value['assigni_id'];
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <th scope="row"><?php echo $i; ?></th>
                                                                            <td><?php echo getUserName($value['assigned_by']); ?></td>
                                                                            <td><?php echo getUserName($value['assigni_id']); ?></td>
                                                                            <td><?php if ($value['minutes'] != null || $value['minutes'] != null) {
                                                                echo number_format((float) ($value['minutes'] / 60), 2, '.', '') . ' hrs';
                                                            } else {
                                                                echo '-';
                                                            }; ?></td>
                                                                            <td><?php echo dateFormate($value['ticket_assign_at']); ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                } else {
                                                                    ?>    
                                                                        <tr><td class="dataTables_empty" colspan="5">No result Found</td></tr>
    <?php }
    ?> 
                                                            <input type="hidden" id="ttl_time" value="<?php echo $total_hr; ?>">
                                                            <input type="hidden" id="working_user" value="<?php echo $working_user; ?>">
                                                            <input type="hidden" id="assign_at" value="<?php echo $assign_at; ?>">
                                                            <input type="hidden" id="assign_by" value="<?php echo $assign_by; ?>">
                                                            <input type="hidden" id="group_id" value="<?php echo $group_id; ?>">
                                                            <input type="hidden" id="assinee_id" value="<?php echo $assinee_id; ?>">
                                                            </tbody>
                                                        </table>



                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" id='comment_view'>
                            
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                <?php if($access_level!=2){?>
                                <div class="col-md-3 col-sm-3 hidden-xs">
                                    <div class="right_section">
                                        
                                        <h3><?php echo getUserName($user_detail['user_id']);?> <i class="fa fa-user pull-right"></i></h3>
                                        <?php if($user_detail['user_email']!=''){?>
                                        <p><i class="fa fa-envelope-o"></i>  <span><?php echo $user_detail['user_email'];?></span></p>
                                        <?php } ?>
                                        <?php if($user_detail['user_phone']!=''){?>
                                        <p><i class="fa fa-phone"></i> <span><?php echo $user_detail['user_phone'];?></span></p>
                                        <?php } ?>
                                        <h6><b>User notes-</b><a  href="javascript:void(0)"  class="notes edit_this"> &nbsp;&nbsp;edit</a></h6>
                                        <div class="user_notes_div" style="display:none">
                                         <textarea name="user_notes" id="user_notes" class="form-control"></textarea>
                                         <p class="error" id="user_error"></p>
                                         <button data_user="<?php echo $form_data['user_id'] ;?> type="button" id="user_notes_btn"  class="notes_button btn btn-success btn-xs pull-right">Update</button>
                                                 
                                        </div>
                                        <div class="clearfix"></div>
                                        <p id="user_doc"><?php echo $user_detail['user_note'];?></p>
                                     </div>
                                   
                                   
                                      <div class="clearfix"></div>
                                      <div class="ln_solid"></div>
                                     <div class="right_section">
                                         <h6><b>Ticket</b></h6>
                                        <li class="load_extra" id="firstTab"><a href = "#tab1" data-val="1" data-toggle="tab"><i class = "pull-right new_open">1</i>New,Open or Pending</a>
                         </li>
                                <li class="load_extra"><a href = "#tab7" data-val="7" data-toggle = "tab"><i class = "pull-right recently_solved_tickets">5</i> Recently Closed</a>
                                  
                               </li>   
                             <li class="load_extra"><a href = "#tab6"  data-val="6" data-toggle = "tab"><i class = "pull-right all_tickets">0</i>All tickets</a>
                           </li>
                             <li class="load_extra"><a href = "#tab11" data-val="11" data-toggle = "tab"><i class = "pull-right assigned_tickets">2</i> Assigned tickets</a>
                            </li>
                                    </div>
                                      <div class="clearfix"></div>
                                      <div class="ln_solid"></div>
                                    <div class="col-md-12">
                                     <?php $org_detail = getUserOrginasationDetails($form_data['user_id']);?>
                                    <div class="right_section">
                                       
                                        <h3><?php echo ucfirst($org_detail['organisation_name']);?></h3>
                                        <p><b>Organisation details</b></p>
                                          <?php if($org_detail['organisation_extra']!=''){?>
                                        <p><?php echo $org_detail['organisation_extra'];?></p>
                                          <?php }?>
                                        <p class="address_bar"> <i class="fa fa-home"></i><span><?php echo $org_detail['organisation_address'] .' '.$org_detail['organisation_address2'].' <br>'.$org_detail['city'].' '.$org_detail['postcode'];?></span></p>
                                       
                                        <?php if($org_detail['organisation_phone']!=''){?>
                                        <p><i class="fa fa-phone"></i> <span><?php echo $org_detail['organisation_phone'];?></span></p>
                                        <p class="organisation_notes"><b>Organisation notes-</b><a  href="javascript:void(0)"  class="org_notes edit_this"> &nbsp;&nbsp;edit</a></p>
                                        <div class="organisation_notes_div" style="display:none">
                                         <textarea name="organisation_notes" id="organisation_notes" class="form-control"></textarea>
                                         <p class="error" id="organisation_error"></p>
                                         <button data_organisation="<?php echo $org_detail['organisation_id'] ;?>" type="button" id="organisation_notes_btn"  class="notes_button btn btn-success btn-xs pull-right">Update</button>
                                                 
                                        </div>
                                        <div class="clearfix"></div>
                                        <p id="organisation_doc"><?php echo $org_detail['organisation_notes'];?></p>
                                       
                                        <?php } ?>
                                    </div>
                                </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div tabindex="-1" class="file-preview-detail-modal modal fade" id="file-preview">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&#10006;</button>
                <h3 class="modal-title">Detailed Preview <small class="small-name"></small></h3>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
    <div align='center' class="wait">
          <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
</div>
<div class="modal modal-md" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
       <form data-parsley-validate action="<?php echo base_url('customerController/createCustomerByEmployee');?>" method="post" id="create_user_form">
  <div class="modal-dialog" role="document">
      
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Customer</h4>
      </div>
      <div class="modal-body clearfix">
     
          <div class="form-group col-md-12">
              <div class="col-md-2 col-md-offset-1">
            <label for="recipient-name" class="control-label">Name *</label>
              </div>
              <div class="col-md-8 col-md-offset-1">
                  <input data-parsley-error-message="The Name field is required." required="" type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Name">
            <ul class="parsley-errors-list filled user_name"><li class="parsley-custom-error-message "></li></ul>
              </div>
          </div>
          <div class="form-group col-md-12">
               <div class="col-md-2 col-md-offset-1">
            <label for="message-text" class="control-label">Email *</label>
               </div>
               <div class="col-md-8 col-md-offset-1">
            <input required="required" type="email" class="form-control" id="user_email" name="user_email"  placeholder="Enter Email" data-parsley-error-message="The Email field is required.">
             <ul class="parsley-errors-list filled user_email"><li class="parsley-custom-error-message "></li></ul>
               </div>
          </div>
          
           <input type="hidden" name="org_id" id="org_id" value="<?php echo $form_data['organisation_id'];?>">
          <input type="hidden" id="user_type">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm">Submit</button>
      </div>
    </div>
  </div></form>

</div>
<input type="hidden" value="<?php echo $form_data['ticket_id']; ?>" id="ticket_cmt_id">
<script>
    $(document).ready(function () {
        $(".chossen").chosen({width: "100%"});
       
     
        var base_url = $("#base_url").val();
        //load comment view...
        var ticket_id = $('body').find('#ticket_cmt_id').val();
        var org_id = $('body').find('#org_id').val();
        loadCommentView(ticket_id,org_id);
<?php if ($access_level != 2) { ?>
            var log_id = <?php echo getLoginUser();?>;
            var status = '<?php echo $form_data['ticket_status'];?>';
            $("#user_cc").chosen({width: "95%", include_group_label_in_selected: true,placeholder:"Select User"});
            $("#user_select").chosen({width: "95%", include_group_label_in_selected: true,placeholder:"Select User"});
            if(status=='Closed'){
               $('body').find('.assign_field').prop('disabled',true).trigger("chosen:updated");   
            }
            var org_id = $('body').find('#org_id').val();
            getTabCount(org_id,log_id);
            var detail = '';
            var ttl_time = $('#ttl_time').val();
            if (typeof ttl_time != 'undefined') {
                $('body').find('#total_time').text((ttl_time / 60).toFixed(2) + ' hrs');
                detail += '<div class="col-md-12 col-sm-12 col-xs-12 nopadding"><div class="col-md-5 col-sm-6 col-xs-6"><label>Time:</label></div><div id="ticketStatus" class="col-md-5 col-sm-6 col-xs-6">' + (ttl_time / 60).toFixed(2) + ' hrs</div></div>';
            }
            var working_user = $('#working_user').val();

            if (typeof working_user != 'undefined' && working_user != '') {
                detail += '<div class="col-md-12 col-sm-12 col-xs-12 nopadding">' +
                        '<div class="col-md-5 col-sm-6 col-xs-6">' +
                        '<label>Assigne To:</label></div>' +
                        '<div id="ticketStatus" class="col-md-6 col-sm-6 col-xs-6">' + working_user + '</div></div>';
            }
            var assign_at = $('#assign_at').val();

            if (typeof assign_at != 'undefined' && assign_at != '') {
                detail += '<div class="col-md-12 col-sm-12 col-xs-12 nopadding">' +
                        '<div class="col-md-5 col-sm-6 col-xs-6">' +
                        '<label>Assigne Date:</label></div>' +
                        '<div id="ticketStatus" class="col-md-7 col-sm-6 col-xs-6">' + assign_at + '</div></div>';
            }
            var assign_by = $('#assign_by').val();
            if (typeof assign_by != 'undefined' && assign_by != '') {
                $('body').find('#tct_assigned_by').html('Assigned By: <b>' + assign_by + '</b>')
                detail += '<div class="col-md-12 col-sm-12 col-xs-12 nopadding">' +
                        '<div class="col-md-5 col-sm-6 col-xs-6">' +
                        '<label>Assigne By:</label></div>' +
                        '<div id="ticketStatus" class="col-md-6 col-sm-6 col-xs-6">' + assign_by + '</div></div>';
            }

            
    //        $('.ticket_box').empty();
            $('.ticket_box').append(detail);
            
             var grp_id = $('body').find('#group_id').val();
             if(grp_id == '' || typeof grp_id==undefined){
               var grp_id = $('body').find('#group').val();
             }
            $("#group").val(grp_id);
            $("#group").trigger('update');
            
            var org_id = $('body').find('#org_id').val();
            var assignee = $('body').find('#assignee');
            var assignee_id = $('body').find('#assinee_id').val();
              
            $.ajax({
                type: 'POST',
                url: base_url + 'ticketController/getAssineebygrp',
                data:{grp_id:grp_id,org_id:org_id},
                success: function(data) {
                    
                       if(data!=''){
                    var groupArray = $.parseJSON(data);
                   
                  assignee.empty();
                  $(groupArray).each(function(index, value) {
                      
                  $(assignee).append('<option value="' + value.user_id + '_'+ value.group_id + '">' + value.assignee_name + '</option>');
         });
       
               if(assignee_id!=''){
               $(assignee).val(assignee_id+'_'+grp_id);
               }
               $(assignee).trigger("chosen:updated");    
             
         }else{
              assignee.empty();
                  $(assignee).trigger("chosen:updated");  
         }
        }
         });
         
         $("body").on('change','#group',function(){
            var grp_id = $(this).val(); 
            var org_id = $('body').find('#org_id').val();
             $.ajax({
                type: 'POST',
                url: base_url + 'ticketController/getAssineebygrp',
                data:{grp_id:grp_id,org_id:org_id},
                success: function(data) {
                    if(data!=''){
                    var groupArray = $.parseJSON(data);
                   
                  assignee.empty();
                  $(groupArray).each(function(index, value) {
                      
                  $(assignee).append('<option value="' + value.user_id + '_'+ value.group_id + '">' + value.assignee_name + '</option>');
         });
            
//             $(grp).val(selected_option);
               $(assignee).trigger("chosen:updated");    
             
         }else{
              assignee.empty();
                $(assignee).trigger("chosen:updated");  
           }
         }
         });
         });
         
         
          $(".tags").chosen({width: "100%", include_group_label_in_selected: true,placeholder:"Enter Tag",no_results_text: "No results match ! Press enter to add tag"});
           if($("#select_array").length>0){
            var selected_option =  $.parseJSON($("#select_array").val());
           }
            var tag =  $(".tags");
            console.log(selected_option);
            var org_id = $('body').find('#org_id').val();
            $.ajax({
                type: 'POST',
                url: base_url +'ticketController/getTag',
                data: {organisation_id: org_id},
                success: function(data) {
                    
                    if(data!=false){
                    var tagArray = $.parseJSON(data);
                  tag.empty();
                  $(tagArray).each(function(index, value) {
                      
                  $(tag).append('<option value="' + value.tag_id + '">' + value.tag_heading + '</option>');
         });
            
             $(tag).val(selected_option);
             $(tag).trigger("chosen:updated");
         }
                }
            });
            
            
            // user notes 
            $('body').find('.notes').click(function(){
             $('body').find('.user_notes_div').toggle();
             var text = $('body').find('#user_doc').text();
              $('#user_notes').val(text);
             });
            $('body').find('#user_notes_btn').click(function(){
            var user_note  = $('#user_notes').val();
            var user_id  =   $(this).attr('data_user');
                $.ajax({
                type: 'POST',
                url: base_url + 'ticketController/updateUserNotes',
                data:{user_note:user_note,user_id:user_id},
                success: function(data) {
                    var res = $.parseJSON(data);
                    if(res.result == 'False'){
                      $('#user_error').empty();  
                      $('#user_error').text(res.msg);  
                    }
                    else{
                     $('#user_doc').empty();   
                     $('#user_doc').text(res.msg);   
                     $('.user_notes_div').css('display','none');   
                 
                }
            }
         });
            });
          
          // organisation notes
          
             $('body').find('.org_notes').click(function(){
             $('body').find('.organisation_notes_div').toggle();
             var text = $('body').find('#organisation_doc').text();
              $('#organisation_notes').val(text);
             });
            $('body').find('#organisation_notes_btn').click(function(){
                
            var organisation_note  = $('#organisation_notes').val();
            var organisation_id  =   $(this).attr('data_organisation');
          
                $.ajax({
                type: 'POST',
                url: base_url + 'ticketController/updateOrgansationNotes',
                data:{organisation_notes:organisation_note,organisation_id:organisation_id},
                success: function(data) {
                    var res = $.parseJSON(data);
                    if(res.result == 'False'){
                      $('#organisation_error').empty();  
                      $('#organisation_error').text(res.msg);  
                    }
                    else{
                     $('#organisation_doc').empty();   
                     $('#organisation_doc').text(res.msg);   
                     $('.organisation_notes_div').css('display','none');   
                 
                }
            }
         });
            });
            
            
            
          $("body").on("click", ".load_extra a", function () {
     
              var org_id = $('body').find('#org_id').val();
              var type = $(this).attr("data-val");
              setLocalStorage("org_id", org_id);
              setLocalStorage("active_tab", type);
              window.location.href= base_url +'request';
        });
        
        $("body").on("click",".edit_cc",function(){
          var cc_object =  $('body').find('#cc_div');
          if($(cc_object).hasClass('text_content')){
             $(cc_object).removeClass('text_content'); 
          }else{
             $(cc_object).addClass('text_content'); 
          }
        });
        $("body").on("click","#requester_change",function(){
          var req_object =  $('body').find('#requester_div');
          if($(req_object).hasClass('text_content')){
             $(req_object).removeClass('text_content'); 
          }else{
             $(req_object).addClass('text_content'); 
          }
        });
        
    function getTabCount(org_id, user_id) {
//        TicketCount
        var base_url = $("#base_url").val();

        $.ajax({
            type: "GET",
            url: base_url + 'ticketController/TicketCount/' + org_id + "/" + user_id,
            success: function (data) {
                var dataArray = $.parseJSON(data);
                console.log(dataArray);
                $.each(dataArray, function (key, value) {

                    $("body").find("." + key).text(value);

                })
            }
        });


    }
    
     $(".add_button").click(function(){
           $("#create_user_form input[type=text]").val(''); 
          $("#create_user_form input[type=email]").val(''); 
          $("#user_type").val($(this).attr('data-type')); 
        });
       
       
       // create user 
       
           $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
        
        
    $('#create_user_form').ajaxForm(function (data) {
        var err = $.parseJSON(data);
         var type = $('#user_type').val();
        if (err.result == false) {
            $.each( err.error, function( index, value ){
                
            $("."+index).find('li').empty();
            $("."+index).find('li').text(value);
            $("."+index).parent().find('input').addClass('parsley-error animated shake');
            });
         }
        else {
            if (err.result) {
          
                var n = noty({
                    text: err.msg,
                    type:  err.type,
                    dismissQueue: true,
                    layout: 'center',
                    closeWith: ['click'],
                    theme: 'relax',
                    maxVisible: 10,
                    timeout: 3000,
                    animation: {
                        open: 'animated flipInX',
                        close: 'animated flipOutX',
                        easing: 'swing',
                        speed: 500
                    }
                });
               
                $('#addCustomer').modal('hide');
                var option = err.detail.user_id ; 
                var option_name = err.detail.user_name;
                var option_email = err.detail.user_email;
                if(type=='normal_user'){
                $("#user_select").prepend("<option value="+option+" selected='selected'>"+option_name+"</option>").trigger('chosen:updated');
                }else{
                $("#user_cc").prepend("<option value="+option_email+" selected='selected'>"+option_name+"&nbsp;&lt"+option_email+"&gt</option>").trigger('chosen:updated');    
                }
       }
    }
 });
<?php } ?>
        var arr = new Array();
        $("#attach_ids").val('');
        ;
        var base_url = $("#base_url").val();
        $("#image").fileinput({
            showUpload: false,
            overwriteInitial: false,
            showCaption: false,
            initialPreview: [
<?php
if (!empty($attachment)) {
    foreach ($attachment as $val) {
        echo "'$val'" . ',';
    }
}
?>

            ],
            previewFileIconSettings: {
                'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                'sql': '<i class="fa fa-file-word-o text-primary"></i>',
                'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                'htm': '<i class="fa fa-file-code-o text-info"></i>',
                'txt': '<i class="fa fa-file-text-o text-info"></i>',
                'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
                'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
            },
            initialPreviewConfig: <?php
if ($attachment_info != '') {
    echo $attachment_info;
} else {
    echo '{}';
}
?>,
        });




        $(document).on("click", ".btn-preview", function () {
            var type = $(this).attr("data-type");
            var this_obj = $(this);
            var html;

            switch (type)
            {
                case "doc":
                    html = "<pre>" + $(this_obj).parents().find("pre").html() + "</pre>";
                    break;
                case "object":
                    html = '<object class="obj_class" type="pdf" data="' + $(this_obj).attr("data-value") + '"></object>';
                    break;
            }

            var caption = $(this).parent(".file-preview-other-frame").find(".file-footer-caption").text();
            console.log(html);
            $("#file-preview").find(".small-name").text(caption);
            $("#file-preview").find(".modal-body").html(html);
            $("#file-preview").modal("show");
        })







        $("body").find(".file-preview-thumbnails .file-footer-buttons").each(function () {

            $(this).append('<a target="_blank" href="' + base_url + 'common/download/' + $(this).find(".kv-file-remove").attr("data-key") + '" title="Download file" class="kv-file-download btn btn-xs btn-default" type="button"><i class="fa fa-download"></i></a>');
        })


        //show browse button....
        $('body').on('click', '#attach_file', function () {
            $('body').find('#attachment').trigger('click');
        })
        $('body').on('change', '#attachment', function () {

            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: base_url + 'common/upload_attachment/', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    var attachment_res = $.parseJSON(response);
                    $('#attchment_list').append('<div class="col-md-12"><a href="javascript:void(0)" style="font-weight:bold;">' + attachment_res.attachment_name + '</a>\n\
                            <span style="font-weight:normal;"><a href="javascript:void(0)" class="text-danger"  id="remove_file" data-attachment="' + attachment_res.attchment_id + '"><i class="fa fa-remove"></i></span></a><input type="hidden" name="attachment_id[]" value=' + attachment_res.attchment_id + '></div>')
//                   $('#attchment_list').append()
                }
            });

        })

        //remove uploaded file...
        $('body').on('click', '#remove_file', function () {
            var obj = $(this);
            $.ajax({
                type: 'post',
                url: base_url + 'common/delete_attachment/',
                data: {'id': $(obj).attr('data-attachment')},
                success: function (response) {
                    $(obj).parent().parent('div').remove();
                }
            })
        })


        // Ajax form submit for add user
        $('body').on('click', '#send_comment', function () {
            var obj = $(this);
            var flag = 0;
            $('.small_loader').css('display','block');
            $(obj).addClass('disabled');

                var form_data = $('body').find('#comment_form').serialize();
               
                $.ajax({
                    type: 'post',
                    url: base_url + 'comment/addComment/',
                    data: form_data,
                    success: function (response) {
                        var err = $.parseJSON(response);
                        if (err.result == false) {
                        $.each( err.error, function( index, value ){
                        $('body').find("."+index).find('li').empty();
                        $('body').find("."+index).find('li').text(value);
                 
                      });
                   }else{
                      loadCommentView(ticket_id,org_id);  
                   }

                    },
                   complete:function(){
                   $(obj).removeClass("disabled");
                    $('.small_loader').css('display','none');
                   }         
                })
            

        })
        
        // appointment
        
        $('body').on('click',".chk",function(){
        $('.apt_input').val('');
        $('.apt_end_time').attr('disabled','disabled');
        if($(this).is(":checked")){
        $('.appointment_div').css('display','block');
        }else{
        $('.appointment_div').css('display','none');
        }
        });
        
        
        
        
        // start appointment
        $('body').on('focus',".apt_date", function(){
             
               $(this).datetimepicker({  
                format: 'DD-MM-YYYY',
               minDate: moment(),
                
             });
             
             $(this).parent().find('.date').find('li').text('');
            });
        $('body').on('focus',".apt_start_time", function(){
              $(this).timepicker({
              'showDuration': true,
              'timeFormat': 'H:i'
            });
            
            $(this).parent().find('.start_time').find('li').text('');
       });
        $('body').on('changeTime',".apt_start_time", function(){
            
                var start_time  =$(this).val();
                 $(".apt_end_time").val(start_time);
                 $(".apt_end_time").removeAttr('disabled');
                $('.apt_end_time').timepicker('option', 'minTime', start_time);
                 $(this).parent().find('.end_time').find('li').text('');
       });
     
        $('body').on('focus',".apt_end_time", function(){
                 var start_time  =$(".apt_start_time").val(); 
                 $(this).timepicker({
              'showDuration': true,
              'timeFormat': 'H:i',
              'minTime':start_time
            });
                  $(this).parent().find('.end_time').find('li').text('');
         });
        $('body').on('change',".apt_venue", function(){
             $(this).parent().find('.venue').find('li').text('');
         });
        $('body').on('change',"#comments", function(){
             $(this).parent().find('.comments').find('li').text('');
         });
         


   

        // change comment type on click..
        $('body').on('click', '#public_comment', function () {
     
            $(this).addClass('active');
            $('body').find('#private_comment').removeClass('active');
            $('body').find('#comment_type').val('public');
            $('body').find('.comment_option').text('your comment is sent to the ticket requester');
              $('body').find('.appointment_main_div').css('display','none');
              $('body').find('.comments').find('li').text('');
        })
        $('body').on('click', '#private_comment', function () {
     
            $(this).addClass('active');
            $('body').find('#public_comment').removeClass('active');
            $('body').find('#comment_type').val('private');
            $('body').find('.comment_option').text('your comment is visible to employee only');
            $('body').find('.appointment_main_div').css('display','block');
            $('body').find('.comments').find('li').text('');

        })

       $(document).on('click','.innertab',function(){
         var type=$(this).attr('data-type');
         $(this).addClass('edit_this');
         if(type=='comment_div'){
           $(this).addClass('edit_this');
           $('#appointment_link').removeClass('edit_this');
           
           $('body').find('#'+type).removeClass('content_text');  
           $('body').find('#appointment_div').addClass('content_text');  
         }else{
              $(this).addClass('edit_this');
              $('#comment_link').removeClass('edit_this');
             
            $('body').find('#'+type).removeClass('content_text');  
            $('body').find('#comment_div').addClass('content_text'); 
         }
       });

    });

    function loadCommentView(ticket_id,org_id) {
        var base_url = $("#base_url").val();
        // load comment view....
        $("body").find('#comment_view').load(base_url + 'commentController/index/' + ticket_id + '/' +org_id, {}, function () {
            $("body").find(".animsition-loading").addClass("hide");
               
        });

    }

</script>

<style>

    .obj_class{
        width: 100%;
        min-height: 400px;
    }
    @media all and (max-width:640px) {
        .obj_class{
            max-height: 300px;
            min-height: 300px;
        }

    }

    .btn.btn-primary.btn-file,.fileinput-remove,.kv-file-remove {
        display: none;
    }
    .comment_box{
        margin-bottom: 1%;
        height: available !important;
        max-height: 100%;
        overflow: visible !important

    }
    .mail_list_column .right {
        padding-bottom: 10px
    }
    .ticket_data{
        border:none;
        border-left: 1px solid #ddd
    }



    .ticket {
        background:#f8f8f8;
        padding-right:0;
    }
    .ticket .left {
        padding-right:2px;
        padding-left:0;
        /*        overflow-y:auto;*/
        max-height:480px
    }
    .ticket .right {
        padding-left:2px;
        padding-right:0;
    }
    .ticket_left form {
        width:100%;
    }
    .ticket_left {
        background: #ffffff none repeat scroll 0 0;
        border: 1px solid #d5d5d5;
        border-radius: 5px;
        float: left;
        margin: 8px 0;
        padding:15px;
        width:100%;
    }
    .ticket_left .form-group  {
        margin-left:0;
        margin-right:0;
    }
    .ticket_left select {
        -moz-appearance:none;
        position:relative;
        -webkit-appearance:none;
    }
    .ticket_left label {
        width:100%;
        font-size: 11px;
        color: #999;
        float: none;
        margin: 4px 0 6px 0;
        text-align: left;
        z-index: 0;
    }
    .ticket_right {
        background: #fff;
        border-left: 1px solid #d5d5d5;
        border-radius: 0px;
        float: left;
        margin: 8px 0;
        padding:15px;
        width:100%;
        min-height:450px;
    }
    .ticket_right label span {
        border-left: 1px solid #dddddd;
        color: #999999;
        float: none;
        font-size: 11px;
        padding-left: 13px;
        margin-left: 10px;
        text-align: left;
        width: 100%;
    }
    .bootstrap-tagsinput{
        width:100%
    }

    .wait{
        display:none;
        z-index: 9999;
    }
    .wait img {
        left: 0;
        margin: 0 auto;
        position: fixed;
        right: 0;
        top: 45%;
    }
    #pop_div {
        border: 1px solid #ddd;
        border-top-color: transparent;
        padding: 0px;
        width: 100%;
        overflow: hidden;
    }
    #pop_div i {
        width: 18px;
    }
    #pop_div i.fa.fa-caret-right {
        position: relative;
        top: 3px;
    }
    #pop_div ul {
        list-style: outside none none;
        padding: 0;
    }
    #pop_div ul li {
        padding: 4px 0 4px 10px;
    }
    #pop_div ul li:hover {
        background: #ddd;
        transition: all 0.3s;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        cursor: pointer;

    }
    .pop_div.form-control.input_tag.bootstrap-tagsinput {
        height: auto;
        min-height: 30px;
    }
    
    .disabled, .btn[disabled], fieldset[disabled] .btn {
       box-shadow: none;
       cursor: not-allowed !important;
       opacity: 0.65;
        /*background: transparent !important;*/
    }
    
    
    /* Right Section Css */
    .right_section {
        float: right;
        width: 90%;
    }
    .right_section > h3 {
        font-size: 18px;
        }
    .right_section > p {
        margin-bottom: 0px;
        font-size: 12px;
        line-height: 21px;
    }
    .right_section p i {
        width: 18px;
    }
    .right_section > p span {
        color: #1a82c3;
    }
    .right_section textarea {
        width: 100% !important;
    }
    .right_section li {
        list-style: outside none none;
        padding-left: 15px;
        position: relative;
    }
    .right_section li::after {
        background: transparent;
        border: 1px solid #888;
        border-radius: 50%;
        box-shadow: 0 0 1px 0 #333 inset;
        -moz-box-shadow: 0 0 1px 0 #333 inset;
        -webkit-box-shadow: 0 0 1px 0 #333 inset;
        content: "";
        height: 8px;
        left: 0;
        position: absolute;
        top: 5px;
        width: 8px;
    }
    .right_section .organisation_notes {
        margin: 15px 0 0;
    }
    .right_section .address_bar {
        margin-top: 15px;
    }
    .notes_button{
        margin-top: 10px;
    }
    .notes{
        margin-left: 10px;
       text-decoration:none;
    }
    @media all and (min-width: 768px) and (max-width: 1024px){
        .right_section {
            float: right;
            width: 90% !important;
        }
    }

    .no-border .x_panel{
        border: none!important;
        padding: 2px 17px
    }
    .no-border .x_title {
    border-bottom: 2px solid #eee;
    }
    .status_span{
        margin-top: 3px;
    }
    #requester_header {
    border-bottom: 1px solid #e9e9e9;
    color: #555;
    font-size: 9pt;
    margin: 20px 10px 0;
    padding-bottom: 10px;
}
#requester_header .separator {
    color: #ddd;
    font-size: 7pt;
    margin: 5px;
}
.text_content{
    display:none;
}
.ln_solid {
 margin: 10px 0 !important;
}
</style>

