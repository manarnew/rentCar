
@extends('layouts.admin')
@section('title')
   التقارير
@endsection
@section('contentheader')
تقارير المستخدمين
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.Report.bookingReport') }}">    تقارير المستخدمين </a>
@endsection
@section('contentheaderactive')
التقارير
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">  تقارير المستخدمين</h3>
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <form action="{{ route('admin.Report.userReport') }}" method="POST">
         @csrf
      <div class="row">
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>      من تاريخ </label>
               <input name="from_date_search" id="from_date_search" class="form-control" type="date" value=""    >
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>     الي تاريخ  </label>
               <input name="to_date_search" id="to_date_search" class="form-control" type="date" value=""    >
            </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>بحث باسم المستخدم</label>
               <select id="user" name="user" class="form-control ">
                  <option value="all"> اختر اسم المستخدم </option>
                  @foreach ($user as $item)
                      <option value="{{ $item->id }}"> {{ $item->name }} </option>
                  @endforeach
              </select>
           </div>
         </div>
         <div class="col-md-12 text-center">
            @if(check_permission_sub_menue_actions(36)==true) 
            <button  type="submit" class="btn btn-info">بحث</button>
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