<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Book Your Appointment</title>
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
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Appointment BookingPage">
					     <h2 class="text-center">Book Your Appointment</h2>
					     <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Item_Status Appointment_form_section">
					     <div class="col-md-6 col-sm-12 col-xs-12">
						  <form class="form-horizontal Status-form">
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="Subject">Subject<span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="Subject" name="Subject" type="text" placeholder="Subject" class="form-control input-md">
							    </div>
						       </div>
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="Problem">Problem <span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <input id="Problem" name="Problem" type="text" placeholder="Problem" class="form-control input-md">
							    </div>
						       </div>
						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="Description">Description <span>*</span></label>  
							    <div class="form-group col-sm-8 col-xs-12">
								 <textarea class="form-control" id="Description"></textarea>
							    </div>
						       </div>

						       <div class="form-group">
							    <!-- Text input-->
							    <label class="col-sm-4 control-label" for="textinput">Pririty <span>*</span></label> 
							    <div class="form-group col-sm-8 col-xs-12">
								 <select class="form-control">
								      <option>Low</option>
								      <option>Medium</option>
								      <option>Hign</option>
								 </select>
							    </div>
						       </div>

						       <div class="form-group">
							    <div class="col-sm-4"> </div>
							    <button id="Submit" class="btn btn-default">Submit</button>
						       </div>
						       <!-- Button -->
						  </form>
					     </div>

					     <div class="col-md-6 col-sm-12 col-xs-12">
						  <img src="<?php echo base_url() ?>assets/img/Appointment.png" class="img-responsive"/>
					     </div>
					</div>
				   </div>

				   <script type="text/javascript">
					$(function () {
					     $('#datetimepicker1').datetimepicker();
					});
				   </script>


<!-- <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
   $(function () {
       $(".datepicker").datepicker({
	   autoclose: true,
	   todayHighlight: true
       }).datepicker('update', new Date());
       ;
   });
</script>-->


			      </body>
			      </html>
