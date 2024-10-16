@if (@isset($data) && !@empty($data))
@php
$i=1;   
@endphp
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th> نوع المصروف </th>
      <th>  سعر المصروف</th>
      <th> الضريبة    </th>
      <th> اجمالي السعر مع الضريبة </th>
      <th>  ملاحظات </th>
      <th></th>
   </thead>
   <tbody>
      @foreach ($data as $info )
      <tr>
         <td>{{ $info->type->name }}</td>
         <td> {{$info->price}}  </td>
         <td> {{$info->tax}}  </td>
         <td> {{$info->total}}  </td>
         <td> {{$info->note}}  </td>
         <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  @if(check_permission_sub_menue_actions(16)==true) 
                  <a type="button" class="btn are_you_shue btn-danger"
                 href="{{ route('admin.expenses.delete',$info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                </a>
                @endif
                @if(check_permission_sub_menue_actions(15)==true) 
                <a class="btn btn-warning" href="{{ route('expenses.edit',$info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                </a>
                @endif
                @if(check_permission_sub_menue_actions(14)==true) 
                <a class="btn btn-success" href="{{ route('expenses.show',$info->id) }}" style="color:#fff;" title="تفاصيل"><i class="fas fa-info-circle"></i>
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