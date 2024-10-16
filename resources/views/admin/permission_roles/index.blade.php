@extends('layouts.admin')

@section('title')
{{ __('permission_roles.title') }}
@endsection

@section('contentheader')
{{ __('permission_roles.contentheader') }}
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.permission_roles.index') }}">{{ __('permission_roles.contentheaderlink') }}</a>
@endsection

@section('contentheaderactive')
{{ __('permission_roles.contentheaderactive') }}
@endsection

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('permission_roles.card_title') }}</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            @if(check_permission_sub_menue_actions(30))
            <a href="{{ route('admin.permission_roles.create') }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus"></i> {{ __('permission_roles.add_new') }}
            </a>
            @endif
         </div>
         <div class="card-body">
            <div id="ajax_responce_serarchDiv">
               @if (@isset($data) && !@empty($data) && count($data) > 0)
               @php
               $i = 1;
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>{{ __('permission_roles.serial') }}</th>
                     <th>{{ __('permission_roles.role_name') }}</th>
                     <th>{{ __('permission_roles.activation_status') }}</th>
                     <th>{{ __('permission_roles.creation_date') }}</th>
                     <th>{{ __('permission_roles.update_date') }}</th>
                     <th>{{ __('permission_roles.action') }}</th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info)
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->name }}</td>
                        <td>@if($info->active == 1) {{ __('permission_roles.enabled') }} @else {{ __('permission_roles.disabled') }} @endif</td>
                        <td>
                           @php
                           $dt = new DateTime($info->created_at);
                           $date = $dt->format("Y-m-d");
                           $time = $dt->format("h:i");
                           $newDateTime = date("A", strtotime($time));
                           $newDateTimeType = ($newDateTime == 'AM') ? 'صباحا ' : 'مساء';
                           @endphp
                           {{ $date }} <br>
                           {{ $time }} {{ $newDateTimeType }} <br>
                           {{ __('permission_roles.updated_by') }} {{ $info->added_by_admin }}
                        </td>
                        <td>
                           @if($info->updated_by > 0 && $info->updated_by != null)
                           @php
                           $dt = new DateTime($info->updated_at);
                           $date = $dt->format("Y-m-d");
                           $time = $dt->format("h:i");
                           $newDateTime = date("A", strtotime($time));
                           $newDateTimeType = ($newDateTime == 'AM') ? 'صباحا ' : 'مساء';
                           @endphp
                           {{ $date }} <br>
                           {{ $time }} {{ $newDateTimeType }} <br>
                           {{ __('permission_roles.updated_by') }} {{ $data['updated_by_admin'] }}
                           @else
                           {{ __('permission_roles.no_update') }}
                           @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                               @if(check_permission_sub_menue_actions(31))
                               <a type="button" class="btn btn-warning" href="{{ route('admin.permission_roles.edit', $info->id) }}" style="color:#fff;" title="{{ __('permission_roles.edit') }}">
                                   <i class="fas fa-edit"></i>
                               </a>
                               @endif
                               @if(check_permission_sub_menue_actions(32))
                               <a type="button" class="btn btn-info" href="{{ route('admin.permission_roles.details', $info->id) }}" style="color:#fff;" title="{{ __('permission_roles.permissions') }}">
                                   <i class="fas fa-universal-access"></i>
                               </a>
                               @endif
                            </div>
                        </td>
                     </tr>
                     @php
                     $i++;
                     @endphp
                     @endforeach
                  </tbody>
               </table>
               <br>
               {{ $data->links() }}
               @else
               <div class="alert alert-danger">{{ __('permission_roles.no_data') }}</div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/admin/js/treasuries.js') }}"></script>
@endsection