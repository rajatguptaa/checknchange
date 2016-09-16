<?php
$user = $this->session->userdata('logged_in');
$menu = menu_list($user['user_access_level'], 'menu');

?>
<input type="hidden" id="local_access_level" value="<?= $user['user_access_level'] ?>">
<input type="hidden" id="local_user_id" value="<?= $user['user_id'] ?>">

<div class="navbar second">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar btn-toggle" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a><div class="clearfix"></div>
            <div class="nav-collapse collapse">
                <ul class="nav main-nav" id="sidebar-menu">
                    <?php
                    if (count($menu) > 0) :
                        foreach ($menu as $menuli):
                    $sb_menu = submenu_list('submenu', $menuli['module_id']);
                        ?>
                    
                    <li><a <?php if (!empty($sb_menu)) { echo 'data-toggle="dropdown" class="dropdown-toggle"'; }?> href="<?php
                                if ($menuli['module_link'] != '#') {
                                    echo base_url($menuli['module_link']);
                                } else {
                                    echo'#';
                                };
                                ?>"><i class="<?= $menuli['module_icon'] ?>">&nbsp;</i><?= ucfirst($menuli['module_name']) ?></a><?php 
                        if (!empty($sb_menu)) { ?>
                                    <ul class="nav child_menu dropdown-menu mega-dropdown-menu animated fadeInDown  pull-right">
                                        <?php foreach ($sb_menu as $submenu) { ?>
                                            <li><a class="sub_select" data-module="<?php echo ($submenu['module_name']); ?>" href="<?php echo base_url($submenu['module_link']); ?>"><i class="<?= $submenu['module_icon'] ?>">&nbsp;</i><?= ucfirst($submenu['module_name']) ?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>



                                <?php }; ?></li>
                                <?php
                        endforeach;
                    endif;
                    ?>
                </ul>    

            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div>
<script>
    $(document).ready(function() {
       
       $('#sidebar-menu a[href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>"]').parent().addClass('current-page');
     
    $('#sidebar-menu a[href="<?php echo base_url(); ?><?php echo $this->uri->segment(1); ?>"]').parent().parent('ul').parent('li').addClass('current-page');
    });
</script>