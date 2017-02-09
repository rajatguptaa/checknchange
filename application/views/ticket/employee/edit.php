<div class="container">
    <div class="col-md-12 col-sm-12 ticket">
        <form data-parsley-validate id="employee_ticket"  class="form-horizontal form-label-left"   action="" method="post" enctype="multipart/form-data">
            <div class="col-md-4 col-sm-5 left">
                <div class="ticket_left">
                    <div class="form-group col-md-12">
                        <label for="filter">Requester </label>
                        <input type='text' class="form-control col-md-7 col-xs-12" value="<?php echo ucwords($ticket_detail['ticket_creater']);?>" disabled=""></span>
                  </div>
                    <div class="form-group col-md-12">
                        <label for="contain">Assignee*</label>
                        <?php $assign_user=array(); 
                                if(!empty($ticket_detail['assign_user'])){
                                foreach ($ticket_detail['assign_user'] as $key => $asn_value) {
                                       $assign_user[]=$key;
                                 }
                        }
                        ?>
                        
                        <select id='group' class="group form-control" multiple data-name="assign_user">
                            <?php
                            if (!empty($group)) {
                                foreach ($group as $key => $grp_val) {

                                    $group_data = explode('_', $key);
                                    ?>

                                    <optgroup label="<?php echo $group_data[0]; ?>" id='<?php echo $group_data[1]; ?>'>
                                        <?php foreach ($grp_val as $user_data) { ?>
                                            <option <?php if(!empty($assign_user)){if(in_array($user_data['user_id'].'_'.$group_data[1], $assign_user)){ echo 'selected';}} ?> value='<?php echo $user_data['user_id'].'_'.$group_data[1]; ?>'>
                                                <?php echo getUserName($user_data['user_id']); ?>   
                                            </option>
                                        <?php } ?>
                                    </optgroup>   
                                    <?php
                                }
                            }
                            ?>   
                        </select>
                     
                    </div>
                     <?php echo form_error('assign_user'); ?>  
                </div>
         
            <div class="ticket_left"> 
                <div class="form-group col-md-6">
                    <label for="filter">Type </label>
                    <select class="form-control chossen" data-parsley-error-message="Ticket type field is required." name="ticket_type" required="">
                    
                        <option value="question" <?= ( $method == "post") ? (set_value('ticket_type') == "question") ? "selected" : "" : ($ticket_detail['ticket_type'] == "question" ) ? "selected" : ""; ?>>Question</option>
                        <option value="task" <?= ( $method == "post") ? (set_value('ticket_type') == "task") ? "selected" : "" : ($ticket_detail['ticket_type'] == "task" ) ? "selected" : ""; ?>>Task</option>
                        <option value="problem"  <?= ( $method == "post") ? (set_value('ticket_type') == "problem") ? "selected" : "" : ($ticket_detail['ticket_type'] == "problem" ) ? "selected" : ""; ?>>Problem</option>
                    </select>
                </div>
                    <?php echo form_error('ticket_type'); ?>
                <div class="form-group col-md-6">
                    <label for="filter">Priority </label>
                    <select class="form-control chossen" name="ticket_priority" required="" data-parsley-error-message="Priority  type field is required.">
                       
                        <option value="normal" <?= ( $method == "post") ? (set_value('ticket_priority') == "normal") ? "selected" : "" : ($ticket_detail['ticket_priority'] == "normal" ) ? "selected" : ""; ?>>Normal</option>
                        <option value="high" <?= ( $method == "post") ? (set_value('ticket_priority') == "high") ? "selected" : "" : ($ticket_detail['ticket_priority'] == "high" ) ? "selected" : ""; ?>>High</option>
                        <option value="low" <?= ( $method == "post") ? (set_value('ticket_priority') == "low") ? "selected" : "" : ($ticket_detail['ticket_priority'] == "low" ) ? "selected" : ""; ?>>Low</option>
                        <option value="urgent" <?= ( $method == "post") ? (set_value('ticket_priority') == "urgent") ? "selected" : "" : ($ticket_detail['ticket_priority'] == "urgent" ) ? "selected" : ""; ?>>Urgent</option>
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
               <input id="ticket_subject" data-parsley-error-message="The Subject field is required." class="form-control col-md-7 col-xs-12 <?php echo (strlen(form_error('ticket_subject')) > 0) ? "parsley-error" : "" ?>" value="<?php echo ( $method == "post") ? set_value('ticket_subject') : $ticket_detail['ticket_subject']; ?>" name="ticket_subject" placeholder="Ticket Subject"  type="text">
                <?php echo form_error('ticket_subject'); ?>
            </div>
            <div class="form-group col-md-12">
                <label>Description <span> your comment is sent to the ticket requester</span> </label>
               <textarea  rows="7" data-parsley-error-message="The Description field is required."  id="ticket_description" required="required" placeholder="Enter Description" name="ticket_description" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('ticket_description')) > 0) ? "parsley-error" : "" ?>"><?= ( $method == "post") ? set_value('ticket_description') : $ticket_detail['ticket_description']; ?></textarea>
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
 <?php if(!empty($ticket_detail['tag']))
      {
        foreach($ticket_detail['tag'] as $tag_detail){
        $sel[]=$tag_detail['tag_id'];
     }?>
     
        <?php }
        else{
           $sel=array(); 
        }
        ?>
  <input type='hidden' value='<?php echo json_encode($sel);?>' id='select_array'>                  
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm">Submit</button>
      </div>
    </div>
  </div></form>

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
//   CKEDITOR.replace('ticket_description');
      
        var arr = new Array();
        $(".chossen").chosen({width: "100%"});
        $(".tags").chosen({width: "100%", include_group_label_in_selected: true});
            var organisation_id =  $('body').find('#organisation_type').val();
            var grp = $(".tags");
            
            var selected_option =  $.parseJSON($("#select_array").val());
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
            
             $(grp).val(selected_option);
             grp.trigger("chosen:updated");
         }
                }
            });
       
        $("#create_ticket").click(function () {
            $("#employee_ticket").submit();
        });

        $(".add_button").click(function(){
            
        
          $("#create_user_form input[type=text]").val(''); 
          $("#create_user_form input[type=email]").val(''); 
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
                var option_name = err.detail.user_name ;
                $("#user_select").prepend("<option value="+option+" selected='selected'>"+option_name+"</option>").trigger('chosen:updated');
       }
    }
 });

  $("#group").formgroup();

 

 var arr = new Array();
        $("#attach_ids").val('');
   
        var base_url = $("#base_url").val();
        $("#image").fileinput({
            uploadUrl: base_url + 'common/upload_attachment',
            uploadAsync: true,
            showRemove: false,
            overwriteInitial: false,
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


        $image = $('#image');

        $image.on('fileuploaded', function (event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;


            arr.push(response.attchment_id);
            $("#attach_ids").val(arr);
            $("#pre_ids").val(arr);
            $("#" + previewId).attr("response_id", response.attchment_id);
        }).on("filebatchselected", function (event, files) {
            $image.fileinput("upload");
        });

        $(document).on("click", ".btn-preview", function () {
            var type = $(this).attr("data-type");
            var this_obj = $(this);
            var html;
          
            switch (type)
            {
                case "doc":
                    html = "<pre>"+$(this_obj).parents().find("pre").html()+"</pre>";
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

        $(document).on("click", ".kv-file-remove", function () {
            var delete_id = $(this).attr('data-key');

            if (typeof delete_id != 'undefined') {
                del_id = delete_id;
            }
            else {
                del_id = $(this).parents(".file-preview-frame").attr("response_id");
            }


            var url = base_url + 'common/delete_attachment';

            ajaxRequest(url, 'POST', {id: del_id}, function (data) {
                if (data == 1) {
                    var attchstr = $('body').find("#attach_ids").val();
                    if (attchstr != '') {
                        var new_string = remove(attchstr, del_id);

                        $('body').find("#attach_ids").val('');
                        $('body').find("#attach_ids").val(new_string);
                    }
                }
            });
        });

        $image.on("filepredelete", function (jqXHR) {
            console.log($(this).parents(".file-preview-frame").attr("response_id"));
            // you can also send any data/object that you can receive on `filecustomerror` event
        });

        var pre_ids = $("#pre_ids").val();
        if (pre_ids != '') {
            var url = base_url + 'common/delete_attachment';
            ajaxRequest(url, 'POST', {id: pre_ids}, function (data) {
            });
        }

        $('body').find("#cancel").click(function () {
            var pre_ids = $("#pre_ids").val();
            if (pre_ids != '') {
                var url = base_url + 'common/delete_attachment';
                ajaxRequest(url, 'POST', {id: pre_ids}, function (data) {
                });
            }
        });

        $('body').find(".kv-file-download").click(function () {
            
        });

        $("body").find(".file-preview-thumbnails .file-footer-buttons").each(function () {

            $(this).append('<a target="_blank" href="'+base_url+'common/download/'+$(this).find(".kv-file-remove").attr("data-key")+'" title="Download file" class="kv-file-download btn btn-xs btn-default" type="button"><i class="fa fa-download"></i></a>');
        })
    });

   


</script>