$(document).ready(function() {
    $(document).on('change', '#delivered', function(e) {
        make_search();
    });
    function make_search() {
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        var search_by_text = $("#delivered").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token_search,
                ajax_search_url: ajax_search_url,
                search_by_text: search_by_text,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    }
    $(document).on('click', '#ajax_pagination_in_search a ', function(e) {
        e.preventDefault();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        var search_by_text = $("#delivered").val();
        var url = $(this).attr("href");
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token_search,
                ajax_search_url: ajax_search_url,
                search_by_text: search_by_text,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    });
});