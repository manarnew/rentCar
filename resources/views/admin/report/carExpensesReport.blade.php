<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#A52A2A">
    <meta name="msapplication-navbutton-color" content="#A52A2A">
    <meta name="apple-mobile-web-app-status-bar-style" content="#A52A2A">
    <title>{{ __('carExpensesReport.report_title') }}</title>
    <link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css') }}">
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
            <br><br>
            <h3 class="card-title card_title_center">{{ __('carExpensesReport.report_title') }} من تاريخ ({{ $from_date_search }}) الي تاريخ ({{ $to_date_search }})</h3>
        </div>
        <div class="card-body">
            @if (@isset($total_price) && !@empty($total_price))
                <div class="row" style="padding-bottom: 30px">
                    <h3 class="card-title card_title_center">{{ __('carExpensesReport.report_title') }}</h3>
                    <table id="example2" class="table table-bordered table-hover">
                        @if ($car != "")
                        <tr>
                            <th class="width30">{{ __('carExpensesReport.plate_number') }}</th>
                            <td>{{ $car->plate_number }}</td>
                        </tr>
                        <tr>
                            <th class="width30">{{ __('carExpensesReport.car_model') }}</th>
                            <td>{{ $car->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="width30">{{ __('carExpensesReport.car_type') }}</th>
                            <td>{{ $car->carModals->name }}</td>
                        </tr>
                        @endif
                        @if ($car == "")
                        <tr>
                            <th>{{ __('carExpensesReport.number_of_cars') }}</th>
                            <td>{{ $car_number }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th class="width30">{{ __('carExpensesReport.total_expenses') }}</th>
                            <td>{{ $total_price }}</td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">{{ __('carExpensesReport.no_data') }}</div>
            @endif

            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($carExpenses) && !@empty($carExpenses))
                    @php $i = 1; @endphp
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            @if ($car == "")
                            <th>{{ __('carExpensesReport.plate_number') }}</th>
                            <th>{{ __('carExpensesReport.car_model') }}</th>
                            <th>{{ __('carExpensesReport.car_type') }}</th>
                            @endif
                            <th>{{ __('carExpensesReport.date') }}</th>
                            <th>{{ __('carExpensesReport.supplier') }}</th>
                            <th>{{ __('carExpensesReport.amount') }}</th>
                            <th>{{ __('carExpensesReport.tax') }}</th>
                            <th>{{ __('carExpensesReport.total_price_tax') }}</th>
                            <th>{{ __('carExpensesReport.employee') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($carExpenses as $info)
                                <tr>
                                    @if ($car == "")
                                    <td>{{ $info->car->plate_number }}</td>
                                    <td>{{ $info->car->type->name }}</td>
                                    <td>{{ $info->car->carModals->name }}</td>
                                    @endif
                                    <td>{{ $info->date }}</td>
                                    <td>{{ $info->supplier }}</td>
                                    <td>{{ $info->price }}</td>
                                    <td>{{ $info->tax }}</td>
                                    <td>{{ $info->total_price_tax }}</td>
                                    <td>{{ $info->user->name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="8">
                                        <span style="color: aqua; margin-right: 50%;">{{ __('carExpensesReport.note') }}</span>
                                        <br>
                                        <span style="text-align:center">{{ $info->note }}</span>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">{{ __('carExpensesReport.no_data') }}</div>
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