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
عرض التفاصيل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> عرض بيانات العميل</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>الاسم </td>
                        <td colspan="2">
                            {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td> الايميل </td>
                        <td colspan="2">
                            {{ $data['email'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الشخصية</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td>رقم  الهوية</td>
                        <td colspan="2">
                            {{ $data['identity_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الامامية للهوية</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->identity_front_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الخلفية للهوية</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->identity_back_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td class="width30"> تاريخ الاضافة</td>
                        <td>
                            @php
                                $dt = new DateTime($data['created_at']);
                                $date = $dt->format('Y-m-d');
                                $time = $dt->format('h:i');
                                $newDateTime = date('A', strtotime($time));
                                $newDateTimeType = $newDateTime == 'AM' ? 'صباحا ' : 'مساء';
                            @endphp
                            {{ $date }}
                            {{ $time }}
                            {{ $newDateTimeType }}
                            بواسطة
                            {{ $data->creator->name }}
                        </td>
                    </tr>
                    <tr>
                        <td> تاريخ اخر تحديث</td>
                        <td colspan="2">
                            @if ($data['updated_by'] > 0 and $data['updated_by'] != null)
                                @php
                                    $dt = new DateTime($data['updated_at']);
                                    $date = $dt->format('Y-m-d');
                                    $time = $dt->format('h:i');
                                    $newDateTime = date('A', strtotime($time));
                                    $newDateTimeType = $newDateTime == 'AM' ? 'صباحا ' : 'مساء';
                                @endphp
                                {{ $date }}
                                {{ $time }}
                                {{ $newDateTimeType }}
                                بواسطة
                                {{ $data->updatetor->name }}
                            @else
                                لايوجد تحديث
                            @endif
                            <a href="{{ route('admin.customer.edit', $data['id']) }}"
                                class="btn btn-sm btn-success">تعديل</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            
    </div>
    @endsection

    
