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
            </div>


                    <div class="row">
		    <?php if ($this->session->flashdata('dashboard_danger')) : ?>
     		    <div class="alert alert-danger">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('dashboard_danger'); ?>
     		    </div>
		    <?php endif; ?>
		    <?php if ($this->session->flashdata('dashboard_success')) : ?>
     		    <div class="alert alert-success">
     			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <?php echo $this->session->flashdata('dashboard_success'); ?>
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
						  <label>Latest Amc Due</label>
					     </div>
					</div>
				   </div>
                                   <div class="row">
					<div class="clearfix"></div>
					<div id="amc_ser">
					     <div class="x_content">
						  <table id="amc_service" class="table table-striped responsive-utilities jambo_table pull-left">
						       <thead>
							    <tr class="headings">
								 <th>#
								 </th>
								 <th>Name</th>
								 <th>Contact No.</th>                                        
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
					<input type='hidden' name='base_url' id='base_url' value="<?php echo base_url();?>">
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
						  <label>Latest Amc Complete</label>
					     </div>
					</div>
				   </div>
                                   <div class="row">
					<div class="clearfix"></div>
					<div id="amc_archive">
					     <div class="x_content">
						  <table id="amc_service_history" class="table table-striped responsive-utilities jambo_table pull-left">
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
		    </div>
		    



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
<script>
$(document).ready(function(){
   var base_url = $("#base_url").val();
    var cat = $("#amc_service").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": false,
            "sAjaxSource": "<?= base_url(); ?>dashboardController/getAmcService",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[10, 20, -1], [10, 20, "All"]],
            "iDisplayLength": 10,
            "responsive": true,
	    "searching": false,
	     "paging": false,
            "bSortCellsTop": true,
            "bDestroy": true, //!!!--- for remove data table warning.
            "aoColumnDefs": [
                {"sClass": "eamil_conform aligncenter", "aTargets": [0],orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [1], orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [2],orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [3], orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [4], orderable: false},
            ]}
        );

	var cat = $("#amc_service_history").dataTable({
            "oLanguage": {
                "sProcessing": "<div class='loader-center'><img height='50' width='50' src='" + base_url + "assets/images/ajax-loader_1.gif'></div>"
            },
            "ordering": false,
            "sAjaxSource": "<?= base_url(); ?>dashboardController/history_amc",
            "bProcessing": true,
            "bServerSide": true,
	    "searching": false,
	     "paging": false,
            "aLengthMenu": [[10, 20, -1], [10, 20, "All"]],
            "iDisplayLength": 10,
            "responsive": true,
            "bSortCellsTop": true,
            "bDestroy": true, //!!!--- for remove data table warning.
            "aoColumnDefs": [
                {"sClass": "eamil_conform aligncenter", "aTargets": [0],orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [1], orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [2],orderable: false},
                {"sClass": "eamil_conform aligncenter", "aTargets": [3], orderable: false},
                
            ]}
        );
});
</script>
<!-- footer content -->
