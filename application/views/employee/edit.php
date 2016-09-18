<div class="right_col" role="main">
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
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="image" name="image" type="file" class="file-loading">
                                    </div><?php echo form_error('image'); ?>

                                </div>
                                <div class="form-group">
                                    <span class="section">Document</span>

                                    <div class="kv-avatar center-block" style="width:200px">
                                        <span class="msg"></span>

                                        <input id="image1" name="image1" type="file" class="file-loadings form-control" value="<?php echo $form_data['document']; ?>">
                                        <div class="clearfix"></div>

                                        <input type="hidden" name="document" id="file_path" value=""/>
                                        

                                       
                                        <img src="<?php echo base_url() ?>assets/images/ajax-small_loader.gif" class="small_loader pull-right" style="display: none;">
                                        <?php echo form_error('document'); ?>
                                        <br>
                                        <label class="control-label " for="employee_name">Document<span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control" disabled="disbled" id="file_show" value="<?php echo $form_data['document']; ?>"/>

                                    </div>

                                </div>
                            </div> 
                            <div class="col-md-8">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_name">Employee Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input data-parsley-error-message="The Name field is required." id="employee_name" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_name')) > 0) ? "parsley-error" : "" ?>" value="<?= ( $method == "post") ? set_value('user_name') : $form_data['user_name']; ?>" name="user_name" placeholder="Employee name" required="required" type="text">
                                        <?php echo form_error('user_name'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_code">Employee Code <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input data-parsley-error-message="The Code field is required." id="employee_code" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_code')) > 0) ? "parsley-error" : "" ?>" value="<?= ( $method == "post") ? set_value('user_code') : $form_data['user_code']; ?>" name="user_code" placeholder="Employee code" required="required" type="text">
                                        <?php echo form_error('user_code'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password"  placeholder="Password" class="form-control col-md-7 col-xs-12" name="user_password" id="user_password"  >
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
                                        <input type="text" value="<?= ( $method == "post") ? set_value('address1') : $form_data['address1']; ?>" data-parsley-error-message="The Address field is required"  id="organisation_address1" required="required" placeholder="First line of address" name="address1" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('address1')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('address1'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address2">Address 2 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?= ( $method == "post") ? set_value('address2') : $form_data['address2']; ?>" id="organisation_address2" placeholder="Second line of address" name="address2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?= ( $method == "post") ? set_value('user_city') : $form_data['user_city']; ?>" data-parsley-error-message="Please add city."  id="city" required="required" placeholder="The city you live in" name="user_city" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_city')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_city'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?= ( $method == "post") ? set_value('user_country') : $form_data['user_country']; ?>" data-parsley-error-message="Country"  id="country" required="required" placeholder="The country you live in" name="user_country" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_country')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_country'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Postcode <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?= ( $method == "post") ? set_value('user_postcode') : $form_data['user_postcode']; ?>" data-parsley-error-message="Please add Postcode."  id="user_postcode" required="required" placeholder="Your postcode" name="user_postcode" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_postcode')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_postcode'); ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_phone">Contact Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input id="user_phone" name="user_phone" type="text" data-parsley-type="integer" data-parsley-required-message="The Phone field is required." data-parsley-integer-message="The Phone field should be integer." value="<?= ( $method == "post") ? set_value('user_phone') : $form_data['user_phone']; ?>" required="required" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_phone')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('user_phone'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" data-parsley-error-message="The Email field is required." value="<?= ( $method == "post") ? set_value('user_email') : $form_data['user_email']; ?>" required="required" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_email')) > 0) ? "parsley-error" : "" ?>" placeholder="Email" class="form-control col-md-7 col-xs-12" name="user_email" id="email" required="required" data-parsley-id="6">
                                        <input type="hidden" name="old_email" value="<?php echo $form_data['user_email']; ?>"/>
                                        <?php echo form_error('user_email'); ?>                                            
                                    </div>

                                </div>
                                <input type="hidden" name="old_image" id="old_image" value="<?php echo $form_data['user_email']; ?>"/>
                                <div class="clearfix"></div>
                                <span class="section">Other Information</span>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_notes">Notes
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="organisation_notes" placeholder="" name="user_note" class="form-control col-md-7 col-xs-12"><?= ( $method == "post") ? set_value('user_note') : $form_data['user_note']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            <div class="row">
                                <div class="form-group pull-right">


                                    <a href="<?= base_url('employee') ?>" class="btn btn-default ">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>

                                </div>
                            </div>
                        </form>


                    </div></div>

            </div>
        </div>
    </div></div>
<style>
    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }
    .file-default-preview{
        border: 3px solid #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        display: block;

        overflow: hidden;

    }



</style>

<script>

    $(document).ready(function () {

        var url = '<?php echo base_url(); ?>employeeController/upload_attachement';

        $('#image1').ajaxfileupload({
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




    });
    var base_url = $("#base_url").val();
    var old_image = $("#old_image").val();
    if (old_image == "") {
        old_image = "assets/images/default_avatar_male.jpg"
    }

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
        defaultPreviewContent: '<img src="<?php echo base_url(getUsersImage($form_data['user_id']), 'small'); ?>" alt="Your Amc Logo" style="width:190px">',
        layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });


</script>
<!-- footer content -->
