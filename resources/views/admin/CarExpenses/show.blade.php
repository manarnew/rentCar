@extends('layouts.admin')

@section('title')
    {{ __('CarExpenses.title') }}
@endsection

@section('contentheader')
    {{ __('CarExpenses.content_header') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('CarExpenses.index') }}">{{ __('CarExpenses.content_header_link') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('CarExpenses.content_header_active') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('CarExpenses.view_expense_data') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>{{ __('CarExpenses.plate_number') }}</td>
                        <td colspan="2">{{ $data['car_id'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.car_color') }}</td>
                        <td colspan="2">{{ $data->car->car_color }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.car_type') }}</td>
                        <td colspan="2">{{ $data->car->type->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.receipt_image') }}</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->image }}" style="width: 150px; padding: 5px; height: 150px;">
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.expense_price') }}</td>
                        <td colspan="2">{{ $data->price }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.tax') }}</td>
                        <td colspan="2">{{ $data->tax }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.total_with_tax') }}</td>
                        <td colspan="2">{{ $data->total_price_tax }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.supplier') }}</td>
                        <td colspan="2">{{ $data->supplier }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.details') }}</td>
                        <td colspan="2">{{ $data->note }}</td>
                    </tr>
                    <tr>
                        <td class="width30">{{ __('CarExpenses.created_at') }}</td>
                        <td>
                            @php
                                $dt = new DateTime($data['created_at']);
                                $date = $dt->format('Y-m-d');
                                $time = $dt->format('h:i');
                                $newDateTime = date('A', strtotime($time));
                                $newDateTimeType = $newDateTime == 'AM' ? 'صباحا' : 'مساء';
                            @endphp
                            {{ $date }} {{ $time }} {{ $newDateTimeType }} بواسطة {{ $data->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('CarExpenses.updated_at') }}</td>
                        <td colspan="2">
                            @if ($data['updated_by'] > 0 && $data['updated_by'] != null)
                                @php
                                    $dt = new DateTime($data['updated_at']);
                                    $date = $dt->format('Y-m-d');
                                    $time = $dt->format('h:i');
                                    $newDateTime = date('A', strtotime($time));
                                    $newDateTimeType = $newDateTime == 'AM' ? 'صباحا' : 'مساء';
                                @endphp
                                {{ $date }} {{ $time }} {{ $newDateTimeType }} بواسطة {{ $data->user->name }} {{ $data['updated_by_admin'] }}
                            @else
                                {{ __('CarExpenses.no_update') }}
                            @endif
                            <a href="{{ route('admin.customer.edit', $data['id']) }}" class="btn btn-sm btn-success">{{ __('CarExpenses.edit') }}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection