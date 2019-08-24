@extends('admin.app')
@section('content_dashboard')
    <div class="nav-tabs-justified">
            <ul class="nav nav-tabs bg-gray-light">
                <li class="active">
                    <a href="#tab1"  data-toggle="tab" aria-expanded="true">
                        <i class="fa fa-table" aria-hidden="true"></i> &nbsp;
                       Extract Data </a>
                </li>
                <li>
                    <a href="#tab2"  data-toggle="tab" aria-expanded="true">
                        <i class="fa fa-exchange" aria-hidden="true"></i> &nbsp;
                        Transformation Data</a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab" aria-expanded="true">
                        <i class="fa fa-upload" aria-hidden="true"></i> &nbsp;
                        Load Data
                    </a>
                </li>
            </ul>
            <div class="tab-content bg-gray-light">
                <div class="tab-pane active" id="tab1">
                    <div class="panel-heading">
                        <div class="row">
                            @include('datasource.query.Partials.form_schemas_tables')
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @include('datasource.query.Partials.table_rows')
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    @include('datasource.query.Partials.panel_tranformation')
                </div>
                <div class="tab-pane" id="tab3">
                    @include('datasource.query.Partials.panel_load')
                </div>
            </div>
        </div>
    <script>
      $('#sel_columns').select2({placeholder: 'Select Column'});

      $('#schemas').on('change',function () {
          GetTables($('#schemas option:selected').text());
      });

      $('#btn_agregar_trans').click(function (e) {
           e.preventDefault();
           let schema = $('#schemas option:selected').text();
           let table  = $('#tables option:selected').text();
           let operation = $('#sel_operation').val();
           let fields = Array.from($('#sel_columns').val());
           SendTransformer(schema,table,operation,fields,function (resp) {
               console.log(resp.html);
               let colum =GetColumns(resp.keys);
               SetColumns(resp.keys);
               $('#table_result').DataTable({
                   "destroy":true,
                   "autoWidth":true,
                   "scrollCollapse": true,
                   "responsive":true,
                   "data":resp.data,
                   "columns":colum,
               });
           });
      });

      function GetTables(Schemaname) {
          let URL = "{{url('/')}}"+"/Query/"+Schemaname.trim()+"/GetTables";
          $.get(URL,function (response) {
                SetTables(response);
          },'json');
      }
      function SendTransformer(schema,table,operation,columns,callback) {
          let URL = "{{url('/')}}"+"/Query/"+schema.trim()+"/"+table.trim()+"/"+operation.trim()+"/"+columns+"/TransformerData";
          $.get(URL,function (response,status){
              if(status === 'success'){
                 callback(response);
              }
          },'json');
      }
      function SetTables(tables) {
          $('#tables  option').remove();
          $('#tables').append('<option>select tables</option>');
          $.each(tables, function (index, value) {
              $('#tables').append('<option  value="'+value.table_name+'">'+value.table_name+'</option>');
          });
      }
      function SetColumns(columns) {
          $('#table_result thead').remove();
          let col = "<tr>";
          columns.forEach( function(valor, indice, array) {
              col += "<th>"+valor+"</th>";
          });
          col += "</tr>";
          console.log(col);
          $('#table_result').append("<thead>"+col+"</thead>");
      }
      function GetColumns(columns){
          let coll = [];
          columns.forEach( function(valor, indice, array) {
                 coll.push({"data":valor});
          });
          console.log(coll);
          return coll;
      }
  </script>
@endsection
