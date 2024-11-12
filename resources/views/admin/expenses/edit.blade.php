@extends('layouts.admin')
@section('title')
المصروفات
@endsection
@section('contentheader')
المصروفات
@endsection
@section('contentheaderlink')
<a href="{{ route('expenses.index') }}">  المصروفات </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> تعديل بيانات العميل </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
            <form action="{{ route('expenses.update', $data['id']) }}" method="post" enctype="multipart/form-data">
                @method('PUT')   
                @csrf
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> اختر نوع المصروف</label>
                        <select name="expenses_type" id="expenses_type" class="form-control ">
                            <option value=""> اختر نوع المصروف </option>
                            @foreach ($expenses_type as $item)
                                <option @if (old('expenses_type', $data['expenses_type']) == $item->id) selected="selected" @endif
                                    value="{{ $item->id }}"> {{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('expenses_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> سعر  المصروف  </label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price',$data['price']) }}"
                                    placeholder=" سعر  المصروف ">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> ادخل قيمة الضريبة </label>
                                <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax',$data['tax']) }}"
                                    placeholder=" الضريبة">
                                @error('tax')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> اجمالي السعر مع الضريبة </label>
                                <input name="total" id="total" disabled="disabled" class="form-control" value="{{ old('total',$data['total']) }}"
                                   >
                                @error('total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"  >
                                <label>   صورة الايصال   </label>
                               <div class="image">
                                  <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['image'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image">
                            </div>
                         </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <label> ملاحظات</label> 
                                   <textarea name="note" class="form-control " id="note" cols="100" rows="5">{{$data['note']}}</textarea>
                               @error('note')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                       </div>
                <div class="col-md-12">
            <div class="form-group text-center">
                <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm"> حفظ التعديلات</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-danger">الغاء</a>
            </div>
        </div>
        </div>
    </form>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
  $(document).on('click', '#image_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_upload").hide();
          $("#cancel_image_upload").show();
          $("#old_image").html('<br><input type="file" onchange="readURL(this)"  name="image" id="image" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_upload', function(e) {
      e.preventDefault();
      $("#image_upload").show();
      $("#cancel_image_upload").hide();
      $("#old_image").html('');
      return false;
  });

  
$(document).on('input', '#tax', function(e) {
     var tax = $("#tax").val();
     var price = $("#price").val();
     total = parseFloat(tax) + parseFloat(price);
     if(tax != ''&& price != ''){
        $("#total").val(total)  ;
     }else if(tax == ''){
        $("#total").val(price)
     }else{
        $("#total").val(0)
     }
  
    });
    $(document).on('input', '#price', function(e) {
     var tax = $("#tax").val();
     var price = $("#price").val();
     total =  parseFloat(tax) + parseFloat(price);
     if(tax != ''&& price != ''){
        $("#total").val(total)  ;
     }else if(tax == ''){
        $("#total").val(price)
     }else{
        $("#total").val(0)
     }
  
    });
    </script>  
@endsection   
