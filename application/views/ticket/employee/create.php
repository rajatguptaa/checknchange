<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="container">
    <div class="col-md-12 col-sm-12 ticket">
        <form data-parsley-validate id="employee_ticket"  class="form-horizontal form-label-left"   action="" method="post" enctype="multipart/form-data">
            <div class="col-md-4 col-sm-5 left">
                <div class="ticket_left">
                         <div class="form-group col-md-12">
                             
                            <?php if (access_check("organisation", "view")) : ?>
                              <label for="orginasation_search">Organisation </label>
                                <select name="orginasation_name" id="orginasation_search" tabindex="-1" class="select_organisation chossen form-control" onchange="">    
                                    <?php foreach ($organisation as $org) { ?>
                                        <option <?php echo ($org['organisation_id'] == $organisation_id) ? 'selected' : '' ?>  value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                    <?php } ?>
                                </select>   
                              <?php endif; ?>
                            
                        </div>
                   <div class="form-group col-md-12">
                        <label for="filter">Requester </label>


                        
                            <select class="form-control" id="user_select" name="user_id">
                                <?php
                                foreach ($customer_details as $customer_details_list) {
                                    ?>
                                    <option value="<?php echo $customer_details_list['user_id']; ?>"><?php echo getUserName($customer_details_list['user_id']); ?></option>
                                <?php }
                                ?>
                            </select>
                       
                    <div class="pull-right">
                        <button type="button" class="btn btn-success  btn-xs btn-square active pull-right add_button" data-type="normal_user" data-toggle="modal" data-target="#addCustomer"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                    <div class="form-group col-md-12">
                        <label for="filter">Cc </label>

                         <select data-choosen-extra="false"  id="user_cc" name="user_cc[]" tabindex="-1" class="customer_div form-control col-md-7 col-xs-12" multiple="">                                                                  <?php
                                foreach ($customer_details as $customer_details_cc) {
                                    ?>
                                    <option value="<?php echo $customer_details_cc['user_email']; ?>">
                                    <?php 
                                    $email = $customer_details_cc['user_email']; 
                                    echo getUserName($customer_details_cc['user_id']).'&lt'.$email.'&gt;
';?>
                                    </option>
                                <?php }
                                ?>
                     </select>   
                       
                    <div class="pull-right">
                        <button type="button" class="btn btn-success  btn-xs btn-square active pull-right add_button" data-type="cc" data-toggle="modal" data-target="#addCustomer"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="contain">Assignee*</label>
                        <select  class="group form-control" multiple data-name="assign_user">
                            <?php
                            if (!empty($group)) {
                                foreach ($group as $key => $grp_val) {

                                    $group_data = explode('_', $key);
                                    ?>

                                    <optgroup label="<?php echo $group_data[0]; ?>" id='<?php echo $group_data[1]; ?>'>
                                        <?php foreach ($grp_val as $user_data) { ?>
                                            <option  value='<?php echo $user_data['user_id']; ?>'>
                                                <?php echo getUserName($user_data['user_id']); ?>   
                                            </option>
                                        <?php } ?>
                                    </optgroup>   
                                    <?php
                                }
                            }
                            ?>   
                        </select>
                        <?php echo form_error('assign_user'); ?>
                    </div>
                </div>
         
            <div class="ticket_left"> 
                <div class="form-group col-md-6">
                    <label for="filter">Type </label>
                    <select class="form-control chossen" data-parsley-error-message="Ticket type field is required." name="ticket_type" required="">
                        <option value="" selected>-</option>
                        <option value="question">Question</option>
                        <option value="task">Task</option>
                        <option value="problem">Problem</option>
                    </select>
                </div>
                    <?php echo form_error('ticket_type'); ?>
                <div class="form-group col-md-6">
                    <label for="filter">Priority </label>
                    <select class="form-control chossen" name="ticket_priority" required="" data-parsley-error-message="Priority  type field is required.">
                        <option value="" selected>-</option>
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                        <option value="low">Low</option>
                        <option value="urgent">Urgent</option>
                    </select>
                    <?php echo form_error('ticket_priority'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="filter">Tags </label>
                    <select  name="tags[]" tabindex="-1" class="tags form-control col-md-7 col-xs-12 chosen-select" multiple="">                                          
                     </select>   
                </div>
            </div>
    </div>
    <div class="col-md-8 col-sm-7 right">
        <div class=" ticket_right">
            <div class="form-group col-md-12">
                <label>Subject </label>
                <input  data-parsley-error-message="Ticket subjct field is required."  required="required" id="ticket_subject" placeholder="Enter ticket subject" name="ticket_subject" value="<?php echo set_value('ticket_subject'); ?>" type="text" class="form-control col-md-7 col-xs-12"><?php echo form_error('ticket_subject'); ?>
            </div>
            <div class="form-group col-md-12">
                <label>Description <span> your comment is sent to the ticket requester</span> </label>
                <textarea  rows="7"  data-parsley-error-message="Ticket description field is required." required="required" id="ticket_description" placeholder="Enter ticket description" name="ticket_description" class="form-control col-md-7 col-xs-12"><?php echo set_value('ticket_description'); ?></textarea>
                <?php echo form_error('ticket_description'); ?>
            </div>
            <div class="form-group col-md-12">
                <label>Attchment</label>
                <input  multiple id="image" name="file" type="file" class="file-loading">
            </div>
             <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group col-md-12 pull-right">
                <a id="cancel" href="javascript:history.back()" class="btn btn-default ">Cancel</a>
                <button id="create_ticket" type="button" class="btn btn-success">Submit</button>
            </div>
           
            
        </div>
        <input type="hidden" id="attach_ids" name="attachment_id"> 
        <input type="hidden" id="pre_ids"> 
        <input type="hidden" id="group_ids"> 
        <input type="hidden" id="organisation_type" value="<?php echo $organisation_id;?>"> 
    </div>
</form>
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
          
          <input type="hidden" name="org_id" value="<?php echo $organisation_id; ?>">
          <input type="hidden" id="user_type">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm">Submit</button>
      </div>
    </div>
  </div></form>

</div>

<style>

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
    background: transparent !important;
}
    

</style>
<script>
    $(document).ready(function () {

         var base_url = $("#base_url").val();

//         CKEDITOR.replace('ticket_description');
      
        
        $("#orginasation_search").change(function (){
            
            var id = $(this).val();
         
            window.location.href = base_url+"request/employee/add/"+id;
            
        });
        
        var arr = new Array();
        $(".chossen").chosen({width: "100%"});
      
        $(".tags").chosen({width: "100%", include_group_label_in_selected: true});
        $("#user_cc").chosen({width: "90%", include_group_label_in_selected: true});
        $("#user_select").chosen({width: "90%", include_group_label_in_selected: true});
        
            var organisation_id =  $('body').find('#organisation_type').val();
            var grp = $(".tags");
          
         
            $.ajax({
                type: 'POST',
                url: base_url +'ticketController/getTag',
                data: {organisation_id: organisation_id},
                success: function(data) {
                    if(data!=false){
                    var groupArray = $.parseJSON(data);
                  grp.empty();
                  $(groupArray).each(function(index, value) {
                      
                  $(grp).append('<option value="' + value.tag_id + '">' + value.tag_heading + '</option>');
         });
            grp.trigger("chosen:updated"); 
         }
                }
            });
            
//            var user_div = $('body').find(".customer_div");
//          
//            $.ajax({
//                type: 'POST',
//                url: base_url +'ticketController/getemployee',
//                data: {organisation_id: organisation_id},
//                success: function(data) {
//                    if(data!=false){
//                    var userArray = $.parseJSON(data);
//                 
//                  user_div.empty();
//                  $(userArray).each(function(index, value) {
//                 
//                  $(user_div).append('<option value="' + value.user_email + '">' + (value.user_name) + '</option>');
//         });
//                  user_div.trigger("chosen:updated"); 
//         }
//                }
//         });
//         
         
        $("#create_ticket").click(function () {
            $("#employee_ticket").submit();
        });

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

$(".group").formgroup();

 $('#tag_file').tagsinput({
  confirmKeys: [32,13],
 
});
 $('#tag_file').tagsinput('removeAll'); 
    });


</script>