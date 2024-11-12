@extends('layouts.admin')
@section('title')
    ضبط السيارات
@endsection
@section('contentheader')
    السيارات
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.car.index') }}"> السيارات </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="card">
        <style>
            .topic::before {
  content: '⛅ ';
}
        </style>
        <div class="card-header">
            <h3 class="card-title card_title_center">بيانات السيارات</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{ route('admin.car.ajax_search') }}">
            @if(check_permission_sub_menue_actions(19)==true) 
            <a href="{{ route('admin.car.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> اضافة جديد</a> 
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label> بحث برقم اللوحة </label>
                    <input style="margin-top: 6px !important;" type="text" id="search_by_text"
                        placeholder="بحث برقم اللوحة" class="form-control"> <br>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label> بحث بالنوع </label>
                        <select name="car_type_id_search" id="car_type_id_search" class="form-control ">
                            <option value="all"> بحث بالكل</option>
                            @if (@isset($carType) && !@empty($carType))
                                @foreach ($carType as $info)
                                    <option value="{{ $info->id }}"> {{ $info->name }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label> بحث بالحالة </label>
                        <select name="car_status_id_search" id="car_status_id_search" class="form-control ">
                            <option value="all"> بحث بالكل</option>
                                    <option value="1"> متاحة </option>
                                    <option value="0"> غير متاحة </option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="ajax_responce_serarchDiv" class="col-md-12">
                    @if (@isset($data) && !@empty($data))
                        @php
                            $i = 1;
                        @endphp
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th> رقم اللوحة </th>
                                <th> لون السيارة </th>
                                <th> نوع السيارة </th>
                                <th> موديل السيارة </th>
                                <th> حالة السيارة</th>
                                <th> عدد الكيلومترات الحالي </th>
                                <th> عدد العقود </th>
                                <th> صورة السيارة </th>
                                <th>إجراء</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $info->plate_number }}</td>
                                        <td>{{ $info->car_color }}</td>
                                        <td>{{ $info->type->name }}</td>
                                        <td>{{ $info->carModals->name }}</td>
                                        <td>
                                            @if ($info->car_status == 1)
                                                متاحة
                                            @else
                                                غير متاحة
                                            @endif
                                        </td>
                                        <td> {{ $info->km_number }} </td>
                                        <td style="text-align: center">
                                            {{ $info->contract_number }}
                                            <br>
                                            @if(check_permission_sub_menue_actions(23)==true) 
                                            <a @if ($info->car_status == 0)style="text-decoration: line-through; color:#6C757D; background-color:#6C757D; border:#6C757D; pointer-events:none;opacity: 0.65;" @endif href="{{ route('admin.contracts.create', $info->id) }}"
                                                class="btn btn-sm  btn-success"><b class="topics">حجز جديد</b></a>
                                                @endif
                                           
                                        </td>
                                        <td>
                                            <img class="img-thumbnail custom_img"
                                                src="{{ asset('assets/admin/uploads') . '/' . $info->image }}"
                                                style="width: 80px;padding: 5px;height:80px;">
                                        </td>
                                        <td>
                                             <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                @if(check_permission_sub_menue_actions(21)==true) 
                                                <a type="button" class="btn are_you_shue btn-danger"
                                              href="{{ route('admin.car.delete', $info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                                             </a>
                                             @endif
                                             @if(check_permission_sub_menue_actions(20)==true) 
                                             <a class="btn btn-warning" href="{{ route('admin.car.edit', $info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                                             </a>
                                             @endif
                                             @if(check_permission_sub_menue_actions(22)==true) 
                                             <a class="btn btn-info" href="{{ route('admin.car.show', $info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
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
    </script>
@endsection
