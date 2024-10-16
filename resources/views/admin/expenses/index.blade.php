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
    {{ __('expenses.add_new_expense') }}
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title card_title_center">{{ __('expenses.add_new_expense') }}</h3>
        <input type="hidden" id="token_search" value="{{ csrf_token() }}">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.choose_expense_type') }}</label>
                        <select name="expenses_type" id="expenses_type" class="form-control">
                            <option value="">{{ __('expenses.choose_expense_type') }}</option>
                            @foreach ($expenses_type as $item)
                                <option @if (old('expenses_type') == $item->id) selected="selected" @endif
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
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                            placeholder="{{ __('expenses.expense_price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.enter_tax_value') }}</label>
                        <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax') }}"
                            placeholder="{{ __('expenses.enter_tax_value') }}">
                        @error('tax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.total_price_with_tax') }}</label>
                        <input name="total" id="total" disabled="disabled" class="form-control" value="{{ old('total', 0) }}">
                        @error('total')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('expenses.receipt_image') }}</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('expenses.notes') }}</label>
                        <textarea name="note" class="form-control" id="note" cols="100" rows="5">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm">{{ __('expenses.add') }}</button>
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