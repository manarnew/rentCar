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
            <h3 class="card-title card_title_center">{{ __('taxReport.tax_reports') }} {{ __('taxReport.from_date') }} ({{ $from_date_search }}) {{ __('taxReport.to_date') }} ({{ $to_date_search }})</h3>
        </div>
        <div class="card-body">
            @if ((@isset($total_Contracts_tax) && !@empty($total_Contracts_tax)) || (@isset($total_CarExpenses_tax) && !@empty($total_CarExpenses_tax)))
                <div class="row" style="padding-bottom: 30px">
                    <h3 class="card-title card_title_center">{{ __('taxReport.tax_reports') }}</h3>
                    <table id="example2" class="table table-bordered table-hover">
                        @if ($taxType == 1 || $taxType == '')
                        <tr>
                            <th class="width30">{{ __('taxReport.car_expenses_tax') }}</th>
                            <td>{{ $total_CarExpenses_tax }}</td>
                        </tr>
                        @endif
                        @if ($taxType == 0 || $taxType == '')
                        <tr>
                            <th class="width30">{{ __('taxReport.contracts_tax') }}</th>
                            <td>{{ $total_Contracts_tax }}</td>
                        </tr>
                        @endif
                        @if ($taxType == '')
                        <tr>
                            <th class="width30">{{ __('taxReport.total_tax') }}</th>
                            <td>{{ $total_Contracts_tax + $total_CarExpenses_tax }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    {{ __('taxReport.no_data') }}
                </div>
            @endif

            @if ($taxType == 1 || $taxType == '')
            <h3 style="text-align: center; color:red">{{ __('taxReport.car_expenses_tax') }} {{ __('taxReport.details') }}</h3>
            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($carExpenses) && !@empty($carExpenses))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>{{ __('taxReport.plate_number') }}</th>
                            <th>{{ __('taxReport.car_model') }}</th>
                            <th>{{ __('taxReport.type') }}</th>
                            <th>{{ __('taxReport.date') }}</th>
                            <th>{{ __('taxReport.supplier') }}</th>
                            <th>{{ __('taxReport.tax') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($carExpenses as $info)
                                <tr>
                                    <td>{{ $info->car->plate_number }}</td>
                                    <td>{{ $info->car->type->name }}</td>
                                    <td>{{ $info->car->carModals->name }}</td>
                                    <td>{{ $info->date }}</td>
                                    <td>{{ $info->supplier }}</td>
                                    <td>{{ $info->tax }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        {{ __('taxReport.no_data') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12" style="margin-top:50px">
                <hr style="border: 1px solid rgb(78, 96, 212)">
            </div>
            @endif

            @if ($taxType == 0 || $taxType == '')
            <h3 style="text-align: center; color:red">{{ __('taxReport.contracts_tax') }} {{ __('taxReport.details') }}</h3>
            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @if (@isset($contracts) && !@empty($contracts))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>{{ __('taxReport.reservation_number') }}</th>
                            <th>{{ __('taxReport.type') }}</th>
                            <th>{{ __('taxReport.number_per_day') }}</th>
                            <th>{{ __('taxReport.plate_number') }}</th>
                            <th>{{ __('taxReport.car_model') }}</th>
                            <th>{{ __('taxReport.customer_name') }}</th>
                            <th>{{ __('taxReport.date') }}</th>
                            <th>{{ __('taxReport.return_date') }}</th>
                            <th>{{ __('taxReport.tax') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $info)
                                <tr>
                                    <td>{{ $info->id }}</td>
                                    <td>
                                        @if ($info->contract_type == 1)
                                            {{ __('taxReport.daily') }}
                                        @elseif($info->contract_type == 2)
                                            {{ __('taxReport.weekly') }}
                                        @else
                                            {{ __('taxReport.monthly') }}
                                        @endif
                                    </td>
                                    <td>{{ $info->contract_number }}</td>
                                    <td>{{ $info->car->plate_number }}</td>
                                    <td>{{ $info->car->type->name }}</td>
                                    <td>{{ $info->customer->name }}</td>
                                    <td>{{ $info->date }}</td>
                                    <td>{{ $info->return_date }}</td>
                                    <td>{{ $info->tax_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        {{ __('taxReport.no_data') }}
                    </div>
                @endif
            </div>
            @endif
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