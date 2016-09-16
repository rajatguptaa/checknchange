$(document).ready(function() {
    var base_url = $("#base_url").val();
    $(document).ajaxStart(function() {
        $(".wait").css("display", "block");
    });

    $(document).ajaxComplete(function() {
        $(".wait").css("display", "none");
    });

    var customer_type = $('body').find('#customer_type').val();
    if (customer_type == 1) {
        var type = 1;
    }
    else {
        var type = 2;
    }

    filter(1, true, type);


    $("body").on('click', '.search_button', function() {
        filter(1, true, type);
    });

    $("body").on('change', '.search_input', function() {

        var input = $(this).val();
        var customer_type = $('body').find('#customer_type').val();
        var org_id = $("#orginasation_search").val();
        if (input == '') {
            filter(1, true, type);
        }
    });

    $(".select_organisation").chosen({width: "85%", });

    $("body").on('change', '#orginasation_search', function() {
        $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });


        $('body').find('.search_input').val('');
        var org_id = $(this).val();
        var url = base_url + 'customerController/filter';
        var method = 'POST';
        var data = {input: org_id, customer_type: type}
        ajaxRequest(url, method, data, function(data) {
            $('body').find('#customer').empty();
            var obj = $('body').find('#customer').html(data);
            var count = $(obj).find("#count").val();
            pagination(count);
            if($('body').find('#customer > div').length!=0){
              $('body').find('.selected_approval').css('display','inline-block');  
              $('body').find('.approve_all').css('display','inline-block');  
            }
            else{
              $('body').find('.selected_approval').css('display','none');  
              $('body').find('.approve_all').css('display','none');  
            }
        });

    });
    var count = $('body').find("#count").val();
    $('body').find('.pagination_div').pagination({
        items: count,
        itemsOnPage: 1,
        cssStyle: 'light-theme'
    });


    $('body').find('.pagination_div').pagination('nextPage');

// delete user
    $("body").on("click", ".delete", function() {
        var id = $(this).attr("id");
        bootbox.confirm({
            size: 'small',
            message: "Are you sure?",
            callback: function(result) {
                if (result) {
                    var url = base_url + 'customer/delete';
                    window.location.href = url + "/" + id + "/" + type;
                }
            }
        });

// approve single user
    });
    $("body").on("click", ".approve", function() {
        var id = $(this).attr("id");
        bootbox.confirm({
            size: 'small',
            message: "Do you want to approve this user?",
            callback: function(result) {
                if (result) {
                    var url = base_url + 'customer/approve';
                    window.location.href = url + "/" + id;
                }
            }
        });
    });

// approve all user
    $("body").on("click", ".approve_all", function() {
        var id = $(this).attr("id");
        bootbox.confirm({
            size: 'small',
            message: "Do you want to approve all user?",
            callback: function(result) {
                if (result) {
                    var url = base_url + 'customer/approve/all';
                    window.location.href = url;
                }
            }
        });
    });
    
    // selected approval
   
    $("body").on("click", ".unapproved", function() {
       $(this).toggleClass('box_selected');
     });
     
      $("body").on("click", ".selected_approval", function() {
        var id = $(this).attr("id");
        bootbox.confirm({
            size: 'small',
            message: "Do you want to approve selected user?",
            callback: function(result) {
                if (result) {
                     var obj = $('#customer').children().children();
                     var ids = [];
                     $.each( obj, function( key, value ) {
                        if($(this).hasClass('box_selected')){
                        ids[key]  = $(this).attr('data-id');
                        }
                     });
                     
                     var url = base_url + 'customer/approve/selected';
                     var method = 'POST';
                     var data = {id:ids}
                     ajaxRequest(url, method, data, function(data) {
                         if(data){
                        window.location.href = base_url + 'customer';
                         }
                     });
                }
            }
        });
    });
    
   
 

});

function filter(offset, flag, type) {

    var base_url = $("#base_url").val();
    var input = $(".search_input").val();
    $('body').find('#search_val').val(input);

    var org_id = $("#orginasation_search").val();

    var url = base_url + 'customerController/search';
    var method = 'POST';
    var data = {input: input, org_id: org_id, offset: offset, customer_type: type}
    ajaxRequest(url, method, data, function(data) {

        $('body').find('#customer').empty();
        var obj = $('body').find('#customer').html(data);
        var count = $(obj).find("#count").val();
          if($('body').find('#customer > div').length!=0){
              $('body').find('.selected_approval').css('display','inline-block');  
              $('body').find('.approve_all').css('display','inline-block');  
            }
            else{
              $('body').find('.selected_approval').css('display','none');  
              $('body').find('.approve_all').css('display','none');  
            }
        if (flag)
            pagination(count);
    });

}

function pagination(count) {
    if (count != 0 && typeof(count) != 'undefined') {
        $('body').find('.pagination_div').pagination({
            items: count,
            itemsOnPage: 9,
            cssStyle: 'light-theme'
        });
    }
    else {
        $('body').find('.pagination_div').pagination('destroy');
    }
}

function pagechange(obj) {
      var customer_type = $('body').find('#customer_type').val();
    if (customer_type == 1) {
        var type = 1;
    }
    else {
        var type = 2;
    }
    filter(obj, false,type);
}


