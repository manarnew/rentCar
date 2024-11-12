<!--@extends('layouts.admin')-->
@section('title')
تعديل الضبط العام
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheader')
الضبط
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.adminPanelSetting.index') }}"> الضبط </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">تعديل بيانات الضبط العام</h3>
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      @if (@isset($data) && !@empty($data))
      <form action="{{ route('admin.adminPanelSetting.update') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>اسم الشركة</label>
                  <input name="system_name" id="system_name" class="form-control" value="{{ $data['system_name'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('system_name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>رقم الشركة</label>
                  <input name="cr_number" id="cr_number" class="form-control" value="{{ $data['cr_number'] }}" placeholder="ادخل رقم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('cr_number')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>رقم الضريبي للشركة</label>
                  <input name="tax_number" id="tax_number" class="form-control" value="{{ $data['tax_number'] }}" placeholder="ادخل الرقم الضريبي" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('tax_number')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>عنوان الشركة عربي</label>
                  <input name="address" id="address" class="form-control" value="{{ $data['address'] }}" placeholder="ادخل عنوان الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('address')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror  
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>عنوان الشركة انجليزي</label>
                  <input name="address_two" id="address_two" class="form-control" value="{{ $data['address_two'] }}" placeholder="ادخل عنوان الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('address_two')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>هاتف الشركة</label>
                  <input name="phone_one" id="phone_one" class="form-control" value="{{ $data['phone_one'] }}" placeholder="ادخل هاتف الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('phone_one')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>ايميل الشركة </label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ $data['email'] }}" placeholder="ايميل البريد الالكتروني للشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
               
            <div class="col-md-4">
               <div class="form-group">
                  <label>لون الثيم</label>
                  
                  <input type="color" name="theme_color" id="favcolor" class="form-control" value="{{ $data['theme_color'] }}" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" value="#ff0000">
                  @error('theme_color')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <!---->
              <div class="col-md-4">
      <div class="form-group">
          <label> رمز   العملة</label>
          <select name="currency_type" id="currency_type" class="form-control ">
              <option value="{{ $data['currency_type'] }}">{{ $data['currency_type'] }}</option>
              <option value="$"> $</option>
              <option value="EGP"> EGP</option>
              <option value="IQD"> IQD</option>
              <option value="SYP"> SYP</option>
              <option value="LBP"> LBP</option>
              <option value="JOD"> JOD</option>
              <option value="SAR"> SAR</option>
              <option value="YER"> YER</option>
              <option value="LYD"> LYD</option>
              <option value="SDG"> SDG</option>
              <option value="MAD"> MAD</option>
              <option value="TND"> TND</option>
              <option value="KWD"> KWD</option>
              <option value="DZD"> DZD</option>
              <option value="MRO"> MRO</option>
              <option value="BHD"> BHD</option>
              <option value="QAR"> QAR</option>
              <option value="AED"> AED</option>
              <option value="OMR"> OMR</option>
              <option value="SOS"> SOS</option>
              <option value="PP"> PP</option>
              <option value="FDJ"> FDJ</option>
              <option value="KMF"> KMF</option>
              
          </select>
          @error('currency_type')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>
   <div class="col-md-12">
                            <div class="form-group">
                                      <label> عدد الكيلومترات لشعارات الصيانة مطلوب    </label>
                               <input type="number" name="number_of_km_mantince" id="number_of_km_mantince" class="form-control" value="{{ $data['number_of_km_mantince'] *1 }}" placeholder=" عدد الكيلومترات لشعارات الصيانة مطلوب " oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                               @error('number_of_km_mantince')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror   
                            </div>
                         </div>
            <!---->
            <div class="col-md-4">
               <div class="form-group">
                  <label> حول الشركة</label> 
                 
              <textarea name="intro" class="form-control " id="intro" cols="100" value="برنامج إدارة شركات تأجير السيارات من البرامج المميزة التي تساعد أصحاب شركات أو مكاتب تأجير السيارات والمركبات على الإدارة المتميزة لعملية تأجير السيارات بكل سهولة ويسر , ومن خلال البرنامج يمكن الإطلاع على سير العملية الإدارية والمحاسبية للشركة , ويمكن الاطلاع على كافة التقارير في النظام بين تاريخين مما ينظم العملية الإدارية والمحاسبية" rows="5">{{$data['intro']}}</textarea>
                  @error('intro')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
               <label> شروط العقد عربي </label> 
              
           <textarea name="ar_contract" class="form-control " id="ar_contractr" cols="100" rows="5">{{$data['ar_contract']}}</textarea>
               @error('ar_contract')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
    
       <div class="col-md-4">
         <div class="form-group">
            <label> شروط العقد انجليزي </label> 
           
        <textarea name="en_contract" class="form-control " id="en_contractc" cols="100" rows="5">{{$data['en_contract']}}</textarea>
            @error('en_contract')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
     <div class="col-md-4">
               <div class="form-group"  >
                  <label>شعار الشركة</label>
                  <div class="img-thumbnail image">
                     <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
                     <button type="button" class="btn btn-sm btn-danger" id="image_upload">تغير الصورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload"> الغاء</button>
                  </div>
               </div>
               <div id="old_image">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group"  >
                  <label>صورة اللتر هيد</label>
                  <div class="img-thumbnail image">
                     <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo_two'] }}"  alt="صورة الختم">       
                     <button type="button" class="btn btn-sm btn-danger" id="image_photo_two_upload">تغير الصورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_photo_two_upload"> الغاء</button>
                  </div>
               </div>
               <div id="old_photo_two_image">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group"  >
                  <label>صورة الختم </label>
                  <div class="img-thumbnail image">
                     <img class="img-thumbnail custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['mark_image'] }}"  alt="صورة الختم">       
                     <button type="button" class="btn btn-sm btn-danger" id="image_mark_image_upload">تغير الصورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_mark_image_upload"> الغاء</button>
                  </div>
               </div>
               <div id="old_image_mark_image">
               </div>
            </div>
            <div class="col-md-12">
                <hr style="border-top: 1px solid {{ $data['theme_color'] }};">
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
               </div>
            </div>
         </div>
      </form>
      @else
      <div class="alert alert-danger">
         عفوا لاتوجد بيانات لعرضها !!
      </div>
      @endif
         </div>
         </div>
         @endsection
         @section("script")

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script>
      $('#introz').summernote({
        placeholder: 'نبذة',
        tabsize: 2,
        height: 100
      });
        </script>
        <script>
       $('#ar_contract').summernote({
        placeholder: 'نبذة',
        tabsize: 2,
        height: 100
      });
        </script>
        
        <script>
       $('#en_contract').summernote({
        placeholder: 'نبذة',
        tabsize: 2,
        height: 100
      });
     </script>
   
<script>
  $(document).on('click', '#image_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_upload").hide();
          $("#cancel_image_upload").show();
          $("#old_image").html('<br><input type="file" onchange="readURL(this)"  name="photo" id="photo" > ');
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

  $(document).on('click', '#image_mark_image_upload', function(e) {   
      e.preventDefault();
      if (!$("#image").length) {
          $("#image_mark_image_upload").hide();
          $("#cancel_image_mark_image_upload").show();
          $("#old_image_mark_image").html('<br><input type="file" onchange="readURL(this)"  name="mark_image" id="mark_image" > ');
      }
      return false;
  });
  $(document).on('click', '#cancel_image_mark_image_upload', function(e) {
      e.preventDefault();
      $("#image_mark_image_upload").show();
      $("#cancel_image_mark_image_upload").hide();
      $("#old_image_mark_image").html('');
      return false;
  });
  $(document).on('click', '#image_photo_two_upload', function(e) {   
   e.preventDefault();
   if (!$("#image").length) {
       $("#image_photo_two_upload").hide();
       $("#cancel_photo_two_image_upload").show();
       $("#old_photo_two_image").html('<br><input type="file" onchange="readURL(this)"  name="photo_two" id="photo_two" > ');
   }
   return false;
});
$(document).on('click', '#cancel_photo_two_image_upload', function(e) {
   e.preventDefault();
   $("#image_photo_two_upload").show();
   $("#cancel_photo_two_image_upload").hide();
   $("#old_photo_two_image").html('');
   return false;
});
</script>
@endsection