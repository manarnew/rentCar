@extends('layouts.admin')
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
                  <input name="cr_number" id="cr_number" class="form-control" value="{{ $data['cr_number'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('cr_number')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>رقم الضريبي للشركة</label>
                  <input name="tax_number" id="tax_number" class="form-control" value="{{ $data['tax_number'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('tax_number')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>عنوان الشركة</label>
                  <input name="address" id="address" class="form-control" value="{{ $data['address'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                  @error('address')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror  
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>هاتف الشركة الاول</label>
                  <input name="phone_one" id="phone_one" class="form-control" value="{{ $data['phone_one'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('phone_one')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>هاتف الشركة الثاني</label>
                  <input name="phone_two" id="phone_two" class="form-control" value="{{ $data['phone_two'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('phone_two')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>ايميل الشركة </label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ $data['email'] }}" placeholder="ايميل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror   
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> نبذة</label> 
                 
              <textarea name="intro" class="form-control " id="intro" cols="100" rows="5">{{$data['intro']}}</textarea>
                  @error('intro')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
               <label> شروط العقد عربي </label> 
              
           <textarea name="ar_contract" class="form-control " id="ar_contract" cols="100" rows="5">{{$data['ar_contract']}}</textarea>
               @error('ar_contract')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
       <div class="col-md-12">
         <div class="form-group">
            <label> شروط العقد انجليزي </label> 
           
        <textarea name="en_contract" class="form-control " id="en_contract" cols="100" rows="5">{{$data['en_contract']}}</textarea>
            @error('en_contract')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
          <label> نوع   العملة</label>
          <select name="currency_type" id="currency_type" class="form-control ">
              <option value=""> اختر نوع العملة </option>
              <option value="$"> دولار</option>
          </select>
          @error('currency_type')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
  </div>
            <div class="col-md-12">
               <div class="form-group"  >
                  <label>شعار الشركة</label>
                  <div class="image">
                     <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
                     <button type="button" class="btn btn-sm btn-danger" id="image_upload">تغير الصورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_upload"> الغاء</button>
                  </div>
               </div>
               <div id="old_image">
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group"  >
                  <label>شعار الشركة</label>
                  <div class="image">
                     <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['mark_image'] }}"  alt="لوجو الشركة">       
                     <button type="button" class="btn btn-sm btn-danger" id="image_mark_image_upload">تغير الصورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_image_mark_image_upload"> الغاء</button>
                  </div>
               </div>
               <div id="old_image_mark_image">
               </div>
            </div>
            <div class="col-md-12">
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script>
      $('#intro').summernote({
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
</script>
@endsection