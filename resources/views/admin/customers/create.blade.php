@extends('layouts.admin')
@section('title')
ضبط العملاء
@endsection
@section('contentheader')
العملاء
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.customer.index') }}">  العملاء </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة عميل جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.customer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                    <div class="form-group">
                        <label>اسم العميل</label> 
                        <input name="name" id="name" class="form-control" value="{{ old('name') }}"
                            placeholder="ادخل اسم العميل">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>اسم الشركة</label> 
                        <input name="com_name" id="com_name" class="form-control" value="{{ old('com_name') }}"
                            placeholder="اسم الشركة">
                        @error('com_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>رقم الهوية </label> 
                        <input type="number" name="identity_number" id="identity_number" class="form-control" value="{{ old('identity_number') }}"
                            placeholder="رقم الهوية ">
                        @error('identity_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>تاريخ اصدار الهوية </label> 
                        <input type="date" name="identity_release_date" id="identity_release_date" class="form-control" value="{{ old('identity_release_date') }}"
                            placeholder="تاريخ  اصدار الهوية ">
                        @error('identity_release_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>تاريخ انتهاء الهوية </label> 
                        <input type="date" name="identity_end_date" id="identity_end_date" class="form-control" value="{{ old('identity_end_date') }}"
                            placeholder="تاريخ  انتهاء الهوية ">
                        @error('identity_end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>مكان اصدار الهوية </label> 
                        <input  name="identity_address" id="identity_address" class="form-control" value="{{ old('identity_address') }}"
                            placeholder="تاريخ  انتهاء الهوية ">
                        @error('identity_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3">
                    <div class="form-group"> 
                        <label>   الصورة الامامية للهوية</label>
                        <input type="file" class="form-control "  name="identity_front_image" id="identity_front_image" >
                        @error('identity_front_image')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label>   الصورة الخلفية للهوية</label>
                            <input type="file" class="form-control "  name="identity_back_image" id="identity_back_image" >
                            @error('identity_back_image')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>
                        </div>
                            <div class="col-md-3">
                    <div class="form-group">
                        <label> رقم الجوال</label> <span id="nameCheckMessage"> </span>
                        <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="رقم الجوال ">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>    البريد الالكتروني </label>
                        <input name="email" id="email" class="form-control"  placeholder=" الايميل" value="{{ old('email') }}"  oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                    </div>
                     <div class="col-md-3">
                     <div class="form-group">
                        <label>عنوان العمل</label> 
                        <input name="word_address" id="word_address" class="form-control" value="{{ old('word_address') }}"
                            placeholder="عنوان العمل ">
                        @error('word_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            <div class="col-md-3">
            <div class="form-group">
               <label> عنوان السكن</label> 
               <input name="address" id="address" class="form-control" value="{{ old('address') }}"
                   placeholder="عنوان السكن">
               @error('address')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> الجنسية</label> 
                        <input name="nationality" id="nationality" class="form-control" value="{{ old('nationality') }}"
                            placeholder="ادخل الجنسية ">
                        @error('nationality')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>  رقم رخصة القيادة </label> 
                        <input name="driver_license_number" id="driver_license_number" class="form-control" value="{{ old('driver_license_number') }}"
                            placeholder="رقم رخصة القيادة">
                        @error('driver_license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>  مكان اصدار رخصة القيادة </label> 
                        <input name="driver_license_address" id="driver_license_address" class="form-control" value="{{ old('driver_license_address') }}"
                            placeholder="مكان اصدار رخصة القيادة">
                        @error('driver_license_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>  تاريخ اصدار رخصة القيادة</label> 
                        <input type="date" name="driver_license_release_date" id="driver_license_release_date" class="form-control" value="{{ old('driver_license_release_date') }}"
                            placeholder="تاريخ اصدار رخصة القيادة">
                        @error('driver_license_release_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>  تاريخ انتهاء رخصة القيادة</label> 
                        <input type="date" name="driver_license_address_end_date" id="driver_license_address_end_date" class="form-control" value="{{ old('driver_license_address_end_date') }}"
                            placeholder="تاريخ انتهاء رخصة القيادة">
                        @error('driver_license_address_end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3">
                    <div class="form-group"> 
                        <label>   الصورة الامامية لرخصة القيادة</label>
                        <input type="file" class="form-control "  name="driver_license_front_image" id="driver_license_front_image" >
                        @error('driver_license_front_image')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label>   الصورة الخلفية لرخصة الفيادة</label>
                            <input type="file" class="form-control "  name="driver_license_back_image" id="driver_license_back_image" >
                            @error('driver_license_back_image')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>
                        </div>
                            <div class="col-md-3">
                     <div class="form-group">
                        <label> ملاحظات</label> 
                            <textarea style="height:38px" name="details" class="form-control " id="details" cols="100" rows="5"></textarea>
                        @error('details')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> اضافة</button>
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
    <script src="{{ asset('assets/admin/js/inv_itemcard.js') }}"></script>
@endsection
