<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Home Service Provider Company</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/icheck/flat/green.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/fileinput.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/pageanimation/animsition.min.css" rel="stylesheet">
        <!--Add CSS From Controller-->  
        <?php
        if (isset($style_to_load)) :
            foreach ($style_to_load as $css):
                ?>
                <link href="<?php echo base_url($css); ?>" rel="stylesheet"/>
                <?php
            endforeach;
        endif;
        ?>    

    </head>
    <body class="nav-md animsition">

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validator/validator.js"></script>     
        <script src="<?php echo base_url(); ?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/parsley/parsley.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/icheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/file_input/fileinput.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/responsive-tabs.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/responsive-tabs.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>


        <!--Page animation-->
        <script src="<?php echo base_url(); ?>assets/js/pageanimation/animsition.min.js"></script>

        <!--Add JS From Controller-->
        <?php
        if (isset($scripts_to_load)) :
            foreach ($scripts_to_load as $script):
                ?>

                <script type='text/javascript' src = '<?= base_url($script) ?>'></script>

                <?php
            endforeach;
        endif;
        ?>
        <script src="<?php echo base_url(); ?>assets/js/common/common.js"></script>
        <div class="main_container ">
            <input type='hidden' id='base_url' value='<?php echo base_url(); ?>'>


