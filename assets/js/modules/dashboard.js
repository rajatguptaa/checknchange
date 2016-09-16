    $(document).ajaxStart(function() {
            $(".wait").css("display", "block");
        });

        $(document).ajaxComplete(function() {
            $(".wait").css("display", "none");
        });
$(document).ready(function () {

    var base_url = $("#base_url").val();
    $("#orginasation_search").chosen({width: "85%"});

    var organisation_id = $('.select_organisation').val();
    var url = base_url + "dashboard/supportForum/";
    var method = "POST";
    var data = {organisation_id: organisation_id};
    ajaxRequest(url, method, data, function (data) {
        $('.dashboard_div').html(data);
    });

    $(document).on('change', '#orginasation_search', function () {
        var organisation_id = $('.select_organisation').val();
        var url = base_url + "dashboard/supportForum/";
        var method = "POST";
        var data = {organisation_id: organisation_id};
        ajaxRequest(url, method, data, function (data) {
            $('.dashboard_div').html(data);
        });

    });

    $(document).on('click', '.unpinpost', function () {
        var postid = this.id;
        var obj = $(this);
        console.log(postid);
        var url = base_url + "dashboard/unpinforumpost/";
        var method = "POST";
        var data = {postid: postid};
        ajaxRequest(url, method, data, function (data) {
            if (data) {

                $(obj).closest('.article_pin').fadeOut("normal", function () {
                    $(obj).remove();
                });
            } else {
                //nothing
            }
        });
    });

    
   

         $('body').on('click', '.recentchange', function () {
             var organisation_id = $('.select_organisation').val();
            var recentid = this.id;
            if (recentid == 'overview') {
                categoryorg(organisation_id);
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.recentchange').removeClass('active');
                $(this).addClass('active');
                recentview(organisation_id);
            }




        });
});

    function categoryorg(organisation_id) {
        var base_url = $("#base_url").val();
        var url = base_url + "support/categoryForum/";
        var method = "POST";
        var data = {organisation_id: organisation_id,pagetype:'dashboard'};
        ajaxRequest(url, method, data, function (data) {

            $('.recentsection').html(data);
        });
    }
    
    function recentview(organisation_id){
        
        var base_url = $("#base_url").val();
        var url = base_url + "support/recentpost";
        var method = "POST";
        var data = {organisation_id: organisation_id};
        ajaxRequest(url, method, data, function (data) {

            $('.recentsection').html(data);
        });
        
    }