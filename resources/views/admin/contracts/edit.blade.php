@extends('layouts.admin')
@section('title')
     الحجوزات
@endsection
@section('contentheader')
الحجوزات
@endsection
@section('contentheaderlink')
    <a href="{{ route('contracts.index') }}"> الحجوزات </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> تعديل بيانات الحجوزات </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <form action="{{ route('contracts.update', $data['id']) }}" method="post" enctype="multipart/form-data">
                @method('PUT')   
                    @csrf
                    <div class="row">
                        <input type="hidden" name="car_id" id="car_id" class="form-control"
                        value="{{ $car_id->id }}" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  نوع الحجز</label>
                                <select  id="contract_type" name="contract_type" class="form-control ">
                                    <option value=""> اختر نوع الحجز </option>
                                        <option  @if (old('contract_type', $data['contract_type']) == 1) selected="selected" @endif value="1"> يومي</option>
                                        <option  @if (old('contract_type', $data['contract_type']) == 2) selected="selected" @endif value="2"> اسبوعي</option>
                                        <option  @if (old('contract_type', $data['contract_type']) == 3) selected="selected" @endif value="3"> شهري</option>
                                </select>
                                @error('contract_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                                            <input type="hidden" value="{{old('contract_type_price', $data['contract_type_price'])}}" name="contract_type_price" id="contract_type_price">

                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>العدد/اليوم</label>
                                <input type="number" name="contract_number" id="contract_number" class="form-control"
                                    value="{{old('contract_number', $data['contract_number'])}}" >
                                @error('contract_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> نوع الدفع</label>
                                <select  id="payment_type" name="payment_type" class="form-control ">
                                    <option value=""> اختر  نوع الدفع  </option>
                                        <option @if (old('payment_type', $data['payment_type']) == "تحويل بنكي") selected="selected" @endif value="تحويل بنكي"> تحويل بنكي </option>
                                        <option @if (old('payment_type', $data['payment_type']) == "كاش") selected="selected" @endif value="كاش"> كاش </option>
                                        <option @if (old('payment_type', $data['payment_type']) == "بطاقة") selected="selected" @endif value="بطاقة"> بطاقة </option>
                                        <option @if (old('payment_type', $data['payment_type']) == "شيك") selected="selected" @endif value="شيك"> شيك </option>
                                        <option @if (old('payment_type', $data['payment_type']) == "دين") selected="selected" @endif value="دين"> دين </option>
                                </select>
                                @error('payment_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> اختر اسم العميل</label>
                                <select  id="customer_id" name="customer_id" class="form-control ">
                                    <option value=""> اختر اسم العميل </option>
                                    @foreach ($customer_id as $item)
                                        <option @if ($item->customer_status == 0) disabled="disabled" @endif  @if (old('customer_id', $data['customer_id']) == $item->id) selected="selected" @endif
                                            value="{{ $item->id }}"> {{ $item->name }}  @if ($item->customer_status == 0) ( <span style="color: red">{{"محظور"}}</span>) @endif</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>     اسم السائق  </label>
                                <input name="driver_name" id="driver_name" class="form-control"
                                    value="{{ old('driver_name', $data['driver_name']) }}" >
                                    @error('driver_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> تاريخ الحجز </label>
                                <input type="date" name="date" id="date" class="form-control"
                                    value="{{ old('date', $data['date']) }}" >
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> اختر حالة الحجز</label>
                                <select  id="contract_status" name="contract_status" class="form-control ">
                                    <option value=""> اختر  حالة الحجز  </option>
                                        <option @if (old('contract_status', $data['contract_status']) == 1)  selected="selected" @endif value="1"> مكتمل </option>
                                        <option @if (old('contract_status', $data['contract_status']) == 2) selected="selected" @endif value="2"> في الانتظار </option>
                                        <option @if (old('contract_status', $data['contract_status']) == 3) selected="selected" @endif value="3">  مرفوض </option>
                                        <option @if (old('contract_status', $data['contract_status']) == 4) selected="selected" @endif value="4">  ملغي </option>
                                </select>
                                @error('contract_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> تاريخ المغادرة  </label>
                                <input type="date" name="exist_date" id="exist_date" class="form-control"
                                    value="{{ old('exist_date', $data['exist_date']) }}" >
                                @error('exist_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> وقت المغادرة  </label>
                                <input type="time" name="exist_time" id="exist_time" class="form-control"
                                    value="{{ old('exist_time', $data['exist_time']) }}" >
                                @error('exist_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  عدد الكيلومترات وقت المغادرة  </label>
                                <input type="text" name="exist_km" readonly id="exist_km" class="form-control"
                                    value="{{ old('exist_km', $data['exist_km']) }}" >
                                @error('exist_km')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> تاريخ العودة  </label>
                                <input type="date" name="return_date" id="return_date" class="form-control"
                                    value="{{ old('return_date', $data['return_date']) }}" >
                                @error('return_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> وقت العودة  </label>
                                <input type="time" name="return_time" id="return_time" class="form-control"
                                    value="{{ old('return_time', $data['return_time']) }}" >
                                @error('return_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  عدد الكيلومترات وقت العودة  </label>
                                <input type="number" name="return_km" id="return_km" class="form-control"
                                    value="{{ old('return_km', $data['return_km']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  اجمالي الكيلومترات  المقطوعة  </label>
                                <input type="number" readonly name="total_km" id="total_km" class="form-control"
                                    value="{{ old('total_km', $data['total_km']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>   الكيلومترات  المستحقة  </label>
                                <input type="number" name="due_km" id="due_km" class="form-control"
                                    value="{{ old('due_km', $data['due_km']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>   الكيلومترات  المجانية  </label>
                                <input type="number" name="free_km" id="free_km" class="form-control"
                                    value="{{ old('free_km', $data['free_km']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>   الكيلومترات  الزائدة  </label>
                                <input readonly type="number" name="excess_km" id="excess_km" class="form-control"
                                    value="{{ old('excess_km', $data['excess_km']) }}" >
                            </div>
                        </div>
                        <div  class="col-md-12">
                            <hr style="  border: 1px solid rgb(78, 96, 212)">
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> سعر العقد </label>
                                <input readonly name="contract_price" id="contract_price" class="form-control"
                                    value="{{ old('contract_price', $data['contract_price']) }}" >
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>     دفعة مقدمة  </label>
                                <input type="number" name="pre_paid_price" id="pre_paid_price" class="form-control"
                                    value="{{ old('pre_paid_price', $data['pre_paid_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  تخفيض </label>
                                <input type="number" name="discount" id="discount" class="form-control"
                                    value="{{ old('discount', $data['discount']) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      ضريبة  </label>
                                <input type="text" name="tax_price" id="tax_price" class="form-control"
                                    value="{{ old('tax_price', $data['tax_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      زيادة الكيلو  </label>
                                <input readonly type="number" name="excess_km_price" id="excess_km_price" class="form-control"
                                    value="{{ old('excess_km_price', $data['excess_km_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      بترول  </label>
                                <input type="number" name="patrol_price" id="patrol_price" class="form-control"
                                    value="{{ old('patrol_price', $data['patrol_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      غسيل  </label>
                                <input type="number" name="washing_price" id="washing_price" class="form-control"
                                    value="{{ old('washing_price', $data['washing_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      التامين  </label>
                                <input type="number" name="insurance_price" id="insurance_price" class="form-control"
                                    value="{{ old('insurance_price', $data['insurance_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      غرامة  </label>
                                <input type="number" name="penalty_price" id="penalty_price" class="form-control"
                                    value="{{ old('penalty_price', $data['penalty_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      المبلغ المستلم  </label>
                                <input type="number" name="paid_price" id="paid_price" class="form-control"
                                    value="{{ old('paid_price', $data['paid_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      الباقي  </label>
                                <input  readonly type="text" name="remind_price" id="remind_price" class="form-control"
                                    value="{{ old('remind_price', $data['remind_price']) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>      المجموع  </label>
                                <input  readonly type="text" name="total_price" id="total_price" class="form-control"
                                    value="{{ old('total_price', $data['total_price']) }}" >
                            </div> 
                        </div>
                <div class="col-md-12">
            <div class="form-group text-center">
                <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm"> حفظ التعديلات</button>
                <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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
   
   $(document).on('input', '#return_km', function(e) {
 var exist_km = $("#exist_km").val();
  if(exist_km ==""){
    exist_km = 0;
  }
 var return_km = $("#return_km").val();
 if(return_km ==""){
    return_km = 0;
  }
 total_km =  parseFloat(return_km) - parseFloat(exist_km);
 if(exist_km != ''&& return_km != ''){
    $("#total_km").val(total_km)  ;
 }else{
    $("#total_km").val(0)  ;
 }
 culc();
 recCulcForexcessKm()
});
$(document).on('input', '#due_km', function(e) {
    recCulcForexcessKm()
    culc();
});
$(document).on('input', '#free_km', function(e) {

    recCulcForexcessKm()
    culc();
});
function recCulcForexcessKm(){
    var due_km = $("#due_km").val();
  if(due_km ==""){
    due_km = 0;
  }
  var free_km = $("#free_km").val();
  if(free_km !="" && free_km !=0){
    excess =    parseFloat(due_km) + parseFloat(free_km);
  }else{
    excess =  parseFloat(due_km);
  }

  if(excess < $("#total_km").val()){
        var excess_km =    parseFloat( $("#total_km").val()) - excess;
    }else{
        excess_km = 0;
    }
    $("#excess_km").val(excess_km);
    $("#excess_km_price").val(excess_km * {{$car_id->km_rent_price}})
}
        ////////////////////////////////////



        $(document).on('input', '#contract_type', function(e) {
            var contract_type = $("#contract_type").val();
            var contract_number = $("#contract_number").val();
            if (contract_number != "" && contract_type != "") {
                  if (contract_type == 1) {
                    $("#contract_price").val(contract_number * {{ $car_id->daily_rent_price }})
                    $("#contract_type_price").val({{ $car_id->daily_rent_price }})
                } else if (contract_type == 2) {
                    $("#contract_price").val(contract_number * {{ $car_id->weekly_rent_price }})
                    $("#contract_type_price").val({{ $car_id->weekly_rent_price }})
                } else if (contract_type == 3) {
                    $("#contract_price").val(contract_number * {{ $car_id->monthly_rent_price }})
                    $("#contract_type_price").val({{ $car_id->monthly_rent_price }})
                }
            } else {
                $("#contract_price").val(0);
            }
        });

        $(document).on('input', '#contract_number', function(e) {
            var contract_type = $("#contract_type").val();
            var contract_number = $("#contract_number").val();
            if (contract_number != "" && contract_type != "") {
                 if (contract_type == 1) {
                    $("#contract_price").val(contract_number * {{ $car_id->daily_rent_price }})
                    $("#contract_type_price").val({{ $car_id->daily_rent_price }})
                } else if (contract_type == 2) {
                    $("#contract_price").val(contract_number * {{ $car_id->weekly_rent_price }})
                    $("#contract_type_price").val({{ $car_id->weekly_rent_price }})
                } else if (contract_type == 3) {
                    $("#contract_price").val(contract_number * {{ $car_id->monthly_rent_price }})
                    $("#contract_type_price").val({{ $car_id->monthly_rent_price }})
                }
            } else {
                $("#contract_price").val(0);
            }

        });

      

        function culc() {
            var tax_price = $("#tax_price").val()
            if (tax_price == "") {
                tax_price = 0;
            }
            var excess_km_price = $("#excess_km_price").val()
            if (excess_km_price == "") {
                excess_km_price = 0;
            }
            var patrol_price = $("#patrol_price").val()
            if (patrol_price == "") {
                patrol_price = 0;
            }
            var washing_price = $("#washing_price").val()
            if (washing_price == "") {
                washing_price = 0;
            }
            var insurance_price = $("#insurance_price").val()
            if (insurance_price == "") {
                insurance_price = 0;
            }
            var penalty_price = $("#penalty_price").val()
            if (penalty_price == "") {
                penalty_price = 0;
            }
            var contract_price = $("#contract_price").val()
            if (contract_price == "") {
                contract_price = 0;
            }
            var pre_paid_price = $("#pre_paid_price").val()
            if (pre_paid_price == "") {
                pre_paid_price = 0;
            }
            var paid_price = $("#paid_price").val()
            if (paid_price == "") {
                paid_price = 0;
            }
            var discount = $("#discount").val()
            if (discount == "") {
                discount = 0;
            }
            var total_nagtive = (parseFloat(tax_price) + parseFloat(excess_km_price) + parseFloat(patrol_price) + parseFloat(
                    washing_price) +
                parseFloat(insurance_price) + parseFloat(penalty_price) + parseFloat(contract_price)) - parseFloat(discount);
            $("#total_price").val(total_nagtive )
            var total_postive = parseFloat(pre_paid_price) + parseFloat(paid_price)  ;
            $("#remind_price").val(total_nagtive - total_postive)

        }
        $(document).on('input', '#tax_price', function(e) {
            culc();
        });
        $(document).on('input', '#discount', function(e) {
culc();
});
        $(document).on('input', '#washing_price', function(e) {
            culc();
        });
        $(document).on('input', '#patrol_price', function(e) {
            culc();
        });
        $(document).on('input', '#insurance_price', function(e) {
            culc();
        });
        $(document).on('input', '#penalty_price', function(e) {
            culc();
        });
        $(document).on('input', '#pre_paid_price', function(e) {
            culc();
        });
        $(document).on('input', '#paid_price', function(e) {
            culc();
        });
        $(document).on('input', '#contract_number', function(e) {
            culc();
        });
        $(document).on('input', '#contract_type', function(e) {
            culc();
        });
    $(document).on('click', '#do_edit_item_cardd', function(e) {
            var return_km = $("#return_km").val();
            var exist_km = $("#exist_km").val();
            if (return_km < exist_km && return_km != "") {
                alert("من فضلك  يجب ان تكون الكيلومترات عند العودة اكبر من  عند المغادرة");
                return false;
            }
        });
</script>
@endsection   
