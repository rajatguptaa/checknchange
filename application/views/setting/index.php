<?php
$user = $this->session->userdata('logged_in');
$menu = menu_list($user['user_access_level'], 'profile');
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="page-title">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('change_success')) : ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('change_success'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class = "x_panel">
            <div class = "x_title">
                <h2><i class = "fa fa-wrench"></i> <?php echo $mainHeading; ?> </h2>
                <div class = "clearfix"></div>
            </div>
            <div class = "x_content">

                <ul class = "nav nav-tabs responsive col-md-3">
                    <li class="<?= ($activeTab == "profile") ? "active" : "" ?>"><a href = "#profile" data-toggle = "tab"><i class = "fa fa-user pull-right"></i> Profile</a>
                    </li>
                    <li class="<?= ($activeTab == "change_password") ? "active" : "" ?>"><a href = "#change_password" data-toggle = "tab"><i class = "fa fa-lock pull-right"></i> Change Password</a>
                    </li>
                    <?php
                    if (count($menu) > 0) :
                        foreach ($menu as $menuli):
                            ?> 
                            <li>
                                <a class="load_extra" data-toggle = "tab" load-href="<?php echo base_url($menuli['module_link']); ?>" data-id="#<?= str_replace(" ", "_", $menuli['module_name']); ?>" href="#<?= str_replace(" ", "_", $menuli['module_name']); ?>">
                                    <i class="<?= $menuli['module_icon'] ?> pull-right"></i> <?= ucfirst($menuli['module_name']) ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>

                <div class = "tab-content responsive col-md-9">

                    <div class="tab-pane <?= ($activeTab == "profile") ? "active" : "" ?>" id="profile">
                         <div class="x_panel">
                        <span class='section'>Profile Details</span>
                        <form  name="userdetail" method="post" novalidate enctype="multipart/form-data">
                            <div class="col-md-8">
                                <div class="form-group col-md-3 pull-right">
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="image" name="image" type="file" class="file-loading">
                                        <input type='hidden' name='userdetail[user_id]' value='<?php echo $user_detail['user_id']; ?>'>
                                        <input id="old_image"  value="<?php echo $user_detail['user_profile']; ?>" type="hidden" name='userdetail[old_image]'>
                                    </div><?php echo form_error('userdetail[old_image]'); ?>

                                </div>
                                <div class="col-md-8">

                                    <div class="item form-group row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <label>Name :</label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input required="required"  id="name" class="form-control col-md-7 col-xs-12  <?= (strlen(form_error('userdetail[user_name]')) > 0) ? 'parsley-error' : '' ?>" name="userdetail[user_name]" placeholder="Name" data-parsley-error-message="The Name field is required."  type="text"  value="<?= ( $method == "post") ? set_value('userdetail[user_name]') : $user_detail['user_name']; ?>">
                                            <?php echo form_error('userdetail[user_name]'); ?>
                                        </div>
                                    </div>

                                    <div class="item form-group row">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="email">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input required="required" type="email" id="email" name="userdetail[user_email]" class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('userdetail[user_email]')) > 0) ? 'parsley-error' : '' ?>" placeholder="Email" data-parsley-error-message="The Email field is required." value="<?= ( $method == "post") ? set_value('userdetail[user_email]') : $user_detail['user_email']; ?>" >
                                            <?php echo form_error('userdetail[user_email]'); ?>
                                        </div>
                                    </div>

                                    <div class="item form-group row">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="phone">Phone Number <span class="required"></span>
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" data-parsley-type="integer"   placeholder="Phone Number"  id="phone_number" data-parsley-error-message="This Phone Numebr should be a valid integer." name="userdetail[user_phone]"  class="form-control col-md-7 col-xs-12 <?= (strlen(form_error('userdetail[user_phone]')) > 0) ? 'parsley-error' : '' ?>" value="<?= ( $method == "post") ? set_value('userdetail[user_phone]') : $user_detail['user_phone']; ?>">   
                                            <?php echo form_error('userdetail[user_phone]'); ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <input type='hidden' name='user_id' value='<?php echo $user_detail['user_id']; ?>'>
                                        <button id="send" type="submit" class="btn btn-success btn-sm submit">Update Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="tab-pane <?= ($activeTab == "change_password") ? "active" : "" ?>" id="change_password">
                        <div class="x_panel">
                            <section class="col-md-5">


                                <form  name="changepassword" method="post" novalidate>
                                    <span class='section'>Reset Your Password</span>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <label>Old Password</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 center">
                                            <input required="required" type="password" name="changepassword[old_user_password]" class="form-control" placeholder="Enter Old Password" >
                                            <div class="error pull-left">   <?php echo form_error('changepassword[old_user_password]'); ?></div>
                                        </div></div>


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                            <label>New Password</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 center">
                                            <input required="required" type="password" id="passwordl2" name="changepassword[user_password]" class="form-control" placeholder="Enter New Password">
                                            <div class="error pull-left"><?php echo form_error("changepassword[user_password]"); ?>   </div>
                                        </div></div>



                                    <div class="row">&nbsp;</div>
                                    <div class="row">
                                        <div class='col-md-12'>
                                            <button type="submit" class="btn btn-success btn-sm submit pull-left">Change Password</button>
                                        </div></div>
                                    <div class="clearfix"></div>
                                </form>



                            </section>
                        </div>



                    </div>
                    <?php
                    if (count($menu) > 0) :
                        foreach ($menu as $menuli):
                            ?> 
                            <div class="tab-pane" id="<?= str_replace(" ", "_", $menuli['module_name']); ?>"></div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <!--</div>-->

                <div class="clearfix"></div>

            </div>
        </div>
    </div>
</div>
<script>


    $(document).ready(function () {
        fakewaffle.responsiveTabs(['xs', 'sm']);

        $("body").on("click", ".load_extra", function () {

            var id = $(this).attr("href");

            var newid = id.replace("collapse-", '');

            var href = $(this).attr("load-href");

            if ($("body").find(newid).is(':empty')) {
                $("body").find(newid).load(href, {}, function () {
                    $("body").find(".animsition-loading").addClass("hide");
                });
            }
        });



        var base_url = $("#base_url").val();
        var old_image = $("#old_image").val();
        if (old_image == "") {
            old_image = "assets/images/default_avatar_male.jpg"
        }
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
            defaultPreviewContent: '<img src="' + base_url + old_image + '" alt="Your Avatar" style="width:160px">',
            layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
        });

    });

</script>
<style>
    .nav .active a{
        color: rgb(26, 187, 156) !important;
    }
    .login_content {
        /*        box-shadow: 0px 0px 8px 0 #ccc;
                -moz-box-shadow: 0px 0px 8px 0 #ccc;
                -webkit-box-shadow: 0px 0px 8px 0 #ccc;*/
        padding: 20px;
        max-width: 300px;
    }
    .login_content input {
        margin-bottom: 14px !important;
    }
    @media all and (max-width: 480px) {
        .login_content {
            max-width: 290px !important;
            min-width: 210px;
            padding: 10px;
        }
        .login_content span.section {
            font-size: 19px;
        }
    }

</style>