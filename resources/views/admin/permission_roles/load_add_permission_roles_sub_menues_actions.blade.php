@if (isset($permission_roles_sub_menu) && !empty($permission_roles_sub_menu))
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

<form action="{{ route('admin.permission_roles.add_permission_roles_sub_menues_actions', $permission_roles_sub_menu['id']) }}" method="post">
    @csrf
    <div class="form-group">
        <label>{{ __('permission_roles.permission_data') }}</label>
        <select name="permission_sub_menues_actions_id[]" multiple id="permission_sub_menues_actions_id" class="form-control select2">
            <option value="">{{ __('permission_roles.choose_permissions') }}</option>
            @if (isset($permission_sub_menues_actions) && !empty($permission_sub_menues_actions))
                @foreach ($permission_sub_menues_actions as $info)
                <option value="{{ $info->id }}">{{ $info->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('permission_roles.add') }}</button>
    </div>
</form>

@else
<div class="alert alert-danger">
    {{ __('permission_roles.no_data') }}
</div>
@endif

@section("script")
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    // Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    });
</script>
@endsection