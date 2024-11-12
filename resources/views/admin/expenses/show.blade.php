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
عرض التفاصيل
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> عرض بيانات مصروفات السيارات </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>   نوع المصروف </td>
                        <td colspan="2">
                            {{ $data->type->name}}
                        </td>
                    </tr>
                   
                    <tr>
                        <td>صورة الايصال   </td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                        </td>
                    </tr>
                    <tr>
                        <td> سعر المصروف   </td>
                        <td colspan="2">
                            {{$data->price}}
                        </td>
                    </tr>
                    <tr>
                        <td> الضريبة    </td>
                        <td colspan="2">
                            {{$data->tax}}
                        </td>
                    </tr>
                    <tr>
                        <td> الاجمالي مع الضريبة    </td>
                        <td colspan="2">
                            {{$data->total}}
                        </td>
                    </tr>
                    <tr>
                        <td>   تفاصيل    </td>
                        <td colspan="2">
                            {{$data->note}}
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
                            <a href="{{ route('expenses.edit', $data['id']) }}"
                                class="btn btn-sm btn-success">تعديل</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            
    </div>
    @endsection

    
