@extends('layouts.admin')
@section('title')
ضبط السيارات
@endsection
@section('contentheader')
فئات السيارات
@endsection
@section('contentheaderlink')
<a href="{{ route('carType.index') }}"> فئات السيارات </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">بيانات  فئات السيارات</h3>
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
            @if(check_permission_sub_menue_actions(6)==true) 
            <a href="{{ route('carType.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
            @endif
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div id="ajax_responce_serarchDiv">
               @if (@isset($data) && !@empty($data) && count($data)>0)
               @php
               $i=1;   
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>مسلسل</th>
                     <th>اسم الفئة</th>
                     <th> تاريخ الاضافة</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info )
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->name }}</td>
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
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(8)==true) 
                            <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.carType.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(7)==true) 
                            <a type="button" class="btn btn-warning"                     
                            href="{{ route('carType.edit',$info->id) }}" style="color:#fff;" title="تعديل"><i class="fas fa-edit"></i>
                            </a>
                            @endif
                            <!--<button type="button" class="btn btn-success">Right</button>-->
                            
                           
                            
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