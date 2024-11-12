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
<a href="{{ route('admin.adminPanelSetting_API.index_API') }}"> الضبط </a>
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
      <form action="{{ route('admin.adminPanelSetting_API.update_API') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="row">
      
         <div class="col-md-4">
            <div class="form-group">
               <label>Inctance id</label> 
              
           <textarea name="Inctance_id" class="form-control " id="Inctance_id" cols="100" rows="5" readonly>{{$data['Inctance_id']}}</textarea>
               @error('Inctance_id')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
        <div class="col-md-4">
            <div class="form-group">
               <label> Access Token</label> 
              
           <textarea name="access_token" class="form-control " id="access_token" cols="100" rows="5" readonly>{{$data['access_token']}}</textarea>
               @error('access_token')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
       
        <div class="col-md-4">
            <div class="form-group">
               <label>Message</label> 
              
           <textarea name="message" class="form-control " id="message" cols="100" rows="5">{{$data['message']}}</textarea>
               @error('message')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
       
        <div class="col-md-4">
            <div class="form-group">
               <label>notfication number</label> 
              
           <textarea name="notfication_number" class="form-control " id="notfication_number" cols="100" rows="5">{{$data['notfication_number']}}</textarea>
               @error('notfication_number')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>
          <div class="col-md-4">
            <div class="form-group">
               <label>country key</label> 
              
           <textarea name="country_key" class="form-control " id="country_key" cols="100" rows="5">{{$data['country_key']}}</textarea>
               @error('country_key')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
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