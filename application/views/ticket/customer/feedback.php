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


        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    
                    <a class="btn btn-success btn-sm pull-right" href="<?= base_url('request') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="feedback_form" data-parsley-validate  class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class='col-md-12 col-sm-12 col-xs-12 feedback' >
                                <div class="form-group col-md-12 col-sm-12 col-xs-12"><label>How would you rate the support you recieved ?</label><button type='button' id='good' feedback_type='good' class='good btn btn-lg btn-default btn-round'>Good,I'm satisfied</button><button id='bad' type='button' feedback_type='bad' class='bad btn btn-lg btn-default btn-round'>Bad,I'm unsatisfied</button> <span class="invalid"></span></div>
                               
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Add the comment about the quality of support you received (optional)</label>
                            <textarea placeholder="Enter Your Comment" class="form-control col-md-7 col-xs-12" name="comment" placeholder="" id="organisation_extra" data-parsley-id="22"></textarea>
                             </div>
                                <input type='hidden' name='feedback_type' id='feedback_type'>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 pull-right">
                                <div class="col-md-offset-10">
                                    <a class="btn btn-default " href="http://192.168.10.67:8080/crm/organisation">Cancel</a>
                                    <button class="btn btn-success" id="feedback_button" type="button" id="send">Submit</button>
                                </div>
                                </div>
                            </div>
                          
                        </div>
                    </form>
                    
                </div>  
            </div>
            
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#feedback_type').val('');
 $('#good').click(function(){
  $(this).toggleClass('select_good');        
  $(this).toggleClass('good');  
   if($('#bad').hasClass('select_bad')){
     $('#bad').removeClass('select_bad');
     $('#bad').addClass('bad');
  }
 $('#feedback_type').val($(this).attr('feedback_type')); 
 $('.invalid').empty();
 }); 
 $('#bad').click(function(){
  $(this).toggleClass('select_bad');        
  $(this).toggleClass('bad');
  if($('#good').hasClass('select_good')){
     $('#good').removeClass('select_good');
     $('#good').addClass('good');
  }
  $('#feedback_type').val($(this).attr('feedback_type')); 
  $('.invalid').empty();
 }); 
 
 $('#feedback_button').click(function(){
    var type = $('#feedback_type').val();
    if(type == '' || typeof type == undefined){
        $('.invalid').empty();
        $('.invalid').text('Please select type of feedback.');
    }else{
        $('#feedback_form').submit();
    }
 });
 
 
});

</script>
<style>
 .btn-round {
    border-radius: 10px !important;
    margin-right: 10px !important;
     font-size: 14px !important;
     font-weight: bold!important;
       padding: 5px 8px 2px 7px !important;
}   

.good.btn-round{
    color:#1ABB9C!important;
    margin-left: 5px;
}    
.bad.btn-round{
    color:#F16460!important;
}    
.form-group.col-md-12.col-sm-12.col-xs-12 {
    margin-top: 11px;
    margin-left: 5px;
}
.feedback{
   background-color: #DBDBDB; 
   height: 250px
}
.form-group .label{
    color:black !important;
}

.select_good{
   color:#FFF!important;
   margin-left: 5px;
   background-color:#1ABB9C!important; 
}
.select_bad{
   color:#FFF!important;
   margin-left: 5px;
   background-color:#f16460 !important;
}
.invalid{
    color:red;
    font-weight: bold;
}

</style>



<!-- footer content -->
