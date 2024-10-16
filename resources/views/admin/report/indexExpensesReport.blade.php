@extends('layouts.admin')
@section('title')
   {{ __('reportIndex.reports') }}
@endsection
@section('contentheader')
{{ __('reportIndex.expenses_reports') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.Report.bookingReport') }}">{{ __('reportIndex.expenses_reports') }}</a>
@endsection
@section('contentheaderactive') 
{{ __('reportIndex.reports') }}
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">{{ __('reportIndex.expenses_reports') }}</h3>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.Report.expensesReport') }}" method="POST">
         @csrf
      <div class="row">
         <div class="col-md-4">
            <div class="form-group">
               <label>{{ __('reportIndex.search_by_type') }}</label>
               <select name="expenses_type_id_search" id="expenses_type_id_search" class="form-control ">
                  <option value="">{{ __('reportIndex.search_all') }}</option>
                  @if (@isset($expenses_type) && !@empty($expenses_type))
                  @foreach ($expenses_type as $info )
                  <option value="{{ $info->id }}">{{ $info->name }}</option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>{{ __('reportIndex.from_date') }}</label>
               <input name="from_date_search" id="from_date_search" class="form-control" type="date" value="">
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>{{ __('reportIndex.to_date') }}</label>
               <input name="to_date_search" id="to_date_search" class="form-control" type="date" value="">
            </div>
         </div>
         <div class="col-md-12 text-center">
            @if(check_permission_sub_menue_actions(49) == true) 
            <button type="submit" class="btn btn-info">{{ __('reportIndex.search') }}</button>
            @endif
         </div>
      </div>
   </form>
   </div>
</div>

@endsection
@section('script')
<script></script>
<script>
  
</script>
@endsection