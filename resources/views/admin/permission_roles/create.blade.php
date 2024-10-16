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
            <h3 class="card-title card_title_center">{{ __('permission_roles.add_role') }}</h3>
         </div>
         <div class="card-body">
            <form action="{{ route('admin.permission_roles.store') }}" method="post">
               @csrf
               <div class="form-group">
                  <label>{{ __('permission_roles.role_name') }}</label>
                  <input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('permission_roles.role_name_placeholder') }}" oninvalid="setCustomValidity('{{ __('permission_roles.name_error') }}')" onchange="try{setCustomValidity('')}catch(e){}">
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               
               <div class="form-group">
                  <label>{{ __('permission_roles.activation_status') }}</label>
                  <select name="active" id="active" class="form-control">
                     <option value="">{{ __('permission_roles.choose_status') }}</option>
                     <option @if(old('active')==1) selected="selected" @endif value="1">{{ __('permission_roles.yes') }}</option>
                     <option @if(old('active')==0 && old('active')!="") selected="selected" @endif value="0">{{ __('permission_roles.no') }}</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>

               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary btn-sm">{{ __('permission_roles.add') }}</button>
                  <a href="{{ route('admin.permission_roles.index') }}" class="btn btn-sm btn-danger">{{ __('permission_roles.cancel') }}</a>    
               </div>
            </form>
         </div>  
      </div>
   </div>
</div>
@endsection