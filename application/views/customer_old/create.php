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
                        <a  class="btn btn-success btn-sm pull-right" href="<?= base_url('customer') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form data-parsley-validate  class="form-horizontal form-label-left"   method="post"enctype="multipart/form-data">
                            <div class=" row">
                                <div class="col-md-8">


                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input required="required"  id="name" class="form-control col-md-7 col-xs-12  <?= (strlen(form_error('user_name')) > 0) ? 'parsley-error' : '' ?>" name="user_name" placeholder="Name" data-parsley-error-message="The Name field is required."  type="text" value="<?php echo set_value('user_name'); ?>">
                                            <?php echo form_error('user_name'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input required="required" type="email" id="email" name="user_email" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_email')) > 0) ? 'parsley-error' : '' ?>" placeholder="Email" value="<?php echo set_value('user_email'); ?>" data-parsley-error-message="The Email field is required.">
                                            <?php echo form_error('user_email'); ?>
                                        </div>

                                    </div>
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone Number <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" data-parsley-type="integer"   placeholder="Phone Number"  id="phone_number" data-parsley-error-message="This Phone Numebr should be a valid integer." name="user_phone"  class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_phone')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('user_phone'); ?>">   
                                            <?php echo form_error('user_phone'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_extra">Notes  
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="user_note" placeholder="Enter Notes" name="user_note" class="form-control col-md-7 col-xs-12"><?php echo set_value('user_note'); ?></textarea>
                                    </div>
                                </div>
                                    <?php if (access_check("organisation", "view")){ ?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Orginasation <span class="required">*</span>
                                        </label>



                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                                <select name="orginasation_type" tabindex="-1" class="select_organisation form-control col-md-7 col-xs-12 <?= (strlen(form_error('orginasation_type')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('orginasation_type'); ?>">                                             <?php foreach ($organisation as $org) { ?>
                                                        <option value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                                    <?php } ?>
                                                </select> 
                                             <?php echo form_error('orginasation_type'); ?>
                                        </div>
                                   </div>
                                    <?php } else{?>
                                  <input type="hidden" name="orginasation_type" id="orginasation_search" value="<?php $org = getUserOrginasationDetails(getLoginUser());
                                            echo $org['organisation_id']; ?>">
                                    <?php } ?>
                                           

                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <div class="kv-avatar center-block" style="width:200px">
                                            <input id="image" name="image" type="file" class="file-loading">
                                        </div><?php echo form_error('image'); ?>

                                    </div>
                                </div> 
                            </div> 
                            <div class="ln_solid"></div>
                            <div class="row">
                                <div class="form-group">


                                    <a href="<?php echo base_url('customer'); ?>" class="btn btn-primary pull-right">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success pull-right">Submit</button>

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


</style>

<script>
    var base_url = $("#base_url").val();
    $(document).ready(function() {


        $(".select_organisation").chosen({width: "100%",
        });

        // Initialize autocomplete with custom appendTo:

    });
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
        defaultPreviewContent: '<img src="' + base_url + 'assets/images/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
    });


</script>
<!-- footer content -->
