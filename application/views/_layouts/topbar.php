<?php 
$user = $this->session->userdata('logged_in');
$menu = menu_list($user['user_access_level'], 'profile');
?>
<div class="top_nav">

                <div class="nav_menu">
                    <nav class="container" role="navigation">
                         <div class="nav toggle">
                            <a id=""> <img width="100px" src="<?php echo base_url(); ?>assets/img/checknchange.png" title="" alt="" /></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php if(!empty($user)) {echo base_url().getUserImage($user['user_id'],'small');}?>" alt=""><?php if(!empty($user)) {echo getUserName($user['user_id']);}?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <?php 
                                    
                                    if($user['user_access_level'] != 1){
                                    ?>
                                     <li ><a href="<?php echo base_url("employee/show/".$user["user_id"]); ?>"><i class="fa fa-user pull-right">&nbsp;</i>Profile</a></li>
                                    <?php } ?>
                                     <li ><a href="<?php echo base_url("setting"); ?>"><i class="fa fa-wrench pull-right">&nbsp;</i>Settings</a></li>
                                    
                                    <li><a href="<?php echo base_url() . 'authController/logout'; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

<div class="clearfix"></div>