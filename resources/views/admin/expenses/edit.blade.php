@extends('layouts.admin')

@section('title')
    {{ __('expenses.expenses') }}
@endsection

@section('contentheader')
    {{ __('expenses.expenses') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('expenses.index') }}">{{ __('expenses.expenses') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('expenses.edit_expense') }}
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title card_title_center">{{ __('expenses.edit_expense') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <input type="hidden" id="token_search" value="{{ csrf_token() }}">
        <form action="{{ route('expenses.update', $data['id']) }}" method="post" enctype="multipart/form-data">
            @method('PUT')   
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.choose_expense_type') }}</label>
                        <select name="expenses_type" id="expenses_type" class="form-control">
                            <option value="">{{ __('expenses.choose_expense_type') }}</option>
                            @foreach ($expenses_type as $item)
                                <option @if (old('expenses_type', $data['expenses_type']) == $item->id) selected="selected" @endif
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('expenses_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.expense_price') }}</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $data['price']) }}"
                            placeholder="{{ __('expenses.expense_price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.enter_tax_value') }}</label>
                        <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax', $data['tax']) }}"
                            placeholder="{{ __('expenses.enter_tax_value') }}">
                        @error('tax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.total_price_with_tax') }}</label>
                        <input name="total" id="total" disabled="disabled" class="form-control" value="{{ old('total', $data['total']) }}">
                        @error('total')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('expenses.receipt_image') }}</label>
                        <div class="image">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['image'] }}">
                            <button type="button" class="btn btn-sm btn-danger" id="image_upload">{{ __('expenses.change_image') }}</button>
                            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload">{{ __('expenses.cancel_image_upload') }}</button>
                        </div>
                    </div>
                    <div id="old_image"></div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('expenses.notes') }}</label>
                        <textarea name="note" class="form-control" id="note" cols="100" rows="5">{{ $data['note'] }}</textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm">{{ __('expenses.save_changes') }}</button>
                        <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-danger">{{ __('expenses.cancel') }}</a>
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

    $(document).on('input', '#tax', function(e) {
        var tax = $("#tax").val();
        var price = $("#price").val();
        var total = parseFloat(tax) + parseFloat(price);
        if (tax != '' && price != '') {
            $("#total").val(total);
        } else if (tax == '') {
            $("#total").val(price);
        } else {
            $("#total").val(0);
        }
    });

    $(document).on('input', '#price', function(e) {
        var tax = $("#tax").val();
        var price = $("#price").val();
        var total = parseFloat(tax) + parseFloat(price);
        if (tax != '' && price != '') {
            $("#total").val(total);
        } else if (tax == '') {
            $("#total").val(price);
        } else {
            $("#total").val(0);
        }
    });
</script>
@endsection