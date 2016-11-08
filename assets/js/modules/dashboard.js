    $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
$(document).ready(function () {

    var base_url = $("#base_url").val();
    
    
      var cat = $("#amc_service").dataTable({
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
                {"sClass": "eamil_conform aligncenter", "aTargets": [4], orderable: false},
            ]}
        );
    
    
    
    });