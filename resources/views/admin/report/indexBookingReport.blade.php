
@extends('layouts.admin')
@section('title')
   التقارير
@endsection
@section('contentheader')
تقارير الحجوزات
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.Report.bookingReport') }}">    تقارير الحجوزات </a>
@endsection
@section('contentheaderactive')
التقارير
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">  تقارير الحجوزات</h3>
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <form action="{{ route('admin.Report.bookingReport') }}" method="POST">
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
               <label>بحث بنوع العقد</label>
               <select name="contract_type" id="contract_type"
                   class="form-control  select2">
                   <option value=""> بحث بالكل</option>
                   <option  @if (old('contract_type') == 1) selected="selected" @endif value="1"> يومي</option>
                   <option  @if (old('contract_type') == 2) selected="selected" @endif value="2"> اسبوعي</option>
                   <option  @if (old('contract_type') == 3) selected="selected" @endif value="3"> شهري</option>
               </select>
           </div>
         </div>
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>بحث بحالة العقد</label>
               <select name="contract_status" id="contract_status"
                   class="form-control  select2">
                   <option value=""> بحث بالكل</option>
                   <option value="1"> جديد </option>
                   <option  value="0"> منتهي </option>
               </select>
           </div>
         </div>
         <div class="col-md-12 text-center">
            @if(check_permission_sub_menue_actions(44)==true) 
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