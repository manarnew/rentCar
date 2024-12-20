@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection
@section('contentheader')
الأدوار
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.permission_roles.index') }}">  أدوار المستخدمين </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">بيانات   أدوار المستخدمين</h3>
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
            @if(check_permission_sub_menue_actions(30)==true) 
            <a href="{{ route('admin.permission_roles.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> اضافة جديد</a>
            @endif
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div id="ajax_responce_serarchDiv">
               @if (@isset($data) && !@empty($data) && count($data) >0)
               @php
               $i=1;   
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>مسلسل</th>
                     <th>اسم الدور</th>
                    
                     <th>حالة التفعيل</th>
                     <th> تاريخ الاضافة</th>
                     <th> تاريخ التحديث</th>
                     <th>إجراء</th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info )
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->name }}</td>
                        
                        <td>@if($info->active==1) مفعل @else معطل @endif</td>
                        <td > 
                           @php
                           $dt=new DateTime($info->created_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($time));
                           $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                           @endphp
                           {{ $date }} <br>
                           {{ $time }}
                           {{ $newDateTimeType }}  <br>
                           بواسطة 
                           {{ $info->added_by_admin}}
                        </td>
                        <td > 
                           @if($info->updated_by>0 and $info->updated_by!=null )
                           @php
                           $dt=new DateTime($info->updated_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($time));
                           $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                           @endphp
                           {{ $date }}  <br>
                           {{ $time }}
                           {{ $newDateTimeType }}  <br>
                           بواسطة 
                           {{ $data['updated_by_admin'] }}
                           @else
                           لايوجد تحديث
                           @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                           @if(check_permission_sub_menue_actions(31)==true) 
                           <a type="button" class="btn btn-warning"                     
                            href="{{ route('admin.permission_roles.edit',$info->id) }}" style="color:#fff;" title="تعديل"><i class="fas fa-edit"></i>
                            </a>
                           <!--<a href="{{ route('admin.permission_roles.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   -->
                           @endif
                           @if(check_permission_sub_menue_actions(32)==true) 
                           <a type="button" class="btn btn-info"                     
                            href="{{ route('admin.permission_roles.details',$info->id) }}" style="color:#fff;" title="الصلاحيات"><i class="fas fa-universal-access"></i>
                            </a>
                           <!--<a href="{{ route('admin.permission_roles.details',$info->id) }}" class="btn btn-sm  btn-info">الصلاحيات</a>   -->
                           @endif
                           </div>
                        </td>
                     </tr>
                     @php
                     $i++; 
                     @endphp
                     @endforeach
                  </tbody>
               </table>
               <br>
               {{ $data->links() }}
               @else
               <div class="alert alert-danger">
                  عفوا لاتوجد بيانات لعرضها !!
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/admin/js/treasuries.js') }}"></script>
@endsection