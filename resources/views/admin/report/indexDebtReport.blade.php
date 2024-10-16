@extends('layouts.admin')
@section('title')
   {{ __('debtReport.reports') }}
@endsection
@section('contentheader')
{{ __('debtReport.user_reports') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.Report.bookingReport') }}">{{ __('debtReport.user_reports') }}</a>
@endsection
@section('contentheaderactive')
{{ __('debtReport.reports') }}
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">{{ __('debtReport.user_reports') }}</h3>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.Report.debtReport') }}" method="POST">
         @csrf
      <div class="row">
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>{{ __('debtReport.from_date') }}</label>
               <input name="from_date_search" id="from_date_search" class="form-control" type="date" value="">
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>{{ __('debtReport.to_date') }}</label>
               <input name="to_date_search" id="to_date_search" class="form-control" type="date" value="">
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>{{ __('debtReport.search_by_username') }}</label>
               <select id="customer" name="customer" class="form-control">
                  <option value="all">{{ __('debtReport.select_username') }}</option>
                  @foreach ($customer as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
           </div>
         </div>
         <div class="col-md-12 text-center">
            @if(check_permission_sub_menue_actions(36) == true) 
            <button type="submit" class="btn btn-info">{{ __('debtReport.search') }}</button>
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