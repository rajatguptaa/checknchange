 $(document).ready(function () {
          var base_url = $("#base_url").val();
        $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
  
      
        $(".select_organisation").chosen({width: "85%", });
        var org_id = $("#orginasation_search").val();
        $('#organisation_id').val(org_id);
        
        
        // organisation change
        
         $("body").on('change', '.select_organisation', function () {
            var org_id = $(this).val();
            $('#organisation_id').val(org_id);
        });
        
        // submit report form
        
        $('.report').click(function(){
           var type= $(this).attr('type');
           var heading= $(this).text();
           var url = base_url+'report/' +type; 

           $('#report_type').val(type);
           $('#report_heading').val(heading);
           $('#report_form').attr('action',url);
           $('#report_form').submit();
           
           
        });
        
      
        
        
  });

