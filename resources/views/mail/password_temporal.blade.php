<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Password Temporal </title>
</head>
<body>
     <p>Saludos <b>{{ $msg['name'] }}</b>, se envio una contraseña Temporal al correo: <b>{{ $msg['email'] }}</b>
      Su password temporal es : <b>{{ $msg['password'] }}</b>
     </p>
     <p>Creado el: {{ $msg['created_at'] }} </p>
</body>
</html>
