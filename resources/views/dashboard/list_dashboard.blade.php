@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_dashboard">
        <div class="box-header">
          <i class="fas fa-list-ul"></i>&nbsp;
          &nbsp;
          <h3 class="box-title">List Dashboard</h3>
        </div>
        <div class="box-body">
            @include('dashboard.Partials.select_dashboard')
        </div>
    </div>
    <div class="row" id="panels_html"></div>
@endsection
@section('scripts')
    <script src="{{  asset('js/app/list_dashboard.js')  }}"></script>
@endsection

