@extends('admin.login')
@section('title_login')
      Registro Usuario
@endsection
@section('login_content')
      <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group has-feedback">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder="nombre"  required autofocus>
                                <span class="fa fa-address-card form-control-feedback"></span>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group has-feedback">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="correo" required>
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group has-feedback">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="contraseña" required>
                                <span  class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group has-feedback">
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                             <span  class="glyphicon glyphicon-lock form-control-feedback"></span>
                       </div>
                       <button type="submit" class="btn btn-primary btn-block">
                           <i class="glyphicon glyphicon-floppy-disk"></i>
                           {{ __('Registrar') }}
                       </button>

      </form>
@endsection
