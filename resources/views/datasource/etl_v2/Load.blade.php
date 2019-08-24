@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="content_load">
        <div class="box-header">
            <h4 class="box-title">Load Data</h4>
        </div>
        <div class="box-body">
            @include('datasource.etl_v2.PartialsLoad.select_data')
        </div>
    </div>
    <div class="box box-default box-solid">
         <div class="box-header">
            <h4 class="box-title">Preview Data</h4>
         </div>
         <div class="box-body">
             @include('datasource.etl_v2.PartialsLoad.tabla_data')
         </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"  src="{{  asset('js/app/load.js')  }}"></script>
@endsection