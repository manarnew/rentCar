@extends('layouts.admin')
@section('title')
    اشعارات السيارات
@endsection
@section('contentheader')
الاشعارات
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.car.index') }}"> الاشعارات </a>
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
            <h3 class="card-title card_title_center"> بيانات السيارات </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                <div class="clearfix"></div>
                <div id="ajax_responce_serarchDiv" class="col-md-12">
                    @if (@isset($data) && !@empty($data))
                        @php
                            $i = 1;
                        @endphp
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th> رقم اللوحة </th>
                                <th> اللون  </th>
                                <th> النوع  </th>
                                <th> الموديل  </th>
                                <th> غيار الزيت السابق  </th>
                                <!--<th>غيار الزيت القادم</th>-->
                                <th> انتهاء الترخيص </th>
                                <th> الصورة  </th>
                                <th>إجراء</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $info->plate_number }}</td>
                                        <td>{{ $info->car_color }}</td>
                                        <td>{{ $info->type->name }}</td>
                                        <td>{{ $info->carModals->name }}</td>
                                        <td> {{ $info->km_for_mantince * 1 }} </td>
                                        <!--<td>1</td>-->
                                        <td> {{ $info->driver_license_end_date }} </td>
                                        <td>
                                            <img class="img-thumbnail custom_img"
                                                src="{{ asset('assets/admin/uploads') . '/' . $info->image }}"
                                                style="width: 80px;padding: 5px;height:80px;">
                                        </td>
                                        <td>
                                             <div class="btn-group" role="group" aria-label="Basic mixed styles example">
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

