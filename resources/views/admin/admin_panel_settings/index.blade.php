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
         <div id="ajax_responce_serarchDiv" class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">اسم الشركة</td>
                  <td > {{ $data['system_name'] }}</td>
               <!--</tr>-->
               <!--<tr>-->
                  <td class="width30">رقم الشركة</td>
                  <td > {{ $data['cr_number'] }}</td>
               </tr>
               
               <tr>
                  <td class="width30">الرقم الضريبي  للشركة </td>
                  <td > {{ $data['tax_number'] }}</td>
               <!--</tr>-->
               <!--<tr>-->
                  <td class="width30">عنوان الشركة عربي</td>
                  <td > {{ $data['address'] }}</td>
               </tr>
               
               <tr>
                  <td class="width30">عنوان الشركة انجليزي</td>
                  <td > {{ $data['address_two'] }}</td>
               <!--</tr>-->
               <!--<tr>-->
                  <td class="width30">هاتف الشركة</td>
                  <td > {{ $data['phone_one'] }}</td>
               </tr>
               
               <tr>
                  <td class="width30">ايميل  الشركة </td>
                  <td > {{ $data['email'] }}</td>
               <!--</tr>-->
               <!--  <tr>-->
                  <td class="width30">لون الثيم</td>
                  <td>
                      <div style="background-color:{{ $data['theme_color'] }}; padding: 20px; border: 1px solid #ccc;">
                          
                      </div>
                      </td>
               </tr>
               
               <tr>
                  <td class="width30">نبذة  الشركة </td>
                  <td>
                      
                  <p id="ellipsis" class="overflow-ellipsis" title="{{ $data['intro'] }}"><i class="fa fa-info fa-sm" style="color:{{ $data['theme_color'] }};"></i> {{ $data['intro'] }} </p>
                  </td>
               <!--</tr>-->
               <!--  <tr>-->
                  <td class="width30"> شروط العقد عربي   </td>
                  <td>
                      <p id="ellipsis" class="overflow-ellipsis" title="{{ $data['ar_contract'] }}"><i class="fa fa-info fa-sm" style="color:{{ $data['theme_color'] }};"></i> {{ $data['ar_contract'] }}</p>
                           </td>
               </tr>
               
                <tr>
                   <td class="width30"> شروط العقد انجليزي   </td>
                   <td>
                       <p id="ellipsis" class="overflow-ellipsis" title="{{ $data['en_contract'] }}"><i class="fa fa-info fa-sm" style="color:{{ $data['theme_color'] }};"></i> {{ $data['en_contract'] }} </p>
                            </td>
               <!--</tr>-->
              <!-- <tr>-->
              <!--    <td class="width30">   رمز العملة   </td>-->
              <!--    <td > {{ $data['currency_type'] }}</td>-->
              <!--</tr>-->
                              <!--<tr>-->
                   <!--<td colspan='2' class="width30"> عدد الكيلومترات لشعارات الصيانة مطلوب     </td>-->
                   <!--<td colspan='2'>-->
                   <!--    <p   title="{{ $data['number_of_km_mantince'] }}"> {{ $data['number_of_km_mantince'] *1 }} KM </p>-->
                   <!--         </td>-->
               <!--</tr>-->
               <!--<tr>-->
                  <td class="width30">   رمز العملة   </td>
                  <td > {{ $data['currency_type'] }}</td>
              </tr>
              <tr>
                  <td colspan='2' class="width30"> عدد الكيلومترات لشعارات الصيانة مطلوب     </td>
                   <td colspan='2'>
                       <p   title="{{ $data['number_of_km_mantince'] }}"> {{ $data['number_of_km_mantince'] *1 }} KM </p>
                            </td>
              </tr>
               <tr>
                  <td class="width30">لوجو  الشركة</td>
                  <td >
                     <div class="image">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
                     </div>
                  </td>
               <!--</tr>-->
               <!--<tr>-->
                 <td class="width30">صورة اللتر هيد</t>
                  <td >
                     <div class="image">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo_two'] }}"  alt="لوجو الشركة">       
                     </div>
                  </td>
               </tr>
               
                 <tr>
                  <td class="width30">صورة الختم</td>
                  <td >
                     <div class="image">
                        <img class="custom_img" src="{{ asset('/assets/admin/uploads').'/'.$data['mark_image'] }}"  alt="صورة الختم">       
                     </div>
                  </td>
               <!--</tr>-->
               <!--<tr>-->
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