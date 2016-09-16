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
        <?php
        if ($this->session->flashdata('invalid') != '') {
            $new = "new";
        } else {
            $new = "";
        }
        ?>
        <div id="wrapper" class="<?php echo $new; ?>">
            <div id="login" class="animate form">
                <?php if ($this->session->flashdata('invalid') != '') { ?>
                    <div class="alert alert-warning">
                        <?php echo $this->session->flashdata('invalid'); ?> 
                    </div>

                    <?php
                }
                ?>
                <section class="login_content">


                    <form action="" method="post" novalidate>
                        <h2>Find Your Account</h2>
                        <div class="my_div">
                            <input type="email" id="email" name="user_email"  class="form-control col-md-7 col-xs-12" Placeholder="Email" value="<?php echo set_value('user_email'); ?>">
                            <div class="error pull-left"><?php echo form_error('user_email'); ?></div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info btn-block submit pull-left"><b>Send</b></button>
                        </div>
                        <div class="clearfix"></div>
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
     <div class="clearfix"></div>
     <div class="col-md-6 col-sm-8 col-xs-12 head_logos ">
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
        margin: 120px auto 0;
    }
    .main_container {
        float: left;
        width: 100%;
    }
   footer {
        z-index: 999;
    }
    .my_div input{
       margin: 0 !important;
   }
    .login_content button.submit{
        margin-top: 10px;
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

</style>
