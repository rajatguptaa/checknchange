<div role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?= strtoupper($mainHeading) ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Annual Maintenance Contract</h2>
                        <a class="btn btn-success btn-sm pull-right" href="<?= base_url('amc') ?>"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal form-label-left"  data-parsley-validate action="" method="post" enctype="multipart/form-data">
                            <span class="section">Information</span>
                            <div class="col-md-4 pull-right">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_logo">AMC PIC: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 <?= (strlen(form_error('image')) > 0) ? "parsley-error" : "" ?>">
                                      
                                        <div class="kv-avatar center-block" style="width:200px">
                                            <input  id="image" name="image" type="file" class="file-loading">
                                        </div><?php echo form_error('image'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_name">AMC Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input data-parsley-error-message="The AMC field is required." id="organisation_name" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_name')) > 0) ? "parsley-error" : "" ?>" value="<?php echo set_value('amc_name'); ?>" name="amc_name" placeholder="AMC name" required="required" type="text">
                                        <?php echo form_error('amc_name'); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_title">AMC Code<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input data-parsley-error-message="The AMC code field is required." id="amc_code" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_code')) > 0) ? "parsley-error" : "" ?>" value="<?php echo set_value('amc_code'); ?>" name="amc_code" placeholder="AMC Code" required="required" type="text">
                                        <?php echo form_error('amc_code'); ?>
                                    </div>
                                </div>
                                                                  <div class="item form-group">                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address">AMC Type </label>                                    <div class="col-md-6 col-sm-6 col-xs-12 ">                                    <select class="form-control col-md-7 col-xs-12" name="amc_type" id="amc_type">									  <option value="primary">PRIMARY SERVICE</option>									  <option value="secondary">SECONDARY SERVICE</option>									  <option value="home_appliance">HOME APPLIANCE</option>									  </select>                                                                   </div>                                 </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address">AMC Duration <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" value="<?php echo set_value('amc_duration'); ?>" data-parsley-error-message="AMC Duration field is required"  id="duaration" required="required" placeholder="AMC Duration" name="amc_duration" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_duration')) > 0) ? "parsley-error" : "" ?>">
                                        <?php echo form_error('amc_duration'); ?>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organisation_address2">AMC Visits 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                         <input type="text" value="<?php echo set_value('amc_visit'); ?>" data-parsley-error-message="AMC Visit field is required"  id="visits" required="required" placeholder="No of Visits" name="amc_visit" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_visit')) > 0) ? "parsley-error" : "" ?>">
                                  </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">Criteria <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="criteria" placeholder="Criteria " data-parsley-error-message="The criteria field is required."  name="amc_criteria" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('amc_criteria')) > 0) ? "parsley-error" : "" ?>"><?php echo set_value('amc_criteria'); ?></textarea>
                                        <?php echo form_error('amc_criteria'); ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <span class="section">Other Information</span>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amc description">Description
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="amc_description" placeholder="" name="amc_description" class="form-control col-md-7 col-xs-12"><?php echo set_value('amc_description'); ?></textarea>
                                    </div>
                                </div>
                                
                            </div>
                           
                                
                          
                                
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                          
                              <div class="row">
                                <div class="form-group pull-right">


                                   <a href="<?= base_url('organisation') ?>" class="btn btn-default ">Cancel</a>
                                  <button id="send" type="submit" class="btn btn-success">Create</button>

                                </div>
                            </div>
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
            defaultPreviewContent: '<img src="'+base_url+'assets/img/default_avatar_male.jpg" alt="Your Organisation Logo" style="width:190px">',
            layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

    });
</script>

<!-- footer content -->
