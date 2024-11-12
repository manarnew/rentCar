@extends('layouts.admin')
@section('title')
ضبط العملاء
@endsection
@section('contentheader')
العملاء
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.customer.index') }}">  العملاء </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">بيانات   العملاء</h3>
      <input type="hidden" id="token_search" value="{{csrf_token() }}">
      <input type="hidden" id="ajax_search_url" value="{{route('admin.customer.ajax_search')}}">
      @if(check_permission_sub_menue_actions(2)==true) 
      <a href="{{ route('admin.customer.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
      @endif
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <div class="row">
         <div class="col-md-6">
            <input checked type="radio" name="searchbyradio" id="searchbyradio" value="name">  اسم العميل 
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="com_name"> اسم الشركة 
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="identity_number"> رقم الهوية 
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="driver_license_number"> رخصة القيادة 
            <input style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control"> <br>
         </div>
       
         <div class="clearfix"></div>
         <div id="ajax_responce_serarchDiv" class="col-md-12">
            @if (@isset($data) && !@empty($data))
            @php
            $i=1;   
            @endphp
            <table id="example2" class="table table-bordered table-hover">
               <thead class="custom_thead">
                  <th>  اسم العميل  </th>
                  <th> اسم الشركة </th>
                  <th> رقم الهوية</th>
                  <th> رقم الهاتف</th>
                  <th> عنوان العميل</th>
                  <th> الجنسية </th>
                  <th> رقم رخصة القيادة </th>
                  <th> مكان اصدار رخصة القيادة </th>
                  <th> عدد العقود </th>
                    <th>  قايمة الحظر </th>
                  <th>إجراء</th>
               </thead>
               <tbody>
                  @foreach ($data as $info )
                  <tr>
                     <td>{{ $info->name }}</td>
                     <td>{{ $info->com_name }}</td>
                     <td>{{$info->identity_number}}</td>
                     <td> {{$info->phone}}  </td>
                     <td> {{$info->address}}  </td>
                     <td> {{$info->nationality}}  </td>
                     <td> {{$info->driver_license_number}}  </td>
                     <td> {{$info->driver_license_address}}  </td>
                     <td> {{$info->contract_number}} </td>
                       <td style="text-align: center">
                        <a @if ($info->customer_status == 0)style="pointer-events:none;opacity: 0.65;"@endif href="{{ route('admin.Black_lists.create', $info->id) }}"
                            class="btn btn-sm  btn-primary">  حظر</a>
                    </td>
                     <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(4)==true) 
                            <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.customer.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(3)==true) 
                            <a class="btn btn-warning" href="{{ route('admin.customer.edit',$info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(43)==true) 
                            <a class="btn btn-success" href="{{ route('admin.customer.show',$info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
                            </a>
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
@endsection
@section('script')
<script>
     $(document).on('input', '#search_by_text', function(e) {
        make_search();
    });
  
    $('input[type=radio][name=searchbyradio]').change(function() {
        make_search();
    });
      function make_search() {
     var search_by_text = $("#search_by_text").val();
        var search_searchbyradio =$("input[type=radio][name=searchbyradio]:checked").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                search_searchbyradio: search_searchbyradio,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
      }
</script>
@endsection