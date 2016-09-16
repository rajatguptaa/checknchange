<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Dashboard
                </h3>
            </div>


                    <div class="page-content">
                        <center>
                            <h1>Coming Soon...</h1>
                        </center>
                    </div>

<!--            <div class="title_right">
                <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">

                    <?php if (access_check("organisation", "view")) : ?>
                        <select name="orginasation_search" id="orginasation_search" tabindex="-1" class="select_organisation form-control">    
                            <?php foreach ($organisation as $org) { ?>
                                <option value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                            <?php } ?>
                        </select>   
                    <?php else :
                        ?>
                        <input type="hidden" name="orginasation_search" class="select_organisation" id="orginasation_search_hidden" value="<?php
                        $org = getUserOrginasationDetails($user['user_id']);
                        echo $org['organisation_id'];
                        ?>">
                           <?php endif; ?>

                </div>
            </div>-->
        </div>
        
        <!--<div class="dashboard_div"></div>-->    

    </div><!---wrapper end-->
</div>
<div align='center' class="wait">
        <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
    </div>
<!--<script>
    $(document).ready(function () {
        var base_url = $("#base_url").val();
        $(document).on('click', '.notes', function () {

            if ($('body').find('.view_data').hasClass('text_content')) {
                $('body').find('.view_data').removeClass('text_content');
                $('body').find('.edit_data').addClass('text_content');
            } else {
                $('body').find('.view_data').addClass('text_content');
                $('body').find('#organisation_title').val($('.lead_div').text());
                $('body').find('#organisation_text').val($('.text_div').text());
                $('body').find('.edit_data').removeClass('text_content');
                $('#organisation_error').empty();
            }
        });


        $(document).on('click', '.cancle', function () {
            $('body').find('.view_data').removeClass('text_content');
            $('body').find('.edit_data').addClass('text_content');

        });


        $(document).on('click', '#add_button', function () {

            var organisation_title = $('#organisation_title').val();
            var organisation_text = $('#organisation_text').val();
            var organisation_id = $(this).attr('data_id');

            $.ajax({
                type: 'POST',
                url: base_url + 'dashboardController/updateOrgansationTitle',
                data: {organisation_title: organisation_title, organisation_id: organisation_id, organisation_text: organisation_text},
                success: function (data) {
                    var res = $.parseJSON(data);
                    if (res.result == 'False') {
                        $('#organisation_error').empty();
                        $('#organisation_error').text(res.msg);
                    } else {
                        $('body').find('.lead_div').empty();
                        $('body').find('.text_div').empty();
                        $('body').find('.lead_div').text(res.msg.organisation_title);
                        $('body').find('.text_div').text(res.msg.organisation_text);
                        $('body').find('.view_data').removeClass('text_content');
                        $('body').find('.edit_data').addClass('text_content');

                    }
                }
            });
        });
    });

</script>-->


<style>
    .support-section {
        background: #F4F4F4;
    }
    #search {
        float: right;
        margin-top: 9px;
        width: 250px;
    }
    button.search-btn {
        background: #425160; /* Old browsers */
        background: -moz-linear-gradient(top, #425160 0%, #2a3f54 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #425160 0%,#2a3f54 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #425160 0%,#2a3f54 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#425160', endColorstr='#2a3f54',GradientType=0 ); /* IE6-9 */
        border-color: #4f4f4f;
        border-radius: 3px;
        font-size: 15px;
        height: 25px;
        line-height: 0;
        padding: 17.5px;
        position: relative;
    }
    .input-sm {
        height: 39px;
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .btn-group-sm>.btn, .btn-sm {
        padding: 0px 15px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .hilight {
        padding-top: 10px;
        background-color: #FFFFFF;
        padding-bottom: 12px;
        min-height: 170px;
    }
    h2.hilight-text {
        border-bottom: 1px solid #eeeeee;
        color: #2a3f54;
        font-size: 14px;
        font-weight: 600;
        padding-bottom: 5px;
        width: 100%;
    }
    .hilight ul li {
        display: block;
        padding: 5px 0;
    }.hilight ul li a{color:#000}
    h2.support-portal, h2.support-portal a {
        color: #000000;
        font-size: 18px;
    }
    h2.support-portal{
        border-bottom: 1px solid #dddddd;
        padding-bottom: 10px;
    }
    .inVentry {
        padding-bottom: 25px;
        box-shadow: 0px 0px 1px 0px #ddd;
        margin-top: 10px;
        background-color: #FFFFFF;

    }
    .support-section ul, ol {
        padding: 0px;
        margin-top: 0;
        margin-bottom: 10px;
    }
.wait{
        display:none;
        z-index: 9999;
    }
    .wait img {
        left: 0;
        margin: 0 auto;
        position: fixed;
        right: 0;
        top: 45%;
    }

</style>

<!-- footer content -->
