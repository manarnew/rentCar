@extends('layouts.admin')
@section('title')
ضبط السيارات
@endsection
@section('contentheader')
مصروفات السيارات 
@endsection
@section('contentheaderlink')
<a href="{{ route('CarExpenses.index') }}">مصروفات  السيارات </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">بيانات  مصروفات السيارات</h3>
      <input type="hidden" id="token_search" value="{{csrf_token() }}">
      <input type="hidden" id="ajax_search_url" value="{{route('admin.CarExpenses.ajax_search')}}">
      @if(check_permission_sub_menue_actions(56)==true) 
      <a href="{{ route('CarExpenses.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> اضافة جديد</a>
      @endif
   </div>
   <!-- /.card-header -->
   <div class="card-body">
      <div class="row">
         <div class="col-md-4">
            <label> بحث برقم اللوحة </label>
            <input style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder="بحث برقم اللوحة" class="form-control"> <br>
         </div>
       
         <div class="col-md-4">
            <div class="form-group">
               <label>   بحث بالنوع </label>
               <select name="car_type_id_search" id="car_type_id_search" class="form-control ">
                  <option value="all"> بحث بالكل</option>
                  @if (@isset($carType) && !@empty($carType))
                  @foreach ($carType as $info )
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
                  <th> رقم اللوحة </th>
                  <th> لون السيارة </th>
                  <th> البيان</th>
                  <th>  سعر المصروف</th>
                  <th> الضريبة </th>
                  <th> اجمالي السعر مع الضريبة </th>
                  <th>  ملاحظات </th>
                  <th>اجراء</th>
               </thead>
               <tbody>
                  @foreach ($data as $info )
                  <tr>
                     <td>{{ $info->car->plate_number }}</td>
                     <td>{{ $info->car->car_color }}</td>
                     <td>{{$info->supplier}}</td>
                     <td> {{$info->price}}  </td>
                     <td> {{$info->tax}}  </td>
                     <td> {{$info->total_price_tax}}  </td>
                     <td> {{$info->note}}  </td>
                     <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(59)==true) 
                              <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.CarExpenses.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(57)==true) 
                            <a class="btn btn-warning" href="{{ route('CarExpenses.edit',$info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(58)==true) 
                            <a class="btn btn-success" href="{{ route('CarExpenses.show',$info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
                            </a>
                            @endif
                            </div>
                            
                        <!--<a href="{{ route('CarExpenses.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>  -->
                        <!--<a href="{{ route('CarExpenses.show',$info->id) }}" class="btn btn-sm   btn-info">تفاصيل</a> -->
                        <!--<a href="{{ route('admin.CarExpenses.delete',$info->id) }}" class="btn are_you_shue btn-sm  btn-danger">حذف</a>   -->
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

      $(document).on('input', '#search_by_text', function(e) {
        make_search();
    });
    $(document).on('change', '#car_type_id_search', function(e) {
        make_search();
    });
      function make_search() {
     var search_by_text = $("#search_by_text").val();
        var search_car_type_id_search = $("#car_type_id_search").val();
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