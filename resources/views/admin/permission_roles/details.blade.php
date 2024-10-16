@php
$langCurent = "Illuminate\Support\Facades\App";
@endphp

@extends('layouts.admin')

@section('title')
{{ __('permission_roles.title') }}
@endsection

@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
{{ __('permission_roles.contentheader') }}
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.permission_roles.index') }}">{{ __('permission_roles.contentheaderlink') }}</a>
@endsection

@section('contentheaderactive')
{{ __('permission_roles.contentheaderactiveDetails') }}
@endsection

@section('content')
<div class="row">
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">{{ __('permission_roles.role_details') }}</h3>
         <input type="hidden" id="token_search" value="{{ csrf_token() }}">
         <input type="hidden" id="ajax_search_load_add_permission_roles_sub_menu" value="{{ route('admin.permission_roles.load_add_permission_roles_sub_menu') }}">
         <input type="hidden" id="ajax_search_load_add_permission_roles_sub_menues_actions" value="{{ route('admin.permission_roles.load_add_permission_roles_sub_menues_actions') }}">
      </div>
      <div class="card-body">
         @if (@isset($data) && !@empty($data))
         <table id="example2" class="table table-bordered table-hover">
            <tr>
               <td class="width30">{{ __('permission_roles.role_name') }}</td>
               <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
               <td class="width30">{{ __('permission_roles.activation_status') }}</td>
               <td>{{ $data['active'] == 1 ? __('permission_roles.active') : __('permission_roles.inactive') }}</td>
            </tr>
            <tr>
               <td class="width30">{{ __('permission_roles.added_date') }}</td>
               <td>
                  @php
                  $dt = new DateTime($data['created_at']);
                  $date = $dt->format("Y-m-d");
                  $time = $dt->format("h:i");
                  $newDateTime = date("A", strtotime($time));
                  $newDateTimeType = ($newDateTime == 'AM' ? 'صباحا' : 'مساء');
                  @endphp
                  {{ $date }} {{ $time }} {{ $newDateTimeType }} {{ __('permission_roles.updated_by') }} {{ $data['added_by_admin'] }}
               </td>
            </tr>
            <tr>
               <td class="width30">{{ __('permission_roles.updated_date') }}</td>
               <td>
                  @if($data['updated_by'] > 0 && $data['updated_by'] != null)
                  @php
                  $dt = new DateTime($data['updated_at']);
                  $date = $dt->format("Y-m-d");
                  $time = $dt->format("h:i");
                  $newDateTime = date("A", strtotime($time));
                  $newDateTimeType = ($newDateTime == 'AM' ? 'صباحا' : 'مساء');
                  @endphp
                  {{ $date }} {{ $time }} {{ $newDateTimeType }} {{ __('permission_roles.updated_by') }} {{ $data['updated_by_admin'] }}
                  @else
                  {{ __('permission_roles.no_update') }}
                  @endif
                  <a href="{{ route('admin.permission_roles.edit', $data['id']) }}" class="btn btn-sm btn-success">{{ __('permission_roles.edit') }}</a>
                  <a href="{{ route('admin.permission_roles.index') }}" class="btn btn-sm btn-info">{{ __('permission_roles.return') }}</a>
               </td>
            </tr>
         </table>
         <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('permission_roles.main_menu_name') }} ( {{ $data['name'] }} )
               <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Add_permission_main_menuesModal">{{ __('permission_roles.add_main_menu') }}</button>
            </h3>
         </div>
         <div id="ajax_responce_serarchDiv">
            @if (@isset($permission_roles_main_menus) && !@empty($permission_roles_main_menus) && count($permission_roles_main_menus) > 0)
            @foreach ($permission_roles_main_menus as $info)
            <table id="example2" class="table table-bordered table-hover">
               <thead class="custom_thead">
                  <th>{{ __('permission_roles.main_menu_name') }}</th>
                  <th>{{ __('permission_roles.added_date') }}</th>
                  <th>{{ __('permission_roles.action') }}</th>
               </thead>
               <tbody>
                  <tr>
                     <td>{{ $info->permission_main_menues_name }}</td>
                     <td>
                        @php
                        $dt = new DateTime($info->created_at);
                        $date = $dt->format("Y-m-d");
                        $time = $dt->format("h:i");
                        $newDateTime = date("A", strtotime($time));
                        $newDateTimeType = ($newDateTime == 'AM' ? 'صباحا' : 'مساء');
                        @endphp
                        {{ $date }} {{ $time }} {{ $newDateTimeType }} {{ __('permission_roles.updated_by') }} {{ $info->added_by_admin }}
                     </td>
                     <td>
                        <a href="{{ route('admin.permission_roles.delete_permission_main_menues', $info->id) }}" class="btn btn-sm btn-danger are_you_shue"><i class="fas fa-trash-alt"></i></a>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="3">
                        <p style="text-align: center; font-size: 1.4vw; color: brown">
                           {{ __('permission_roles.sub_menu_name') }}
                           <button data-id="{{ $info->id }}" class="btn btn-sm load_add_permission_roles_sub_menu btn-info">{{ __('permission_roles.add_sub_menu') }}</button>
                        </p>
                        @if (@isset($info->permission_roles_sub_menu) && !@empty($info->permission_roles_sub_menu) && count($info->permission_roles_sub_menu) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                           <thead class="bg-info">
                              <th>{{ __('permission_roles.sub_menu_name') }}</th>
                              <th>{{ __('permission_roles.added_date') }}</th>
                              <th>{{ __('permission_roles.action') }}</th>
                           </thead>
                           <tbody>
                              @foreach ($info->permission_roles_sub_menu as $sub)
                              <tr>
                                 <td>{{ $sub->permission_sub_menues_name }}</td>
                                 <td>
                                    @php
                                    $dt = new DateTime($sub->created_at);
                                    $date = $dt->format("Y-m-d");
                                    $time = $dt->format("h:i");
                                    $newDateTime = date("A", strtotime($time));
                                    $newDateTimeType = ($newDateTime == 'AM' ? 'صباحا' : 'مساء');
                                    @endphp
                                    {{ $date }} {{ $time }} {{ $newDateTimeType }} {{ __('permission_roles.updated_by') }} {{ $sub->added_by_admin }}
                                 </td>
                                 <td>
                                    <button data-id="{{ $sub->id }}" class="btn btn-sm load_add_permission_roles_sub_menues_actions btn-success">{{ __('permission_roles.add_permission') }}</button>
                                    <a href="{{ route('admin.permission_roles.delete_permission_sub_menues', $sub->id) }}" class="btn btn-sm btn-danger are_you_shue"><i class="fas fa-trash-alt"></i></a>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="3" style="text-align: center">
                                    @if (@isset($sub->permission_roles_sub_menues_actions) && !@empty($sub->permission_roles_sub_menues_actions) && count($sub->permission_roles_sub_menues_actions) > 0)
                                    @foreach ($sub->permission_roles_sub_menues_actions as $action)
                                    <a style="background-color: #DC3545;" href="{{ route('admin.permission_roles.delete_permission_sub_menues_actions', $action->id) }}" class="btn btn-sm are_you_shue text-light">
                                       @if ($langCurent::isLocale('en'))
   
                                     
                                       @php
                                       switch ($action->permission_sub_menues_actions_name) {
                                          case 'حذف':
                                              $translated = 'Delete';
                                              break;
                                          case 'اضافة':
                                              $translated = 'Add';
                                              break;
                                          case 'تعديل':
                                              $translated = 'Edit';
                                              break;
                                          case 'بحث':
                                              $translated = 'Search';
                                              break;
                                          case 'عرض':
                                              $translated = 'Display';
                                              break;
                                          case 'حجز جديد':
                                              $translated = 'New Booking';
                                              break;
                                          case 'تفاصيل':
                                              $translated = 'Details';
                                              break;
                                          case 'الصلاحيات':
                                              $translated = 'Permissions';
                                              break;
                                          case 'التوقيع':
                                              $translated = 'Signature';
                                              break;
                                          case 'اضافة سند قبض':
                                              $translated = 'Add Receipt';
                                              break;
                                          case 'طباعة':
                                              $translated = 'Print';
                                              break;
                                          default:
                                              $translated = 'Translation not found';
                                      }
                                      @endphp
                                      {{$translated  }}
                                        @else
                                      {{$action->permission_sub_menues_actions_name}}
                                         @endif
                                       <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    @endforeach
                                    @endif
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                        @else
                        <div class="alert alert-danger">
                           {{ __('permission_roles.no_data') }}
                        </div>
                        @endif
                     </td>
                  </tr>
               </tbody>
            </table>
            @endforeach
            @else
            <div class="alert alert-danger">
               {{ __('permission_roles.no_data') }}
            </div>
            @endif
         </div>
         @else
         <div class="alert alert-danger">
            {{ __('permission_roles.no_data') }}
         </div>
         @endif
      </div>
   </div>
</div>
</div>

<!-- Modal for adding main menu -->
<div class="modal fade" id="Add_permission_main_menuesModal">
<div class="modal-dialog modal-xl">
   <div class="modal-content bg-info">
      <div class="modal-header">
         <h4 class="modal-title text-center">{{ __('permission_roles.add_main_menu') }}</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="background-color: white !important; color:black;">
         <form action="{{ route('admin.permission_roles.Add_permission_main_menues', $data['id']) }}" method="post">
            @csrf
            <div class="form-group">
               <label>{{ __('permission_roles.main_menu_name') }}</label>
               <select required name="permission_main_menues_id[]" multiple id="permission_main_menues_id" class="form-control select2">
                  <option value="">{{ __('permission_roles.choose_main_menu') }}</option>
                  @if (@isset($Permission_main_menues) && !@empty($Permission_main_menues))
                  @foreach ($Permission_main_menues as $info)
                  <option @if(old('permission_main_menues_id')==$info->id) selected="selected" @endif value="{{ $info->id }}">{{ $info->name }}</option>
                  @endforeach
                  @endif
               </select>
               @error('permission_main_menues_id')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary btn-sm">{{ __('permission_roles.add') }}</button>
            </div>
         </form>
      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{ __('permission_roles.close') }}</button>
      </div>
   </div>
</div>
</div>

<!-- Modal for loading sub menu -->
<div class="modal fade" id="load_add_permission_roles_sub_menuModal">
<div class="modal-dialog modal-xl">
   <div class="modal-content bg-info">
      <div class="modal-header">
         <h4 class="modal-title text-center">{{ __('permission_roles.add_sub_menu') }}</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="background-color: white !important; color:black;" id="load_add_permission_roles_sub_menuModalBody">
      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{ __('permission_roles.close') }}</button>
      </div>
   </div>
</div>
</div>

<!-- Modal for loading sub menu actions -->
<div class="modal fade" id="load_add_permission_roles_sub_menues_actionsModal">
<div class="modal-dialog modal-xl">
   <div class="modal-content bg-info">
      <div class="modal-header">
         <h4 class="modal-title text-center">{{ __('permission_roles.add_permission') }}</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="background-color: white !important; color:black;" id="load_add_permission_roles_sub_menues_actionsModalBody">
      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{ __('permission_roles.close') }}</button>
      </div>
   </div>
</div>
</div>

@endsection

@section("script")
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/permission_roles.js') }}"></script>

<script>
//Initialize Select2 Elements
$('.select2').select2({
  theme: 'bootstrap4'
});
</script>
@endsection