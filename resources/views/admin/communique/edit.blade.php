@extends('layouts.admin')
@section('title')
 البلاغات
@endsection
@section('contentheader')
البلاغات
@endsection
@section('contentheaderlink')
<a href="{{ route('communique.index') }}"> البلاغات  </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">تعديل بيانات  فئة السيارة</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <form action="{{ route('communique.update',$data['id']) }}" method="post" >
               @method('PUT')
               @csrf
            
                  <div class="form-group">
              <input type="hidden" class="form-control" name="contract_id" id="contract_id" >
            <label for="recipient-name" class="col-form-label">رقم البلاغ</label>
            <input type="text" class="form-control" id="recipient-name"  value="{{ old('communique_number',$data['communique_number']) }}"   name="communique_number">
          </div>
          <div class="form-group">
  
  <label for="recipient-name" class="col-form-label">مكان البلاغ</label>
  <input type="text" class="form-control" id="recipient-name"  value="{{ old('communique_place',$data['communique_place']) }}"  name="communique_place">
</div>
        <div class="form-group">
    <label for="message-text" class="col-form-label">تاريخ البلاغ</label>
      <input type="date" class="form-control" id="recipient-name"  value="{{ old('date',$data['date']) }}"  name="date">
    
  </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">تفاصيل البلاغ</label>
            <textarea class="form-control" id="message-text"  name="details">{{ old('details',$data['details']) }}</textarea>
          </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                  <a href="{{ route('communique.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
               </div>
            </form>
            @else
            <div class="alert alert-danger">
               عفوا لاتوجد بيانات لعرضها !!
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection