@php
$sys =  App\Models\Panel_settings::where('id',1)->first();
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="theme-color" content="#A52A2A">
   <link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
   <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css')}}">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
   <style>
       * {
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
           <h3 class="card-title card_title_center">{{ __('userReport.user_reports') }} {{ __('userReport.from_date') }} ({{ $from_date_search }}) {{ __('userReport.to_date') }} ({{ $to_date_search }})</h3>
       </div>
       <div class="card-body">
           @if (@isset($total_price) && !@empty($total_price))
               <div class="row" style="padding-bottom: 30px">
                   <h3 class="card-title card_title_center">{{ __('userReport.user_reports') }}</h3>
                   <table id="example2" class="table table-bordered table-hover">
                       @if ($user_name != "")
                       <tr>
                           <th class="width30">{{ __('userReport.employee_name') }}</th>
                           <td>{{ $user_name }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.identity_number') }}</th>
                           <td>{{ $identity_number }}</td>
                       </tr>
                       @endif
                       <tr>
                           <th>{{ __('userReport.number_of_reservations') }}</th>
                           <td>{{ $number_reserved_car }}</td>
                       </tr>
                       <tr>
                           <th>{{ __('userReport.number_of_cars') }}</th>
                           <td>{{ $car_number }}</td>
                       </tr>
                       <tr>
                           <th>{{ __('userReport.number_of_customers') }}</th>
                           <td>{{ $customer_number }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.completed') }}</th>
                           <td>{{ $total_completed }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.in_waiting') }}</th>
                           <td>{{ $total_inWait }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.blocked') }}</th>
                           <td>{{ $total_blocked }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.canceled') }}</th>
                           <td>{{ $total_canceld }}</td>
                       </tr>
                       <tr>
                           <th class="width30">{{ __('userReport.total') }}</th>
                           <td>{{ $total_price }}</td>
                       </tr>
                   </table>
               </div>
           @else
               <div class="alert alert-danger">
                   {{ __('userReport.no_data') }}
               </div>
           @endif

           <div id="ajax_responce_serarchDiv" class="col-md-12">
               @if (@isset($user_contracts) && !@empty($user_contracts))
                   <table id="example2" class="table table-bordered table-hover">
                       <thead class="custom_thead">
                           <th>{{ __('userReport.amount') }}</th>
                           <th>{{ __('userReport.date') }}</th>
                           <th>{{ __('userReport.reservation_number') }}</th>
                           @if ($user_name == "")
                           <th>{{ __('userReport.employee_name') }}</th>
                           @endif
                           <th>{{ __('userReport.customer_name') }}</th>
                           <th>{{ __('userReport.plate_number') }}</th>
                           <th>{{ __('userReport.car_model') }}</th>
                           <th>{{ __('userReport.contract_type') }}</th>
                       </thead>
                       <tbody>
                           @foreach ($user_contracts as $info)
                               <tr>
                                   <td>{{ $info->total_price }}</td>
                                   <td>{{ $info->date }}</td>
                                   <td>{{ $info->id }}</td>
                                   @if ($user_name == "")
                                   <td>{{ $info->user->name }}</td>
                                   @endif
                                   <td>{{ $info->customer->name }}</td>
                                   <td>{{ $info->car->plate_number }}</td>
                                   <td>{{ $info->car->carModals->name }}</td>
                                   <td>
                                       @if ($info->contract_status == 1)
                                       {{ __('userReport.completed') }}
                                       @elseif($info->contract_status == 2)
                                       {{ __('userReport.in_waiting') }}
                                       @elseif($info->contract_status == 3)
                                       {{ __('userReport.blocked') }}
                                       @else
                                       {{ __('userReport.canceled') }}
                                       @endif
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               @else
                   <div class="alert alert-danger">
                       {{ __('userReport.no_data') }}
                   </div>
               @endif
           </div>
       </div>
   </div>

   <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
   <script src="{{ asset('assets/admin/js/general.js') }}"></script>
   <script>
       $(document).ready(function() {
           window.print();
       });
   </script>
</body>
</html>