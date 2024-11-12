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
            <h3 class="card-title card_title_center">إعدادات Api واتساب </h3>
         </div>
         <!-- /.card-header -->
         <div id="ajax_responce_serarchDiv" class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                   <td > {{ $data['Inctance_id'] }}</td>
                   <td class="width30">Inctance_id &nbsp;<i class="fas fa-info" title="API Whatsapp Inctance_id">&nbsp;</i></td>
               </tr>
               
               <tr>
                   <td > {{ $data['access_token'] }}</td>
                   <td class="width30">اAccess_token &nbsp;<i class="fas fa-info" title="API Whatsapp Access_token"></i> </td>
               </tr>
               
               <tr>
                   <td > {{ $data['message'] }}</td>
                   <td class="width30">Message &nbsp;<i class="fas fa-info" title="اكتب رسالة مرفقة مع العقد علي الواتساب"></i></td>
               </tr>
             
                 <tr>
                   <td > {{ $data['notfication_number'] }}</td>
                   <td class="width30">notfication number &nbsp;<i class="fas fa-info" title="رقم واتساب لارسال اشعارات النظام"></i></td>
               </tr>
                 <tr>
                   <td > {{ $data['country_key'] }}</td>
                   <td class="width30">Tracking link &nbsp;<i class="fas fa-info" title="رابط الطرف الثالث لتتبع السيارات"></i></td>
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
                     <a href="{{ route('admin.adminPanelSetting_API.edit_API') }}" class="btn btn-sm btn-success">تعديل</a>
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