@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="transformer_panel">
        <div class="box-header">
            <h4 class="box-title">Transformation</h4>
        </div>
        <div class="box-body">
             @include('datasource.etl_v2.PartialsTransformer.columnas_operaciones')
        </div>
    </div>
    <div class="box box-default box-solid">
        <div class="box-header">
            <h4 class="box-title">Cola</h4>
            <div class="pull-right">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-flat" id="btn_enviar_trnf">
                        <i class="fas fa-retweet"></i>&nbsp;
                        Transformar
                    </button>
                </div>
            </div>
        </div>
        <div class="box-body">
            @include('datasource.etl_v2.PartialsTransformer.tabla_lista_transformation')
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"  src="{{  asset('js/app/transformer.js')  }}"></script>
@endsection