  <?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="">
              <div class="page-title">
                <div class="title_left">
                    <h3><?php echo Report; ?></h3>
                </div>
                
            </div>
            <div class="clearfix"></div>
  
           
            <div class="x_panel">
                  <div class="page-title">
                        
                        <h2><?php echo $mainHeading; ?> <a href="<?php echo base_url().'/report';?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-chevron-circle-left"></i> Back</a></h2>
                       
                     
                    </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                      
                   
                      
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_content">
                                <form method="post" id="report_form" action="<?php echo base_url().'reportController/genrate';?>">
                               
                                    <h4>Reporting period</h4>
                                            <div class="ln_solid"></div>
                                        
                                    <div class="col-md-12 col-sm-12 col-xs-12 head-check">


                                        <input type="radio"  value="true" data_tab="relative_report" name="report[is_relative_interval]" id="relative_radio" class="radio pull-left chk_radio" checked="checked">
                                        <label class="option pull-left"> Relative to today</label>

                                        <input  type="radio" value="false" data_tab="fixed_report" name="report[is_relative_interval]" id="report_is_relative_interval_false" class="radio pull-left">
                                        <label class="option pull-left">Fixed date interval</label>
                                    </div>
                                     
                                    <div class="relative_report col-md-12 col-sm-12 col-xs-12">
                                     
                                         <div class="col-md-3 col-sm-6 col-xs-6" id="relative_interval_selection">
                                            <label class="">View by</label></div>
                                            <div class="indented_option col-md-6 col-sm-12 col-xs-6" id="relative_interval_selection">
                                            <select  class="form-control chosen" style="width:30%" name="report[relative_interval_in_days]" id="report_relative_interval_in_days"><option value="7">Last week</option>
                                                <option value="14">Last 2 weeks</option>
                                                <option value="30">Last month</option>
                                                <option selected="selected" value="91">Last 3 months</option></select>
                                        </div>

                                    </div>
                                    <div class="fixed_report col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4 col-sm-6 col-xs-6" id="fixed_interval_selection">
                                            <label class="option">Start Date</label>    
                                            <input type="text" name="report[start_date]"  class="form-control startdate" placeholder="Start date">
                                        </div>
                                        <div class="to"><b>To</b></div>

                                        <div class="col-md-4 col-sm-6 col-xs-6" id="fixed_interval_selection">
                                            <label class="option">End Date</label>    
                                            <input placeholder="End date" type="text" name="report[end_date]"  class="form-control enddate">
                                        </div>
                                    </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 org_div">
                                    <?php   if(access_check("organisation","view")) : ?>
                          <div class="col-md-3 col-sm-6 col-xs-6">
                                   <span><b>Organisation</b></span>
                          </div> 
                          <div class="col-md-6 col-sm-6 col-xs-6">             
                         <select name="orginasation_search" id="orginasation_search" tabindex="-1" class="select_organisation form-control">    
                                          
                               <?php foreach ($organisation as $org) { ?>
                               <option value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name']?></option>
                              <?php } ?>
                         </select></div>   
                            <?php 
                            else : ?>
                            <input type="hidden" name="orginasation_search" id="orginasation_search" value="<?php  $org=getUserOrginasationDetails($user['user_id']); echo $org['organisation_id']; ?>">
                            <?php
                            endif; ?>
                                  </div> 
                                   
                                   <?php 
                                   if($access_level==1){
                                   if($report_type=='1120' || $report_type=='1121'){?>
                                   <div class="col-md-12 col-sm-12 col-xs-12 org_div">
                                  
                                   <div class="col-md-3 col-sm-2 col-xs-2">
                                   <span><b>Employee</b></span>
                                   </div>
                                   <div class="col-md-3 col-sm-4 col-xs-4">     
                                   <select name="sets[operator]" class="form-control chosen" id="set_opt"><option value="is">Is</option><option value="is_not">Is not</option>
                                   </select>
                                   </div>
                                   <div class="col-md-3 col-sm-4 col-xs-4">     
                                   <select  class="form-control chosen" id="set_emp"  name="sets[employee_id]">
                                   </select></div>
                                    </div>
                                   <?php }} ?>
                                   
                                 <div class="col-md-12 col-sm-12 col-xs-12 btn-div">
                                     <input type="hidden" id="org_id" name="org_id"> 
                                     <input type="hidden" name="report[report_type]" value="<?php echo $report_type;?>"> 
                                    <button type="submit" class="pull-right btn btn-success btn-sm generate">Generate Report</button>
                                 </div></form>   
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_content">
                              
                                    <h4>Download</h4>
                             
                               <div class="ln_solid"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div style="" class="pdf_btn pull-left" > 
                                        <a  href="#" onclick="javascript:void(0)" data_type="pdf" class="genrate_report btn_download" type="button"> <img width="50px" src="<?php echo base_url() . 'assets/images/pdf-icon.png' ?>" class=""></a>
                                    </div>
                                    <div style="margin: 0 20px" class="csv_btn pull-left" disabled>
                                        <div class="pull-right">
                                            <a href="#"  data_type="csv" class="genrate_report btn_download" type="button" onclick="javascript:void(0)"><img width="46px" src="<?php echo base_url() . 'assets/images/csv-icon.png'; ?>" class=""></a>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" id="report_generate_form" action="<?php echo base_url().'reportController/genrateReport';?>">
                                   <input type="hidden" name="org_id" id="pdf_org_id"> 
                                   <input type="hidden" name="report[report_type]" value="<?php echo $report_type;?>">     
                                    <input type="hidden" name="report[start_date]" class="form-control" id="startdate">
                                    <input type="hidden" name="report[end_date]" class="form-control" id="enddate">
                                    <input type="hidden" value="true" id="type" name="report[is_relative_interval]">
                                    <input type="hidden" name="report[relative_interval_in_days]" id="interval_in_days">
                                    <input type="hidden" value="is" name="sets[operator]" id="operator">
                                    <input value="All" type="hidden" name="sets[employee_id]" id="employee">
                                    <input value="" type="hidden" name="report_type" id="report_type">
                                    
                                </form>
                            </div>
                        </div></div></div>
                        

                   
             


               


                <div class="clearfix"></div>

               
            </div>
             <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 report_data">
                      
                    
                    </div>
            </div>
            </div></div>
        <div align='center' class="wait">
    <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
</div>
    </div>
    <script>
        $(document).ready(function() {
             var base_url = $("#base_url").val();  
              $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
        
           $(".select_organisation").chosen({width: "85%", });
        var org_id = $("#orginasation_search").val();
        getEmployee(org_id);
        $('#org_id').val(org_id);
        $('#pdf_org_id').val(org_id);
        
     
        
        // organisation change
        
         $("body").on('change', '.select_organisation', function () {
            var org_id = $(this).val();
            $('#org_id').val(org_id);
            $('#pdf_org_id').val(org_id);
             getEmployee(org_id);
        });
        
                 $(".chosen").chosen({width: "85%" });
        
                var dateNow = new Date();
                $('.startdate').datetimepicker({
                    format: 'DD-MM-YYYY',
                    defaultDate:moment(dateNow)
                }).on('dp.change', function (selected) {
                   
                    $('.enddate').datetimepicker({
                    format: 'DD-MM-YYYY',
                    minDate:selected.date,
                   });
               
                   
                });
                
             
                $('.enddate').datetimepicker({
                    format: 'DD-MM-YYYY',
                    defaultDate:moment(dateNow)
                 });   
                  
           
           
              $('.chk_radio').prop('checked','checked');
            $('body').find('.radio').click(function() {
                var div_id = $(this).attr('data_tab');
                $('#type').val($(this).val());
                if (div_id == 'relative_report') {
                    $('.relative_report').css('display', 'block');
                    $('.fixed_report').css('display', 'none');
                    
                } else {
                    $('.relative_report').css('display', 'none');
                    $('.fixed_report').css('display', 'block');

                }
            });
            
            $('#interval_in_days').val($('#report_relative_interval_in_days').val());
            $('#report_relative_interval_in_days').change(function(){
            $('#interval_in_days').val($(this).val());  
            });
            
            
            $('.generate').click(function(){
             var start_date = ($('.startdate').val());
             var end_date = ($('.enddate').val());
             $('#startdate').val(start_date);
             $('#enddate').val(end_date);
             $('.genrate_report').removeClass('btn_download');
            });
            
            $('#report_form').ajaxForm(function (data) {
              $('.report_data').empty(); 
              $('.report_data').html(data); 
                
            });
            
//            $('.genrate_report').click(function(){
//             var type = $(this).attr('data_type');
//             $('#report_type').val(type);
//              $('#report_generate_form').submit(); 
//            });
            
            $('#set_opt').change(function(){
               $('#operator').val($(this).val());
               if($(this).val()=='is_not'){
               $('#opt_all').prop('disabled',true).trigger('chosen:updated');
               $('#opt_all').removeAttr('selected').trigger('chosen:updated');
               }else{
               $('#opt_all').prop('disabled',false).trigger('chosen:updated');
               }
            });
            
              var set_opt =  $('#set_opt').val();
               $('#operator').val(set_opt);
               if(set_opt=='is_not'){
               $('#opt_all').prop('disabled',true).trigger('chosen:updated');
               $('#opt_all').removeAttr('selected').trigger('chosen:updated');
               }else{
               $('#opt_all').prop('disabled',false).trigger('chosen:updated');
               }
         
            $('#set_emp').change(function(){
               $('#employee').val($(this).val()); 
            });
            
             //
             
             
          $(".genrate_report").click(function() {
        
          
             var count =  $('body').find('#page_count').val();
        if (count==0) {
            bootbox.alert({
                "message": "Please genrate report first after that you can download report.",
                "className": "my-custom-class",
                buttons: {
                    ok: {
                        className: "btn-warning",
                    }
                }
            });
        }
        else {
            
            var type = $(this).attr('data_type');
            $('#report_type').val(type);
            $('#report_generate_form').submit();
          }
          })
           

        });
        
        function getEmployee(org_id){
              var base_url = $("#base_url").val();  
              var obj = $('#set_emp');
               $.ajax({
                type: 'POST',
                url: base_url +'reportController/employeeDetail/',
                data: {organisation_id: org_id},
                success: function(data) {
                    
                    if(data!=false){
                    var empArray = $.parseJSON(data);
                  obj.empty();
                  $(empArray).each(function(index, value) {
                      
                  $(obj).append('<option value="' + value.user_id + '">' + (value.user_name).toUpperCase() + '</option>');
         });
            
            
             $(obj).trigger("chosen:updated");
         }
                }
            });
        }
    </script>
    <style>
   
        .head-check label.option {
            margin: 2px 25px 2px 5px;
        }
     .col-md-12.col-sm-12.col-xs-12.head-check {
    margin-left: 8px;
}
        .btn-div{
           margin: 15px 20px 2px 5px; 
        }

        .to {
            float: left;
            position: relative;
            text-indent: 5px;
            top: 40px;
            width: 50px;
        }
        .content input.radio {
            margin: 0;
            top: 1px;
        }



        .fixed_report {
            display: none;
        }
        .fixed_report, #relative_interval_selection {
            margin-top: 25px;
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
    .org_div{
        margin-top: 30px;
    }
    .btn_download {
   pointer-events: none !important;
   cursor: not-allowed !important;
}
   

    </style>

    <!-- footer content -->

