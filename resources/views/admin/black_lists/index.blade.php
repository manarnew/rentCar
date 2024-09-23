@extends('layouts.admin')
@section('title')
 القائمة السوداء
@endsection
@section('contentheader')
القائمة السوداء 
@endsection
@section('contentheaderlink')
<a href="{{ route('Black_lists.index') }}">  القائمة السوداء </a>
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
                     <th>  اسم العميل  </th>
                     <th> رقم الهوية</th>
                     <th> رقم الهاتف</th>
                     <th> عنوان العميل</th>
                     <th>  سبب الحظر</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info )
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->customer->name }}</td>
                        <td>{{ $info->customer->identity_number }}</td>
                        <td>{{ $info->customer->phone }}</td>
                        <td>{{ $info->customer->address }}</td>
                        <td>{{ $info->note }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(8)==true) 
                            <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.Black_lists.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(7)==true) 
                            <a type="button" class="btn btn-warning"                     
                            href="{{ route('Black_lists.edit',$info->id) }}" style="color:#fff;" title="تعديل"><i class="fas fa-edit"></i>
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