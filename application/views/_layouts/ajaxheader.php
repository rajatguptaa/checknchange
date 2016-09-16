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