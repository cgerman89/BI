@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_users">
        <div class="box-header">
            <h3 class="box-title"> <i class="fas fa-user"></i>&nbsp; Add User </h3>
        </div>
        <div class="box-body">
            @include('administration.Partials.form_create_user')
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" id="btn_save" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    &nbsp; Save
                </button>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <i class="far fa-list-alt"></i> Users </h3>
        </div>
        <div class="panel-body">
            @include('administration.Partials.table_users')
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app/users.js') }}"></script>
@endsection