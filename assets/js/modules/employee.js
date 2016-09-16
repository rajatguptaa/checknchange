$(document).ready(function() {
    var base_url = $("#base_url").val();
    $(document).ajaxStart(function() {
        $(".wait").css("display", "block");
    });

    $(document).ajaxComplete(function() {
        $(".wait").css("display", "none");
    });
    filter(1, true);


    $("body").on('click', '.search_button', function() {
        filter(1, true);
    });

    $("body").on('change', '.search_input', function() {

        var input = $(this).val();
        var org_id = $("#orginasation_search").val();
        if (input == '') {
            filter(1, true);
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
        var url = base_url + 'employeeController/filter';
        var method = 'POST';
        var data = {input: org_id}
        ajaxRequest(url, method, data, function(data) {
            $('body').find('#employee').empty();
            var obj = $('body').find('#employee').html(data);
            var count = $(obj).find("#count").val();
            pagination(count);
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

  $("body").on("click", ".delete", function () {
            var id = $(this).attr("id");
            bootbox.confirm("Are you sure?", function (result) {
                if (result) {
                    var url = base_url+'employee/delete' ;
                    window.location.href = url + "/" + id;
                }
            });
        })

});

function filter(offset, flag) {
   
    var base_url = $("#base_url").val();
    var input = $(".search_input").val();
    $('body').find('#search_val').val(input);

    var org_id = $("#orginasation_search").val();

    var url = base_url + 'employeeController/search';
    var method = 'POST';
    var data = {input: input, org_id: org_id, offset: offset}
    ajaxRequest(url, method, data, function(data) {

        $('body').find('#employee').empty();
        var obj = $('body').find('#employee').html(data);
        var count = $(obj).find("#count").val();

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

    filter(obj, false);
}


