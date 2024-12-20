@extends('layouts.admin')
@section('title')
ضبط السيارات
@endsection
@section('contentheader')
فئات السيارات
@endsection
@section('contentheaderlink')
<a href="{{ route('carType.index') }}"> فئات السيارات </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">اضافة  فئة سيارة جديدة</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <form action="{{ route('carType.store') }}" method="post" >
               @csrf
               <div class="form-group">
                  <label>اسم الفئة </label>
                  <input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="ادخل اسم الفئة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm"> اضافة</button>
                  <a href="{{ route('carType.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
@endsection