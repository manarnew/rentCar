$(document).ready(function() {
    $(document).on('input', '#search_by_text', function(e) {
        make_search();
    });
    $(document).on('change', '#approve_search', function(e) {
        make_search();
    });
    $(document).on('change', '#from_date_search', function(e) {
        make_search();
    });
    $(document).on('change', '#to_date_search', function(e) {
        make_search();
    });

    function make_search() {
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        var search_by_text = $("#search_by_text").val();
        var approve_search = $("#approve_search").val();
        var from_date_search = $("#from_date_search").val();
        var to_date_search = $("#to_date_search").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token_search,
                ajax_search_url: ajax_search_url,
                search_by_text: search_by_text,
                approve_search: approve_search,
                from_date_search: from_date_search,
                to_date_search: to_date_search
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
        var search_by_text = $("#search_by_text").val();
        var approve_search = $("#approve_search").val();
        var from_date_search = $("#from_date_search").val();
        var to_date_search = $("#to_date_search").val();
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
                approve_search: approve_search,
                from_date_search: from_date_search,
                to_date_search: to_date_search
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    });
});