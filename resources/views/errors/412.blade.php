@extends('errors.default')
@section('title_error')
    412
@endsection
@section('message_error')
    Nesecita conectarse a una fuente de datos...
    <small><a href="{{ route('Connections.index') }}" class="btn-link">Conectar</a></small>
@endsection
