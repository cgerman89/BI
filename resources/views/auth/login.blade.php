@extends('admin.login')
@section('title_login')
    Inicias Session
@endsection
@section('login_content')
      <form method="POST" action="{{ route('login') }}">
          @csrf
         <div class="form-group has-feedback">
               <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="usuario"  required autofocus>
               <span class="fa fa-user-circle form-control-feedback"></span>
         </div>
         <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password" name="password" required>
                <span class="fa fa-lock form-control-feedback"></span>
         </div>
         <div>
            <button type="submit" class="btn btn-primary btn-block">
                 <i class="fas fa-sign-in-alt"></i>
                 {{ __('Iniciar Session') }}
            </button>
          </div>
      </form>
@endsection
@section('section_js')
    @include('auth.Partials.Errors')
@endsection
