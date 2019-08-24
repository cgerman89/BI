@extends('admin.app')
@section('content_dashboard')
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"> <i class="fa fa-plug"></i>  Edit Connections </h3>
        </div>
        <div class="box-body">
            {!! Form::model($connection,['route'=>['Connections.update',$connection->id],'method' => 'PUT']) !!}
                    @include('datasource.connection.Partials.form')
            {!! Form::close() !!}
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
    @include('datasource.connection.Partials.Errors')
    @include('datasource.connection.Partials.Alert')
    <script>
        GetDataTable();

        function  GetDataTable(){
            $('#connections_table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth:false,
                scrollCollapse: true,
                responsive:true,
                ajax: '{!! route('Connections.get_data') !!}',
                columns: [
                    { data: 'collection.name'},
                    { data: 'host'},
                    { data: 'username'},
                    { data: 'dbname' },
                    { data: 'port'},
                    { data: 'OPTIONS', name: 'OPTIONS', orderable: false, searchable: false},
                ],
            });
        }
    </script>
@stop