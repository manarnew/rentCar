@extends('layouts.admin')
@section('title')
 البلاغات
@endsection
@section('contentheader')
البلاغات
@endsection
@section('contentheaderlink')
<a href="{{ route('communique.index') }}"> البلاغات  </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">بيانات  البلاغات</h3>
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
                     <th>  اسم العميل</th>
                     <th> رقم الهوية</th>
                     <th> رقم العقد</th>
                     <th> رقم البلاغات</th>
                     <th> تاريخ البلاغات</th>
                     <th> مكان البلاغات</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info )
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->Contracts->customer->name }}</td>
                        <td>{{ $info->Contracts->customer->identity_number }}</td>
                        <td>{{ $info->contract_id }}</td>
                        <td>{{ $info->communique_number }}</td>
                        <td>{{ $info->date }}</td>
                        <td>{{ $info->communique_place }}</td>
                       
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(8)==true) 
                            <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.communique.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(7)==true) 
                            <a type="button" class="btn btn-warning"                     
                            href="{{ route('communique.edit',$info->id) }}" style="color:#fff;" title="تعديل"><i class="fas fa-edit"></i>
                            </a>
                            @endif
                              @if(check_permission_sub_menue_actions(43)==true) 
                            <a class="btn btn-success" href="{{ route('communique.show',$info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
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