@extends('layouts.admin')
@section('title')
    ضبط العملاء
@endsection
@section('contentheader')
    العملاء
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.customer.index') }}"> العملاء </a>
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
            <form action="{{ route('admin.customer.update', $data['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input name="name" id="name" class="form-control"
                                value="{{ old('name', $data['name']) }}" placeholder="ادخل اسم الصنف">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>اسم الشركة</label>
                            <input name="com_name" id="com_name" class="form-control"
                                value="{{ old('com_name', $data['com_name']) }}" placeholder="اسم الشركة">
                            @error('com_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>رقم الهوية </label>
                            <input name="identity_number" id="identity_number" class="form-control"
                                value="{{ old('identity_number', $data['identity_number']) }}" placeholder="رقم الهوية ">
                            @error('identity_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تاريخ اصدار الهوية </label>
                            <input type="date" name="identity_release_date" id="identity_release_date"
                                class="form-control"
                                value="{{ old('identity_release_date', $data['identity_release_date']) }}"
                                placeholder="تاريخ  اصدار الهوية ">
                            @error('identity_release_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تاريخ انتهاء الهوية </label>
                            <input type="date" name="identity_end_date" id="identity_end_date" class="form-control"
                                value="{{ old('identity_end_date', $data['identity_end_date']) }}"
                                placeholder="تاريخ  انتهاء الهوية ">
                            @error('identity_end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>مكان اصدار الهوية </label>
                            <input name="identity_address" id="identity_address" class="form-control"
                                value="{{ old('identity_address', $data['identity_address']) }}"
                                placeholder="تاريخ  انتهاء الهوية ">
                            @error('identity_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!--<div class="col-md-3">-->
                    <!--    <div class="form-group">-->
                    <!--        <label> الصورة الامامية للهوية</label>-->
                    <!--        <div class="image">-->
                    <!--            <img class="custom_img"-->
                    <!--                src="{{ asset('assets/admin/uploads') . '/' . $data['identity_front_image'] }}">-->
                    <!--            <button type="button" class="btn btn-sm btn-danger" id="identity_front_image_upload">تغير-->
                    <!--                الصورة</button>-->
                    <!--            <button type="button" class="btn btn-sm btn-danger" style="display: none;"-->
                    <!--                id="cancel_identity_front_image_upload"> الغاء</button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div id="old_identity_front_image">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-3">-->
                    <!--    <div class="form-group">-->
                    <!--        <label> الصورة الخلفية للهوية</label>-->
                    <!--        <div class="image">-->
                    <!--            <img class="custom_img"-->
                    <!--                src="{{ asset('assets/admin/uploads') . '/' . $data['identity_back_image'] }}">-->
                    <!--            <button type="button" class="btn btn-sm btn-danger" id="identity_back_image_upload">تغير-->
                    <!--                الصورة</button>-->
                    <!--            <button type="button" class="btn btn-sm btn-danger" style="display: none;"-->
                    <!--                id="cancel_identity_back_image_upload"> الغاء</button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div id="old_identity_back_image">-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> رقم الهاتف</label> <span id="nameCheckMessage"> </span>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $data['phone']) }}" placeholder="رقم الهاتف ">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> البريد الالكتروني </label>
                            <input name="email" id="email" class="form-control" placeholder=" الايميل"
                                value="{{ old('email', $data['email']) }}"
                                oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')"
                                onchange="try{setCustomValidity('')}catch(e){}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>عنوان العمل</label>
                            <input name="word_address" id="word_address" class="form-control"
                                value="{{ old('word_address', $data['word_address']) }}" placeholder="عنوان العمل ">
                            @error('word_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> عنوان السكن</label>
                        <input name="address" id="address" class="form-control"
                            value="{{ old('address', $data['address']) }}" placeholder="عنوان السكن">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> الجنسية</label>
                        <input name="nationality" id="nationality" class="form-control"
                            value="{{ old('nationality', $data['nationality']) }}" placeholder="ادخل الجنسية ">
                        @error('nationality')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> رقم رخصة القيادة </label>
                        <input name="driver_license_number" id="driver_license_number" class="form-control"
                            value="{{ old('driver_license_number', $data['driver_license_number']) }}"
                            placeholder="رقم رخصة القيادة">
                        @error('driver_license_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> مكان اصدار رخصة القيادة </label>
                        <input name="driver_license_address" id="driver_license_address" class="form-control"
                            value="{{ old('driver_license_address', $data['driver_license_address']) }}"
                            placeholder="مكان اصدار رخصة القيادة">
                        @error('driver_license_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> تاريخ اصدار رخصة القيادة</label>
                        <input type="date" name="driver_license_release_date" id="driver_license_release_date"
                            class="form-control"
                            value="{{ old('driver_license_release_date', $data['driver_license_release_date']) }}"
                            placeholder="تاريخ اصدار رخصة القيادة">
                        @error('driver_license_release_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> تاريخ انتهاء رخصة القيادة</label>
                        <input type="date" name="driver_license_address_end_date" id="driver_license_address_end_date"
                            class="form-control"
                            value="{{ old('driver_license_address_end_date', $data['driver_license_address_end_date']) }}"
                            placeholder="تاريخ انتهاء رخصة القيادة">
                        @error('driver_license_address_end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-group">
                        <label> ملاحظات</label>
                        <textarea style="height:38px" name="details" class="form-control " id="details" cols="100" rows="5"> {{ old('details', $data['details']) }}</textarea>
                        @error('details')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label> الصورة الامامية للهوية</label>
                            <div class="image">
                                <img class="custom_img"
                                    src="{{ asset('assets/admin/uploads') . '/' . $data['identity_front_image'] }}">
                                <button type="button" class="btn btn-sm btn-danger" id="identity_front_image_upload">تغير
                                    الصورة</button>
                                <button type="button" class="btn btn-sm btn-danger" style="display: none;"
                                    id="cancel_identity_front_image_upload"> الغاء</button>
                            </div>
                        </div>
                        <div id="old_identity_front_image">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> الصورة الخلفية للهوية</label>
                            <div class="image">
                                <img class="custom_img"
                                    src="{{ asset('assets/admin/uploads') . '/' . $data['identity_back_image'] }}">
                                <button type="button" class="btn btn-sm btn-danger" id="identity_back_image_upload">تغير
                                    الصورة</button>
                                <button type="button" class="btn btn-sm btn-danger" style="display: none;"
                                    id="cancel_identity_back_image_upload"> الغاء</button>
                            </div>
                        </div>
                        <div id="old_identity_back_image">
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> الصورة الامامية لرخصة القيادة</label>
                        <div class="image">
                            <img class="custom_img"
                                src="{{ asset('assets/admin/uploads') . '/' . $data['driver_license_front_image'] }}">
                            <button type="button" class="btn btn-sm btn-danger"
                                id="driver_license_front_image_upload">تغير الصورة</button>
                            <button type="button" class="btn btn-sm btn-danger" style="display: none;"
                                id="cancel_driver_license_front_image_upload"> الغاء</button>
                        </div>
                    </div>
                    <div id="old_driver_license_front_image">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label> الصورة الخلفية لرخصة الفيادة</label>
                        <div class="image">
                            <img class="custom_img"
                                src="{{ asset('assets/admin/uploads') . '/' . $data['driver_license_back_image'] }}">
                            <button type="button" class="btn btn-sm btn-danger"
                                id="driver_license_back_image_upload">تغير الصورة</button>
                            <button type="button" class="btn btn-sm btn-danger" style="display: none;"
                                id="cancel_driver_license_back_image_upload"> الغاء</button>
                        </div>
                    </div>
                    <div id="old_driver_license_back_image">
                    </div>
                </div>

                <!--<div class="col-md-12">-->
                <!--    <div class="form-group">-->
                <!--        <label> ملاحظات</label>-->
                <!--        <textarea name="details" class="form-control " id="details" cols="100" rows="5"> {{ old('details', $data['details']) }}</textarea>-->
                <!--        @error('details')-->
                <!--            <span class="text-danger">{{ $message }}</span>-->
                <!--        @enderror-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm"> حفظ
                            التعديلات</button>
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
        $(document).on('click', '#identity_front_image_upload', function(e) {
            e.preventDefault();
            if (!$("#image").length) {
                $("#identity_front_image_upload").hide();
                $("#cancel_identity_front_image_upload").show();
                $("#old_identity_front_image").html(
                    '<br><input type="file" onchange="readURL(this)"  name="identity_front_image" id="identity_front_image" > '
                    );
            }
            return false;
        });
        $(document).on('click', '#cancel_identity_front_image_upload', function(e) {
            e.preventDefault();
            $("#identity_front_image_upload").show();
            $("#cancel_identity_front_image_upload").hide();
            $("#old_identity_front_image").html('');
            return false;
        });

        $(document).on('click', '#identity_back_image_upload', function(e) {
            e.preventDefault();
            if (!$("#image").length) {
                $("#identity_back_image_upload").hide();
                $("#cancel_identity_back_image_upload").show();
                $("#old_identity_back_image").html(
                    '<br><input type="file" onchange="readURL(this)"  name="identity_back_image" id="identity_back_image" > '
                    );
            }
            return false;
        });
        $(document).on('click', '#cancel_identity_back_image_upload', function(e) {
            e.preventDefault();
            $("#identity_back_image_upload").show();
            $("#cancel_identity_back_image_upload").hide();
            $("#old_identity_back_image").html('');
            return false;
        });

        $(document).on('click', '#driver_license_front_image_upload', function(e) {
            e.preventDefault();
            if (!$("#image").length) {
                $("#driver_license_front_image_upload").hide();
                $("#cancel_driver_license_front_image_upload").show();
                $("#old_driver_license_front_image").html(
                    '<br><input type="file" onchange="readURL(this)"  name="driver_license_front_image" id="driver_license_front_image" > '
                    );
            }
            return false;
        });
        $(document).on('click', '#cancel_driver_license_front_image_upload', function(e) {
            e.preventDefault();
            $("#driver_license_front_image_upload").show();
            $("#cancel_driver_license_front_image_upload").hide();
            $("#old_driver_license_front_image").html('');
            return false;
        });

        $(document).on('click', '#driver_license_back_image_upload', function(e) {
            e.preventDefault();
            if (!$("#image").length) {
                $("#driver_license_back_image_upload").hide();
                $("#cancel_driver_license_back_image_upload").show();
                $("#old_driver_license_back_image").html(
                    '<br><input type="file" onchange="readURL(this)"  name="driver_license_back_image" id="driver_license_back_image" > '
                    );
            }
            return false;
        });
        $(document).on('click', '#cancel_driver_license_back_image_upload', function(e) {
            e.preventDefault();
            $("#driver_license_back_image_upload").show();
            $("#cancel_driver_license_back_image_upload").hide();
            $("#old_driver_license_back_image").html('');
            return false;
        });
    </script>
@endsection
