@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_dashboard">
        <div class="box-header">
            <div class="col-md-6">
                <i class="fas fa-tachometer-alt"></i> &nbsp;
                <h3 class="box-title">Dashboard</h3>
            </div>
        </div>
        <div class="box-body">
            <div class="pull-right">
                    <button class="btn btn-primary" id="btn_add_workspace"><i class="fas fa-folder-plus"></i> &nbsp; Add</button>
            </div>
            <div class="row">
                @include('dashboard.Partials.table_dashboard_rows')
            </div>
        </div>
    </div>
    @include('dashboard.Partials.modal_add_dashboard')
@endsection
@section('scripts')
    <script src="{{  asset('js/app/dashboard.js')  }}"></script>
@endsection
