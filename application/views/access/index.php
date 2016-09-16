<div role="main">
    <div class="" >
        <div class="">
<!--            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo $mainHeading; ?></h3>
                </div>
            </div>
            <div class="clearfix"></div>-->
            <div class="row">
                <?php if ($this->session->flashdata('access_danger')) : ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('access_danger'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('access_success')) : ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('access_success'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form method="post" action="<?php echo base_url() . 'accessController/edit'; ?>" id="edit_access_form">

                                <div class="row">
                                    <div class="col-md-4 col-sm-5 col-xs-12">
                                        <span class="section">Permission Group</span>

                                        <table class="table table-striped responsive-utilities jambo_table dataTable no-footer dtr-inline" id="access_level">
                                            <thead>
                                                <tr>
                                                    <th>Permission</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($access_level)) :
                                                    foreach ($access_level as $val) :
                                                        ?>
                                                        <tr id="<?= $val['access_level_id'] ?>">
                                                            <td><?= ucfirst($val['access_level_name']) ?></td>
                                                            <td><?= $val['access_level_description'] ?></td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                else :
                                                    ?>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                    </tr>
                                                <?php
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-8 col-sm-7 col-xs-12" id="access_div">
                                        <span class="section">Permission</span>
                                        <table id="access" class="table table-striped responsive-utilities jambo_table dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th>View</th>
                                                    <th>Add</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group pull-right">
                                        
                                        <button id="send" type="submit" class="btn btn-sm btn-success">Update</button>
                                    </div>
                                </div>
                            </form></div>
                    </div>
                </div>

                <br />
                <br />
                <br />

            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {

        var base_url = $("#base_url").val();
        var level_id = 0;

        var access_table = $("body").find("#access").dataTable({
            "ordering": false,
            "searching": false,
            "paging": false,
            "sAjaxSource": base_url + "accessController/getTableData",
            "bProcessing": true,
            "bServerSide": true,
            "bInfo": false,
            "responsive": true,
            "bSortCellsTop": true,
            "bDestroy": true, //!!!--- for remove data table warning.
            "fnServerParams": function (aoData) {
                aoData.push({"name": "access_level", "value": level_id});
            },
            "fnDrawCallback": function (oSettings) {
                $("body").find('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            },
            "oLanguage": {
                "sEmptyTable": "Please select a access level.",
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "aoColumnDefs": [
                {"sClass": "", "aTargets": [0]},
                {"sClass": "", "aTargets": [1], orderable: false},
                {"sClass": "", "aTargets": [2]},
                {"sClass": "", "aTargets": [3], orderable: false},
                {"sClass": "", "aTargets": [4]}
            ]}
        );

        $("body").on("click", "#access_level tr",function () {
            level_id = $(this).attr("id");
            $("body").find("#access_level").find(".selected").removeClass("selected");
            $(this).addClass("selected");
            access_table.fnDraw();

        });

        var options = {
            beforeSend: function ()
            {

            },
            success: function (data) {
                var dataArray =  $.parseJSON(data);
                
                var n = noty({
                    text: dataArray.message,
                    type: dataArray.type,
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

            },
            //complete: this function is called when the form upload is completed.
            complete: function (response)
            {

            },
        }

        $('body').find('#edit_access_form').ajaxForm(options);
        $(document).ajaxStart(function () {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function () {
            $(".wait").css("display", "none");
        });
    });

</script>
<style>
    #access_level tr {
        cursor: pointer;
    }
</style>
<!-- footer content -->
