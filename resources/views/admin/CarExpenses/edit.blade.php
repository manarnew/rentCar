@extends('layouts.admin')

@section('title')
    {{ __('CarExpenses.title') }}
@endsection

@section('contentheader')
    {{ __('CarExpenses.content_header') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('admin.customer.index') }}">{{ __('CarExpenses.content_header_link') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('CarExpenses.content_header_active') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('CarExpenses.edit_expense') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{ route('admin.CarExpenses.ajax_get_car') }}">
            <form action="{{ route('CarExpenses.update', $data['id']) }}" method="post" enctype="multipart/form-data">
                @method('PUT')   
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.plate_number') }}</label>
                            <select id="car_type_id" name="car_id" class="form-control">
                                <option value="">{{ __('CarExpenses.plate_number') }}</option>
                                @foreach ($car_id as $item)
                                    <option @if (old('car_id', $data['plate_number']) == $item->car_id) selected="selected" @endif
                                        value="{{ $item->plate_number }}">{{ $item->plate_number }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="ajax_responce_serarchDiv">
                            <label>{{ __('CarExpenses.car_type') }}</label>
                            <input value="{{ old('type_id', $data->type->name) }}" class="form-control" readonly>
                            <input name="type_id" type="hidden" id="type_id" class="form-control" readonly value="{{ $data->type->id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.supplier') }}</label>
                            <input name="supplier" id="supplier" class="form-control" value="{{ old('supplier', $data['supplier']) }}" placeholder="{{ __('CarExpenses.supplier') }}">
                            @error('supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.expense_price') }}</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $data['price']) }}" placeholder="{{ __('CarExpenses.expense_price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.tax_value') }}</label>
                            <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax', $data['tax']) }}" placeholder="{{ __('CarExpenses.tax_value') }}">
                            @error('tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.total_with_tax') }}</label>
                            <input name="total_price_tax" id="total_price_tax" disabled="disabled" class="form-control" value="{{ old('total_price_tax', $data['total_price_tax']) }}">
                            @error('total_price_tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.receipt_image') }}</label>
                            <div class="image">
                                <img class="custom_img" src="{{ asset('assets/admin/uploads') . '/' . $data['image'] }}">
                                <button type="button" class="btn btn-sm btn-danger" id="image_upload">{{ __('CarExpenses.receipt_image') }}</button>
                                <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload">{{ __('CarExpenses.cancel') }}</button>
                            </div>
                        </div>
                        <div id="old_image"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.notes') }}</label>
                            <textarea name="note" class="form-control" id="note" cols="100" rows="5">{{ $data['note'] }}</textarea>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm">{{ __('CarExpenses.save_changes') }}</button>
                            <a href="{{ route('CarExpenses.index') }}" class="btn btn-sm btn-danger">{{ __('CarExpenses.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).on('click', '#image_upload', function(e) {   
        e.preventDefault();
        if (!$("#image").length) {
            $("#image_upload").hide();
            $("#cancel_image_upload").show();
            $("#old_image").html('<br><input type="file" onchange="readURL(this)" name="image" id="image">');
        }
        return false;
    });

    $(document).on('click', '#cancel_image_upload', function(e) {
        e.preventDefault();
        $("#image_upload").show();
        $("#cancel_image_upload").hide();
        $("#old_image").html('');
        return false;
    });

    $(document).on('input', '#tax, #price', function(e) {
        var tax = $("#tax").val();
        var price = $("#price").val();
        var total_price_tax = parseFloat(tax) + parseFloat(price);
        $("#total_price_tax").val(isNaN(total_price_tax) ? 0 : total_price_tax);
    });

    $(document).on('change', '#car_type_id', function(e) {
        make_search();
    });

    function make_search() {
        var search_car_type_id_search = $("#car_type_id").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_car_type_id_search: search_car_type_id_search,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    }
</script>
@endsection