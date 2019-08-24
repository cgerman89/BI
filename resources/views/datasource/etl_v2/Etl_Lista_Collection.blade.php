@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_etl_collections_list">
        <div class="box-header">
            <h3 class="box-title"> ETL COLLECTIONS  </h3>
        </div>
        <div class="box-body">
            @include('datasource.etl_v2.PartialsListEtl.table_list')
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{  asset('js/app/etl_lista.js')  }}"></script>
@endsection