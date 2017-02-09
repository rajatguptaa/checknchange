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
			     <button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#import"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Import follow up</button><a  target="_blank" class="btn btn-info pull-right btn-xs"  href="<?php echo base_url('/followup.csv');?>">Download Demo CSV</a>
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
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Work Requirement</th>
                                        <th>Status</th>
                                        <th>Notes </th>
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



<div class="modal modal-md" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <form data-parsley-validate action="<?php echo base_url('followupController/import'); ?>" enctype="multipart/form-data" method="post" id="create_followup_form">
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


<div class="modal modal-md" id="followstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     
	  <div class="modal-dialog" role="document">

	       <div class="modal-content">
		    <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <h4 class="modal-title" id="exampleModalLabel">Status Change</h4>
		    </div>
		    <div class="modal-body clearfix">

			 <div class="form-group col-md-12">
			      <div class="col-md-2 col-md-offset-1">
				   <label for="recipient-name" class="control-label">Status *</label>
			      </div>
			      <div class="col-md-8 col-md-offset-1">
				   <select id="status" class="form-control">
					<option value="1">Primary</option>
					<option value="2">Secondary</option>
					<option value="3">Final</option>
				   </select>
			      </div>
			      <input type="hidden" id="status_id" value=""/>
			 </div>
			
			 
			 

			 
		    </div>
		    <div class="modal-footer">
			 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			 <button type="button" class="btn btn-success btn-sm status_model">Submit</button>
		    </div>
	       </div>
	  </div>

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
                {"sClass": "eamil_conform aligncenter", "aTargets": [1]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [2]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [3]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [4]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [5]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [6]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [7]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [8], orderable: false, 'render': function(data, type, row) {
                        return data;
                    }
                },
            ],  "fnDrawCallback": function () {
		    $('body').find('.red').closest('tr').css('background-color', 'red');
		    $('body').find('.green').closest('tr').css('background-color', 'green');
		    $('body').find('.yellow').closest('tr').css('background-color', 'yellow');
	       }}
        );
	
	$('body').on('click','.change-status',function(){
	  var id =  $(this).attr('data_id');  
	$('#status_id').val(id);
     });

      $('body').on('click','.status_model',function(){
	var id = $('#status_id').val();   
	var status = $('#status').val();
	
	
		  $.ajax({
	    type: "POST",
	    url: base_url+'followupController/change',
	    data: {id:id,status:status},
	    cache: false,
	    success: function(data){
		 var data = $.parseJSON(data);
	       if(data.result){
		     $('#followstatus').modal('hide');
		    cat.fnDraw();
	       }else{
		     $('#followstatus').modal('hide');
		    cat.fnDraw();
		    
	       }
	    }
	  });
	
     });
        
    });


</script>

<!-- footer content -->
