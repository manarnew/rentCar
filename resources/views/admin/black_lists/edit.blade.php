@extends('layouts.admin')
@section('title')
 القائمة السوداء
@endsection
@section('contentheader')
القائمة السوداء 
@endsection
@section('contentheaderlink')
<a href="{{ route('carType.index') }}">  القائمة السوداء </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">تعديل عميل لقائمة الحظر</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <form action="{{ route('Black_lists.update', $data['id']) }}" method="post" >
               @method('PUT')   
               @csrf
               <div class="form-group">
                  <label>اسم العميل </label>
                  <input type="hidden" name="customer_id" readonly id="customer_id" class="form-control" value="{{ $data->customer->id }}">
                  <input readonly  class="form-control" value="{{ $data->customer->name }}">
               </div>
                  
                     <div class="form-group">
                        <label> اسباب الحظر </label>
                            <textarea name="note" class="form-control " id="note" cols="100" rows="5">{{ $data->note }}</textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm"> اضافة</button>
                  <a href="{{ route('Black_lists.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
@endsection