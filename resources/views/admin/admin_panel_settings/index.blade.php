@extends('layouts.admin')
@section('title')
الضبط العام
@endsection
@section('contentheader')
الضبط
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.adminPanelSetting.index') }}"> الضبط </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">بيانات الضبط العام</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">اسم الشركة</td>
                  <td > {{ $data['system_name'] }}</td>
               </tr>
               <tr>
                  <td class="width30">رقم الشركة</td>
                  <td > {{ $data['cr_number'] }}</td>
               </tr>
               <tr>
                  <td class="width30">الرقم الضريبي  للشركة </td>
                  <td > {{ $data['tax_number'] }}</td>
               </tr>
               <tr>
                  <td class="width30">عنوان الشركة</td>
                  <td > {{ $data['address'] }}</td>
               </tr>
               <tr>
                  <td class="width30">هاتف الشركة الاول</td>
                  <td > {{ $data['phone_one'] }}</td>
               </tr>
               <tr>
                  <td class="width30">هاتف  الشركة الثاني</td>
                  <td > {{ $data['phone_two'] }}</td>
               </tr>
               <tr>
                  <td class="width30">ايميل  الشركة </td>
                  <td > {{ $data['email'] }}</td>
               </tr>
               <tr>
                  <td class="width30">نبذة  الشركة </td>
                  <td > @php
                      echo nl2br( $data['intro']) 
                  @endphp</td>
               </tr>
                 <tr>
                  <td class="width30"> شروط العقد عربي   </td>
                  <td > {{ $data['ar_contract'] }}</td>
               </tr>
                <tr>
                   <td class="width30"> شروط العقد انجليزي   </td>
                   <td > {{ $data['en_contract'] }}</td>
               </tr>
               <tr>
                  <td class="width30">   نوع العملة   </td>
                  <td > {{ $data['currency_type'] }}</td>
              </tr>
               <tr>
                  <td class="width30">لوجو  الشركة</td>
                  <td >
                     <div class="image">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="width30">صورة الختم</td>
                  <td >
                     <div class="image">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['mark_image'] }}"  alt="صورة الختم">       
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="width30">  تاريخ اخر تحديث</td>
                  <td > 
                     @if($data['updated_by']>0 and $data['updated_by']!=null )
                     @php
                     $dt=new DateTime($data['updated_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}
                     بواسطة 
                     {{ $data->user->name }}
                     @else
                     لايوجد تحديث
                     @endif
                     @if(check_permission_sub_menue_actions(40)==true) 
                     <a href="{{ route('admin.adminPanelSetting.edit') }}" class="btn btn-sm btn-success">تعديل</a>
                     @endif
                  </td>
               </tr>
            </table>
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