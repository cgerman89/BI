@extends('admin.app')
@section('content_dashboard')
    <div class="col-md-8 col-lg-offset-2">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fas fa-exclamation-triangle"></i> &nbsp;
                    Alerta - &nbsp;
                    @yield('title_error')
                </h3>
            </div>
            <div class="box-body">
                <blockquote>
                    @yield('message_error')
                </blockquote>
            </div>
        </div>
    </div>
@endsection
