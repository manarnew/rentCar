<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="theme-color" content="#A52A2A">
      <meta name="msapplication-navbutton-color" content="#A52A2A">
      <meta name="apple-mobile-web-app-status-bar-style" content="#A52A2A">
      <title>تقارير الضرائب    </title>
      <!--logo header-->
       <link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css')}}">
      <!--google font-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
 <style>
       *{
        font-family: "Tajawal", sans-serif;
        font-weight: 700;
        font-style: normal;
        }
   </style>
   </head>
   
   <body class="hold-transition sidebar-mini">
    <div class="card">
        <div class="card-header bg-info">
            <h1 class="card-title card_title_center">
                {{ App\Models\Panel_settings::where('id', 1)->value('system_name') }}
            </h1>
            <br>
            <br>
            <h3 class="card-title card_title_center">تقارير الضرائب   من تاريخ        (
                {{ $from_date_search }}) الي تاريخ ( {{ $to_date_search}})</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ((@isset($total_Contracts_tax) && !@empty($total_Contracts_tax)) || (@isset($total_CarExpenses_tax) && !@empty($total_CarExpenses_tax))  )
                <div class="row" style="padding-bottom: 30px">
                    <h3 class="card-title card_title_center"> تقارير الضرائب    </h3>
                    <table id="example2" class="table table-bordered table-hover">
                        @if ($taxType == 1 || $taxType == '')
                        <tr>
                            <th class="width30"> ضريبة مصروفات سيارات </th>
                            <td>
                                {{ $total_CarExpenses_tax  }}
                            </td>
                        </tr>
                        @endif
                        @if ($taxType == 0 || $taxType == '')
                        <tr>
                            <th class="width30"> ضريبة  عقود الاجار </th>
                            <td>
                                {{ $total_Contracts_tax }}
                            </td>
                        </tr>
                        @endif
                         @if ( $taxType == '')
                        <tr>
                            <th class="width30"> اجمالي   الضريبة </th>
                            <td>
                                {{ $total_Contracts_tax + $total_CarExpenses_tax }}
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    عفوا لاتوجد بيانات لعرضها !!
                </div>
            @endif
            @if ($taxType == 1 || $taxType == '')
            <h3 style="text-align: center;color:red">تفاصيل ضرائب مصروفات السيارات</h3 style="text-align: center;color:red">
            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($carExpenses) && !@empty($carExpenses))
                    @php
                        $i = 1;
                    @endphp
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th> رقم اللوحة </th>
                            <th>  موديل السيارة </th>
                            <th>   الطراظ </th>
                            <th> التاريخ</th>
                            <th>  المورد</th>
                            <th> الضريبة </th>
                        </thead>
                        <tbody>
                            @foreach ($carExpenses as $info)
                                <tr>
                                    <td>{{ $info->car->plate_number }}</td>
                                    <td>{{ $info->car->type->name }}</td>
                                    <td>{{ $info->car->carModals->name }}</td>
                                    <td>{{ $info->date }}</td>
                                    <td> {{ $info->supplier}} </td>
                                    <td> {{ $info->tax }} </td>
                                </tr>
                               
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        عفوا لاتوجد بيانات لعرضها !!
                    </div>
                @endif
            </div>
            <div class="col-md-12 " style="margin-top:50px">
                <hr style="  border: 1px solid rgb(78, 96, 212)">
            </div>
            @endif
            @if ($taxType == 0 || $taxType == '')
            <h3 style="text-align: center;color:red">تفاصيل ضرائب  عقود الاجار</h3 style="text-align: center;color:red">
            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($contracts) && !@empty($contracts))
                 
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
                            <th> الضريبة </th>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $info)
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
                                    <td> {{ $info->tax_price }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        عفوا لاتوجد بيانات لعرضها !!
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/general.js') }}"></script>
    <script>
        $(document).ready(function() {
            window.print()
        })
    </script>
 </body>
</html>