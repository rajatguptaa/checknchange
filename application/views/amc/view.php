<?php
$current_user = $this->uri->segment(3);
?>
<div class="right_col" role="main">
    <div class="container">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?= $mainHeading ?></h3>
                </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?= $mainHeading ?> <small><?= $subHeading ?></small></h2>
                            <button class="btn btn-success btn-sm pull-right" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Back</button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_left">

                                <div class="profile_img">

                                    <!-- end of image cropping -->
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <div class="avatar-view amc_view" title="Change the avatar">
                                            <img src="<?php echo base_url() . getAmcImage($amc_detail['id']); ?>" alt="Amc">
                                        </div>
                                    </div>
                                    <!-- end of image cropping -->

                                </div>
                                <h3><?php echo $amc_detail['amc_name'] ?></h3>
                                <h4>Detail</h4>
                                <div class="ln_solid"></div>
                                <ul class="list-unstyled user_data">

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"> AMC CODE:</i> 
                                        <?php
                                        echo $amc_detail['amc_code'];
                                        ?>
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"> AMC DURATION:</i>
                                        <?php echo $amc_detail['amc_duration']; ?>
                                    </li>
                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"> AMC VISIT:</i>
                                        <?php echo $amc_detail['amc_visit']; ?>
                                    </li>
                                </ul>
                                <h4>Amc Type</h4>
                                <div class="ln_solid"></div>
                                <label class="btn btn-success" style="text-transform: uppercase;"><?php echo $amc_detail['amc_type']?></label>
                                <!-- end of skills -->

                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">


                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Amc Criteria </h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <?php echo $amc_detail['amc_criteria'] ?>
                                            <!-- blockquote -->
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Amc Description </h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <?php echo $amc_detail['amc_description'] ?>
                                            <!-- blockquote -->
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer content -->

        <!-- /footer content -->

    </div></div>
<style>
    .x_content .profile_left h4 {
        margin-top: 20px;
    }
    .x_content .profile_left .ln_solid {
        margin: 0 0 10px;
    }
    .amc_view{
        width:300px;
        height: 300px;
    }
</style>
<script>
    $(function () {



    });

</script>
