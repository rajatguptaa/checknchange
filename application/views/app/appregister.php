<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Register Account</title>
	  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.min.css">

	       <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		    <link href="<?php echo base_url(); ?>assets/css/datepicker/bootstrap-datetimepicker.css" rel="stylesheet">
			 <link href="<?php echo base_url(); ?>assets/css/app/main.css" rel="stylesheet">
			      <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

			      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
			      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker/jquery-2.js"></script>
			      <script src="<?php echo base_url(); ?>assets/js/datepicker/moment-with-locales.js"></script>
			      <script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datetimepicker.js"></script>
			      </head>

			      <body>
				   <div class="container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Appointment">
					     <h2 class="text-center">Register Your Account</h2>
					     <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Item_Status Appointment_form_section">
					     <div class="col-md-6 col-sm-12 col-xs-12">
						  <form class="form-horizontal Status-form">
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Name<span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
							    </div>
						       </div>
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Email <span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="textinput" name="textinput" type="email" placeholder="" class="form-control input-md">
							    </div>
						       </div>
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Phone <span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
							    </div>
						       </div>


						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Address <span>*</span></label> 
							    <div class="form-group col-sm-8 col-xs-12">
								 <textarea class="form-control" rows="3"></textarea>
							    </div>
						       </div>

						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Password <span>*</span></label> 
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="password" name="password" type="password" placeholder="" class="form-control input-md">
							    </div>
						       </div>

						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Confirm Password <span>*</span></label> 
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="password" name="password" type="password" placeholder="" class="form-control input-md">
							    </div>
						       </div>
						       <div class="form-group">
							    <div class="checkbox"> 
								 <label> Already Registered<a href="<?php echo base_url('app'); ?>"> Login </a> 
							    </div>
						       </div>  
						       <div class="form-group">
							    <div class="col-sm-4"> </div>
							    <button id="singlebutton" class="btn btn-default">Register</button>
						       </div>
						       <!-- Button -->
						  </form>
					     </div>

					     <div class="col-md-6 col-sm-12 col-xs-12">
						  <img src="<?php echo base_url() ?>assets/img/cal.png" class="img-responsive"/>
					     </div>
					</div>
				   </div>

				   <script type="text/javascript">
					$(function () {
					     $('#datetimepicker1').datetimepicker();
					});
				   </script>





			      </body>
			      </html>
