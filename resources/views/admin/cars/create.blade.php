@extends('layouts.admin')
@section('title')
    ضبط السيارات
@endsection
@section('contentheader')
    السيارات
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.car.index') }}"> السيارات </a>
@endsection
@section('contentheaderactive')
    اضافة
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة صنف جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.car.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> رقم اللوحة </label>
                            <input name="plate_number" id="plate_number" class="form-control"
                                value="{{ old('plate_number') }}" placeholder="ادخل  رقم اللوحة ">
                            @error('plate_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> لون السيارة</label>
                            <input name="car_color" id="car_color" class="form-control" value="{{ old('car_color') }}"
                                placeholder=" لون السيارة">
                            @error('car_color')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> اختر نوع السيارة</label>
                            <select name="type_id" id="type_id" class="form-control ">
                                <option value=""> اختر نوع السيارة </option>
                                @foreach ($carType as $item)
                                    <option @if (old('type_id') == $item->id) selected="selected" @endif
                                        value="{{ $item->id }}"> {{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> اختر موديل السيارة </label>
                            <select name="car_modals_id" id="car_modals_id" class="form-control ">
                                <option value=""> اختر موديل السيارة </option>
                                @foreach ($carModals as $item)
                                    <option @if (old('car_modals_id') == $item->id) selected="selected" @endif
                                        value="{{ $item->id }}"> {{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('car_modals_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> عدد الكيلومترات الحالي </label>
                            <input type="number" name="km_number" id="km_number" class="form-control" value="{{ old('km_number') }}"
                                placeholder=" عدد الكيلومترات الحالي ">
                            @error('km_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> سعر الاجار اليومي  </label>
                            <input type="number"  name="daily_rent_price" id="daily_rent_price" class="form-control" value="{{ old('daily_rent_price') }}"
                                placeholder=" سعر الاجار اليومي ">
                            @error('daily_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> سعر الاجار الاسبوعي  </label>
                            <input type="number"  name="weekly_rent_price" id="weekly_rent_price" class="form-control" value="{{ old('weekly_rent_price') }}"
                                placeholder=" سعر الاجار الاسبوعي ">
                            @error('weekly_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> سعر الاجار الشهري  </label>
                            <input type="number"  name="monthly_rent_price" id="monthly_rent_price" class="form-control" value="{{ old('monthly_rent_price',) }}"
                                placeholder=" سعر الاجار الشهري ">
                            @error('monthly_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> سعر الاجار بالساعة </label>
                            <input type="number"  name="hourly_rent_price" id="hourly_rent_price" class="form-control" value="{{ old('hourly_rent_price') }}"
                                placeholder=" سعر الاجار بالساعة ">
                            @error('hourly_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> سعر الاجار بالكيلو </label>
                            <input type="number"  name="km_rent_price" id="km_rent_price" class="form-control" value="{{ old('km_rent_price') }}"
                                placeholder=" سعر الاجار بالكيلو ">
                            @error('km_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>   تأمين </label>
                            <input name="insurance" id="insurance" class="form-control" value="{{ old('insurance') }}"
                                placeholder="تأمين">
                            @error('insurance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> هل تامين شامل</label>
                            <select name="full_insurance" id="full_insurance" class="form-control ">
                                <option value=""> اختر حالة تامين السيارة </option>
                                <option @if (old('full_insurance') == 1) selected="selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('full_insurance') == 0 and old('full_insurance')!="") selected="selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('full_insurance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> هل يوجد طرف ثالث</label>
                            <select name="third_party" id="third_party" class="form-control ">
                                <option value=""> اختر حالة طرف ثالث </option>
                                <option @if (old('third_party') == 1) selected="selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('third_party') == 0 and old('third_party')!="") selected="selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('third_party')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> هل تغطية شامله </label>
                            <select name="full_cover" id="full_cover" class="form-control ">
                                <option value=""> اختر حالة تغطية شامله </option>
                                <option @if (old('full_cover') == 1) selected="selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('full_cover') == 0 and old('full_cover')!="") selected="selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('full_cover')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الامارات العربية المتحدة </label>
                            <select name="UAE" id="UAE" class="form-control ">
                                <option value=""> اختر حالة الامارات العربية المتحدة</option>
                                <option @if (old('UAE') == 1) selected="selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('UAE') == 0 and old('UAE')!="") selected="selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('UAE')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> عمان </label>
                            <select name="oman" id="oman" class="form-control ">
                                <option value=""> اختر حالة عمان </option>
                                <option @if (old('oman') == 1) selected="selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('oman') == 0 and old('oman')!="") selected="selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('oman')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الصورة </label>
                            <input type="file" class="form-control " name="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الصورة الاميمة لملكية السيارة</label>
                            <input type="file" class="form-control " name="car_own_image_front" id="car_own_image_front">
                            @error('car_own_image_front')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الصورة الخلفية لملكية السيارة</label>
                            <input type="file" class="form-control " name="car_own_image_back" id="car_own_image_back">
                            @error('car_own_image_back')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الصورة الاميمة لكرة التشغيل </label>
                            <input type="file" class="form-control " name="card_run_image_back" id="card_run_image_back">
                            @error('card_run_image_back')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> الصورة الخلفية لكرة التشغيل </label>
                            <input type="file" class="form-control " name="card_run_image_front" id="card_run_image_front">
                            @error('card_run_image_front')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> اضافة</button>
                            <a href="{{ route('admin.car.index') }}" class="btn btn-sm btn-danger">الغاء</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/inv_itemcard.js') }}"></script>
@endsection
