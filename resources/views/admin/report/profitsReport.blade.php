<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="theme-color" content="#A52A2A">
      <meta name="msapplication-navbutton-color" content="#A52A2A">
      <meta name="apple-mobile-web-app-status-bar-style" content="#A52A2A">
      <title> تقارير الارباح و الخسائر   </title>
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
            <h3 class="card-title card_title_center"> تقارير الارباح و الخسائر       (
                {{ $from_date_search }}) الي تاريخ ( {{ $to_date_search}})</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($total_Contracts) && !@empty($total_Contracts) )
                <div class="row" style="padding-bottom: 30px">
                    <h3 class="card-title card_title_center"> تقارير الارباح و الخسائر     </h3>
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <th class="width30"> اجمالي   مصروفات السيارات </th>
                            <td>
                                {{ $total_CarExpenses }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> اجمالي   المصروفات العامة </th>
                            <td>
                                {{ $total_Expenses }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> اجمالي دخل الاجارات </th>
                            <td>
                                {{ $total_Contracts }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> اجمالي   الخسائر </th>
                            <td>
                                {{ $total_Expenses + $total_CarExpenses }}
                            </td>
                        </tr>
                        <tr>
                            <th class="width30"> اجمالي   الارباح </th>
                            <td>
                                {{ $total_Contracts - ($total_Expenses + $total_CarExpenses) }}
                            </td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    عفوا لاتوجد بيانات لعرضها !!
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