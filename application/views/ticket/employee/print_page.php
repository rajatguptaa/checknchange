<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="print" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <?php // var_dump($ticket_assign_data);?>
    <div style="width: 100%; float: left; padding: 0 15px 30px;">
        <div style="width: 100%; float: left; border-bottom: 1px solid #ddd;">
            <div style="width: 30%; float: left; text-align: center; padding: 30px;">
                <img src="<?php echo base_url();?>assets/img/checknchange.png" class="img-responsive" />
            </div>
            <div style="width: 70%; float: left; text-align: center; padding-top: 25px">
                <h1 style=" margin-bottom: 0px; font-size: 60px;">Check-N-Change</h1>
                <h3 style="margin-top: 10px;">Home Services Pvt. Ltd.</h3>
            </div>
        </div>
        <div style="width: 100%; float: left; border-bottom: 1px solid #ddd;">
            <div style="width: 100%; float: left;">
                <p style="margin: 0px;"> <i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;0731 - 2025555,  096300 36131&nbsp; www.checknchange.com&nbsp; Mail:checknchange.hspl@gmail.com
                101, Harshdeep Avenue, Chikitsak Nagar Mahalakshmi Nagar Main Road, Opp. Bombay Hospital, Indore(M.P.) India</p>
            </div>
        </div>
    </div>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
              
                <h4 class="modal-title text-center" id="myModalLabel">Job Card</h4>
            </div>
            
         
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 id="ticketSubject" class="col-sm-8 pull-left nopadding_l">DATE:- &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/ </h4>
                    <div class="col-md-4 pull-right">
                        <lable id="ticketPriority" class="label pull-right text-capitalize"><?php echo  $ticket_detail[0]['ticket_number'] ;?></lable>
                    </div>
                </div>

                
                <!--all fields...-->    
                <div class="col-sm-8">
                   
                    <div>&nbsp;</div>
                  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>WORK NAME:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketStatus">
                                <?php echo $ticket_detail[0]['ticket_subject'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">ASSIGN TO:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedBy">
                                <?php echo $ticket_assign_data[0]['assignee']  ?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">EMPLOYEE ID:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedDate">
                                <?php echo  $ticket_assign_data[0]['user_code'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>COMPLAIN ADRESS:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignedBy">
                                <?php echo $ticket_assign_data[0]['address1'].','.$ticket_assign_data[0]['address2'].','.$ticket_assign_data[0]['user_city'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>CONTACT PERSON:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignDate">
                                <?php echo $ticket_assign_data[0]['user_mobile'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...--> 
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6" >
                                <label>WORK DESCRIPTION:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketUpdateBy">
                                <?php echo $ticket_detail[0]['ticket_description']?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 30px;">
                            <label style="width: 28%; float: left;">WORK SATISFACTION / REMARK</label>
                            <label style="border-bottom: 1px solid #ddd; width: 72%;">&nbsp; </label>
                            <label style="border-bottom: 1px solid #ddd; width: 100%; margin-bottom: 30px;">&nbsp; </label>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!--all fields...-->    
                <div class="col-sm-8">
                    <div>&nbsp;</div>
                  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>Estimated Cost:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="">
                                
                            </div>
                        </div>
                    </div>
                    <!--all fields...--> 
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>Customer Pay:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="">
                            </div>
                        </div>
                    </div>
                    
                    <!--all fields...--> 
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-12 col-xs-12">
                                <label style="width: 100%; text-align: right;">SIGNATURE</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">Job Card</h4>
            </div>
         
            <div class="modal-body">
                

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 id="ticketSubject" class="col-sm-8 pull-left nopadding_l">DATE:- &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/ </h4>
                    <div class="col-md-4 pull-right">
                        <lable id="ticketPriority" class="label pull-right text-capitalize"><?php echo  $ticket_detail[0]['ticket_number'];?></lable>
                    </div>
                </div>
                  <div class="col-sm-8">
                   
                    <div>&nbsp;</div>
                  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>WORK NAME:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketStatus">
                                <?php echo $ticket_detail[0]['ticket_subject'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">ASSIGN TO:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedBy">
                                <?php echo $ticket_assign_data[0]['assignee']  ?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">EMPLOYEE ID:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedDate">
                                <?php echo $ticket_assign_data[0]['user_code'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>COMPLAIN ADRESS:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignedBy">
                                <?php echo $ticket_assign_data[0]['address1'].','.$ticket_assign_data[0]['address2'].','.$ticket_assign_data[0]['user_city'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>CONTACT PERSON:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignDate">
                                <?php echo $ticket_assign_data[0]['user_mobile'];?>
                            </div>
                        </div>
                    </div>
                    <!--all fields...--> 
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6" >
                                <label>WORK DESCRIPTION:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketUpdateBy">
                                <?php echo $ticket_detail[0]['ticket_description']?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 30px;">
                            <label style="width: 28%; float: left;">WORK SATISFACTION / REMARK</label>
                            <label style="border-bottom: 1px solid #ddd; width: 72%;">&nbsp; </label>
                            <label style="border-bottom: 1px solid #ddd; width: 100%; margin-bottom: 30px;">&nbsp; </label>
                        </div>
                    </div>
                </div>
                <!--all fields...--> 
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-12 col-xs-12">
                            <label style="width: 100%; text-align: right;">SIGNATURE</label>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>