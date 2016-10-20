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
		    <?php if ($this->session->flashdata('service_danger')) : ?>
     		    <div class="alert alert-danger">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('service_danger'); ?>
     		    </div>
		    <?php endif; ?>
		    <?php if ($this->session->flashdata('service_success')) : ?>
     		    <div class="alert alert-success">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('service_success'); ?>
     		    </div>
		    <?php endif; ?>
	       </div>
	       <div class="row">
		    <div class="col-md-12 col-sm-12 col-xs-12">
			 <div class="x_panel">


			      <div class="x_content">
				   <table id="example" class="table table-striped responsive-utilities jambo_table pull-left">
					<thead>
					     <tr class="headings">
						 <!--<th>Input</th>-->
						  <th>
							      <!--<input type="checkbox" class="tableflat">-->
						       #
						  </th>
						  <th>Amc Name</th>
						  <th>Customer Name</th>
						  <th>Address</th>
						  <th>Phone</th>
						  <th>Email</th>
						  <th>Service Date</th>
						  <th>Customer Type</th>
						  <!--<th>Updated At </th>-->
						  <th class=" no-link last"><span class="nobr">Action</span>
						  </th>
					     </tr>
					     <tr>
						  <th></th>
	  <!--                                        <th></th> -->
						  <th><select id="amc_name"><option value=""></option>
							    <?php
							    $amc = getAMCByFilter(1);
							    if (!empty($amc)) {
								 foreach ($amc as $value) {
								      ?>
	  							    <option value="<?php echo $value['id']; ?>"><?php echo $value['amc_name'] ?></option>
								      <?php
								 }
							    }
							    ?>
						       </select></th>
						  <th><select id="customer_name"><option value=""></option>
							    <?php
							    $user = getUserByAccess(4);
							    if (!empty($user)) {
								 foreach ($user as $value) {
								      ?>
	  							    <option value="<?php echo $value['user_id']; ?>"><?php echo $value['first_name'].' '.$value['last_name'] ?></option>
								      <?php
								 }
							    }
							    ?>
						       </select></th>
						  <th></th>
						  <th></th>
						  <th>
						       <select id="customer_email"><option value=""></option>
							    <?php
							    $user = getEmail(4);
							    if ($user) {
								 foreach ($user as $value) {
								      ?>
	  							    <option value="<?php echo $value['user_id']; ?>"><?php echo $value['user_email'] ?></option>
								      <?php
								 }
							    }
							    ?>
						       </select></th>
						  <th><select id="service_date"><option value=""></option>
							    <?php
							    $date = getServiceDate();
							    if ($date) {
								 foreach ($date as $value) {
								      ?>
							    <option value="<?php echo $value['due_date']; ?>"><?php echo date('d-M-Y',  strtotime($value['due_date'])) ?></option>
								      <?php
								 }
							    }
							    ?>
						       </select></th>
						  <th><select id="customer_type"><option value=""></option><option value="premium">Premium</option><option value="regular">Regular</option></select></th>
						  <th></th> 
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

<!-- Modal -->
<div id="completeModel" class="modal fade" role="dialog">
     <div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	       <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal">&times;</button>
		    <h4 class="modal-title">Complete Service</h4>
	       </div>
	       <div class="modal-body">
		    <form id="completeForm" class="">
			 <div class="item form-group">
			      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_notes">Service Name
			      </label>

			      <div class="col-md-6 col-sm-6 col-xs-12 service_name">
			      </div>
			 </div>
			 <div class="clearfix"></div>
			 <div class="item form-group">
			      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_notes">Service Due Date
			      </label>
			      <div class="col-md-6 col-sm-6 col-xs-12 service_due">

			      </div>
			      <input type="hidden" id="due_date" name="due_date" /> 
			      <input type="hidden" id="amc_id" name="amc_id" /> 
			      <input type="hidden" id="user_id" name="user_id" /> 
			      <input type="hidden" id="referenceby" name="referenceby" /> 
			      <input type="hidden" id="start_date" name="start_date" /> 
			      <input type="hidden" id="notes" name="notes" /> 
			      <input type="hidden" id="amc_sevice_id" name="amc_sevice_id" /> 
			 </div>
			 <div class="clearfix"></div>
			 <div class="item form-group">
			      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_notes">Notes
			      </label>
			      <div class="col-md-6 col-sm-6 col-xs-12">
				   <textarea id="amc_complete_notes" placeholder="" name="user_note" class="form-control col-md-7 col-xs-12"><?php echo set_value('user_note'); ?></textarea>
			      </div>
			 </div>
		    </form>
		    <div class="clearfix"></div>
	       </div>
	       <div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    <button type="button" class="btn btn-primary completecheckbtn" onClick="return completeCheck()">Complete</button>
	       </div>
	  </div>
	  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>"/>
     </div>
</div>
 
<script>

     var asInitVals = new Array();
     var base_url = $("#base_url").val();

     $(document).ready(function () {
	  var showhide = true;
	  var cat = $("#example").DataTable({
	       "oLanguage": {
		    "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
	       },
	       "dom": 'T<"clear">lfrtip',
	       tableTools: {
		    "sSwfPath": "http://localhost/checknchange_latest/checknchange/assets/js/datatables/tools/swf/copy_cvs_xls_pdf.swf",
	       },
	       "ordering": true,
	       "sAjaxSource": "<?= base_url(); ?>serviceController/getTableData",
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
		    {"sClass": "eamil_conform aligncenter", "aTargets": [7], orderable: false, 'render': function (data, type, row) {
			      return data;
			 }
		    },
	       ], "fnDrawCallback": function () {
		    $('body').find('.due-cls').closest('tr').css('background-color', '#FF6666');
	       }}
	  );

	  $("body").on("change", "#amc_name", function () {

	       cat.column(2)
		       .search(this.value)
		       .draw();
	  });
	  $("body").on("change", "#customer_name", function () {

	       cat.column(3)
		       .search(this.value)
		       .draw();
	  });
	  $("body").on("change", "#customer_email", function () {

	       cat.column(6)
		       .search(this.value)
		       .draw();
	  });
	  $("body").on("change", "#service_date", function () {

	       cat.column(7)
		       .search(this.value)
		       .draw();
	  });
	  $("body").on("change", "#customer_type", function () {
	       console.log(this.value);
	       cat.column(8)
		       .search(this.value)
		       .draw();
	  });

	  $('body').on('click', '.completeCheck', function () {
	       var data_name = $(this).attr('data_name');
	       var data_due = $(this).attr('data_due');
	       var user_id = $(this).attr('userid');
	       var amc_id = $(this).attr('amc_id');
	       var amc_note = $(this).attr('amc_note');
	       var start_date = $(this).attr('start_date');
	       var notes = $(this).attr('notes');
	       var referenceby = $(this).attr('referenceby');
	       var amc_sevice_id = $(this).attr('amc_sevice_id');
	       $('body').find('.service_name').html(data_name);
	       $('body').find('.service_due').html(data_due);
	       $('body').find('#due_date').val(data_due);
	       $('body').find('#user_id').val(user_id);
	       $('body').find('#amc_id').val(amc_id);
	       $('body').find('#amc_note').val(amc_note);
	       $('body').find('#referenceby').val(referenceby);
	       $('body').find('#amc_sevice_id').val(amc_sevice_id);
	       $('body').find('#start_date').val(start_date);
	       $('body').find('#notes').val(notes);
	  });
     });

     function completeCheck() {
	  var notes = $('#amc_complete_notes').val();
	  var base_url = $('#base_url').val();
	  var form = $('#completeForm').serialize();
	  if (notes != "") {
	  $('.completecheckbtn').attr('disabled', 'disabled');
	       $.ajax({
		    url: base_url + 'serviceController/completeService',
		    type: 'POST',
		    data: form,
		    success: function (data) {
			 var data = $.parseJSON(data);
			 $('.completecheckbtn').removeAttr('disabled');
			 if (data.result) {
			      $('#completeModel').modal('hide');


			      var cat = $("#example").DataTable({
				   "oLanguage": {
					"sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
				   },
				   "dom": 'T<"clear">lfrtip',
				   "tableTools": {
					"sSwfPath": "/swf/copy_csv_xls_pdf.swf"
				   },
				   "ordering": true,
				   "sAjaxSource": "<?= base_url(); ?>serviceController/getTableData",
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
					{"sClass": "eamil_conform aligncenter", "aTargets": [7], orderable: false, 'render': function (data, type, row) {
						  return data;
					     }
					},
				   ], "fnDrawCallback": function () {
					$('body').find('.due-cls').closest('tr').css('background-color', '#FF6666');
				   }}
			      );
			 } else {

			 }
		    }
	       });
	  } else {

	       $('#amc_complete_notes').css('border', '1px solid #DE9FAB');
	       
//	       $(this).effect('shake', {times: 3, distance: 5}, "fast");



	  }

     }
</script>

<!-- footer content -->
