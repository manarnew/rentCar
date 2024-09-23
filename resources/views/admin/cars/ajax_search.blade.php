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
                                <th></th>
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
                                            
                                            <a @if ($info->car_status == 0)style="pointer-events:none;opacity: 0.65;"@endif href="{{ route('admin.contracts.create', $info->id) }}"
                                                class="btn btn-sm  btn-primary">عقد جديد</a>
                                            
                                           
                                        </td>
                                        <td>
                                            <img class="custom_img"
                                                src="{{ asset('assets/admin/uploads') . '/' . $info->image }}"
                                                style="width: 80px;padding: 5px;height:80px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.car.edit', $info->id) }}"
                                                class="btn btn-sm  btn-primary">تعديل</a>
                                            <a href="{{ route('admin.car.show', $info->id) }}"
                                                class="btn btn-sm   btn-info">تفاصيل</a>
                                            <a href="{{ route('admin.car.delete', $info->id) }}"
                                                class="btn are_you_shue btn-sm  btn-danger">حذف</a>
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