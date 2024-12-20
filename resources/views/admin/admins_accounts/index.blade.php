@extends('layouts.admin')
@section('title')
    الصلاحيات
@endsection
@section('contentheader')
    المستخدمين
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.admins_accounts.index') }}"> المستخدمين </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات المستخدمين</h3>
                    <input type="hidden" id="token_search" value="{{ csrf_token() }}">
                    <input type="hidden" id="ajax_search_url" value="{{ route('admin.admins_accounts.ajax_search') }}">
                    @if (check_permission_sub_menue_actions(27) == true)
                        <a href="{{ route('admin.admins_accounts.create') }}" class="btn btn-sm btn-success"><i
                                class="fas fa-plus"></i> اضافة جديد</a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> بحث بالاسم</label>
                                <input style="margin-top: 6px !important;" type="text" id="search_by_name"
                                    placeholder=" اسم المستخدم" class="form-control"> <br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> بحث بأدوار الصلاحيات </label>
                                <select name="permission_roles_id_search" id="permission_roles_id_search"
                                    class="form-control ">
                                    <option value="all">بحث بالكل </option>
                                    @if (@isset($Permission_rols) && !@empty($Permission_rols))
                                        @foreach ($Permission_rols as $info)
                                            <option @if (old('permission_roles_id') == $info->id) selected="selected" @endif
                                                value="{{ $info->id }}"> {{ $info->name }} </option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="ajax_responce_serarchDiv">
                        @if (@isset($data) && !@empty($data))
                            @php
                                $i = 1;
                            @endphp
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="custom_thead">
                                    <th>مسلسل</th>
                                    <th>اسم المستخدم</th>
                                    <th>دور صلاحية المستخدم </th>
                                    <th>حالة التفعيل</th>
                                    <th>اجراء</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $info)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->permissionRole->name }}</td>
                                            <td>
                                                @if ($info->active == 1)
                                                    مفعل
                                                @else
                                                    معطل
                                                @endif
                                            </td>
                                            <td>
                                                @if (check_permission_sub_menue_actions(28) == true)
                                                    <a href="{{ route('admin.admins_accounts.edit', $info->id) }}"
                                                        class="btn btn-sm  btn-primary" title="تعديل"><i
                                                            class="fas fa-edit fa-sm"></i></a>
                                                @endif
                                                @if (check_permission_sub_menue_actions(54) == true)
                                                    <a href="{{ route('admin.admins_accounts.show', $info->id) }}"
                                                        class="btn btn-sm  btn-info">تفاصيل</a>
                                                @endif
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
                            <div class="alert alert-danger">
                                عفوا لاتوجد بيانات لعرضها !!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/admins.js') }}"></script>
@endsection
