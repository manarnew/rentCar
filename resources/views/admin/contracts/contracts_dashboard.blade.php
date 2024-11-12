@extends('layouts.admin')
@section('title')
حجوزات  @if($status == 1) اليوم @elseif($status == 2) تنتهي اليوم @else نشطة @endif
@endsection
@section('contentheader')
حجوزات  @if($status == 1) اليوم @elseif($status == 2) تنتهي اليوم @else نشطة @endif
@endsection
@section('contentheaderlink')
    <a href="{{ route('contracts.index') }}">  الحجز </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> بيانات  حجوزات  @if($status == 1) اليوم @elseif($status == 2) تنتهي اليوم @else نشطة @endif </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="clearfix"></div>
                <div id="ajax_responce_serarchDiv" class="col-md-12">
                    @if (@isset($data) && !@empty($data) && count($data) > 0)
                        @php
                            $i = 1;
                        @endphp
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th> رقم الحجز </th>
                                <th> نوع الحجز </th>
                                <th> العدد/اليوم </th>
                                <th> رقم لوحة السيارة </th>
                                <th> نوع السيارة </th>
                                <th> اسم العميل </th>
                                <th> تاريخ الحجز </th>
                                <th> تاريخ العودة</th>
                                <th> حالة الحجز</th>
                                <th> اجمالي سعر الحجز</th>
                             
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $info->id }}</td>
                                        <td>
                                            @if ($info->contract_type == 1)
                                                يومي
                                            @elseif($info->contract_type == 2)
                                                اسبوعي
                                            @else
                                                شهري
                                            @endif
                                        </td>
                                        <td>{{ $info->contract_number }}</td>
                                        <td> {{ $info->car->plate_number }} </td>
                                        <td> {{ $info->car->type->name }} </td>
                                        <td> {{ $info->customer->name }} </td>
                                        <td> {{ $info->date }} </td>
                                        <td> {{ $info->return_date }} </td>
                                        <td>
                                            @if ($info->contract_type == 1)
                                            مكتمل
                                            @elseif($info->contract_type == 2)
                                            في الانتظار 
                                            @elseif($info->contract_type == 3)
                                            مرفوض
                                            @else
                                            ملغي
                                            @endif
                                        </td>
                                        <td> {{ $info->total_price }} </td>
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
