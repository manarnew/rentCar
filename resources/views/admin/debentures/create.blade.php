@extends('layouts.admin')
@section('title')
    سندات القبض
@endsection
@section('contentheader')
    سندات القبض
@endsection
@section('contentheaderlink')
    <a href="{{ route('debentures.index') }}">
        سندات القبض </a>
@endsection
@section('contentheaderactive')
    اضافة
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة سند القبض</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <h3 class="card-title card_title_center"> بيانات العميل</h3>
             <div id="ajax_responce_serarchDiv" class="col-md-12">
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <td> اسم العميل : {{ $customer_id->name }}</td>
                    <td> اسم الشركة : {{ $customer_id->com_name }}</td>
                    <td> رقم الهاتف : {{ $customer_id->phone }}</td>
                    <td> العنوان : {{ $customer_id->address }}</td>
                    <td> الجنسية : {{ $customer_id->nationality }}</td>
                </tr>
                <tr>
                    <td> رقم الهوية: {{ $customer_id->identity_number }}</td>
                    <td> رقم رخصية القيادة : {{ $customer_id->driver_license_number }}</td>
                    <td> مكان الصدار : {{ $customer_id->driver_license_address }}</td>
                    <td> تاريخ الصدار : {{ $customer_id->driver_license_release_date }}</td>
                    <td> تاريخ الانتهاء : {{ $customer_id->driver_license_address_end_date }}</td>
                </tr>
            </table>
            <br>
            <h3 class="card-title card_title_center"> بيانات السيارة</h3>
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <td> نوع السيارة : {{ $car_id->type->name }}</td>
                    <td> موديل السيارة : {{ $car_id->carModals->name }}</td>
                    <td> رقم اللوحة : {{ $car_id->plate_number }}</td>
                    <td> لون السيارة : {{ $car_id->car_color }}</td>
                    <td> شركة التامين : {{ $car_id->insurance }}</td>
                    <td>
                        نوع التامين : @if ($car_id->full_insurance == 1)
                            تامين شامل
                        @else
                            تامين غير شامل
                        @endif
                    </td>
                </tr>
            </table>
            </div>
            <div class="col-md-12">
                <hr style="  border: 1px solid rgb(78, 96, 212)">
            </div>
            <form action="{{ route('debentures.store') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="car_id" value="{{ $car_id->id }}">
                    <input type="hidden" name="customer_id" value="{{ $customer_id->id }}">
                    <input type="hidden" name="contract_id" value="{{ $Contracts_id->id }}">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>المبلغ</label>
                            <input type="hidden" id="remind_price_old" value="{{ $Contracts_id->remind_price }}">
                            <input type="number" name="paid_price" id="paid_price" class="form-control"
                                value="{{ old('paid_price') }}">
                            @error('paid_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>الباقي</label>
                            <input type="number" readonly name="remind_price" id="remind_price" class="form-control"
                                value="{{ old('remind_price',$Contracts_id->remind_price) }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label> تاريخ </label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ old('date', date('Y-m-d')) }}">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> طريقة الدفع </label>
                            <select id="payment_type" name="payment_type" class="form-control ">
                                <option value=""> اختر طريقة الدفع </option>
                                <option @if (old('payment_type') == 'تحويل بنكي') selected="selected" @endif value="تحويل بنكي">
                                    تحويل بنكي </option>
                                <option @if (old('payment_type') == 'كاش') selected="selected" @endif value="كاش"> كاش
                                </option>
                                <option @if (old('payment_type') == 'بطاقة') selected="selected" @endif value="بطاقة"> بطاقة
                                </option>
                                <option @if (old('payment_type') == 'شيك') selected="selected" @endif value="شيك"> شيك
                                </option>
                                <option @if (old('payment_type') == 'دين') selected="selected" @endif value="دين"> دين
                                </option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> رقم الشيك ان وجد </label>
                            <input name="check_number" id="check_number" class="form-control"
                                value="{{ old('check_number') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>البيان</label>
                            <input name="note" id="note" class="form-control" value="{{ old('note') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> اضافة</button>
                            <a href="{{ route('debentures.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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
        $(document).on('input', '#paid_price', function(e) {
            var remind_price_old = $("#remind_price_old").val();
            if (remind_price_old == 0) {
                $("#paid_price").val("")
                alert("عفوا لايوجد مبلغ متبقي ليتم تسديدة في هذا العقد");
                return false;
            }
            var paid_price = $("#paid_price").val();
            var remind_price = $("#remind_price").val();

            if ((remind_price_old - paid_price) < 0) {
                alert("عفوا لا يمكن ان يكون  مبلغ المدفوع  اكبر من الباقي   ");
                $("#paid_price").val("")
                $("#remind_price").val(remind_price_old)
                return false;
            }else{
                 $("#remind_price").val(remind_price_old-paid_price);
            }
            console.log(remind_price_old > paid_price);
        });
        $(document).on('click', '#do_add_item_cardd', function(e) {
            var remind_price_old = $("#remind_price_old").val();
            if (remind_price_old == 0) {
                $("#paid_price").val("")
                alert("عفوا لايوجد مبلغ متبقي ليتم تسديدة في هذا العقد");
                return false;
            }
        });
    </script>
@endsection
