$(document).ready(function() {

    $(document).on('input', '#search_by_text', function(e) {
        make_search();
    });
    $(document).on('change', '#inv_itemcard_categories_id_search', function(e) {
        make_search();
    });

    
    function make_search() {
        var search_by_text = $("#search_by_text").val();
        var inv_itemcard_categories_id = $("#inv_itemcard_categories_id_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                inv_itemcard_categories_id: inv_itemcard_categories_id,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    }

    $(document).on('click', '#ajax_pagination_in_search a ', function(e) {
        e.preventDefault();
        var search_by_text = $("#search_by_text").val();
        var inv_itemcard_categories_id = $("#inv_itemcard_categories_id_search").val();
        var token_search = $("#token_search").val();
        var url = $(this).attr("href");
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                item_type: item_type,
                inv_itemcard_categories_id: inv_itemcard_categories_id,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    });
 





    $(document).on('change', '#inv_itemcard_categories_id_search', function(e) {
        var inv_itemcard_categories_id = $("#inv_itemcard_categories_id_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                inv_itemcard_categories_id: inv_itemcard_categories_id,
                "_token": token_search,
            },
            success: function(data) {
                $("#inv_itemcard_ajax").html(data);
                $(".select2").select2();
            },
            error: function() {}
        });
    });
    
    $(document).on('click', '#btn_edit', function(e) {
var dataRaw = $(this).closest('tr').find('td');
var id = $(this).closest('tr').data('id');
var productId = $(this).closest('tr').data('product');
var name = $(dataRaw[1]).text();
var quantity = $(dataRaw[2]).text();
$('#quantityEdit').val(quantity);
$('#id').val(id);
$('#inv_itemcardOption').text(name);
$('#inv_itemcardOption').val(productId);
    });


    $(document).on('change', '#inv_itemcard_categories_id_search_edit', function(e) {
        var inv_itemcard_categories_id = $("#inv_itemcard_categories_id_search_edit").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url_edit").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                inv_itemcard_categories_id: inv_itemcard_categories_id,
                "_token": token_search,
            },
            success: function(data) {
                $("#inv_itemcard_ajax_edit").html(data);
                $(".select2").select2();
            },
            error: function() {}
        });
    });


    


});