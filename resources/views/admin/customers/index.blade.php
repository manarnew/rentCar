@extends('layouts.admin')
@section('title')
@if ($status == 1) السيارات المتاحة @else السيارات المحجوزة @endif
@endsection
@section('contentheader')
@if ($status == 1) السيارات المتاحة @else السيارات المحجوزة @endif
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
            <h3 class="card-title card_title_center">  @if ($status == 1) السيارات المتاحة @else السيارات المحجوزة @endif </h3>
          
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
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
