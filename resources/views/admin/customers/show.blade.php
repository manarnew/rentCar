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
                        <td>اسم العميل</td>
                        <td colspan="2">
                            {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>اسم الشركة </td>
                        <td colspan="2">
                            {{ $data['com_name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>رقم  الهوية</td>
                        <td colspan="2">
                            {{ $data['identity_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>تاريخ اصدار لهوية</td>
                        <td colspan="2">
                            {{ $data['identity_release_date'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>تاريخ انتهاء  الهوية</td>
                        <td colspan="2">
                            {{ $data['identity_end_date'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>مكان  إصدار الهوية</td>
                        <td colspan="2">
                            {{ $data['identity_address'] }}
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
                        <td>رقم  الهاتف</td>
                        <td colspan="2">
                            {{ $data['phone'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  البريد الالكتروني </td>
                        <td colspan="2">
                            {{ $data['email'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  عنوان السكن  </td>
                        <td colspan="2">
                            {{ $data['address'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  عنوان العمل </td>
                        <td colspan="2">
                            {{ $data['word_address'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  الجنسية  </td>
                        <td colspan="2">
                            {{ $data['nationality'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>رقم رخصة القيادة  </td>
                        <td colspan="2">
                            {{ $data['driver_license_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>   مكان اصدار رخصة القيادة    </td>
                        <td colspan="2">
                            {{ $data['driver_license_address'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>   تاريخ اصدار رخصة القيادة    </td>
                        <td colspan="2">
                            {{ $data['driver_license_release_date'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>   تاريخ انتهاء اصدار رخصة القيادة    </td>
                        <td colspan="2">
                            {{ $data['driver_license_address_end_date'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الامامية لرخصة القيادة</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->driver_license_front_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الخلفية لرخصة القيادة</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->driver_license_back_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td>   ملاحظات</td>
                        <td colspan="2">
                            {{ $data['details'] }}
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
                            {{ $data->user->name }}
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
                                {{ $data->user->name }}
                                {{ $data['updated_by_admin'] }}
                            @else
                                لايوجد تحديث
                            @endif
                            <a href="{{ route('admin.customer.edit', $data['id']) }}"
                                class="btn btn-sm btn-success">تعديل</a>
                        </td>
                    </tr>
                    <tr>
                        <td>  عدد العقود    </td>
                        <td colspan="2">
                            {{ $data['contract_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>اجمالي الحساب </td>
                        <td colspan="2">
                            {{ $data['total_money'] }}
                        </td>
                    </tr>
                    <tr>
                        <td> المدفوع </td>
                        <td colspan="2">
                            {{ $data['paid_money'] }}
                        </td>
                    </tr>
                    <tr>
                        <td> المتبقي </td>
                        <td colspan="2">
                            {{ $data['remaining_money'] }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            
    </div>
    @endsection

    
