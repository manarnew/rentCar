@extends('layouts.admin')
@section('title')
    العقود
@endsection
@section('contentheader')
    العقود
@endsection
@section('contentheaderlink')
    <a href="{{ route('contracts.index') }}"> العقود </a>
@endsection
@section('contentheaderactive')
عرض التفاصيل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> عرض بيانات العقد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>  رقم العقد   </td>
                        <td colspan="2">
                            {{ $data['id'] }}
                        </td>
                    </tr>
                    <tr>
                        <td> نوع العقد  </td>
                        <td colspan="2">
                            @if ($data->contract_type == 1)
                            يومي
                        @elseif($data->contract_type == 2)
                            اسبوعي
                        @else
                            شهري
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>   العدد/اليوم </td>
                        <td colspan="2">
                            {{ $data->contract_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>     رقم لوحة السيارة  </td>
                        <td colspan="2">
                            {{ $info->car->plate_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>      نوع السيارة  </td>
                        <td colspan="2">
                            {{ $info->car->type->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>  عدد الكيلومترات  الحالي </td>
                        <td colspan="2">
                            {{ $data['km_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  اسم العميل </td>
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
                </table>
            </div>
        </div>
            
    </div>
    @endsection

    
