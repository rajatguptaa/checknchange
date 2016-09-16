<div class="right_col" role="main">
    <div class="container" >
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo $mainHeading; ?></h3>
                </div>
            </div>
            <div class="clearfix"></div>
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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <?php
                        if (access_check("ticket", "add")) :
                            ?>
                            <div class="x_title">
                              <a href="<?php echo base_url() . 'request/customer/add'; ?>" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Add Ticket"><i class="fa fa-plus-circle">
                            </i>&nbsp;&nbsp;Add Ticket</a>
                                <?php 
                              
                                
                                ?>
                                <div class="pull-right">
                                    <a href="<?php echo base_url("request/detail"); ?>" class="active">Detailed list</a> | 
                                    <a  href="<?php echo base_url("request"); ?>">Compact list</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="x_content">
                            <table id="ticket_table" class="table table-striped responsive-utilities jambo_table pull-left">
                                <thead>
                                    <tr class="headings">
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Updated At</th>
                                        <th class=" no-link last"><span class="nobr">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
   var asInitVals = new Array();
    var base_url = $("#base_url").val();

    $(document).ready(function() {
        var showhide = true;
        var cat = $("#ticket_table").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": true,
            "sAjaxSource": "<?= base_url(); ?>ticketController/getCustomerTicket",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[10, 20, -1], [10, 20, "All"]],
            "iDisplayLength": 10,
            "responsive": true,
            "bSortCellsTop": true,
            "bDestroy": true, //!!!--- for remove data table warning.
            "aoColumnDefs": [
                {"sClass": "eamil_conform aligncenter", "aTargets": [0]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [1], orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [2]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [3]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [4], orderable: false, 'render': function(data, type, row) {
                        return data;
                    }
                },
            ]}
        );


        $("body").on("click", ".delete", function() {
            var id = $(this).attr("data-id");
           
            bootbox.confirm({
                size: 'small',
                message: "Are you sure?",
                callback: function(result) {
                    if (result) {
                        var url = "<?= base_url('ticketController/deleteTicket') ?>";
                        window.location.href = url + "/" + id;
                    }
                }
            });
        });
        
    });


</script>
<style>
    .active{
       color:#1ABB9C;
       font-weight:bold;
    }
    
</style>

<!-- footer content -->
