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
                <?php if ($this->session->flashdata('customer_danger')) : ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('followup_danger'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('followup_success')) : ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('followup_success'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <?php
                        if (access_check("followup", "add")) :
                            ?>
                            <div class="x_title">
                             <!--data-toggle="tooltip" data-placement="right"-->
				 <button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#import"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Import follow up</button>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>

                        <div class="x_content">
                            <table id="example" class="table table-striped responsive-utilities jambo_table pull-left">
                                <thead>
                                    <tr class="headings">
                                        <th>
<!--                                                    <input type="checkbox" class="tableflat">-->
                                            #
                                        </th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <!--<th>Updated At </th>-->
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


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="modal modal-md" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <form data-parsley-validate action="<?php echo base_url('followupController/import'); ?>" method="post" id="create_followup_form">
	  <div class="modal-dialog" role="document">

	       <div class="modal-content">
		    <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <h4 class="modal-title" id="exampleModalLabel">Import File</h4>
		    </div>
		    <div class="modal-body clearfix">

			 <div class="form-group col-md-12">
			      <div class="col-md-2 col-md-offset-1">
				   <label for="recipient-name" class="control-label">File *</label>
			      </div>
			      <div class="col-md-8 col-md-offset-1">
				   <input data-parsley-error-message="The type field is required." required="" type="file" class="form-control" id="user_name" name="import_file" >
				   <ul class="parsley-errors-list filled user_name"><li class="parsley-custom-error-message "></li></ul>
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


<script>


    $(document).ready(function() {
    var asInitVals = new Array();
    var base_url = $("#base_url").val();
        var showhide = true;
        var cat = $("#example").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": true,
            "sAjaxSource": "<?= base_url(); ?>followupController/getTableData",
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
			 console.log('test');
                        var url = "<?= base_url('customerController/deleteCustomer') ?>/";
                        window.location.href = url + "/" + id;
                    }
                }
            });
        });
        
    });


</script>

<!-- footer content -->
