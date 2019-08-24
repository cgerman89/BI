@extends('admin.app')
@section('content_dashboard')
    <div class="box box-solid box-default with-border" id="panel_file_load">
        <div class="box-header">
            <h3 class="box-title">File</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            @include('datasource.etl_v2.PartialsFile.form_file_import')
        </div>
    </div>
    <div class="box box-solid box-default with-border">
        <div class="box-header">
            <h3 class="box-title">Data preview</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div id="html_table_preview"></div>
            <div id="js_table_preview"></div>
        </div>
    </div>

    <div class="box box-solid box-default with-border">
        <div class="box-header">
            <h3 class="box-title">Columns</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            @include('datasource.etl_v2.PartialsFile.colunms_select_extract')
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"  src="{{  asset('js/app/etl_file_extract.js')  }}"></script>
@endsection
