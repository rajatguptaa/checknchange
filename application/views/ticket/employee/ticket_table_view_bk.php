<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $mainHeading; ?></h3>
            </div>
            <div class="title_right">
                <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                    
                </div>
            </div>
        </div>

        <div class="row">
            <?php if ($this->session->flashdata('ticket_warning')) : ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('ticket_warning'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('ticket_success')) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('ticket_success'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class = "x_panel">
                    <div class = "x_title">
                        <a id="grid_button" href="<?php echo base_url() . 'request/employee/ticket/grid'; ?>" type="button" class="btn btn-info btn-xs"  title="Grid View"><i class="glyphicon glyphicon-menu-hamburger">
                            </i>&nbsp;&nbsp;Grid View</a>
                        <a id="create_button" type="button" class="btn btn-success btn-xs" title="Add Ticket"><i class="fa fa-plus-circle">
                            </i>&nbsp;&nbsp;Add Ticket</a>
                    </div>
                    <div class = "clearfix"></div>

                    <div class = "x_content">

                        <ul class = "nav nav-tabs responsive col-md-3">
                            <li class="load_extra"><a href = "#tab6"  data-val="6" data-toggle = "tab"><i class = "pull-right all_tickets"></i>All tickets</a>
                            </li>
                            <li class="load_extra" id="firstTab"><a href = "#tab1" data-val="1" data-toggle="tab"><i class = "pull-right new_open"></i>New,Open or Pending</a>
                            </li>

                            <li class="load_extra"><a href = "#tab2" data-val="2" data-toggle = "tab"><i class = "pull-right unassigned_tickets"></i> Unassigned tickets</a>
                            </li>

                            <li class="load_extra"><a href = "#tab11" data-val="11" data-toggle = "tab"><i class = "pull-right assigned_tickets"></i> Assigned tickets</a>
                            </li>
                            <li class="load_extra"><a href = "#tab3" data-val="3" data-toggle = "tab"><i class = "pull-right all_unsolved_tickets"></i> All unsolved tickets</a>
                            </li>
                            <li class="load_extra"><a href = "#tab7" data-val="7" data-toggle = "tab"><i class = "pull-right recently_solved_tickets"></i> Recently Closed</a>

                            </li>           
                            <li class="load_extra"><a href = "#tab4" data-val="4" data-toggle = "tab"><i class = "pull-right recently_updated_tickets"></i> Recently updated tickets</a>
                            </li>
                            <?php if ($access_level == 3) { ?>
                                <li class="load_extra"><a href = "#tab5"  data-val="5" data-toggle = "tab"><i class = "pull-right new_ticket_in_your_group">0</i> New ticket in your group</a>
                                </li>
                            <?php } ?>



                        </ul>

                        <div class = "tab-content responsive col-md-9" id="ticket_tab_data">
                            <div class="tab-pane active" id="tab1">

                            </div>
                            <div class="tab-pane active" id="tab2">

                            </div>
                            <div class="tab-pane active" id="tab3">

                            </div>
                            <div class="tab-pane active" id="tab4">

                            </div>
                            <div class="tab-pane active" id="tab5">

                            </div>
                            <div class="tab-pane active" id="tab6">

                            </div>
                            <div class="tab-pane active" id="tab7">

                            </div>
                            <div class="tab-pane active" id="tab8">

                            </div>
                            <div class="tab-pane active" id="tab9">

                            </div>
                            <div class="tab-pane active" id="tab11">

                            </div>




                        </div>
                        <!--</div>-->
                        <div class="col-md-12 col-sm-12 col-xs-12 pagination_div pagination pagination-split center text-center"></div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 assign_div" style="margin-left:10px; display:none" >  
                <div class="col-md-9 col-md-offset-3">
                    <form data-parsley-validate id="assign_ticket"  class="update_form form-horizontal form-label-left" action="<?php echo base_url() . 'ticketController/assignTicket'; ?>" method="post" enctype="multipart/form-data">
                        <div class="col-md-12 col-sm-12 col-xs-12 inner-box">
                            <h2>Update selected tickets</h2>

                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="filter">Status </label>

                                        <select id="ticket_status" class="form-control chossen" name="ticket_status" required="" data-parsley-error-message="Status is required.">
                                            <option value="Open">Open</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Doing" >Doing</option>
                                            <option value="Solved">Solved</option>
                                        </select>
                                        <?php echo form_error('ticket_status'); ?>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <label for="filter">Type * </label>
                                        <select id="ticket_type" class="form-control chossen" data-parsley-error-message="Ticket type field is required." name="ticket_type" required="">

                                            <option value="question" >Question</option>
                                            <option value="task">Task</option>
                                            <option value="problem">Problem</option>
                                        </select>
                                        <?php echo form_error('ticket_type'); ?>
                                    </div>
                                </div> 

                            </div>  
                            <div class="col-md-4 col-sm-12 col-xs-12"> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="filter">Priority </label>
                                        <select class="form-control chossen" id="ticket_priority"  name="ticket_priority" required="" data-parsley-error-message="Priority  type field is required.">

                                            <option value="normal">Normal</option>
                                            <option value="high">High</option>
                                            <option value="low">Low</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                        <?php echo form_error('ticket_priority'); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="filter">Group </label>

                                        <select class="form-control chossen" id="group">
                                            <?php foreach ($group as $grp_val) { ?>
                                                <option value="<?php echo $grp_val['group_id']; ?>"><?php echo $grp_val['group_title']; ?></option>

                                            <?php }
                                            ?>
                                        </select>
                                        <?php echo form_error('group'); ?>
                                    </div>
                                </div>  
                            </div>  
                            <div class="col-md-4 col-sm-12 col-xs-12"> 
                                <div class="form-group">
                                    <label for="filter">Assignee * </label>
                                    <select id="assignee" class="form-control chossen" name="assign_user" required="" data-parsley-error-message="Assignee field is required.">

                                    </select>
                                    <ul class="parsley-errors-list filled" id="parsley-id-14"><li class="parsley-custom-error-message assinee_error"></li></ul>
                                    <?php echo form_error('ticket_priority'); ?>
                                </div>

                            </div>  
                            <input type="hidden" name="ticket_id" id="select_ticket_id">
                            <input type="hidden" name="org_id" id="org_id">


                            <div class="col-md-12">
                                <label for="filter">Tags </label>
                                <select  name="tags[]" tabindex="-1" class="tags form-control col-md-7 col-xs-12 chosen-select" multiple="">                                          
                                </select>   
                            </div> 
                            <div class="col-md-12">
                                <button type="button" id="assign_btn" class="btn btn-success pull-right" style="margin-top:10px">Update</button>
                            </div>
                        </div>


                    </form>
                </div> </div>
        </div>
    </div>
</div>
<input type="hidden" value="" id="count_table">
<div align='center' class="wait">
    <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
</div>
<script>


    $(document).ready(function() {



        $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });

        fakewaffle.responsiveTabs(['xs', 'sm']);

        $(".select_organisation").chosen({width: "85%", });
//        $('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});
        $('body').popover({selector: '[data-popover]', trigger: 'click hover', placement: 'right', html: true});

        var base_url = $("#base_url").val();
        var org_id;
        var user_id = '<?php echo $user_id; ?>';
        var type = '<?php echo ($access_level == 3 ) ? 1 : 2; ?>';
        var grp_id = $('#group').val();


        // Checkign last status of the organzation and tabs active state

        var org_check = getLocalStorage("org_id");
//        console.log(org_check);
        if (typeof org_check != 'undefined' && org_check != "" && org_check != null) {
            try {

                var org_id = getLocalStorage("org_id");
                var typecheck = getLocalStorage("active_tab");

                if (typeof typecheck != 'undefined' && typecheck != "" && typecheck != null)
                {
                    type = typecheck;
                }
                if ($("body").find("#tabs-0").is(":visible"))
                {
                    $("body").find('#tabs-0 li a[data-val="' + type + '"]').trigger("click");
                }
                else
                {

                    setTimeout(function() {
                        if ('#collapse-tab' + type != $("body").find("#collapse-tabs-0 a:first").attr("href"))
                            $("body").find($("body").find("#collapse-tabs-0 a:first").attr("href")).collapse('hide');


                    }, 1000);

                    $("body").find('#collapse-tab' + type).collapse('show');
                }

                $('#orginasation_search').val(org_id);
                $("#orginasation_search").trigger("chosen:updated");
                getTicketDetialNew('#tab' + type, org_id, type, user_id, 1, true);
            }
            catch (error) {
                clearLocalStorage();
                window.location.reload();
            }
        }
        else {
            org_id = $('#orginasation_search').val();
            getTicketDetialNew('#tab1', org_id, type, user_id, 1, true);
        }
        getTabCount(org_id, user_id);
        getAssigni(org_id, grp_id);
        $('body').find("#create_button").attr('href', base_url + 'request/employee/add/0');
        $('body').find("#grid_button").attr('href', base_url + 'request/employee/ticket/grid/0');

        $("body").on("click", ".load_extra a", function() {
            var obj = $(this);
            var org_id = $('#orginasation_search').val();
            var id = $(obj).attr("href");
            var type = $(obj).attr("data-val");
            getTabCount(org_id, user_id);
            getTicketDetialNew(id, org_id, type, user_id, 1, true);

            
        });

        $("body").on('change', '#orginasation_search', function() {


            var org_id = $(this).val();

            var user_id = '<?php echo $user_id; ?>';
            var grp_id = $('#group').val();
            $("#create_button").attr('href', base_url + 'request/employee/add/' + org_id);
            $("#grid_button").attr('href', base_url + 'request/employee/ticket/grid/' + org_id);
            var type = $('body').find('#tabs-0').find('li.active').find('a').attr('data-val');
            if (typeof type == 'undefined') {
                var type = '<?php echo ($access_level == 3 ) ? 1 : 2; ?>';

                getTabCount(org_id, user_id);
                getTicketDetialNew('#tab1', org_id, type, user_id, 1, true);


            }
            else {

                $('body').find('#tabs-0').find('li.active').find('a').trigger('click');

            }
            getAssigni(org_id, grp_id);
            $('body').find('.assign_div').css('display', 'none');
        });


        // Assign ticket

        $('body').on('click', '.ticketedit', function() {
            var ticket_id = $(this).attr('data-id');
            var org_id = $('#orginasation_search').val();
            setLocalStorage("org_id", org_id);
            setLocalStorage("ticket_id", ticket_id);

            window.location.href = base_url + 'request/employee/assign/' + ticket_id + '/' + org_id;
        });
        // View ticket

        $('body').on('click', '.ticketview', function() {
            var ticket_id = $(this).attr('data-id');
            var org_id = $('#orginasation_search').val();
            setLocalStorage("org_id", org_id);
            setLocalStorage("ticket_id", ticket_id);

            window.location.href = base_url + 'request/ticket/view/' + ticket_id;
        });

        $('body').on('click', '.ticket_edit', function() {
            var ticket_id = $(this).attr('data-id');
            var org_id = $('#orginasation_search').val();
            setLocalStorage("org_id", org_id);
            setLocalStorage("ticket_id", ticket_id);

            window.location.href = base_url + 'request/ticket/view/' + ticket_id;
        });


        $('body').on('click', '#assign_btn', function() {


            var ticket_id = $('input:checkbox:checked:visible').map(function() {
                return $(this).val();
            }).get().join();
            $('#select_ticket_id').val(ticket_id);
            var org_id = $('#orginasation_search').val();
            $('#org_id').val(org_id);
            $('#assign_ticket').submit();
        });


        $('body').on('change', '.select_id', function() {

            if ($('.select_id').is(':checked:visible')) {
                $('body').find('.assign_div').css('display', 'block');
            }
            else {
                $('body').find('.assign_div').css('display', 'none');
            }

//           if($(this).is(':checked')){
//         $('body').find('.assign_div').css('display','block');
//           }
//           else{
//            $('body').find('.assign_div').css('display','none');      
//           }
        });



        $(".chossen").chosen({width: "100%"});
        // get assigni on group change

        $("body").on('change', '#group', function() {
            var grp_id = $(this).val();
            var org_id = $('#orginasation_search').val();
            getAssigni(org_id, grp_id);
            $('body').find('#assignee').next('ul li').find('.parsley-custom-error-message').empty();
        });

        // add tag


        $(".tags").chosen({width: "100%", include_group_label_in_selected: true, no_results_text: "No results match ! Press enter to add tag", placeholder: "Add or Select tag"});
        var organisation_id = $('body').find('#orginasation_search').val();
        var grp = $(".tags");

        $.ajax({
            type: 'POST',
            url: base_url + 'ticketController/getTag',
            data: {organisation_id: organisation_id},
            success: function(data) {
                if (data != false) {
                    var groupArray = $.parseJSON(data);
                    grp.empty();
                    $(groupArray).each(function(index, value) {

                        $(grp).append('<option value="' + value.tag_id + '">' + value.tag_heading + '</option>');
                    });
                    grp.trigger("chosen:updated");
                }
            }
        });
        
        // intailize pagination when document 
        setTimeout(function() {

            var page_count = $('body').find("#tab" + type).find('#page_count').val();
          
            pagination(page_count);
            
        }

        ,500);




    });

//    function getTicketDetial(id, org_id, type, user_id) {
//
//        var base_url = $("#base_url").val();
//
//        setLocalStorage("org_id", org_id);
//        setLocalStorage("active_tab", type);
//
//       <?php if ($access_level == 3) { ?>
    //              
    //            $("body").find(id).load(base_url + 'ticketController/ticketTableView/' + org_id + '/' + type + '/' + user_id, {}, function () {
    //                $("body").find(".animsition-loading").addClass("hide");
    //            });
    //       <?php } else { ?>
    //      
    //            $("body").find(id).load(base_url + 'ticketController/ticketTableView/' + org_id + '/' + type, {}, function () {
    //              
    //                $("body").find(".animsition-loading").addClass("hide");
    //            });
    //        <?php } ?>
//
//    }


    function getTicketDetialNew(id, org_id, type, user_id, offset, flag) {

        var base_url = $("#base_url").val();

        setLocalStorage("org_id", org_id);
        setLocalStorage("active_tab", type);
	org_id = 0;


        var url = base_url + 'ticketController/ticketTableView';
        var method = 'POST';
        var data = {org_id: org_id, type: type, user_id: user_id, offset: offset}
        ajaxRequest(url, method, data, function(data) {
          
            $('body').find(id).empty();
            var obj = $('body').find(id).html(data);
        
              var page_count = $('body').find("#tab" + type).find('#page_count').val();
      
               if (flag){
               pagination(page_count);
               }
               
            $('body').find('.assign_div').css('display','none');

        });



    }




    function pagechange(obj) {
      
    
        var org_id = getLocalStorage("org_id");
        var type = getLocalStorage("active_tab");
        var user_id = '<?php echo $user_id; ?>';
        var id = $('body').find('#tabs-0').find('li.active').find('a').attr('href');

        getTicketDetialNew(id, org_id, type, user_id, obj, false);
    }

    function pagination(count) {
        if (count != 0 && typeof(count) != 'undefined') {
            $('body').find('.pagination_div').pagination({
                items: count,
                itemsOnPage: 5,
                cssStyle: 'light-theme'
            });
        }
        else {
            $('body').find('.pagination_div').pagination('destroy');
        }
    }




    function getAssigni(org_id, grp_id) {
        var base_url = $("#base_url").val();
        var assignee = $('body').find('#assignee');
        $.ajax({
            type: 'POST',
            url: base_url + 'ticketController/getAssineebygrp',
            data: {grp_id: grp_id, org_id: org_id},
            success: function(data) {
                if (data != '') {
                    var groupArray = $.parseJSON(data);

                    assignee.empty();
                    $(groupArray).each(function(index, value) {

                        $(assignee).append('<option value="' + value.user_id + '_' + value.group_id + '">' + value.assignee_name + '</option>');
                    });
                    $(assignee).trigger("chosen:updated");

                } else {
                    assignee.empty();
                    $(assignee).trigger("chosen:updated");
                }
            }
        });
    }

    function getTabCount(org_id, user_id) {
//        TicketCount
        var base_url = $("#base_url").val();
org_id = 0;
        $.ajax({
            type: "GET",
            url: base_url + 'ticketController/TicketCount/' + org_id + "/" + user_id,
            success: function(data) {
		     console.log(data);
                var dataArray = $.parseJSON(data);

                $.each(dataArray, function(key, value) {
                    $("body").find("." + key).text(value);

                })
            }
        });


    }
</script>
<style>

    .update_form {
        border: 1px solid #d7d7d7;
        padding-bottom: 15px;
    }

    .inner-box {
        margin: 15px 15px 0;
        width: 97%;
    }
    .popover{
        width:550px !important;
        max-width: 100% !important;
    }



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
    .login_content input {
        margin-bottom: 14px !important;
    }
    #collapse-tabs-0 .panel-body {
        max-height: inherit;
        min-height: available;
        overflow: auto;
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
    .col-pad  {

        padding: 0px !important;
    }
    .col-pad a{
        margin-top: 20% !important;
    }
</style>