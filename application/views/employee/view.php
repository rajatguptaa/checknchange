<?php 
    $current_user =$this->uri->segment(3);
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
                            <h2><?= $mainHeading ?>
				 <!--<small><?= $subHeading ?></small></h2>-->
                            <button class="btn btn-success btn-sm pull-right" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Back</button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                                <div class="profile_img">

                                    <!-- end of image cropping -->
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <div class="avatar-view" title="Change the avatar">
                                            <img src="<?php echo base_url() . getUserImage($user_detail['user_id'], 'small'); ?>" alt="Avatar">
                                        </div>
                                    </div>
                                    <!-- end of image cropping -->

                                </div>
                                <h3><?php echo getUserName($user_detail['user_id']); ?></h3>

                                <ul class="list-unstyled user_data">
                                    <?php if ($user_detail['user_phone'] != ''): ?>
                                        <li><i class="fa fa-phone user-profile-icon"></i> Phone: <?php echo $user_detail['user_phone']; ?></li>
                                    <?php endif; ?>
                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"> Access Level:</i> 
                                        <?php
                                        $accese_detail = getUserAccessDetails($user_detail['user_id']);
                                        echo $accese_detail['access_level_name'];
                                        ?>
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"> Email:</i>
<?php echo $user_detail['user_email']; ?>
                                    </li>
                                </ul>
                                <?php if (access_check("employee", "edit") && $current_user != getLoginUser()): ?>
                                    <a href="<?php echo base_url() . 'employee/edit/' . $user_detail['user_id'] ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
<?php endif;

if($current_user == getLoginUser()){
    ?>
  <a href="<?php echo base_url() . 'setting' ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
        <?php
}

?> 
<!--                                <h4>Organisation</h4>
                                <div class="ln_solid"></div>
                                <ul class="list-unstyled user_data">

                                    <li>
                                        <a href="<?php ?>"><h5><?php echo $get_belong_organisation['organisation_name']; ?></h5></a>

                                    </li>


                                </ul>
                                <h4>Group</h4>
                                <div class="ln_solid"></div>
                                <ul class="list-unstyled user_data">
<?php foreach ($get_belong_group as $user_grp) { ?>
                                        <li>
                                            <a href="<?php ?>"><h5><?php echo $user_grp['group_title']; ?></h5></a>

                                        </li>
<?php } ?>

                                </ul>-->
                                <!-- end of skills -->

                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2>Employee Activity Report</h2>
                                    </div>

                                </div>
                                <!-- start of user-activity-graph -->
                                <div id="graph_bar" style="width:100%; height:280px;"></div>
                                <!-- end of user-activity-graph -->

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Open Tickets</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Doing Tickets</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Solved Tickets</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">


                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">


                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                                        </div>
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
</style>
<script>
    $(function () {
        var day_data = [
            {
                "period": "Jan",
                "Hours worked": 80
            },
            {
                "period": "Feb",
                "Hours worked": 125
            },
            {
                "period": "Mar",
                "Hours worked": 176
            },
            {
                "period": "Apr",
                "Hours worked": 224
            },
            {
                "period": "May",
                "Hours worked": 265
            },
            {
                "period": "Jun",
                "Hours worked": 314
            },
            {
                "period": "Jul",
                "Hours worked": 347
            },
            {
                "period": "Aug",
                "Hours worked": 287
            },
            {
                "period": "Sep",
                "Hours worked": 240
            },
            {
                "period": "Oct",
                "Hours worked": 211
            }
        ];
        Morris.Bar({
            element: 'graph_bar',
            data: day_data,
            xkey: 'period',
            hideHover: 'auto',
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            ykeys: ['Hours worked', 'sorned'],
            labels: ['Hours worked', 'SORN'],
            xLabelAngle: 60
        });

        //get ticket detail on click...
        var user_id = '<?php echo $user_detail['user_id']; ?>';
        
        //call on ready ..
        getTicketData('tab_content1', '1', user_id);
        
        
        $('body').on('click', '#home-tab', function () {
            getTicketData('tab_content1', '1', user_id);
        })
        $('body').on('click', '#profile-tab', function () {
            getTicketData('tab_content2', '2', user_id);

        })
        $('body').on('click', '#profile-tab2', function () {
            getTicketData('tab_content3', '3', user_id);
        })
    });
    function getTicketData(tab_content, ticket_type, user_id) {
        var href = $("#base_url").val() + 'employee/empTicket';
//        if ($("body").find('#' + tab_content + '').is(':empty')) {
            $("body").find('#' + tab_content + '').load(href + '/'+ticket_type+'/'+user_id, {}, function () {
            });
//        }
    }
</script>
