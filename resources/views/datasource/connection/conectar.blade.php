@extends('admin.app')
@section('content_dashboard')
<div class="box box-default box-solid" id="panel_connections">
    <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-plug"></i>  Add Connections </h3>
    </div>
    <div class="box-body">
        @include('datasource.connection.Partials.form_con')
    </div>
</div>
<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-table"></i>  Registered Connections </h3>
    </div>
    <div class="box-body">
         @include('datasource.connection.Partials.table')
    </div>
</div>
@endsection
@section('scripts')
    <script   src="{{  asset('js/app/Connections.js')  }}"></script>
@stop
