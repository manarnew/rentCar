@extends('layouts.admin')

@section('title')
    {{ __('expensesType.expense_categories') }}
@endsection

@section('contentheader')
    {{ __('expensesType.expense_categories') }}
@endsection

@section('contentheaderlink')
    <a href="{{ route('expensesType.index') }}">{{ __('expensesType.expense_categories') }}</a>
@endsection

@section('contentheaderactive')
    {{ __('expensesType.view') }}
@endsection

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('expensesType.expense_categories') }}</h3>
            <input type="hidden" id="token_search" value="{{ csrf_token() }}">
            @if(check_permission_sub_menue_actions(6))
            <a href="{{ route('expensesType.create') }}" class="btn btn-sm btn-success">{{ __('expensesType.add_new') }}</a>
            @endif
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div id="ajax_responce_serarchDiv">
               @if(isset($data) && !empty($data) && count($data) > 0)
               @php
               $i = 1;   
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>{{ __('expensesType.serial') }}</th>
                     <th>{{ __('expensesType.category_name') }}</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($data as $info)
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              @if(check_permission_sub_menue_actions(8))
                            <a type="button" class="btn are_you_shue btn-danger"
                             href="{{ route('admin.expensesType.delete', $info->id) }}" style="color:#000;" title="{{ __('expensesType.delete') }}"><i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                            @if(check_permission_sub_menue_actions(7))
                            <a type="button" class="btn btn-warning"                     
                            href="{{ route('expensesType.edit', $info->id) }}" style="color:#fff;" title="{{ __('expensesType.edit') }}"><i class="fas fa-edit"></i>
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
               <div class="alert alert-danger">
                  {{ __('expensesType.no_data') }}
               </div>
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