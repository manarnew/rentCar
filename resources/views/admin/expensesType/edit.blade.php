@extends('layouts.admin')

@section('title')
    {{ __('expensesType.expense_categories') }}
@endsection

@section('contentheader')
    {{ __('expensesType.expense_categories') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('expensesType.index') }}">{{ __('expensesType.expense_categories') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('expensesType.edit_expense_category') }}
@endsection

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('expensesType.edit_expense_category') }}</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (isset($data) && !empty($data))
            <form action="{{ route('expensesType.update', $data['id']) }}" method="post">
               @method('PUT')
               @csrf
               <div class="form-group">
                  <label>{{ __('expensesType.expense_name') }}</label>
                  <input name="name" id="name" class="form-control" value="{{ old('name', $data['name']) }}">
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm">{{ __('expensesType.save_changes') }}</button>
                  <a href="{{ route('expensesType.index') }}" class="btn btn-sm btn-danger">{{ __('expensesType.cancel') }}</a>    
               </div>
            </form>
            @else
            <div class="alert alert-danger">
               {{ __('expensesType.no_data') }}
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection