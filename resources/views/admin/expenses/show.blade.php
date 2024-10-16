@extends('layouts.admin')

@section('title')
    {{ __('expenses.title') }}
@endsection

@section('contentheader')
    {{ __('expenses.content_header') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('expenses.index') }}">{{ __('expenses.content_header_link') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('expenses.content_header_active') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('expenses.car_expenses') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>{{ __('expenses.expense_type') }}</td>
                        <td colspan="2">{{ $data->type->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('expenses.receipt_image') }}</td>
                        <td colspan="2">
                            <img class="custom_img" src="{{ asset('assets/admin/uploads') . '/' . $data->image }}" style="width: 150px;padding: 5px;height:150px;">
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('expenses.expense_price') }}</td>
                        <td colspan="2">{{ $data->price }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('expenses.tax') }}</td>
                        <td colspan="2">{{ $data->tax }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('expenses.total_with_tax') }}</td>
                        <td colspan="2">{{ $data->total }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('expenses.details') }}</td>
                        <td colspan="2">{{ $data->note }}</td>
                    </tr>
                    <tr>
                        <td class="width30">{{ __('expenses.addition_date') }}</td>
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
                        <td>{{ __('expenses.last_update_date') }}</td>
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
                                {{ __('expenses.no_update') }}
                            @endif
                            <a href="{{ route('expenses.edit', $data['id']) }}" class="btn btn-sm btn-success">{{ __('expenses.edit') }}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection