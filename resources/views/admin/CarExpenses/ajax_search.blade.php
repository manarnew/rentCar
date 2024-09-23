@if (@isset($data) && !@empty($data))
@php
$i=1;   
@endphp
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th> رقم اللوحة </th>
      <th> لون السيارة </th>
      <th> اسم المورد </th>
      <th>  سعر المصروف</th>
      <th> الضريبة    </th>
      <th> اجمالي السعر مع الضريبة </th>
      <th>  ملاحظات </th>
      <th></th>
   </thead>
   <tbody>
      @foreach ($data as $info )
      <tr>
         <td>{{ $info->car->plate_number }}</td>
         <td>{{ $info->car->car_color }}</td>
         <td>{{$info->supplier}}</td>
         <td> {{$info->price}}  </td>
         <td> {{$info->tax}}  </td>
         <td> {{$info->total_price_tax}}  </td>
         <td> {{$info->note}}  </td>
         <td>
            <a href="{{ route('CarExpenses.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>  
            <a href="{{ route('CarExpenses.show',$info->id) }}" class="btn btn-sm   btn-info">تفاصيل</a> 
            <a href="{{ route('admin.CarExpenses.delete',$info->id) }}" class="btn are_you_shue btn-sm  btn-danger">حذف</a>   
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