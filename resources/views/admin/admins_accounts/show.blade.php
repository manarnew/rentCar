@extends('layouts.admin')

@section('title')
    {{ __('users.customer_control') }}
@endsection

@section('contentheader')
    {{ __('users.customers') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('admin.customer.index') }}">{{ __('users.customers') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('users.customer_details') }}
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title card_title_center">{{ __('users.customer_details') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <td>{{ __('users.name') }}</td>
                    <td colspan="2">{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td>{{ __('users.email') }}</td>
                    <td colspan="2">{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td>{{ __('users.profile_picture') }}</td>
                    <td colspan="2">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->image }}" style="width: 150px;padding: 5px;height:150px;">
                    </td>
                </tr>
                <tr>
                    <td>{{ __('users.identity_number') }}</td>
                    <td colspan="2">{{ $data['identity_number'] }}</td>
                </tr>
                <tr>
                    <td>{{ __('users.identity_front_image') }}</td>
                    <td colspan="2">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->identity_front_image }}" style="width: 150px;padding: 5px;height:150px;">
                    </td>
                </tr>
                <tr>
                    <td>{{ __('users.identity_back_image') }}</td>
                    <td colspan="2">
                        <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->identity_back_image }}" style="width: 150px;padding: 5px;height:150px;">
                    </td>
                </tr>
                <tr>
                    <td class="width30">{{ __('users.added_on') }}</td>
                    <td>
                        @php
                            $dt = new DateTime($data['created_at']);
                            $date = $dt->format('Y-m-d');
                            $time = $dt->format('h:i');
                            $newDateTime = date('A', strtotime($time));
                            $newDateTimeType = $newDateTime == 'AM' ? 'AM' : 'PM';
                        @endphp
                        {{ $date }} {{ $time }} {{ $newDateTimeType }} by {{ $data->user->name }}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('users.updated_on') }}</td>
                    <td colspan="2">
                        @if ($data['updated_by'] > 0 && $data['updated_by'] != null)
                            @php
                                $dt = new DateTime($data['updated_at']);
                                $date = $dt->format('Y-m-d');
                                $time = $dt->format('h:i');
                                $newDateTime = date('A', strtotime($time));
                                $newDateTimeType = $newDateTime == 'AM' ? 'AM' : 'PM';
                            @endphp
                            {{ $date }} {{ $time }} {{ $newDateTimeType }} by {{ $data->user->name }}
                        @else
                            {{ __('users.no_update') }}
                        @endif
                        <a href="{{ route('admin.customer.edit', $data['id']) }}" class="btn btn-sm btn-success">{{ __('users.edit') }}</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection