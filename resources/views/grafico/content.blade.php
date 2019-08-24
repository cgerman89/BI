@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_graficos">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-poll"></i> &nbsp;
                    <h4 class="box-title">Grafico</h4>
                </div>
            </div>
        </div>
        <div class="box-body">
                <div class="pull-right">
                    @include('grafico.Partials.botones_opciones')
                </div>
                @include('grafico.Partials.form_select_parametros')
        </div>
    </div>
    <div class="box box-default box-solid">
        <div class="box-header">
            <div class="pull-right">

            </div>
        </div>
        <div class="box-body">
            @include('grafico.Partials.canvas_grafico')
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data</h3>
            </div>
            <div class="box-body">
                @include('grafico.Partials.table_datos')
            </div>
        </div>
    </div>
    @include('grafico.Partials.modal_save_add_dashboard')
    @include('grafico.Partials.moda_pdf')
@stop
@section('scripts')
    <script src="{{  asset('js/app/grafico.js')  }}"></script>
@endsection