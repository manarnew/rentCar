@if (@isset($data) && !@empty($data))
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
        <th></th>
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
                <td>
                    <a href="{{ route('contracts.edit', $info->id) }}"
                        class="btn btn-sm  btn-primary" title="تعديل"><i class="fas fa-edit fa-sm"></i></a>
                    
                    <a href="{{ route('admin.contracts.delete', $info->id) }}"
                        class="btn are_you_shue btn-sm  btn-danger" title="مسح"><i class="fas fa-trash-alt fa-sm"></i></a>

                        <a href="{{ route('admin.contracts.invoice', $info->id) }}"
                            class="btn btn-sm  btn-info" title="طباعة"><i class="fas fa-print fa-sm"></i></a>
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