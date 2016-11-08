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
			 <div class="x_title">
			      <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
			      <a class="btn btn-success btn-sm pull-right" href="<?= base_url('amc') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
			      <div class="clearfix"></div>
			 </div>
			 <div class="x_content">
			      <form class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
				   <input type="hidden" value="<?= $form_data['id'] ?>" name="id">
				   <input type="hidden" value="<?= $form_data['pacakge_old_logo'] ?>" name="package_old_logo">
				   <span class="section">Information</span>
				   <div class="col-md-4 pull-right">
					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_logo">Logo <span class="required">*</span>
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 <?= (strlen(form_error('image')) > 0) ? "parsley-error" : "" ?>">

						  <div class="kv-avatar center-block" style="width:200px">
						       <input value="./<?= $form_data['package_logo'] ?>" id="image" name="image" type="file" class="file-loading">
						  </div><?php echo form_error('image'); ?>
					     </div>
					</div>
				   </div>
				   <div class="col-md-8">
					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_name">Amc Name <span class="required">*</span>
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 ">
						  <input data-parsley-error-message="The Amc field is required." id="organisation_name" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_name')) > 0) ? "parsley-error" : "" ?>" value="<?= ( $method == "post") ? set_value('amc_name') : $form_data['amc_name']; ?>" name="amc_name" placeholder="Amc name" required="required" type="text">
						  <?php echo form_error('amc_name'); ?>

					     </div>
					</div>


					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_title">Amc Code<span class="required">*</span>
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 ">
						  <input data-parsley-error-message="The code field is required." id="amc_code" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_code')) > 0) ? "parsley-error" : "" ?>" value="<?= ( $method == "post") ? set_value('amc_code') : $form_data['amc_code']; ?>" readonly="" name="amc_code" placeholder="Code" required="required" type="text">
						  <?php echo form_error('amc_code'); ?>
					     </div>
					</div>
					<div class="item form-group"> 
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address">AMC Type </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 ">
						  <select class="form-control col-md-7 col-xs-12" name="amc_type" id="amc_type">
						       <option value="primary" <?= ($form_data['amc_type'] == 'primary') ? 'selected' : '' ?>>PRIMARY SERVICE</option>
						       <option value="secondary" <?= ($form_data['amc_type'] == 'secondary') ? 'selected' : '' ?>>SECONDARY SERVICE</option>
						       <option value="home_appliance" <?= ($form_data['amc_type'] == 'home_appliance') ? 'selected' : '' ?>>HOME APPLIANCE</option>
						       <option value="on_call" <?= ($form_data['amc_type'] == 'on_call') ? 'selected' : '' ?>>ON CALL AMC</option>
						  </select>
					     </div>
					</div>

					<div class="item form-group on-call">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address">AMC Duration <span class="required">*</span>
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 ">
						  <select class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_duration')) > 0) ? "parsley-error" : "" ?>" data-parsley-error-message="AMC Duration field is required" name="amc_duration" id="duaration" required="required">
						       <option value="1" <?= ($form_data['amc_duration'] == 1) ? 'selected' : '' ?>>1 Year</option>
						       <option value="2" <?= ($form_data['amc_duration'] == 2) ? 'selected' : '' ?>>2 Year</option>
						       <option value="3" <?= ($form_data['amc_duration'] == 3) ? 'selected' : '' ?>>3 Year</option>
						       <option value="4" <?= ($form_data['amc_duration'] == 4) ? 'selected' : '' ?>>4 Year</option>
						       <option value="5" <?= ($form_data['amc_duration'] == 5) ? 'selected' : '' ?>>5 Year</option>
						  </select>
						  <?php echo form_error('amc_duration'); ?>
					     </div>
					</div>

					<div class="item form-group on-call">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address2">AMC Visits 
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12 ">


						  <select class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_visit')) > 0) ? "parsley-error" : "" ?>" data-parsley-error-message="AMC Visit field is required" name="amc_visit" id="amc_visit" required="required">
						       <option value="2" <?= ($form_data['amc_visit'] == 2) ? 'selected' : '' ?>>2</option>
						       <option value="4" <?= ($form_data['amc_visit'] == 4) ? 'selected' : '' ?>>4</option>
						       <option value="6" <?= ($form_data['amc_visit'] == 6) ? 'selected' : '' ?>>6</option>
						       <option value="8" <?= ($form_data['amc_visit'] == 8) ? 'selected' : '' ?>>8</option>
						       <option value="12" <?= ($form_data['amc_visit'] == 12) ? 'selected' : '' ?>>12</option>
						  </select>
					     </div>
					</div>
					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">Criteria <span class="required">*</span>
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12">
						  <textarea id="criteria" placeholder="Criteria " data-parsley-error-message="The criteria field is required."  name="amc_criteria" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_criteria')) > 0) ? "parsley-error" : "" ?>"><?= ( $method == "post") ? set_value('amc_criteria') : $form_data['amc_criteria']; ?></textarea>
						  <?php echo form_error('amc_criteria'); ?>
					     </div>
					</div>
					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required"></span></label>
					     <div class="col-md-6 col-sm-6 col-xs-12">

						  <input type="hidden" class="form-control col-md-7 col-xs-12" name='amc_status' value="0" /> <input type="checkbox" class="form-control col-md-7 col-xs-12" name='amc_status' <?php echo($form_data['amc_status'] ? 'checked' : ''); ?> value="1" id="amc_status"/>
					     </div>
					</div>

					<div class="clearfix"></div>
					<span class="section">Other Information</span>
					<div class="item form-group">
					     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amc description">Description
					     </label>
					     <div class="col-md-6 col-sm-6 col-xs-12">
						  <textarea id="amc_description" placeholder="" name="amc_description" class="form-control col-md-7 col-xs-12"><?= ( $method == "post") ? set_value('amc_description') : $form_data['amc_description']; ?></textarea>
					     </div>
					</div>

				   </div>




				   <div class="clearfix"></div>
				   <div class="ln_solid"></div>

				   <div class="row">
					<div class="form-group pull-right">


					     <a href="<?= base_url('amc') ?>" class="btn btn-default ">Cancel</a>
					     <button id="send" type="submit" class="btn btn-success">Submit</button>

					</div>
				   </div>
			      </form>
			 </div>



		    </div>
	       </div>
	  </div>
     </div>
     <?php echo $form_data['id'] . 'testtt' . getAmcImage($form_data['id']); ?>
</div></div>
<script>
     $(document).ready(function () {
	  var base_url = $("#base_url").val();
	  $("#image").fileinput({
	       overwriteInitial: true,
	       showClose: false,
	       showCaption: false,
	       browseLabel: '',
	       removeLabel: '',
	       browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
	       removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	       removeTitle: 'Cancel or reset changes',
	       elErrorContainer: '#kv-avatar-errors',
	       msgErrorClass: 'alert alert-block alert-danger',
	       defaultPreviewContent: '<img src="<?php echo base_url(getAmcImage($form_data['id']), 'small'); ?>" alt="Your Amc Logo" style="width:190px">',
	       layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
	       allowedFileExtensions: ["jpg", "png", "gif"]
	  });
	  $("body").find("#amc_status").bootstrapSwitch({
	       size: 'small',
	       animate: 'true',
	       onColor: 'success',
	       offColor: 'danger',
	  });
	  var value = $('#amc_type').val();
	       if (value == 'on_call') {

		    $('.on-call').hide();
	       } else {

		    $('.on-call').show();
	       }
	  $('body').on('change', '#amc_type', function () {

	       if ($(this).val() == 'on_call') {

		    $('.on-call').hide();
	       } else {

		    $('.on-call').show();
	       }
	  });
     });
</script>

<!-- footer content -->
