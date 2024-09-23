@extends('layouts.admin')
@section('title')
الحجز
@endsection
@section('contentheader')
الحجز
@endsection
@section('contentheaderlink')
    <a href="{{ route('contracts.index') }}"> الحجز </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">بيانات الحجز</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{ route('admin.contracts.ajax_search') }}">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
              
                <div class="col-md-4">
                    <div class="form-group">
                        <label>  بحث بالحالة الحجز</label>
                        <select name="contract_status_search" id="contract_status_search" class="form-control ">
                        <option value="all"> اختر  حالة الحجز  </option>
                        <option @if (old('contract_status') == 1)  selected="selected" @endif value="1"> مكتمل </option>
                        <option @if (old('contract_status') == 2) selected="selected" @endif value="2"> في الانتظار </option>
                        <option @if (old('contract_status') == 3) selected="selected" @endif value="3">  مرفوض </option>
                        <option @if (old('contract_status') == 4) selected="selected" @endif value="4">  ملغي </option>
                </select>
                    </div>
                </div>

                
                <div class="clearfix"></div>
                <div id="ajax_responce_serarchDiv" class="col-md-12">
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
                                <th>إجراء</th>
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
                                            
                                             <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                                 <!--send-whatsapp-->
                                                                            @php
                                                                            $id_get = base64_encode($info->id);
                                                                            @endphp
                                                                 <a type="button" class="btn are_you_shue btn-success"
                                                                  href="{{ route('admin.customer.send',$info->customer->id) }}" style="color:#fff;" title="ارسال العقد علي واتساب"><i class="fab fa-whatsapp fa-sm"></i>
                                                                  </a>
                                                                  <!--/send-whatsapp-->
                                                                   @if(check_permission_sub_menue_actions(25)==true) 
                                                                  <a type="button" class="btn are_you_shue btn-danger"
                                                                  href="{{ route('admin.contracts.delete', $info->id) }}" style="color:#000;" title="حذف"><i class="fas fa-trash-alt"></i> 
                                                                  </a>
                                                                    @endif
                                                                  @if(check_permission_sub_menue_actions(24)==true) 
                                                                  <a class="btn btn-warning" href="{{ route('contracts.edit', $info->id) }}" style="color:#000;" title="تعديل"><i class="fas fa-edit"></i>   
                                                                   </a>
                                                                   <!--</div>-->
                                                                   <!-- <div class="btn-group" role="group" aria-label="Basic mixed styles example">-->
                                                                   @endif
                                                                  @if(check_permission_sub_menue_actions(26)==true) 
                                                                  <a class="btn btn-info" href="{{ route('admin.contracts.invoice', $info->id) }}" style="color:#fff;" title="طباعة"><i class="fas fa-print"></i>
                                                                   </a>
                                                                   @endif
                                                                    @if(check_permission_sub_menue_actions(52)==true) 
                                                                    <a class="btn btn-secondary" href="{{ route('admin.debentures.create', $info->id) }}" style="color:#fff;" title="سند قبض"><i class="fas fa-ticket-alt"></i></a>
                                                                  
                                                                     @endif
                                                                       @if(check_permission_sub_menue_actions(53)==true) 
                                                               <form method="POST" action="{{ route('admin.signature_image.create_signature_image') }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$info->id}}">
                                                            <button style="color:#fff;" title="التوقيع" class="btn btn-primary"><i class="fas fa-signature"></i></button>
                                                          </form>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('input', '#search_by_text', function(e) {
            make_search();
        });
        $(document).on('change', '#contract_status_search', function(e) {
            make_search();
        });
        $(document).on('change', '#car_status_id_search', function(e) {
            make_search();
        });

        function make_search() {
            var contract_status_search = $("#contract_status_search").val();
            var token_search = $("#token_search").val();
            var ajax_search_url = $("#ajax_search_url").val();
            jQuery.ajax({
                url: ajax_search_url,
                type: 'post',
                dataType: 'html',
                cache: false,
                data: {
                    contract_status_search: contract_status_search,
                    "_token": token_search,
                },
                success: function(data) {
                    $("#ajax_responce_serarchDiv").html(data);
                },
                error: function() {}
            });
        }
    </script>
@endsection
