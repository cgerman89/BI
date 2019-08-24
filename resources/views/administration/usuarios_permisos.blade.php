@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_user_permisos_roles">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-user-shield"></i>&nbsp;Users</h3>
        </div>
        <div class="box-body">
            @include('administration.Partials.form_users_permisos_roles')
        </div>
        <div class="box-footer">
            <button type="button" id="btn_clean" class="btn btn-default pull-left">
                <i class="fas fa-redo"></i>
                Clear
            </button>
            <button type="button" id="btn_save" class="btn btn-primary pull-right">
                <i class="fas fa-save"></i>&nbsp;Save
            </button>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp;Usuarios permisos y Roles</h3>
        </div>
        <div class="panel-body">
            @include('administration.Partials.table_users_permisos')
        </div>
   </div>
   @include('administration.Partials.modal_list_roles')
@endsection
@section('scripts')
 <script src="{{ asset('js/app/usuarios_permisos.js') }}"></script>
@endsection
