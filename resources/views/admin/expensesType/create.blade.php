@extends('layouts.admin')
@section('title')
ضبط فئات المصروفات
@endsection
@section('contentheader')
فئات المصروفات
@endsection
@section('contentheaderlink')
<a href="{{ route('expensesType.index') }}"> فئات المصروفات </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">اضافة  فئة المصروفات</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <form action="{{ route('expensesType.store') }}" method="post" >
               @csrf
               <div class="form-group">
                  <label>اسم المصروف </label>
                  <input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="ادخل اسم الفئة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm"> اضافة</button>
                  <a href="{{ route('expensesType.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
@endsection