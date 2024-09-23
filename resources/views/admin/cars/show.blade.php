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
                        <td>  رقم اللوحة   </td>
                        <td colspan="2">
                            {{ $data['plate_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td> لون السيارة  </td>
                        <td colspan="2">
                            {{ $data['car_color'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>   نوع السيارة </td>
                        <td colspan="2">
                            {{ $data->type->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>     موديل السيارة  </td>
                        <td colspan="2">
                            {{ $data->carModals->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>     حالة السيارة  </td>
                        <td colspan="2">
                            @if ($data->car_status == 1)
                                متاحة
                            @else
                                غير متاحة
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td>  عدد الكيلومترات  الحالي </td>
                        <td colspan="2">
                            {{ $data['km_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  سعر الاجار اليومي</td>
                        <td colspan="2">
                            {{ $data['daily_rent_price'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  سعر الاجار بالساعة</td>
                        <td colspan="2">
                            {{ $data['hourly_rent_price'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  سعر الاجار بالكيلو</td>
                        <td colspan="2">
                            {{ $data['km_rent_price'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>    عدد العقود  </td>
                        <td colspan="2">
                            {{ $data['contract_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>      التامين </td>
                        <td colspan="2">
{{  $data['insurance']}}
                        </td>
                    </tr>
                    <tr>
                        <td>    حالة تامين السيارة </td>
                        <td colspan="2">
                            @if ($data['full_insurance'==1])
                                نعم
                            @else
                              لا
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>  هل يوجد طرف ثالث  </td>
                        <td colspan="2">
                            @if ($data['third_party'==1])
                            نعم
                        @else
                          لا
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>هل تغطية شامله     </td>
                        <td colspan="2">
                                @if ($data['full_cover'==1])
                                نعم
                            @else
                              لا
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>  الامارات العربية المتحدة    </td>
                        <td colspan="2">
                            @if ($data['UAE'==1])
                            نعم
                        @else
                          لا
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>   عمان   </td>
                        <td colspan="2">
                            @if ($data['oman'==1])
                            نعم
                        @else
                          لا
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة   </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td> الصورة الاميمة لملكية السيارة   </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->car_own_image_front }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td>الصورة الخلفية لملكية السيارة    </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->car_own_image_back }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td> الصورة الاميمة لكرة التشغيل    </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->card_run_image_front }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td> الصورة الخلفية لكرة التشغيل    </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->card_run_image_back }}" style="width: 150px;padding: 5px;height:150px;"  >   
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
                            <a href="{{ route('admin.car.edit', $data['id']) }}"
                                class="btn btn-sm btn-success">تعديل</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            
    </div>
    @endsection

    
