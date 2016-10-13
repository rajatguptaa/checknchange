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
                                        <th>Input</th>
                                        <th>
<!--                                                    <input type="checkbox" class="tableflat">-->
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
                                        <th></th> 
                                        <th><select id="amc_name"><option value=""></option>
					     <?php $amc = getAMC(1);
					     if(!empty($amc)){
						  foreach ($amc as $value) {  
						  ?>
						  <option value="<?php echo $value['id'];?>"><?php echo $value['amc_name']?></option>
						  <?php
					     }}
					     
					     ?>
					     </select></th>
					     <th><select id="customer_name"><option value=""></option>
						    <?php $user = getUserByAccessLevel(4);
					     if(!empty($user)){
						  foreach ($user as $value) {  
						  ?>
						  <option value="<?php echo $value['user_id'];?>"><?php echo $value['first_name']?></option>
						  <?php
					     }}
					     
					     ?>
						  </select></th>
                                        <th></th>
                                        <th></th>
                                        <th>
					     <select id="customer_email"><option value=""></option>
					         <?php $user = getEmail(4);
					     if($user){
						  foreach ($user as $value) {  
						  ?>
						  <option value="<?php echo $value['user_id'];?>"><?php echo $value['user_email']?></option>
						  <?php
					     }}
					     
					     ?>
					     </select></th>
					     <th><select id="service_date"><option value=""></option>
						      <?php $date = getServiceDate();
					     if($date){
						  foreach ($date as $value) {  
						  ?>
						  <option value="<?php echo $value['due_date'];?>"><?php echo $value['due_date']?></option>
						  <?php
					     }}
					     
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
<script>

    var asInitVals = new Array();
    var base_url = $("#base_url").val();

    $(document).ready(function() {
        var showhide = true;
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
                {"sClass": "eamil_conform aligncenter", "aTargets": [7]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [8]},
                {"sClass": "eamil_conform aligncenter", "aTargets": [9], orderable: false, 'render': function(data, type, row) {
                        return data;
                    }
                },
            ],"fnDrawCallback": function () {
		$('body').find('.due_date_color').closest('tr').css('background-color','#FF6666'); 
	    }}
        );

	 $("body").on("change", "#amc_name", function () {
	      
            cat.column(3)
                    .search(this.value)
                    .draw();
        });
	 $("body").on("change", "#customer_name", function () {
	      
            cat.column(4)
                    .search(this.value)
                    .draw();
        });
	 $("body").on("change", "#customer_email", function () {
	      
            cat.column(7)
                    .search(this.value)
                    .draw();
        });
	 $("body").on("change", "#service_date", function () {
	      
            cat.column(8)
                    .search(this.value)
                    .draw();
        });
	 $("body").on("change", "#customer_type", function () {
	      
            cat.column(9)
                    .search(this.value)
                    .draw();
        });
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
