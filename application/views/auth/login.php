<div class="login_page clearfix" style="background:#F7F7F7;">
    <div class="col-md-6 col-sm-8 col-xs-12 head_logos clearfix">
        <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center left_logo" >
           
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 pull-left text-center">
            <img class="img-responsive" style="margin:auto" src="<?php echo base_url(); ?>assets/img/checknchange.png" title="" alt="" />
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


                    <form action="<?php echo base_url() . 'authController/index'; ?>" method="post" novalidate>
                        <h2>Sign into Check n Change</h2>
                        <div>
                            <input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12" Placeholder="Email">

                        </div>

                        <div>
                            <input type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12" Placeholder="Password">
                        </div>

                        <div class="pull-left col-sm-6 col-xs-6">
                            <label class="pull-left">
                                <input type="checkbox" class="tableflat" name="signin">   &nbsp;&nbsp;Stay Signed in
                            </label>
                        </div>
                        <div class="pull-right col-sm-6 col-xs-6 nopadding">
                             <a class="reset_pass" href="<?php echo base_url().'forget_password'?>">Forgotten your password?</a>
                        </div>



                        <div>
                            <button type="submit" class="btn btn-info btn-block submit pull-left"><b>Sign in</b></button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
<!--                      <span class="change_link">New to site?
                                <a href="<?php echo base_url().'signup'?>"> Create Account </a>
                            </span>-->


                </section>
                <!-- content -->
            </div>


        </div>
    </div>
    <div class="clearfix"></div>
<!--    <div class="col-md-6 col-sm-8 col-xs-12 head_logos ">
        <div class="col-md-4 nopadding  col-sm-4 col-xs-4 pull-left text-center left_logo" >
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/audit.jpg" title="" alt="" />
        </div>
        <div class="col-md-4 nopadding  col-sm-4 col-xs-12 pull-left center_logo text-center">
            <img class="img-responsive" style="margin:auto" src="<?php echo base_url(); ?>assets/images/class-mark.jpg" title="" alt="" />
        </div>
        <div class="col-md-4 nopadding  col-sm-4 col-xs-4 pull-left text-center right_logo">
            <img style="float: right;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/club-reg.jpg" title="" alt="" />
        </div>
    </div>-->
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
        bottom: 0;
        height: auto;
        margin:0px;
        /*padding: 20px;*/
        position: absolute;
        width: 100%;
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
    }
    @media all and (max-width:767px){
        .main_container {
            min-height: 500px
        }
        .head_logos {
            top: 20px;
        }
        .left_logo, .right_logo , .center_logo {
            display: none;
        }
        #wrapper {
            float: none;
            margin:50px auto 0;
            max-width: 290px;
        }
      
    }

</style>
