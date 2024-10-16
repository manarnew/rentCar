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
    اضافة
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة مصروف جديد</h3>
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> اختر نوع المصروف</label>
                            <select name="expenses_type" id="expenses_type" class="form-control ">
                                <option value=""> اختر نوع المصروف </option>
                                @foreach ($expenses_type as $item)
                                    <option @if (old('expenses_type') == $item->id) selected="selected" @endif
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
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                                placeholder=" سعر  المصروف ">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> ادخل قيمة الضريبة </label>
                            <input type="number" name="tax" id="tax" class="form-control" value="{{ old('tax') }}"
                                placeholder=" الضريبة">
                            @error('tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> اجمالي السعر مع الضريبة </label>
                            <input name="total" id="total" disabled="disabled" class="form-control" value="{{ old('total',0) }}"
                               >
                            @error('total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>   صورة الايصال   </label>
                            <input type="file" class="form-control " name="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                           <label> ملاحظات</label> 
                               <textarea name="note" class="form-control " id="note" cols="100" rows="5"></textarea>
                           @error('note')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                   </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> اضافة</button>
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
    <script >

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
