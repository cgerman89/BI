@extends('admin.app')
@section('content_dashboard')
     <div class="row">
         <div class="col-sm-7">
             <div class="box box-default box-solid" id="row_roles_permisos">
                 <div class="box-header">
                     <h3 class="box-title"><i class="fas fa-fingerprint"></i>&nbsp; Rol</h3>
                 </div>
                 <div class="box-body">
                     @include('administration.Partials.form_rol')
                 </div>
                 <div class="box-footer">
                     <div class="pull-right">
                         <button type="submit" id="btn_save_rol" class="btn btn-primary">
                             <i class="fas fa-save"></i>
                             &nbsp; Save
                         </button>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-sm-5">
             <div class="box box-default box-solid">
                 <div class="box-header">
                     <h3 class="box-title"><i class="fas fa-shield-alt"></i>&nbsp; Permisos </h3>
                 </div>
                 <div class="box-body">
                    @include('administration.Partials.sel_permisos')
                 </div>
             </div>
         </div>
     </div>
     <div class="panel panel-default">
         <div class="panel-heading">
             <h3 class="panel-title"> <i class="far fa-list-alt"></i> Roles </h3>
         </div>
         <div class="panel-body">
            @include('administration.Partials.table_roles')
         </div>
     </div>
@include('administration.Partials.modal_list_permissions')
@endsection
@section('scripts')
  <script src="{{ asset('js/app/roles.js') }}"></script>
@endsection
