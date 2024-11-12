@extends('layouts.admin')
@section('title')
المستخدمين
@endsection
@section('contentheader')
المستخدمين
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.admins_accounts.index') }}"> المستخدمين </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">تعديل بيانات مستخدم   </h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <form action="{{ route('admin.admins_accounts.update',$data['id']) }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label>اسم   المستخدم كاملا</label>
                  <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"   >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group">
                  <label>    البريد الالكتروني </label>
                  <input name="email" id="email" class="form-control" value="{{ old('email',$data['email']) }}"  oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>

               <div class="form-group">
                  <label>   بيانات الأدوار </label>
                  <select name="permission_roles_id" id="permission_roles_id" class="form-control ">
                     <option value="">اختر صلاحية الدور للمستخدم  </option>
                     @if (@isset($Permission_rols) && !@empty($Permission_rols))
                     @foreach ($Permission_rols as $info )
                     <option  {{  old('permission_roles_id',$data['permission_roles_id'])==$info->id ? 'selected' : ''}}  value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('permission_roles_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group">
                  <label>اسم  المستخدم للدخول به للنظام </label>
                  <input name="username" id="username" class="form-control" value="{{ old('username',$data['username']) }}"  oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('username')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group">
                  <label>   هل تريد تحديث كلمة المرور</label>
                  <select name="checkForupdatePassword" id="checkForupdatePassword" class="form-control">
                     <option {{ old('checkForupdatePassword',$data['checkForupdatePassword'])==0 ? 'selected' : ''}}  value="0"> لا</option>
                     <option {{  old('checkForupdatePassword',$data['checkForupdatePassword'])==1 ? 'selected' : ''}}   value="1"> نعم</option>
                  </select>
                  @error('checkForupdatePassword')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>


               <div class="form-group" id="PasswordDIV"  @if(old('checkForupdatePassword')==0 ) style="display: none;" @endif >
                  <label>كلمة المرور   للدخول به للنظام </label>
                  <input name="password" type="password" id="password" class="form-control" value=""  oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group">
                  <label>  حالة التفعيل</label>
                  <select name="active" id="active" class="form-control">
                     <option value="">اختر الحالة</option>
                     <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}   value="1"> نعم</option>
                     <option {{ old('active',$data['active'])==0 ? 'selected' : ''}}  value="0"> لا</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                      <label>رقم الهوية </label>
                      <input name="identity_number" id="identity_number" class="form-control"
                          value="{{ old('identity_number', $data['identity_number']) }}" placeholder="رقم الهوية ">
                      @error('identity_number')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>
               <div class="col-md-12">
                  <div class="form-group"  >
                      <label>   الصورة   </label>
                     <div class="image">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['image'] }}"  >     
                        <button type="button" class="btn btn-sm btn-danger" id="image_upload">تغير الصورة</button>
                        <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload"> الغاء</button>
                     </div>
                  </div>
                  <div id="old_image">
                  </div>
               </div>
               <div class="col-md-6">
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
             
              <div class="col-md-6">
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
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                  <a href="{{ route('admin.admins_accounts.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
               </div>
            </form>
            @else
            <div class="alert alert-danger">
               عفوا لاتوجد بيانات لعرضها !!
            </div>
            @endif
         </div>
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
document.addEventListener('DOMContentLoaded', function() {
  var checkForupdatePassword = document.getElementById('checkForupdatePassword');
  var PasswordDIV = document.getElementById('PasswordDIV');

  // Set the initial state of the PasswordDIV based on the selected value
  if (checkForupdatePassword.value === '0') {
    PasswordDIV.style.display = 'none';
  } else {
    PasswordDIV.style.display = 'block';
  }

  checkForupdatePassword.addEventListener('change', function(e) {
    if (this.value === '1') {
      PasswordDIV.style.display = 'block';
    } else {
      PasswordDIV.style.display = 'none';
    }
  });
});
</script>
@endsection