<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Login Your Account</title>
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
					<div class="LoginMainForm">
					     <div class="col-xs-12 Appointment">
						  <h2 class="text-center">Login</h2>
					     </div>

					     <div class="col-xs-12 Item_Status Appointment_form_section LoginForm">
						  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 LoginLogo">
						       <img src="<?php echo base_url(); ?>assets/img/checknchange.png" class="img-responsive"/>
						  </div>

						  <div class="col-md-12 col-sm-12 col-xs-12 LoginForm">
						       <form class="form-horizontal Status-form">
							    <div class="form-group">
								 <!-- Text input-->
								 <label class="col-sm-12 control-label" for="textinput">Email Address <span>*</span></label>  
								 <div class="col-sm-12 col-xs-12 nopadding">
								      <input id="textinput" name="textinput" type="email" placeholder="" class="form-control input-md">
								 </div>
							    </div>

							    <div class="form-group">
								 <!-- Text input-->
								 <label class="col-sm-12 control-label" for="password">Password <span>*</span></label> 
								 <div class="col-sm-12 col-xs-12 nopadding">
								      <input id="password" name="password" type="password" placeholder="" class="form-control input-md">
									   <span class="ForgotText"><a href="">Forgot Password?</a></span>
								 </div>
							    </div>
							    <div class="form-group">
								 <div class="checkbox"> 
								      <label> <input type="checkbox"> Remember me </label> 
								      <label> <a href="<?php echo base_url('app/register');?>"> Register </a> 
								 </div>
							    </div>                        
							    <div class="form-group">
								 <button id="singlebutton" class="btn btn-default">Submit</button>
							    </div>

							    <!-- Button -->
						       </form>
						  </div>

					     </div>

					</div>

					

			      </body>
			      </html>
