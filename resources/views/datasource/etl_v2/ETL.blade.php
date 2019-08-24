@extends('admin.app')
@section('content_dashboard')
   <div class="box box-default box-solid" id="panel_data_source">
       <div class="box-header with-border">
           <h3 class="box-title">Data</h3>
           <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse">
                   <i class="fas fa-minus"></i>
               </button>
           </div>
       </div>
       <div class="box-body">
           @include('datasource.etl_v2.Partials.form_select_schema_and_table')
           <div class="col-sm-12">
               <div id="html_table_preview">
               </div>
               <div id="js_table_preview">
               </div>
           </div>
       </div>
   </div>
   <div class="box box-default box-solid">
       <div class="box-header with-border">
           <h3 class="box-title">Columns</h3>
           <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse">
                   <i class="fas fa-minus"></i>
               </button>
           </div>
       </div>
       <div class="box-body">
           @include('datasource.etl_v2.Partials.dataSource')
       </div>
       <div class="box-footer">
       </div>
   </div>
@endsection
@section('scripts')
    <script type="text/javascript"  src="{{  asset('js/app/etl_2.js')  }}"></script>
@endsection