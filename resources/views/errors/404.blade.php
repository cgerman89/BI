@extends('admin.login')
@section('title_login')
    <i class="far fa-grin-beam-sweat fa-4x"></i>
    <h3 class="text-capitalize">404  oops page no found </h3>
@endsection
@section('login_content')
    <div class="text-center">
        @guest
            <a href="{{ route('session') }}" class="btn btn-primary">
                <i class="fas fa-undo"></i>&nbsp; Ir
            </a>
        @endguest
        @auth
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-undo"></i>&nbsp; Ir
            </a>
        @endauth
    </div>

@endsection
