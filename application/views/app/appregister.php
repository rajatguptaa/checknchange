<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Register Account</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link href="<?php echo base_url(); ?>assets/css/datepicker/bootstrap-datetimepicker.css" rel="stylesheet">	<link href="<?php echo base_url(); ?>assets/css/app/main.css" rel="stylesheet">	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker/jquery-2.js"></script>	<script src="<?php echo base_url(); ?>assets/js/datepicker/moment-with-locales.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datetimepicker.js"></script>
</head>

<body>	<div class="container">		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Appointment">			<h2 class="text-center">Register Your Account</h2>		</div>		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Item_Status Appointment_form_section RegisterAccount">			<div class="col-md-6 col-sm-12 col-xs-12">				<form class="form-horizontal Status-form">
					<div class="form-group">
						<label class="col-sm-12 control-label text-left" for="textinput">Name<span>*</span></label>  						<div class="form-group col-sm-8 col-xs-12">							<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">						</div>					</div>
					<div class="form-group">						<label class="col-sm-12 control-label text-left" for="textinput">Email <span>*</span></label>  						<div class="form-group col-sm-8 col-xs-12">							<input id="textinput" name="textinput" type="email" placeholder="" class="form-control input-md">						</div>
					</div>
					<div class="form-group">						<label class="col-sm-12 control-label text-left" for="textinput">Phone <span>*</span></label>  						<div class="form-group col-sm-8 col-xs-12">							<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">						</div>					</div>
					<div class="form-group">						<label class="col-sm-12 control-label text-left" for="textinput">Address <span>*</span></label> 
						<div class="form-group col-sm-8 col-xs-12">							<textarea class="form-control" rows="3"></textarea>						</div>					</div>
					<div class="form-group">						<label class="col-sm-12 control-label text-left" for="textinput">Password <span>*</span></label> 						<div class="form-group col-sm-8 col-xs-12">							<input id="password" name="password" type="password" placeholder="" class="form-control input-md">						</div>					</div>
					<div class="form-group">						<label class="col-sm-12 control-label text-left" for="textinput">Confirm Password <span>*</span></label> 						<div class="form-group col-sm-8 col-xs-12">
							<input id="password" name="password" type="password" placeholder="" class="form-control input-md">						</div>
					</div>
					<div class="form-group">						<div class="col-xs-12 col-sm-12 nopadding_l">							<span class="col-xs-12 col-sm-12 text-right nopadding_l">If Already Registered&nbsp;								<a href="<?php echo base_url('app'); ?>" class="pull-right"> Login </a>							</span>
						</div>
					</div>  
					<div class="form-group">
						<div class="col-xs-12 col-sm-12 nopadding_l">
							<button id="singlebutton" class="btn btn-default">Register</button>						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12 hidden-xs">
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
