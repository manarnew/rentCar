@extends('layouts.admin')

@section('title')
    {{ __('debentures.title') }}
@endsection

@section('contentheader')
    {{ __('debentures.content_header') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('debentures.index') }}">{{ __('debentures.content_header_link') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('debentures.content_header_active') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('debentures.add_debenture') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <h3 class="card-title card_title_center">{{ __('debentures.customer_data') }}</h3>
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <td> {{ __('debentures.customer_name') }}: {{ $customer_id->name }}</td>
                    <td> {{ __('debentures.company_name') }}: {{ $customer_id->com_name }}</td>
                    <td> {{ __('debentures.phone') }}: {{ $customer_id->phone }}</td>
                    <td> {{ __('debentures.address') }}: {{ $customer_id->address }}</td>
                    <td> {{ __('debentures.nationality') }}: {{ $customer_id->nationality }}</td>
                </tr>
                <tr>
                    <td> {{ __('debentures.identity_number') }}: {{ $customer_id->identity_number }}</td>
                    <td> {{ __('debentures.driver_license_number') }}: {{ $customer_id->driver_license_number }}</td>
                    <td> {{ __('debentures.license_issue_place') }}: {{ $customer_id->driver_license_address }}</td>
                    <td> {{ __('debentures.license_issue_date') }}: {{ $customer_id->driver_license_release_date }}</td>
                    <td> {{ __('debentures.license_expiry_date') }}: {{ $customer_id->driver_license_address_end_date }}</td>
                </tr>
            </table>
            <br>
            <h3 class="card-title card_title_center">{{ __('debentures.car_data') }}</h3>
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <td> {{ __('debentures.car_type') }}: {{ $car_id->type->name }}</td>
                    <td> {{ __('debentures.car_model') }}: {{ $car_id->carModals->name }}</td>
                    <td> {{ __('debentures.plate_number') }}: {{ $car_id->plate_number }}</td>
                    <td> {{ __('debentures.car_color') }}: {{ $car_id->car_color }}</td>
                    <td> {{ __('debentures.insurance_company') }}: {{ $car_id->insurance }}</td>
                    <td>
                        {{ __('debentures.insurance_type') }}: @if ($car_id->full_insurance == 1) 
                            {{ __('debentures.full_insurance') }} 
                        @else 
                            {{ __('debentures.partial_insurance') }} 
                        @endif
                    </td>
                </tr>
            </table>
            <div class="col-md-12">
                <hr style="border: 1px solid rgb(78, 96, 212)">
            </div>
            <form action="{{ route('debentures.store') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="car_id" value="{{ $car_id->id }}">
                    <input type="hidden" name="customer_id" value="{{ $customer_id->id }}">
                    <input type="hidden" name="contract_id" value="{{ $Contracts_id->id }}">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('debentures.amount') }}</label>
                            <input type="hidden" id="remind_price_old" value="{{ $Contracts_id->remind_price }}">
                            <input type="number" name="paid_price" id="paid_price" class="form-control"
                                value="{{ old('paid_price') }}">
                            @error('paid_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('debentures.remaining') }}</label>
                            <input type="number" readonly name="remind_price" id="remind_price" class="form-control"
                                value="{{ old('remind_price', $Contracts_id->remind_price) }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('debentures.date') }}</label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ old('date', date('Y-m-d')) }}">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('debentures.payment_type') }}</label>
                            <select id="payment_type" name="payment_type" class="form-control ">
                                <option value="">{{ __('debentures.choose_payment_type') }}</option>
                                <option @if (old('payment_type') == 'تحويل بنكي') selected="selected" @endif value="تحويل بنكي">
                                    {{ __('debentures.bank_transfer') }}</option>
                                <option @if (old('payment_type') == 'كاش') selected="selected" @endif value="كاش">{{ __('debentures.cash') }}</option>
                                <option @if (old('payment_type') == 'بطاقة') selected="selected" @endif value="بطاقة">{{ __('debentures.card') }}</option>
                                <option @if (old('payment_type') == 'شيك') selected="selected" @endif value="شيك">{{ __('debentures.check') }}</option>
                                <option @if (old('payment_type') == 'دين') selected="selected" @endif value="دين">{{ __('debentures.debt') }}</option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('debentures.check_number') }}</label>
                            <input name="check_number" id="check_number" class="form-control"
                                value="{{ old('check_number') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('debentures.note') }}</label>
                            <input name="note" id="note" class="form-control" value="{{ old('note') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm">{{ __('debentures.add') }}</button>
                            <a href="{{ route('debentures.index') }}" class="btn btn-sm btn-danger">{{ __('debentures.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('input', '#paid_price', function(e) {
            var remind_price_old = $("#remind_price_old").val();
            if (remind_price_old == 0) {
                $("#paid_price").val("")
                alert("{{ __('debentures.no_remaining_amount') }}");
                return false;
            }
            var paid_price = $("#paid_price").val();
            var remind_price = $("#remind_price").val();

            if ((remind_price_old - paid_price) < 0) {
                alert("{{ __('debentures.payment_exceeds') }}");
                $("#paid_price").val("")
                $("#remind_price").val(remind_price_old)
                return false;
            } else {
                $("#remind_price").val(remind_price_old - paid_price);
            }
        });
        $(document).on('click', '#do_add_item_cardd', function(e) {
            var remind_price_old = $("#remind_price_old").val();
            if (remind_price_old == 0) {
                $("#paid_price").val("")
                alert("{{ __('debentures.no_remaining_amount') }}");
                return false;
            }
        });
    </script>
@endsection

