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
                        <a class="btn btn-success btn-sm pull-right" href="<?= base_url('employee') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                            <span class="section">Information</span>
                            <div class='col-md-4 pull-right'>
                                <div class="form-group">
                                    <span class="section">Profile</span>
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="image" name="image" type="file" class="file-loading">
                                    </div><?php echo form_error('image'); ?>

                                </div>
                                 <div class="form-group">
                                     <span class="section">Document</span>                                    
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="image1" name="document" type="file" class="file-loading">
                                    </div><?php echo form_error('document'); ?>

                                </div>
                            </div> 
                            <div class="col-md-8">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_name">Employee Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input data-parsley-error-message="The Name field is required." id="employee_name" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_name')) > 0) ? "parsley-error" : "" ?>" value="<?php echo set_value('user_name'); ?>" name="user_name" placeholder="Employee name" required="required" type="text">
                                        <?php echo form_error('user_name'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_code">Employee Code <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
					 <input data-parsley-error-message="The Code field is required." id="employee_code" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_code')) > 0) ? "parsley-error" : "" ?>" value="<?php echo 'EMP' . random_string('numeric'); ?>" readonly="" name="user_code" placeholder="Employee code" required="required" type="text">
                                        <?php echo form_error('user_code'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" data-parsley-error-message="The Password field is required." placeholder="Password" class="form-control col-md-7 col-xs-12" name="user_password" id="user_password" required="required" data-parsley-id="8">
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" placeholder="Confirm Password" class="form-control col-md-7 col-xs-12 " data-parsley-equalto="#user_password" name="passconf" id="passwordl2" data-parsley-id="10">

                                    </div>

                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address">Address 1 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('address1'); ?>" data-parsley-error-message="The Address field is required"  id="organisation_address1" required="required" placeholder="First line of address" name="address1" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('address1')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('organisation_address'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address2">Address 2 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('address2'); ?>" id="organisation_address2" placeholder="Second line of address" name="address2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('user_city'); ?>" data-parsley-error-message="Please add city."  id="city" required="required" placeholder="The city you live in" name="user_city" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_city')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_city'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">State <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('user_country'); ?>" data-parsley-error-message="State is required"  id="country" required="required" placeholder="The State you live in" name="user_country" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_country')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_country'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Postcode <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('user_postcode'); ?>" data-parsley-error-message="Please add Postcode."  id="user_postcode" required="required" placeholder="Your postcode" name="user_postcode" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_postcode')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_postcode'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_phone">Contact Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="user_phone" name="user_phone" type="text" data-parsley-type="integer" data-parsley-required-message="The Phone field is required." data-parsley-integer-message="The Phone field should be integer." value="<?php echo set_value('user_phone'); ?>" required="required" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_phone')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_phone'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_phone">Contact Number-2 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="user_phone" name="user_mobile" type="text" data-parsley-type="integer" data-parsley-required-message="The Phone-2 field is required." data-parsley-integer-message="The Phone-2 field should be integer." value="<?php echo set_value('user_phone'); ?>" required="required" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_mobile')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_mobile'); ?>
                                    </div>
                                </div>
				 
                                <div class="item form-group">
                                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" data-parsley-error-message="The Email field is required." value="<?php echo set_value('user_email'); ?>" required="required" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_email')) > 0) ? "parsley-error" : "" ?>" placeholder="Email" class="form-control col-md-7 col-xs-12" name="user_email" id="email" required="required" data-parsley-id="6">
                                        <?php echo form_error('user_email'); ?>                                            
                                    </div>

                                </div>

                                <div class="clearfix"></div>
                                <span class="section">Other Information</span>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_notes">Notes
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="organisation_notes" placeholder="" name="user_note" class="form-control col-md-7 col-xs-12"><?php echo set_value('user_note'); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            <div class="row">
                                <div class="form-group pull-right">


                                    <a href="<?= base_url('employee') ?>" class="btn btn-default ">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>

                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal form-label-left"   action="<?php echo base_url('employee/upload_attachment'); ?>" method="post" enctype="multipart/form-data">

                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div></div>
<script>
    $("body").ready(function () {
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
            defaultPreviewContent: '<img src="' + base_url + 'assets/img/default_avatar_male.jpg" alt="Your Organisation Logo" style="width:190px">',
            layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","docx","doc","pdf"]
        });
         $("#image1").fileinput({
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
            defaultPreviewContent: '<img src="' + base_url + 'assets/img/people-300x300.png" alt="Your Organisation Logo" style="width:190px">',
            layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
        });

        var url = '<?php echo base_url(); ?>employeeController/upload_attachement';

        $('#image1').ajaxfileupload({
//            secureuri: true,
            action: url,
            dataType: 'json',
            valid_extensions: ['pdf', 'csv', 'doc', 'docx', 'jpg'],
            onComplete: function (response) {
                $('#file_path').val(response.filepath);
                $('#file_show').val(response.filepath);
            },
            onCancel: function () {
                console.log('no file selected');
            }
        });






//                        });
    });
</script>

<!-- footer content -->
