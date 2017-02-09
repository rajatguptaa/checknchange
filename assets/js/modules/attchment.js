$(document).ready(function () {
      var arr = new Array(); 
      $("#attach_ids").val('');
  
        var base_url = $("#base_url").val();
        $("#image").fileinput({
        uploadUrl: base_url+'common/upload_attachment',
        uploadAsync: true,
        overwriteInitial: false,
         showUpload: false,
         showRemove: false,
        });
         $image = $('#image');
         
         $image.on('fileuploaded', function(event, data, previewId, index) {
          var form = data.form, files = data.files, extra = data.extra,
          response = data.response, reader = data.reader;
          
         
        arr.push(response.attchment_id); 
        $("#attach_ids").val(arr);
        $("#pre_ids").val(arr);
        $("#"+previewId).attr("response_id",response.attchment_id);
    }).on("filebatchselected", function(event, files) {
    $image.fileinput("upload");
});
    
       
    $(document).on("click", ".kv-file-remove",function (){
         var del_id =  $(this).parents(".file-preview-frame").attr("response_id");
           var url = base_url+'common/delete_attachment';
         
           ajaxRequest(url,'POST',{id:del_id}, function(data) {
           if(data==1){
            var attchstr = $('body').find("#attach_ids").val();  
         
            var new_string = remove(attchstr,del_id);   
           
            $('body').find("#attach_ids").val('');
            $('body').find("#attach_ids").val(new_string);
           }
        });
    });
    
    $image.on("filepredelete", function(jqXHR) {
    console.log($(this).parents(".file-preview-frame").attr("response_id"));
        // you can also send any data/object that you can receive on `filecustomerror` event
});

   var pre_ids = $("#pre_ids").val();
   if(pre_ids!=''){
       var url = base_url+'common/delete_attachment'; 
      ajaxRequest(url,'POST',{id:pre_ids}, function(data) {});  
   }
   
   
    $('body').find("#cancel").click(function(){
  
  var pre_ids = $("#pre_ids").val();
 
   if(pre_ids!=''){
       var url = base_url+'common/delete_attachment'; 
      ajaxRequest(url,'POST',{id:pre_ids}, function(data) {});  
   }
    });
    
 


  });
  
  