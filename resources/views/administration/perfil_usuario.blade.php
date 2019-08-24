@extends('admin.app')

@section('content_dashboard')
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fas fa-key"></i> Password</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            @include('administration.Partials.form_password_user')
        </div>
        <div class="box-footer">
            <button type="button" id="btn_save_pwd" class="btn btn-primary pull-right">
                <i class="far fa-save"></i>&nbsp;Save
            </button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app/perfil.js') }}"></script>
@endsection