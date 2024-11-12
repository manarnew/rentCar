@extends('layouts.admin')
@section('title')
    سندات القبض
@endsection
@section('contentheader')
    سندات القبض
@endsection
@section('contentheaderlink')
    <a href="{{ route('debentures.index') }}">
        سندات القبض </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">بيانات  سندات القبض</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            <input type="hidden" id="ajax_search_url" value="{{ route('admin.debentures.ajax_search') }}">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                
                <div class="clearfix"></div>
                <div id="ajax_responce_serarchDiv" class="col-md-12">
                    @if (@isset($data) && !@empty($data))
                        @php
                            $i = 1;
                        @endphp
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th>#</th>
                                <th> اسم العميل </th>
                                <th> رقم الهوية</th>
                                <th> رقم الحجز</th>
                                <th> المبلغ</th>
                                <th> الباقي</th>
                                <th> طريقة الدفع</th>
                                <th> تاريخ</th>
                                <th>اجراء</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $info->customer->name }}</td>
                                        <td>{{ $info->customer->identity_number }}</td>
                                        <td>{{ $info->contract_id }}</td>
                                        <td>{{ $info->paid_price }}</td>
                                        <td>{{ $info->remind_price }}</td>
                                        <td>{{ $info->payment_type }}</td>
                                        <td>{{ $info->date }} </td>
                                        <td>
                                            @if(check_permission_sub_menue_actions(51)==true)
                                                <a href="{{ route('debentures.show', $info->id) }}"
                                                    class="btn btn-sm  btn-info"><i class="fas fa-print" title="طباعة"></i></a>
                                                    @endif
                                            
<!--                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>-->
<!--                                                <button class="btn btn-success" id="download"><i class="fas fa-download fa-sm"></i></button>-->
<!--                                                <script>-->
<!--                                                    window.onload = function () {-->
<!--    document.getElementById("download")-->
<!--        .addEventListener("click", () => {-->
<!--            const invoice = this.document.getElementById("invoice");-->
<!--            console.log(invoice);-->
<!--            console.log(window);-->
<!--            var opt = {-->
<!--                margin: 1,-->
<!--                filename: 'myfile.pdf',-->
<!--                image: { type: 'jpeg', quality: 0.98 },-->
<!--                html2canvas: { scale: 2 },-->
<!--                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }-->
<!--            };-->
<!--            html2pdf().from(invoice).set(opt).save();-->
<!--        })-->
<!--}-->
<!--                                                </script>-->
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
