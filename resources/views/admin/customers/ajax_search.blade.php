@if (@isset($data) && !@empty($data))
@php
$i=1;   
@endphp
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>  اسم العميل  </th>
      <th> اسم الشركة </th>
      <th> رقم الهوية</th>
      <th> رقم الهاتف</th>
      <th> عنوان العميل</th>
      <th> الجنسية </th>
      <th> رقم رخصة القيادة </th>
      <th> مكان اصدار رخصة القيادة </th>
      <th> عدد العقود </th>
      <th></th>
   </thead>
   <tbody>
      @foreach ($data as $info )
      <tr>
         <td>{{ $info->name }}</td>
         <td>{{ $info->com_name }}</td>
         <td>{{$info->identity_number}}</td>
         <td> {{$info->phone}}  </td>
         <td> {{$info->address}}  </td>
         <td> {{$info->nationality}}  </td>
         <td> {{$info->driver_license_number}}  </td>
         <td> {{$info->driver_license_address}}  </td>
         <td> {{$info->contract_number}} </td>
         <td>
            <a href="{{ route('admin.customer.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>  
            <a href="{{ route('admin.customer.show',$info->id) }}" class="btn btn-sm   btn-info">تفاصيل</a> 
            <a href="{{ route('admin.customer.delete',$info->id) }}" class="btn are_you_shue btn-sm  btn-danger">حذف</a>   
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