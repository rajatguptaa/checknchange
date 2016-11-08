<?php
$loginuser = $this->session->userdata('logged_in');
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

			 </div>
		    </div>
	       </div>
	       <div class="clearfix"></div>
	       
	       <div class="row">
		    <?php if ($this->session->flashdata('archive_danger')) : ?>
     		    <div class="alert alert-danger">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('archive_danger'); ?>
     		    </div>
		    <?php endif; ?>
		    <?php if ($this->session->flashdata('archive_success')) : ?>
     		    <div class="alert alert-success">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('archive_success'); ?>
     		    </div>
		    <?php endif; ?>
	       </div>
	       <div class="row">
		    <div class="col-md-6">
			 <div class="x_panel">
			      <div class="x_content">
				   <div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
					     <div class="title_right">
						  <label>Archive Employee</label>
					     </div>
					</div>
				   </div>
                                   <div class="row">
					<div class="clearfix"></div>
					<div id="amc_archive">
					     <div class="x_content">
						  <table id="example" class="table table-striped responsive-utilities jambo_table pull-left">
						       <thead>
							    <tr class="headings">
								 <th>#
								 </th>
								 <th>Name</th>
								 <th>Contact No.</th>                                        
								 <th class=" no-link last"><span class="nobr">Action</span>
								 </th>
							    </tr>
						       </thead>
						       <tbody>
						       </tbody>
						  </table>
					     </div>
					</div>
					<input type='hidden' name='search_val' id='search_val'>
				   </div>

			      </div>
			      <div class="row">&nbsp;</div>
			      <div class="row">&nbsp;</div>
			      <div class="col-md-12 col-sm-12 col-xs-12 pagination_div pagination pagination-split center text-center">

			      </div>
			 </div>
		    </div>
		    <div class="col-md-6">
			 <div class="x_panel">
			      <div class="x_content">
				   <div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
					     <div class="title_right">
						  <label>Archive Customer </label>
					     </div>
					</div>
				   </div>
                                   <div class="row">
					<div class="clearfix"></div>
					<div id="amc_archive">
					     <div class="x_content">
						  <table id="example_1" class="table table-striped responsive-utilities jambo_table pull-left">
						       <thead>
							    <tr class="headings">
								 <th>#
								 </th>
								 <th>Name</th>
								 <th>Contact No.</th>                                        
								 <th class=" no-link last"><span class="nobr">Action</span>
								 </th>
							    </tr>
						       </thead>
						       <tbody>
						       </tbody>
						  </table>
					     </div>
					</div>
					<input type='hidden' name='search_val' id='search_val'>
				   </div>

			      </div>
			      <div class="row">&nbsp;</div>
			      <div class="row">&nbsp;</div>
			      <div class="col-md-12 col-sm-12 col-xs-12 pagination_div pagination pagination-split center text-center">

			      </div>
			 </div>
		    </div>
		    <div class="col-md-6">
			 <div class="x_panel">
			      <div class="x_content">
				   <div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
					     <div class="title_right">
						  <label>Archive Amc </label>
					     </div>
					</div>
				   </div>
                                   <div class="row">
					<div class="clearfix"></div>
					<div id="amc_archive">
					     <div class="x_content">
						  <table id="example_2" class="table table-striped responsive-utilities jambo_table pull-left">
						       <thead>
							    <tr class="headings">
								 <th>#</th>
								 <th>Name</th>
								 <th>Amc Type</th>                                        
								 <th class=" no-link last"><span class="nobr">Action</span>
								 </th>
							    </tr>
						       </thead>
						       <tbody>
						       </tbody>
						  </table>
					     </div>
					</div>
					<input type='hidden' name='search_val' id='search_val'>
				   </div>

			      </div>
			      <div class="row">&nbsp;</div>
			      <div class="row">&nbsp;</div>
			      <div class="col-md-12 col-sm-12 col-xs-12 pagination_div pagination pagination-split center text-center">

			      </div>
			 </div>
		    </div>
		    
	       </div>
	  </div>

     </div>
</div>
<div class="clearfix"></div>

<div class="clearfix"></div>
<style>
     .top_search .search_button {
	  color:#ffffff !important;
     }

</style>
<script>

$(document).ready(function(){
   var base_url = $("#base_url").val();
    var cat = $("#example").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": true,
            "sAjaxSource": "<?= base_url(); ?>archiveController/getArchiveEmp",
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
                {"sClass": "eamil_conform aligncenter", "aTargets": [3], orderable: false},
            ]}
        );
	//exmple 1
	  var cat = $("#example_1").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": true,
            "sAjaxSource": "<?= base_url(); ?>archiveController/getArchivecus",
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
                {"sClass": "eamil_conform aligncenter", "aTargets": [3], orderable: false},
            ]}
        );
   
	//exmple 2 
	  var cat = $("#example_2").dataTable({
            "oLanguage": {
            "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": true,
            "sAjaxSource": "<?= base_url(); ?>archiveController/getArchiveamc",
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
                {"sClass": "eamil_conform aligncenter", "aTargets": [3], orderable: false},
            ]}
        );
   
   
	$('body').on('click','.delete',function(){
	  var  table =   $(this).attr('table-id');
	  var id  = $(this).attr('data-id');
	
	  window.location.href  = base_url+'archiveController/restore/'+table+'/'+id;
     });
});


</script>