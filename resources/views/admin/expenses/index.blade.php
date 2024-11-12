@extends('layouts.admin')
@section('title')
المصروفات
@endsection
@section('contentheader')
المصروفات
@endsection
@section('contentheaderlink')
<a href="{{ route('expenses.index') }}">  المصروفات </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">بيانات  المصروفات </h3>
      <input type="hidden" id="token_search" value="{{csrf_token() }}">
      <input type="hidden" id="ajax_search_url" value="{{route('admin.expenses.ajax_search')}}">
      @if(check_permission_sub_menue_actions(14)==true) 
      <a href="{{ route('expenses.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
      @endif
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <div class="row">
      
       
         <div class="col-md-4">
            <div class="form-group">
               <label>   بحث بالنوع </label>
               <select name="expenses_type_id_search" id="expenses_type_id_search" class="form-control ">
                  <option value="all"> بحث بالكل</option>
                  @if (@isset($expenses_type) && !@empty($expenses_type))
                  @foreach ($expenses_type as $info )
                  <option value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div>
         <div class="clearfix"></div>
         <div id="ajax_responce_serarchDiv" class="col-md-12">
            @if (@isset($data) && !@empty($data))
            @php
            $i=1;   
            @endphp
            <table id="example2" class="table table-bordered table-hover">
               <thead class="custom_thead">
                  <th> نوع المصروف </th>
                  <th>  سعر المصروف</th>
                  <th> الضريبة    </th>
                  <th> اجمالي السعر مع الضريبة </th>
                  <th>  ملاحظات </th>
                  <th></th>
               </thead>
               <tbody>
                  @foreach ($data as $info )
                  <tr>
                     <td>{{ $info->type->name }}</td>
                     <td> {{$info->price}}  </td>
                     <td> {{$info->tax}}  </td>
                     <td> {{$info->total}}  </td>
                     <td> {{$info->note}}  </td>
                     <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(16)==true) 
                              <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.expenses.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(15)==true) 
                            <a class="btn btn-warning" href="{{ route('expenses.edit',$info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(14)==true) 
                            <a class="btn btn-success" href="{{ route('expenses.show',$info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
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
    $(document).on('change', '#car_type_id_search', function(e) {
        make_search();
    });
    $(document).on('change', '#car_status_id_search', function(e) {
        make_search();
    });
      function make_search() {
     var search_by_text = $("#search_by_text").val();
        var search_car_type_id_search = $("#car_type_id_search").val();
        var search_car_status_id_search = $("#car_status_id_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                search_car_type_id_search: search_car_type_id_search,
                search_car_status_id_search: search_car_status_id_search,
                "_token": token_search,
            },
            success: function(data) {
                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function() {}
        });
      }

   
    $(document).on('change', '#expenses_type_id_search', function(e) {
        make_search();
    });
      function make_search() {
        var expenses_type_id_search = $("#expenses_type_id_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                expenses_type_id_search: expenses_type_id_search,
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