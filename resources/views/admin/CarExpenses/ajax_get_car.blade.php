@if (@isset($data) && !@empty($data))
<label>  نوع السيارة</label>
<input  class="form-control" readonly value="{{$data->type->name}}">
<input name="type_id" type="hidden" id="type_id" class="form-control" readonly value="{{$data->type->id}}">
@endif
