<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="theme-color" content="#A52A2A">
      <meta name="msapplication-navbutton-color" content="#A52A2A">
      <meta name="apple-mobile-web-app-status-bar-style" content="#A52A2A">
      <title>تقارير الحجوزات </title>
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
            <h3 class="card-title card_title_center">تقارير الحجوزات  من تاريخ        (
                {{ $from_date_search }}) الي تاريخ ( {{ $to_date_search}})</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($total_price) && !@empty($total_price) )
                <div class="row" style="padding-bottom: 30px">
                    <h3 class="card-title card_title_center"> تقارير الحجوزات    </h3>
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <th class="width30">مكتمل</th>
                            <td>
                                {{ $total_completed }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> في الانتظار </th>
                            <td>
                                {{ $total_inWait }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30">مرفوض</th>
                            <td>
                                {{ $total_blocked }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> ملغي</th>
                            <td>
                                {{ $total_canceld }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> الاجمالي </th>
                            <td>
                                {{ $total_price }}
                            </td>
                        </tr>
                        <tr>
                            <th>  عدد الحجوزات </th>
                            <td>
                                {{ $number_reserved_car }}
                            </td>
                        </tr>
                        <tr>
                            <th>عدد السيارات  </th>
                            <td>
                                {{ $car_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>عدد العملاء  </th>
                            <td>
                                {{ $customer_number }}
                            </td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    عفوا لاتوجد بيانات لعرضها !!
                </div>
            @endif

            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($contracts) && !@empty($contracts))
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
                            <th> الموظف </th>
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
                                    <td>
                                        @if ($info->contract_status == 1)
                                        مكتمل
                                        @elseif($info->contract_status == 2)
                                        في الانتظار 
                                        @elseif($info->contract_status == 3)
                                        مرفوض
                                        @else
                                        ملغي
                                        @endif
                                    </td>
                                    <td> {{ $info->total_price }} </td>
                                    <td> {{ $info->user->name }} </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        عفوا لاتوجد بيانات لعرضها !!
                    </div>
                @endif
            </div>
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