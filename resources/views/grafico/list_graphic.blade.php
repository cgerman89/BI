@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid" id="panel_list_graficos">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-poll"></i> &nbsp;
                    <h4 class="box-title"> Lista Grafico</h4>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12">
                @include('grafico.Partials.table_list')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{  asset('js/app/grafico_list.js')  }}"></script>
@endsection
