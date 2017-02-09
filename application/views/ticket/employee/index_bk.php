<?php
$user = $this->session->userdata('logged_in');
$access_level = $user['user_access_level'];
?>
<div class="right_col" role="main">
    <div class="container" >
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo $mainHeading; ?></h3>
                </div>
                <div class="title_right">
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                        <div class="">
                            <?php if (access_check("organisation", "view")) : ?>
                                <select name="orginasation_name" id="orginasation_search" tabindex="-1" class="select_organisation form-control" onchange="">    
                                    <?php foreach ($organisation as $org) { ?>
                                        <option <?php echo ($org['organisation_id'] == $organisation_id) ? 'selected' : '' ?>  value=<?php echo $org['organisation_id']; ?>><?= $org['organisation_name'] ?></option>
                                    <?php } ?>
                                </select>   
                            <?php else :
                                ?>
                                <input type="hidden" name="orginasation_name" id="orginasation_search" value="<?php
                                $org = getUserOrginasationDetails($user['user_id']);
                                echo $org['organisation_id'];
                                ?>">
                                   <?php endif; ?>
                            <input type="hidden" name="user_id" id="ticket_user_id" value="<?php echo $user['user_id']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <input type="hidden" value="6" id="selected_project_id">

                <input type="hidden" value="25" id="loggedInUserId">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                    <a class="btn btn-info btn-xs" type="button" href="<?= base_url('request') ?>" id="table_button" ><i class="fa fa-table">
                                        </i>&nbsp;&nbsp;Table View</a>
                                    <a title=""  class="btn btn-success btn-xs" id="create_button" type="button" ><i class="fa fa-plus-circle">
                                        </i>&nbsp;&nbsp;Add Ticket</a>
                                </div>
                            </div>                                

                            <div id="taskbar" class="row">
                                <!--                                <div class="col-md-3 col-sm-6">
                                                                    <div class="ticket_box">
                                                                        <div class="task_status_head"> Backlog</div>
                                                                        <div class="column left first" id="backlog">
                                                                            <ul data-status="Pending" class="sortable-list ui-sortable col_backlog"></ul>
                                                                        </div>
                                                                    </div>
                                
                                                                </div>-->

                                <div class=" col-md-4 col-sm-4 col-xs-4 main-ticket_box imporatant">
                                    <div class="ticket_box">
                                        <div class="task_status_head"> To Do</div>
                                        <div class="column left first" id="todo">
                                            <ul data-status="Open" class="sortable-list ui-sortable col_todo"></ul>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-md-4 col-sm-4 col-xs-4 main-ticket_box imporatant">
                                    <div class="ticket_box">
                                        <div class="task_status_head"> Doing</div>
                                        <div class="column left first" id="doing">
                                            <ul data-status="Doing" class="sortable-list ui-sortable col_doing"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-4 col-sm-4 col-xs-4 main-ticket_box imporatant">
                                    <div class="ticket_box">
                                        <div class="task_status_head"> Done</div>
                                        <div class="column left first" id="done">
                                            <ul data-status="Solved" class="sortable-list ui-sortable col_done"></ul>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--HTML for clone .....-->
<li id="template" class="sortable-item ui-sortable-handle ticket_detail" style="display: none" >
    <input type="hidden" name="ticket" id="ticket_id" value='' >
    <div id="severity" class="NotSet pull-left col-xs-12">

        <div class="task-title">   <span>   </span></div>
        <div class="task-decs" data-toggle="modal" data-target=".bs-example-modal-lg">                       


        </div>
        <div class="clearfix"></div>

        <div class="grid_button col-md-12 col-sm-12 pull-right"> 

            <button type="button" data-placement="right" title="View Ticket" class="btn btn-primary btn-xs view_ticket" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i></button>    
            <button type="button" title="Add Hour" class="btn btn-info btn-xs search_btn" id="search_btn" data-toggle="modal" data-target="#addTime"><i class="glyphicon glyphicon-time"></i></button>   
        </div>
        <div class="change-status select-style pull-left">
            <select id='change_status' class="select_task_status chosen-status form-control" data='' onchange="responsiveChangeStatus(this);">
                <option value="Open"> ToDo </option>
                <option value="Doing"> Doing </option>
                <option value="Solved"> Done </option>
            </select>
        </div>
<!--        <div style="right: 30px; position: relative; top: -30px;"><button class="btn btn-default pull-right details-opener" style="border-radius: 50%;"><i class="fa fa-info"></i></button></div>-->
    </div>
</li>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Ticket Detail's</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 id="ticketSubject" class="col-md-8 pull-left nopadding_l">Test Ticket </h4>
                    <div class="col-md-4 pull-right">
                        <lable id="ticketPriority" class="label pull-right text-capitalize">low</lable>
                    </div>
                </div>

                <input type="hidden" value="" id="single_ticket">
                <input type="hidden" value="" id="ticket_position">
                <!--all fields...-->    
                <div class="col-md-8 col-sm-6">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="ticketDesc">

                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <!--all fields...-->   
                    <!--                    <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                                <div class="col-md-5 col-sm-6 col-xs-6">
                                                    <label>Priority:</label>
                                                </div>
                                                <div class="col-md-5 col-sm-6 col-xs-6">
                                                    <lable class="label" id="ticketPriority"></lable>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>Ticket Status:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketStatus">
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">Created By:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedBy">
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label class="lab">Created Date:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketCreatedDate">
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>Assigned By:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignedBy">
                            </div>
                        </div>
                    </div>
                    <!--all fields...-->  
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6">
                                <label>Assigned date:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketAssignDate">
                            </div>
                        </div>
                    </div>
                    <!--all fields...--> 
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-5 col-sm-6 col-xs-6" >
                                <label>Updated By:</label>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-6" id="ticketUpdateBy">

                            </div>
                        </div>
                    </div>
                    <!--all fields...--> 
                    <!--                    <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                                <div class="col-md-5 col-sm-6 col-xs-6">
                                                    <label>Updated Date:</label>
                                                </div>
                                                <div class="col-md-5 col-sm-6 col-xs-6"  id="ticketUpdateDate">
                                                    
                                                </div>
                                            </div>
                                        </div>-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <h4 class='text-left'>Members</h4>
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding" id="ticketMembers">

                    </div>
                </div>
            </div>
            <div class="modal-footer clear">
                <div class="dropup">
                    <button class="btn btn-default dropdown-toggle pull-left" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Priority  <span class="caret"></span>
                    </button>
                    <ul aria-labelledby="dropdownMenu2" class="dropdown-menu"> 
                        <li class="urgent"><a href="javascript:changePriority('urgent')">Urgent</a></li> 
                        <li class="high"><a href="javascript:changePriority('high')">High</a></li> 
                        <li class="medium"><a href="javascript:changePriority('normal')">Normal</a></li> 
                        <li class="low"><a href="javascript:changePriority('low')">Low</a></li> 
                    </ul>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="more_detail" class="btn btn-info" data-dismiss="modal">More Details</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>

        </div>
    </div>
</div>

<div class="modal modal-md" id="addTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <form data-parsley-validate action="<?php echo base_url('ticketController/addHour'); ?>" method="post" id="add_time_form">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add Work Hour</h4>
                </div>
                <div class="modal-body clearfix">
                    <?php if ($access_level == 1) { ?>
                        <div class="form-group col-md-12">
                            <div class="col-md-2 col-md-offset-1">
                                <label for="message-text" class="control-label">User</label>
                            </div>
                            <div class="col-md-8 col-md-offset-1">
                                <select id="user_select" name="user_id"></select>
                            </div>
                        </div>
                    <?php } if ($access_level == 3) {
                        ?>
                        <input type="hidden" name="user_id" id="user_select" value="<?php echo getLoginUser(); ?>"></select>
                        <?php
                    }
                    ?>
                    <div class="form-group col-md-12">
                        <div class="col-md-2 col-md-offset-1">
                            <label for="recipient-name" class="control-label">Working Hour *</label>
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            <div  class="col-md-12 min_hour">
                                <input min="0" max="99" placeholder ="hh" class="form-control times input_field" type="number" name="hour" id="hour">
                                <span class="pull-left text-center"> : </span> 
                                <input min="0" max="99" placeholder ="mm"   class="form-control times input_field" type="number" name="min" id="min" >

                            </div>
                            <div class="custom_err col-md-12">
                                <ul class="parsley-errors-list filled hour_err"><li class="parsley-custom-error-message"></li></ul>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="ticket_id" id="hour_ticket">



                    <div class="form-group col-md-12">
                        <div class="col-md-2 col-md-offset-1">
                            <label for="message-text" class="control-label">Description</label>
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            <textarea   id="description"  placeholder="Enter Description" name="description" class="form-control col-md-7 input_field" col-xs-12 ></textarea>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </div>
        </div></form>

</div>
<div align='center' class="wait">
    <div class="loader-center"><img height='50' width='50' src='<?php echo base_url(); ?>assets/images/ajax-loader_1.gif'></div>
</div>
<input type="hidden" id="org_id"> 

<script type="text/javascript">

    var base_url = $('body').find("#base_url").val();
    $(document).ready(function () {
        
        $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
  
      
        $('[data-toggle="tooltip"]').tooltip()
        var user_id = $('body').find('#ticket_user_id').val();
        $(".select_organisation").chosen({width: "85%", });
        $("body").on('change', '.times', function () {
            $('body').find('.custom_err').find('ul li').text('').removeClass('animated shake');
        });
        var org_id = $('body').find('#orginasation_search').val();
        $('body').find('#org_id').val(org_id);
        getAllToDo(org_id, user_id);
        getAllDoing(org_id, user_id);
        getAllDone(org_id, user_id);

        $('body').find("#create_button").attr('href', base_url + 'request/employee/add/' + org_id);

        $("body").on('change', '#orginasation_search', function () {
            var org_id = $(this).val();
            setLocalStorage("org_id", org_id);
            setLocalStorage("active_tab", "");
            var user_id = $('body').find('#ticket_user_id').val();
            $('body').find('#org_id').val(org_id);
            getAllToDo(org_id, user_id);
            getAllDoing(org_id, user_id);
            getAllDone(org_id, user_id);
        });

        $('#taskbar .sortable-list').sortable({
            connectWith: '#taskbar .sortable-list',
            placeholder: 'placeholder',
            stop: function (event, ui) {
                var ticket_id = $(ui.item).find('input[name="ticket"]').val();
                var dropped_in = $(ui.item).parent().attr('data-status');
                var dropped_from = $(ui.item).attr('data-type');

                $(ui.item).attr('data-type', dropped_in);
                if (dropped_in != dropped_from) {
                    $(ui.item).parents('#taskbar').find('ul').each(function () {
                        if ($(this).find('li').length == 0) {
                            $(this).html('<span>No ticket found here..!!</span>');

                        }
                    })
                    // hide message if ticket found ...
                    if ($(ui).length > 0) {
                        $(ui.item).siblings('span').hide();
                    }
                    changeStatus(ticket_id, dropped_in, user_id);
                }
            }
        });

        // call onchange for get task for selected organisation...
//        $('body').on('change', '#orginasation_search', function () {
//            var org_id = $(this).val();
//            getAllTasks(org_id);
//        });


        //open modal for view tickets detail..
        $('body').on('click', '.task-decs', function () {
            var ticket_id = $(this).parents('.ticket_detail').find('#ticket_id').val();
            $('body').find('#ticket_position').val($(this).parents('.ticket_detail').attr('data-list'));
            viewTicket(ticket_id);
        });



        //open modal for view tickets detail..
        $('body').on('click', '.view_ticket', function () {
           var ticket_id = $(this).attr('ticket_id');
           viewTicket(ticket_id);
        });

        // ADD Time
        $('body').on('click', '.search_btn', function () {
            var ticket_id = $(this).attr('ticket_id');
            $('.input_field').val('');
            $('#hour_ticket').val('');
            $('#hour_ticket').val(ticket_id);
<?php if ($access_level == 1) { ?>
                $('#user_select').chosen({width: "90%"});
                var user_sel = $('#user_select');
                $.ajax({
                    type: 'POST',
                    url: base_url + 'ticketController/getAssignUser',
                    data: {ticket: ticket_id},
                    success: function (data) {
                        if (data != false) {
                            var userArray = $.parseJSON(data);
                            user_sel.empty();
                            $(userArray).each(function (index, value) {
                                $(user_sel).append('<option value="' + value.assigni_id + '">' + value.assignee + '</option>');
                                $(user_sel).trigger("chosen:updated");
                            });



                        }
                    }
                });
<?php } ?>
        });

        // Edit Ticket
        $('body').on('click', '.edit_btn', function () {
            var ticket_id = $(this).attr('ticket_id');
            var org_id = $('body').find('#org_id').val();
            window.location.href = base_url + 'request/employee/assign/' + ticket_id + '/' + org_id;
//                    window.location.href = "";   
        });

        // More Detail 
        $('body').on('click', '#more_detail', function () {
            var ticket_id = $(this).attr('ticket_id');
            window.location.href = base_url + 'request/ticket/view/' + ticket_id;
        });


        // Add Hour Form


        $('body').find('#add_time_form').ajaxForm(function (data) {
            var err = $.parseJSON(data);
            if (err.result == false) {
                $('.custom_err').find('ul li').text(err.msg).addClass('animated shake');
            }
            else {
                if (err.result) {

                    var n = noty({
                        text: err.msg,
                        type: err.type,
                        dismissQueue: true,
                        layout: 'center',
                        closeWith: ['click'],
                        theme: 'relax',
                        maxVisible: 10,
                        timeout: 3000,
                        animation: {
                            open: 'animated flipInX',
                            close: 'animated flipOutX',
                            easing: 'swing',
                            speed: 500
                        }
                    });
                }
                $('#addTime').modal('hide');
            }
        });
    });

    //change task status with drop down in responsive view...
    function responsiveChangeStatus(obj) {

        var org_id = $('body').find('#orginasation_search').val();
        var user_id = $('body').find('#ticket_user_id').val();
        var ticket_id = $(obj).parents("li").find('input[name="ticket"]').val();
        changeStatus(ticket_id, $(obj).val(), user_id);
        getAllToDo(org_id, user_id);
        getAllDoing(org_id, user_id);
        getAllDone(org_id, user_id);
    }


    function changeStatus(ticket_id, dropped_in, user_id) {

        $.ajax({
            url: base_url + 'request/changeTicketStatus',
            type: 'post',
            data: {'ticket_id': ticket_id, 'status': dropped_in, 'user_id': user_id},
            success: function (data) {
                if (data == 1)
                {

                    if (dropped_in == 'Open') {
                        $('body').find('#todo').find('.search_btn').css('display', 'none');
                    }
                    else {
                        $('body').find('#doing,#done').find('.search_btn').css('display', 'inline-block');
                    }
                    noty({text: 'Ticket status changed successfully',
                        type: 'success',
                        dismissQueue: true,
                        layout: 'center',
                        closeWith: ['click'],
                        theme: 'relax',
                        maxVisible: 10,
                        timeout: 3000,
                        animation: {
                            open: 'animated flipInX',
                            close: 'animated flipOutX',
                            easing: 'swing',
                            speed: 500
                        }});

                } else {
                    noty({text: 'Ticket status did not change,please try again.',
                        type: 'error',
                        dismissQueue: true,
                        layout: 'center',
                        closeWith: ['click'],
                        theme: 'relax',
                        maxVisible: 10,
                        timeout: 3000,
                        animation: {
                            open: 'animated flipInX',
                            close: 'animated flipOutX',
                            easing: 'swing',
                            speed: 500
                        }});
                }
            },
            error: function (data) {
                noty({text: 'Ticket status did not change,please try again.',
                    type: 'error',
                    dismissQueue: true,
                    layout: 'center',
                    closeWith: ['click'],
                    theme: 'relax',
                    maxVisible: 10,
                    timeout: 3000,
                    animation: {
                        open: 'animated flipInX',
                        close: 'animated flipOutX',
                        easing: 'swing',
                        speed: 500
                    }});
            }

        });
    }

    // function for get all todo task status data...
    function getAllToDo(org_id, user_id) {
        var base_url = $('body').find("#base_url").val();
//        $.ajax({
//            url: base_url + "request/backlogData/" + org_id + '/' + user_id,
////            beforeSend: function() {
////                $("#ajax_loader").removeClass('hide');
////            },
//            success: function (res) {
//
//                $('#backlog ul').html('');
//                if (res != 'No backlog')
//                {
//
//                    var data = $.parseJSON(res);
//                     var ticketStatus = '';   
//                    $.each(data, function (index, value) {
//
//                        var clone = $('#template').clone();
//                        $(clone).attr('id', value.ticket_id);
//                        $(clone).attr('data-type', 'Pending');
//                        $(clone).attr('data-list', 'Pending_'+value.ticket_id);
//                        $(clone).attr('style', '');
////                        $(clone).attr('data-name', value.first_name + ' ' + value.last_name);
////                        $(clone).attr('data-creater', value.userid);
////                        $(clone).attr('data-date', value.createdDate);
////                        $(clone).find('input[name="task"]').attr('id', 'H_' + value.task_id);
//                        $(clone).find('input[name="ticket"]').attr('value', value.ticket_id);
////                        $(clone).find('.NotSet').attr('class', value.severity);
//                        if(value.ticket_priority == 'normal'){
//                            ticketStatus = 'important';
//                        }
//                        if(value.ticket_priority == 'high'){
//                            ticketStatus = 'critical';
//                        }
//                        if(value.ticket_priority == 'low'){
//                            ticketStatus = 'normal';
//                        }
//                        $(clone).find('#severity').removeClass('NotSet');
//                        $(clone).find('#severity').addClass(ticketStatus);
//                        $(clone).find('.task-title').html('<span>' + value.ticket_subject + '</span>');
//                        $(clone).find('.task-decs').html(value.ticket_description);
////                        $(clone).find('#change_status option[value="col_' + value.status + '"]').attr('selected', 'selected');
////                        $(clone).find('#change_status').attr('id', 'change_status_' + value.task_id);
//
////                        $.each(value.assignTo, function(index, val) {
////
////                            $(clone).find('.assign-to').append('<span class="assign-name label label-default">' + val.fname + '</span>');
////
////                        });
//
//                        $('#backlog ul').append(clone);
//                    });
//                } else {
//                    $('#backlog ul').html('<span>Nothing found here .!!</span>');
//                }
//            }
//
//        });

<?php if ($access_level == 1) { ?>
            var url = base_url + "ticketController/getToDoData/" + org_id;
    <?php
} else {
    ?>
            var url = base_url + "ticketController/getToDoData/" + org_id + '/' + user_id;
    <?php
}
?>
        $.ajax({
            url: url,
            beforeSend: function() {
                $("#ajax_loader").removeClass('hide');
            },

            success: function (res) {
                $('#todo ul').html('');
                if (res != 'No Todo')
                {
                    var data = $.parseJSON(res);
                    var ticketStatus = '';
                    $.each(data, function (index, value) {

                        var clone = $('#template').clone();

                        $(clone).attr('id', value.ticket_id);
                        $(clone).attr('data-type', 'Open');
                        $(clone).attr('data-list', 'Open_' + value.ticket_id);
                        $(clone).attr('style', '');
                        $(clone).find('input[name="ticket"]').attr('value', value.ticket_id);
                        $(clone).find('#change_status').val("Open");
                        if (value.ticket_priority == 'normal') {
                            ticketStatus = 'important';
                        }
                        if (value.ticket_priority == 'high') {
                            ticketStatus = 'critical';
                        }
                        if (value.ticket_priority == 'low') {
                            ticketStatus = 'normal';
                        }
                        if (value.ticket_priority == 'urgent') {
                            ticketStatus = 'urgent';
                        }
                        if (value.ticket_description.length >= 410) {
                            var tct_desc = value.ticket_description.substr(0, 410);
                            tct_desc = tct_desc + ' ..........';
                        } else {
                            var tct_desc = value.ticket_description;
                        }

                        $(clone).find('#severity').removeClass('NotSet');
                        $(clone).find('#severity').addClass(ticketStatus);
                        $(clone).find('.task-title').html('<span>' + value.ticket_subject + '</span>');
                        $(clone).find('.task-decs').html(tct_desc);
                        $(clone).find('.grid_button').find('.view_ticket').attr('ticket_id', value.ticket_id);
                        $(clone).find('.grid_button').find('.search_btn').attr('ticket_id', value.ticket_id);
                        $(clone).find('.grid_button').find('.search_btn').css('display', 'none');
                        $('#todo ul').append(clone);
                    });
                } else {
                    $('#todo ul').html('<span>No ticket found here..!!</span>');
                }

            }
        });
    }

    // function for get doing task status data...
    function getAllDoing(org_id, user_id) {
        var base_url = $('body').find("#base_url").val();
<?php if ($access_level == 1) { ?>
            var url = base_url + "ticketController/getDoingData/" + org_id;
    <?php
} else {
    ?>
            var url = base_url + "ticketController/getDoingData/" + org_id + '/' + user_id;
    <?php
}
?>

        $.ajax({
            url: url,
            success: function (res) {
                $('#doing ul').html('');
                if (res != 'No Doing')
                {
                    var data = $.parseJSON(res);
                    var ticketStatus = '';
                    $.each(data, function (index, value) {

                        var clone = $('#template').clone();

                        $(clone).attr('id', value.ticket_id);
                        $(clone).attr('data-type', 'Doing');
                        $(clone).attr('data-list', 'Doing_' + value.ticket_id);
                        $(clone).attr('style', '');
                        $(clone).find('input[name="ticket"]').attr('value', value.ticket_id);
                        $(clone).find('#change_status').val("Doing");
                        if (value.ticket_priority == 'normal') {
                            ticketStatus = 'important';
                        }
                        if (value.ticket_priority == 'high') {
                            ticketStatus = 'critical';
                        }
                        if (value.ticket_priority == 'low') {
                            ticketStatus = 'normal';
                        }
                        if (value.ticket_priority == 'urgent') {
                            ticketStatus = 'urgent';
                        }
                        if (value.ticket_description.length >= 410) {
                            var tct_desc = value.ticket_description.substr(0, 410);
                            tct_desc = tct_desc + ' ..........';
                        } else {
                            var tct_desc = value.ticket_description;
                        }
                        $(clone).find('#severity').removeClass('NotSet');
                        $(clone).find('#severity').addClass(ticketStatus);
                        $(clone).find('.task-title').html('<span>' + value.ticket_subject + '</span>');
                        $(clone).find('.task-decs').html(tct_desc);
                        $(clone).find('.grid_button').find('.view_ticket').attr('ticket_id', value.ticket_id);
                        $(clone).find('.grid_button').find('.search_btn').attr('ticket_id', value.ticket_id);
                        $('#doing ul').append(clone);
                    });
                } else {
                    $('#doing ul').html('<span>No ticket found here..!!</span>');
                }

            }

        });
    }
    // function for get done task status data...
    function getAllDone(org_id, user_id) {
        var base_url = $('body').find("#base_url").val();
<?php if ($access_level == 1) { ?>
            var url = base_url + "ticketController/getDoneData/" + org_id;
    <?php
} else {
    ?>
            var url = base_url + "ticketController/getDoneData/" + org_id + '/' + user_id;
    <?php
}
?>

        $.ajax({
            url: url,
            success: function (res) {
                $('#done ul').html('');
                if (res != 'No Done')
                {
                    var data = $.parseJSON(res);
                    var ticketStatus = '';
                    $.each(data, function (index, value) {

                        var clone = $('#template').clone();

                        $(clone).attr('id', value.ticket_id);
                        $(clone).attr('data-type', 'Solved');
                        $(clone).attr('data-list', 'Solved_' + value.ticket_id);
                        $(clone).attr('style', '');
                        $(clone).find('input[name="ticket"]').attr('value', value.ticket_id);
                        $(clone).find('#change_status').val("Solved");
                        if (value.ticket_priority == 'normal') {
                            ticketStatus = 'important';
                        }
                        if (value.ticket_priority == 'high') {
                            ticketStatus = 'critical';
                        }
                        if (value.ticket_priority == 'low') {
                            ticketStatus = 'normal';
                        }
                        if (value.ticket_priority == 'urgent') {
                            ticketStatus = 'urgent';
                        }
                        if (value.ticket_description.length >= 410) {
                            var tct_desc = value.ticket_description.substr(0, 410);
                            tct_desc = tct_desc + ' ..........';
                        } else {
                            var tct_desc = value.ticket_description;
                        }
                        $(clone).find('#severity').removeClass('NotSet');
                        $(clone).find('#severity').addClass(ticketStatus);
                        $(clone).find('.task-title').html('<span>' + value.ticket_subject + '</span>');
                        $(clone).find('.task-decs').html(tct_desc);
                        $(clone).find('.grid_button').find('.view_ticket').attr('ticket_id', value.ticket_id);
                        $(clone).find('.grid_button').find('.search_btn').attr('ticket_id', value.ticket_id);
                        $('#done ul').append(clone);
                    });
                }
                else {
                    $('#done ul').append('<span>No ticket found here..!!</span>');
                }

            }

        });
    }

    function changePriority(priority) {
        var base_url = $('body').find("#base_url").val();
        var ticket_id = $('body').find('#single_ticket').val();

        $.ajax({
            'type': 'POST',
            'url': base_url + 'request/changePriority',
            data: {'ticket_id': ticket_id, 'priority': priority},
            success: function (res) {
                var prioClass = '';
                var ticketCalss = '';
                if (res == '1') {
                    if (priority == 'low') {
                        prioClass = 'label-primary ';
                        ticketCalss = 'normal';
                    }
                    if (priority == 'high') {
                        prioClass = 'label-warning';
                        ticketCalss = 'critical';
                    }
                    if (priority == 'normal') {
                        prioClass = 'label-success';
                        ticketCalss = 'important';
                    }
                    if (priority == 'urgent') {
                        prioClass = 'label-danger';
                        ticketCalss = 'urgent';
                    }
                    $('body').find("#ticketPriority").removeClass('label-warning label-danger label-success');
                    $('body').find("#ticketPriority").addClass(prioClass);
                    $('body').find("#ticketPriority").text(priority);
                    var data_list = $('body').find('#ticket_position').val();
                    $('body').find('li[data-list="' + data_list + '"]').children('#severity').removeClass('normal critical important urgent')
                    $('body').find('li[data-list="' + data_list + '"]').children('#severity').addClass(ticketCalss);
                }



            }


        })
    }

    function viewTicket(ticket_id) {
        var base_url = $('body').find("#base_url").val();
        var ticket_id = ticket_id;
        $.ajax({
            url: base_url + "request/ticketDetail/" + ticket_id,
            success: function (res) {

                if (res != '0')
                {
                    var data = $.parseJSON(res);
                    var total_time = parseInt(data.total_time);

                    if (typeof total_time == 'undefined' && total_time == null) {
                        total_time = 0;
                    }
                    var members = '';
                    var priority;
                    $.each(data.ticket_detail, function (index, value) {

                        if (value.ticket_description.length >= 950) {
                            var descriptions = value.ticket_description.substr(0, 950);
                            descriptions = descriptions + '<p>..........</p>';
                        } else {
                            var descriptions = value.ticket_description;
                        }
                        $('body').find("#single_ticket").val(value.ticket_id)
                        $('body').find("#ticketSubject").text(value.ticket_subject)
                        $('body').find("#ticketDesc").html(descriptions);
                        $('body').find("#ticketStatus").text(value.ticket_status)
                        $('body').find("#ticketCreatedBy").html(value.ticket_creater + ' <label class="label label-success text-capitalize">' + data.history.creater_level + '</label>')
                        $('body').find("#ticketCreatedDate").text(value.ticket_created)
                        if (typeof data.ticket_assign_data[0] != "undefined") {
                            $('body').find("#ticketAssignedBy").text(data.ticket_assign_data[0].assigned_by_user);
                            $('body').find("#ticketAssignDate").text(data.ticket_assign_data[0].ticket_assign_at);
                        }
                        $('body').find("#ticketUpdateDate").text(value.ticket_update)
                        $('body').find("#more_detail").attr('ticket_id', value.ticket_id);

                        //open modal for view tickets detail..


                        if (value.ticket_priority == 'normal') {
                            priority = 'label-success';
                        }
                        if (value.ticket_priority == 'high') {
                            priority = 'label-warning';
                        }
                        if (value.ticket_priority == 'low') {
                            priority = 'label-primary';
                        }
                        if (value.ticket_priority == 'urgent') {
                            priority = 'label-danger';
                        }
                        $('body').find("#ticketPriority").addClass(priority);
                        $('body').find("#ticketPriority").text(value.ticket_priority);



                    });

                    $.each(data.ticket_assign_data, function (index, value) {
                        var min = parseInt(value.minutes);
                        var per = 0;

                        if (!isNaN(min) && min != 0) {
                            per = Math.round((min / total_time) * 100);
                        }

                        members += '<div class="col-md-12 col-sm-12 col-xs-12 nopadding"><div class="col-md-2 col-sm-2 col-xs-2 text-right">\n\
                                <img alt="" width="20" height="20" src="' + value.user_image + '"></div><div class="col-md-8 col-sm-8 col-xs-8">\n\
                                        <strong>' + value.assignee + '</strong>\n\
                                        <div class="progress progress_sm"><div data-transitiongoal="' + per + '" role="progressbar" class="progress-bar bg-green" style="width: ' + per + '%;" aria-valuenow="' + per + '">\n\
                                        </div>\n\
                                        </div>\n\
                                        </div>\n\
                                        <div class="col-md-2">\n\
                                        ' + per + '%\n\
                                        </div></div>';


                    });
                    $('body').find("#ticketMembers").html(members)
                    if (typeof data.history[0] != "undefined") {
                        $('body').find("#ticketUpdateBy").text(data.history[0].updated_by_user);
                    }
                } else {

                }
            }

        });
    }



</script>
<style>
    #user_select_chosen.chosen-container-single .chosen-single {
        border-radius: 0px !important;
    }
    .min_hour {
        background-color: #ffffff;
        /*border: 1px solid #dde2e8;*/
        /*border-radius: 4px;*/
        box-shadow: 0 0px 1px rgba(0, 0, 0, 0.075) inset;
        display: block;
        font-size: 14px;
        height: 42px;
        line-height: 1.42857;
        padding-top: 4px !important;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        -moz-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        -webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
        padding-left: 0 !important;
    }
    .min_hour #hour {
        margin-left: 0 !important;
    }
    .times{
        width: 20%;
        float:left; 
        margin:0 6px !important
    }
    .min_hour span.pull-left.text-center {
        padding-top: 4px;
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