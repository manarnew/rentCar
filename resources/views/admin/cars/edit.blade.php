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
تعديل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> تعديل بيانات العميل </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <form action="{{ route('admin.car.update', $data['id']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> رقم اللوحة </label>
                                <input name="plate_number" id="plate_number" class="form-control"
                                    value="{{ old('plate_number', $data['plate_number']) }}" placeholder="ادخل  رقم اللوحة ">
                                @error('plate_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> لون السيارة</label>
                                <input name="car_color" id="car_color" class="form-control" value="{{ old('car_color', $data['car_color']) }}"
                                    placeholder=" لون السيارة">
                                @error('car_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> اختر نوع السيارة</label>
                                <select name="type_id" id="type_id" class="form-control ">
                                    <option value=""> اختر نوع السيارة </option>
                                    @foreach ($carType as $item)
                                        <option @if (old('type_id', $data['type_id']) == $item->id) selected="selected" @endif
                                            value="{{ $item->id }}"> {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> اختر موديل السيارة </label>
                                <select name="car_modals_id" id="car_modals_id" class="form-control ">
                                    <option value=""> اختر موديل السيارة </option>
                                    @foreach ($carModals as $item)
                                        <option @if (old('car_modals_id', $data['car_modals_id']) == $item->id) selected="selected" @endif
                                            value="{{ $item->id }}"> {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                @error('car_modals_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> عدد الكيلومترات الحالي </label>
                                <input type="number" name="km_number" id="km_number" class="form-control" value="{{ old('km_number', $data['km_number']) }}"
                                    placeholder=" عدد الكيلومترات الحالي ">
                                @error('km_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> سعر الاجار اليومي  </label>
                                <input type="number" name="daily_rent_price" id="daily_rent_price" class="form-control" value="{{ old('daily_rent_price', $data['daily_rent_price']) }}"
                                    placeholder=" سعر الاجار اليومي ">
                                @error('daily_rent_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> سعر الاجار الاسبوعي  </label>
                                <input type="number" name="weekly_rent_price" id="weekly_rent_price" class="form-control" value="{{ old('weekly_rent_price', $data['weekly_rent_price']) }}"
                                    placeholder=" سعر الاجار الاسبوعي ">
                                @error('weekly_rent_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> سعر الاجار الشهري  </label>
                                <input type="number" name="monthly_rent_price" id="monthly_rent_price" class="form-control" value="{{ old('monthly_rent_price', $data['monthly_rent_price']) }}"
                                    placeholder=" سعر الاجار الشهري ">
                                @error('monthly_rent_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> سعر الاجار بالساعة </label>
                                <input type="number" name="hourly_rent_price" id="hourly_rent_price" class="form-control" value="{{ old('hourly_rent_price', $data['hourly_rent_price']) }}"
                                    placeholder=" سعر الاجار بالساعة ">
                                @error('hourly_rent_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> سعر الاجار بالكيلو </label>
                                <input type="number" name="km_rent_price" id="km_rent_price" class="form-control" value="{{ old('km_rent_price', $data['km_rent_price']) }}"
                                    placeholder=" سعر الاجار بالكيلو ">
                                @error('km_rent_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                              <div class="col-md-3">
                        <div class="form-group">
                            <label> عدد كيلومترات اخر صيانة  </label>
                            <input name="km_for_mantince" id="km_for_mantince" class="form-control"
                                value="{{ old('km_for_mantince', $data['km_for_mantince']) }}" placeholder="ادخل  رقم اللوحة ">
                            @error('km_for_mantince')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="form-group">
           <label> تاريخ اشعار انتهاء الترخيص </label> 
                        <input type="date" name="driver_license_end_date" id="driver_license_end_date" class="form-control" value="{{ old('driver_license_end_date', $data['driver_license_end_date']) }}"
                            placeholder="تاريخ  انتهاء الهوية ">
                        @error('driver_license_end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>   تأمين </label>
                                <input name="insurance" id="insurance" class="form-control" value="{{ old('insurance', $data['insurance']) }}"
                                    placeholder="تأمين">
                                @error('insurance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> هل تامين شامل</label>
                                <select name="full_insurance" id="full_insurance" class="form-control ">
                                    <option value=""> اختر حالة تامين السيارة </option>
                                    <option @if (old('full_insurance', $data['full_insurance']) == 1) selected="selected" @endif value="1"> نعم
                                    </option>
                                    <option @if (old('full_insurance', $data['full_insurance']) == 0) selected="selected" @endif value="0"> لا
                                    </option>
                                </select>
                                @error('full_insurance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> هل يوجد طرف ثالث</label>
                                <select name="third_party" id="third_party" class="form-control ">
                                    <option value=""> اختر حالة طرف ثالث </option>
                                    <option @if (old('third_party', $data['third_party']) == 1) selected="selected" @endif value="1"> نعم
                                    </option>
                                    <option @if (old('third_party', $data['third_party']) == 0) selected="selected" @endif value="0"> لا
                                    </option>
                                </select>
                                @error('third_party')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> هل تغطية شامله </label>
                                <select name="full_cover" id="full_cover" class="form-control ">
                                    <option value=""> اختر حالة تغطية شامله </option>
                                    <option @if (old('full_cover', $data['full_cover']) == 1) selected="selected" @endif value="1"> نعم
                                    </option>
                                    <option @if (old('full_cover', $data['full_cover']) == 0) selected="selected" @endif value="0"> لا
                                    </option>
                                </select>
                                @error('full_cover')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> الامارات العربية المتحدة </label>
                                <select name="UAE" id="UAE" class="form-control ">
                                    <option value=""> اختر حالة الامارات العربية المتحدة</option>
                                    <option @if (old('UAE', $data['UAE']) == 1) selected="selected" @endif value="1"> نعم
                                    </option>
                                    <option @if (old('UAE', $data['UAE']) == 0) selected="selected" @endif value="0"> لا
                                    </option>
                                </select>
                                @error('UAE')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label> عمان </label>
                                <select name="oman" id="oman" class="form-control ">
                                    <option value=""> اختر حالة عمان </option>
                                    <option @if (old('oman', $data['oman']) == 1) selected="selected" @endif value="1"> نعم
                                    </option>
                                    <option @if (old('oman', $data['oman']) == 0) selected="selected" @endif value="0"> لا
                                    </option>
                                </select>
                                @error('oman')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"  >
                                <label>   صورة السيارة   </label>
                               <div class="img-thumbnail image">
                                  <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['image'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image">
                            </div>
                         </div>
                          <div class="col-md-4">
                            <div class="form-group"  >
                                <label> الصورة الأمامية لملكية السيارة</label>
                               <div class="img-thumbnail image">
                                  <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['car_own_image_front'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_car_own_image_front_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_car_own_image_front_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image_car_own_image_front">
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group"  >
                                <label> الصورة الخلفية لملكية السيارة</label>
                               <div class="img-thumbnail image">
                                  <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['car_own_image_back'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_car_own_image_back_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_car_own_image_back_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image_car_own_image_back">
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group"  >
                                <label> الصورة الأمامية لكرت التشغيل </label>
                               
                               <div class="img-thumbnail image">
                                  <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['card_run_image_front'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_card_run_image_front_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_card_run_image_front_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image_card_run_image_front">
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group"  >
                                <label> الصورة الخلفية لكرت التشغيل </label>
                               <div class="img-thumbnail image">
                                  <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['card_run_image_back'] }}"  >     
                                  <button type="button" class="btn btn-sm btn-danger" id="image_card_run_image_back_upload">تغير الصورة</button>
                                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_card_run_image_back_upload"> الغاء</button>
                               </div>
                            </div>
                            <div id="old_image_card_run_image_back">
                            </div>
                         </div>
                <div class="col-md-12">
            <div class="form-group text-center">
                <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm"> حفظ التعديلات</button>
                <a href="{{ route('admin.customer.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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


  $(document).on('click', '#image_car_own_image_front_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_car_own_image_front_upload").hide();
          $("#cancel_image_car_own_image_front_upload").show();
          $("#old_image_car_own_image_front").html('<br><input type="file" onchange="readURL(this)"  name="car_own_image_front" id="car_own_image_front" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_car_own_image_front_upload', function(e) {
      e.preventDefault();
      $("#image_car_own_image_front_upload").show();
      $("#cancel_image_car_own_image_front_upload").hide();
      $("#old_image_car_own_image_front").html('');
      return false;
  });
//////////////////////
$(document).on('click', '#image_car_own_image_back_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_car_own_image_back_upload").hide();
          $("#cancel_image_car_own_image_back_upload").show();
          $("#old_image_car_own_image_back").html('<br><input type="file" onchange="readURL(this)"  name="car_own_image_back" id="car_own_image_back" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_car_own_image_back_upload', function(e) {
      e.preventDefault();
      $("#image_car_own_image_back_upload").show();
      $("#cancel_image_car_own_image_back_upload").hide();
      $("#old_image_car_own_image_back").html('');
      return false;
  });
//////////////////////////
  $(document).on('click', '#image_card_run_image_front_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_card_run_image_front_upload").hide();
          $("#cancel_image_card_run_image_front_upload").show();
          $("#old_image_card_run_image_front").html('<br><input type="file" onchange="readURL(this)"  name="card_run_image_front" id="card_run_image_front" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_card_run_image_front_upload', function(e) {
      e.preventDefault();
      $("#image_card_run_image_front_upload").show();
      $("#cancel_image_card_run_image_front_upload").hide();
      $("#old_image_card_run_image_front").html('');
      return false;
  });
  //////////////////////////
  $(document).on('click', '#image_card_run_image_back_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_card_run_image_back_upload").hide();
          $("#cancel_image_card_run_image_back_upload").show();
          $("#old_image_card_run_image_back").html('<br><input type="file" onchange="readURL(this)"  name="card_run_image_back" id="card_run_image_back" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_card_run_image_back_upload', function(e) {
      e.preventDefault();
      $("#image_card_run_image_back_upload").show();
      $("#cancel_image_card_run_image_back_upload").hide();
      $("#old_image_card_run_image_back").html('');
      return false;
  });
    </script>  
@endsection   
