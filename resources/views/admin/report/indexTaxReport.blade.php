@extends('layouts.admin')
@section('title')
   التقارير
@endsection
@section('contentheader')
تقارير الضرائب 
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.Report.indexTaxReport') }}">تقارير الضرائب </a>
@endsection
@section('contentheaderactive')
التقارير
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">تقارير الضرائب </h3>
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <form action="{{ route('admin.Report.taxReport') }}" method="POST">
         @csrf
      <div class="row">
         <div class="col-md-4 noPrint">
            <div class="form-group">
               <label>بحث بنوع </label>
               <select name="taxType" id="taxType"
                   class="form-control  select2">
                   <option value=""> بحث بالكل</option>
                   <option value="1"> ضريبة مصروفات السيارات </option>
                   <option  value="0"> ضريبة اجارات السيارات </option>
               </select>
           </div>
         </div>
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
         <div class="col-md-12 text-center">
          
            <button  type="submit" class="btn btn-info">بحث</button>
           
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