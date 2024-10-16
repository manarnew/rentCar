@extends('layouts.admin')

@section('title')
    {{ __('CarExpenses.title') }}
@endsection

@section('contentheader')
    {{ __('CarExpenses.content_header') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('CarExpenses.index') }}">{{ __('CarExpenses.content_header_link') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('CarExpenses.content_header_active') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('CarExpenses.add_expense') }}</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{ route('admin.CarExpenses.ajax_get_car') }}">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('CarExpenses.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.plate_number') }}</label>
                            <select id="car_type_id" name="car_id" class="form-control">
                                <option value="">{{ __('CarExpenses.plate_number') }}</option>
                                @foreach ($car_id as $item)
                                    <option @if (old('car_id') == $item->id) selected="selected" @endif
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
                            <input name="type_id" id="type_id" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.amount') }}</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                                placeholder="{{ __('CarExpenses.amount') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.tax_value') }}</label>
                            <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax') }}"
                                placeholder="{{ __('CarExpenses.tax_value') }}">
                            @error('tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.total_with_tax') }}</label>
                            <input name="total_price_tax" id="total_price_tax" disabled="disabled" class="form-control" value="{{ old('total_price_tax', 0) }}">
                            @error('total_price_tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.receipt_image') }}</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.supplier') }}</label>
                            <textarea name="supplier" id="supplier" class="form-control" cols="100" rows="5">{{ old('supplier') }}</textarea>
                            @error('supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('CarExpenses.notes') }}</label>
                            <textarea name="note" class="form-control" id="note" cols="100" rows="5">{{ old('note') }}</textarea>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm">{{ __('CarExpenses.add') }}</button>
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