@extends('layouts.admin')
@section('title')
ضبط السيارات
@endsection
@section('contentheader')
مصروفات السيارات 
@endsection
@section('contentheaderlink')
<a href="{{ route('CarExpenses.index') }}">مصروفات  السيارات </a>
@endsection
@section('contentheaderactive')
    اضافة
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة مصروف جديد</h3>
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{route('admin.CarExpenses.ajax_get_car')}}">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('CarExpenses.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> رقم اللوحة </label>
                            <select  id="car_type_id" name="car_id" class="form-control ">
                                <option value=""> اختر رقم اللوحة </option>
                                @foreach ($car_id as $item)
                                    <option @if (old('car_id') == $item->id) selected="selected" @endif
                                        value="{{ $item->plate_number }}"> {{ $item->plate_number }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="ajax_responce_serarchDiv">
                            <label>  نوع السيارة</label>
                            <input name="type_id" id="type_id" class="form-control" readonly>
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label>  البيان  </label>-->
                    <!--        <input name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}"-->
                    <!--            placeholder="البيان">-->
                    <!--        @error('supplier')-->
                    <!--            <span class="text-danger">{{ $message }}</span>-->
                    <!--        @enderror-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>المبلع</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                                placeholder="المبلع">
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
                            <input name="total_price_tax" id="total_price_tax" disabled="disabled" class="form-control" value="{{ old('total_price_tax',0) }}"
                               >
                            @error('total_price_tax')
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  البيان  </label>
                            <textarea name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}" cols="100" rows="5"></textarea>
                            @error('supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
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
                            <a href="{{ route('CarExpenses.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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
     total_price_tax = parseFloat(tax) + parseFloat(price);
     if(tax != ''&& price != ''){
        $("#total_price_tax").val(total_price_tax)  ;
     }else if(tax == ''){
        $("#total_price_tax").val(price)
     }else{
        $("#total_price_tax").val(0)
     }
  
    });
    $(document).on('input', '#price', function(e) {
     var tax = $("#tax").val();
     var price = $("#price").val();
     total_price_tax =  parseFloat(tax) + parseFloat(price);
     if(tax != ''&& price != ''){
        $("#total_price_tax").val(total_price_tax)  ;
     }else if(tax == ''){
        $("#total_price_tax").val(price)
     }else{
        $("#total_price_tax").val(0)
     }
  
    });
        $(document).on('change', '#car_type_id', function(e) {
        make_search();
    });

    
      function make_search() {
        var search_car_type_id_search = $("#car_type_id").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_car_type_id_search: search_car_type_id_search,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
    }
    </script>
@endsection
