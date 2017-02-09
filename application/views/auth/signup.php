<div class="login_page clearfix" style="background:#F7F7F7;">
    <div class="col-md-6 col-sm-8 col-xs-12 head_logos clearfix">
        <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center left_logo" >
           
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 pull-left text-center">
            <img class="img-responsive" style="margin:auto" src="<?php echo base_url(); ?>assets/img/inVentryLogosmall.jpg" title="" alt="" />
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center right_logo">
           
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-xs-12 col-sm-12 pull-left clearfix login_details"> 
       
                <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animate form">
                <?php if ($this->session->flashdata('invalid') != '') { ?>
                    <div class="alert alert-warning">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('invalid'); ?> 
                    </div>
                 
                    <?php
                }
                ?>
                <?php if ($this->session->flashdata('login_success') != '') { ?>
                    <div class="alert alert-success">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('login_success'); ?> 
                    </div>

                    <?php
                }
                ?>
                <section class="login_content">


                    <form data-parsley-validate  class="form-horizontal form-label-left" method="post"enctype="multipart/form-data">
                        <h2>Create your InVentry Support Account </h2>
                      
                            <div class=" row">
                                <div class="col-md-12">


                                    <div class="item form-group">
                                      
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <input required="required"  id="name" class="form-control col-md-7 col-xs-12  <?= (strlen(form_error('user_name')) > 0) ? 'parsley-error' : '' ?>" name="user_name" placeholder="Name" data-parsley-error-message="The Name field is required."  type="text" value="<?php echo set_value('user_name'); ?>">
                                            <?php echo form_error('user_name'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                      
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <input required="required" type="email" id="email" name="user_email" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_email')) > 0) ? 'parsley-error' : '' ?>" placeholder="Email" value="<?php echo set_value('user_email'); ?>" data-parsley-error-message="The Email field is required.">
                                            <?php echo form_error('user_email'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                        
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <input required="required" type="password" id="user_password" name="user_password" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_password')) > 0) ? 'parsley-error' : '' ?>" placeholder="Password" data-parsley-error-message="The Password field is required." >
                                            <?php echo form_error('user_password'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                      
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <input  type="password" id="passwordl2" name="passconf" data-parsley-equalto="#user_password" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('confirm_user_password')) > 0) ? 'parsley-error' : '' ?>" placeholder="Confirm Password" >
                                            <?php echo form_error('confirm_user_password'); ?>   
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                      
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <input type="text" data-parsley-type="integer"   placeholder="Phone Number"  id="phone_number" data-parsley-error-message="This Phone Numebr should be a valid integer." name="user_phone"  class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('user_phone')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('user_phone'); ?>">   
                                            <?php echo form_error('user_phone'); ?>
                                        </div>

                                    </div>
                                    <div class="item form-group">
                                      
                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                            <select name="orginasation_type" tabindex="-1" class="select_organisation form-control col-md-7 col-xs-12 <?= (strlen(form_error('orginasation_type')) > 0) ? 'parsley-error' : '' ?>" value="<?php echo set_value('orginasation_type'); ?>">                                             <?php foreach ($organisation as $org) { ?>
                                                    <option value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                                <?php } ?>
                                            </select>   
                                            <?php echo form_error('orginasation_type'); ?>
                                        </div>


                                    </div>
                                    
                                </div>
                             
                            </div> 
                            <div class="">
                              <div class='col-md-12 item form-group' >
                             <input id="input-1a"  data-show-upload="false" data-show-remove="false" type="file" name="image" class="file  form-control col-md-7 col-xs-12 " data-show-preview="false" >
                                </div> 
                            </div>
                            <div class="row">
                                  <div class='col-md-8 col-md-offset-2'>
                                <div class="form-group form_btns">

<div class='col-md-6'>
                                    <a href="<?php echo base_url('employee'); ?>" class="btn btn-sm btn-default">Cancel</a>
</div>
                                    <div class='col-md-6'>
                                    <button id="send" type="submit" class="btn btn-block btn-sm btn-success">Submit</button>
                                    </div>
                                </div>
                                  </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                            <p class="change_link">
                              
                               Already a member ?  <a href="<?php echo base_url('login');?>">   Log in  </a>
                            </p>

                </section>
                <!-- content -->
            </div>
            


        </div>
         
    </div>
   <div class="col-md-4 col-sm-8 col-xs-12 footer_logos ">
        <div class="col-md-4 nopadding  col-sm-4 col-xs-4 pull-left text-center left_logo" >
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/audit.jpg" title="" alt="" />
        </div>
        <div class="col-md-4 nopadding  col-sm-4 col-xs-12 pull-left center_logo text-center">
            <img class="img-responsive" style="margin:auto" src="<?php echo base_url(); ?>assets/images/class-mark.jpg" title="" alt="" />
        </div>
        <div class="col-md-4 nopadding  col-sm-4 col-xs-4 pull-left text-center right_logo">
            <img style="float: right;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/club-reg.jpg" title="" alt="" />
        </div>
    </div>
</div>
<style>

    body, .login_page, #wrapper, .head_logos, .login_details  {
        height: auto !important;
    }
    body{
        background:#F7F7F7;
        position: inherit !important;
    }

    #wrapper {
        margin: 120px auto 0px;
        max-width: 400px;
        min-height: 100%;
    }
    .main_container {
        float: left;
        width: 100%;
    }
    footer {
        z-index: 999;
    }
    .login_content button.submit{
        margin-top: 20px;
        margin-bottom:20px;
    }
    .head_logos {
        display: flex;
        float: left;
        float: none;
        position: relative;
        top: 70px;
        margin: 0 auto;
    }
    .login_content {
        border: 1px solid #ccc;
        -mox-border: 1px solid #ccc;
        -webkit-border: 1px solid #ccc;
        padding: 20px;
        min-width: 400px;
        min-height: 100%;
    }
    ul.parsley-errors-list {
        text-align: left;
    }
    .footer_logos {
        display: flex;
        float: none;
        margin: 0 auto;
        padding-top: 20px;
    }
    @media all and (max-width:767px){
        .main_container {
            min-height: 500px
        }
        .head_logos {
            top: 20px;
        }
        .left_logo, .right_logo,.center_logo {
            display: none;
        }
        #wrapper {
            float: none;
            margin:50px auto 0;
            max-width: 290px;
        }
       
    }
 
    .change_link {
        margin-bottom: 0;
    }
    .form-control {
        margin-bottom: 0 !important
    }
    .login_content form div a {
        margin: 0;
    }
    .form_btns{
        margin-bottom: 0;
    }

</style>

<script>
        $(document).ready(function () {


        $(".select_organisation").chosen({width: "100%",
        });
      
        // Initialize autocomplete with custom appendTo:

    });
 
</script>
