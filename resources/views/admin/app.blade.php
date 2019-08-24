<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name', 'Laravel') }}
        @yield('title_page')
    </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button-data-table/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.4.3/dist/css/AdminLTE.css')  }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.4.3/dist/css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.4.3/bower_components/morris.js/morris.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue top-nav">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href=" {{ url('/home') }} " class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{ config('app.name', 'Laravel') }}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b> {{ config('app.name', 'Laravel') }} </b> </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li>
                        <p class="navbar-btn">
                            <a href="{{ route('Connections.index') }}" class="btn btn-info" title="conectar a fuente de datos">&nbsp;Conectar &nbsp;<i class="fas fa-plug"></i></a>
                        </p>
                    </li>
                    <li>
                        <a><i class="fa fa-server" aria-hidden="true"></i>&nbsp; <b>DBMS:</b>   {{ isset($info)? $info['dbms'] : ''  }}  </a>
                    </li>
                    <li>
                        <a><i class="fa fa-database" aria-hidden="true"></i>&nbsp; <b>DATABASE NAME:</b> {{ isset($info)? $info['dbname']: ''  }} </a>
                    </li>
                     @yield('bar_menu')

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            @yield('imagen_user_navar')
                               <i class="glyphicon glyphicon-user"></i>

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                @yield('user_name_navbar')
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src=" {{ asset('img/user2-160x160.jpg') }} " class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->email  }}
                                    <small> Member {{ Auth::user()->created_at->format('d/M/Y')  }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                   <div class="text-center">
                                       @if( !auth()->user()->roles->isEmpty() )
                                           @foreach( auth()->user()->roles as $role )
                                               <i class="fas fa-user-shield"></i> &nbsp; <b>{{ $role->name }}</b>
                                           @endforeach
                                       @else
                                           <i class="fas fa-user-lock"></i> &nbsp; <b>Sin permisos</b>
                                       @endif
                                   </div>
                                </div>
                                <!-- /.row -->
                            </li>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat btn-block"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Session</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <!-- enlace a menu de configuraciones -->
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- /.search form -->
             @yield('list_menu')
                 <ul class="sidebar-menu" data-widget="tree">
                      <li class="treeview">
                         <a href="#">
                             <i class="fas fa-tachometer-alt"></i>                             &nbsp;
                             <span>Dashboard</span>
                             <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                         </a>
                         <ul class="treeview-menu">
                             <li>
                                 <a href=" {{ route('dashboard.list.index') }} "><i class="fas fa-list-ul"></i> &nbsp;List Dashboard</a>
                             </li>
                         </ul>
                     </li>
                      <li class="treeview">
                         <a href="#">
                                <i class="fas fa-server"></i>
                                 &nbsp;
                                <span>Connections</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                         </a>
                         <ul class="treeview-menu">
                                 <li>
                                     <a href=" {{ route('Connections.index') }} "><i class="fas fa-plug"></i>&nbsp; Connections DBMS</a>
                                 </li>
                         </ul>
                     </li>
                      <li class="treeview">
                         <a href="#">
                             <i class="fas fa-dice-d6"></i>
                             &nbsp;
                             <span>ETL Process</span>
                             <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                             </span>
                         </a>
                         <ul class="treeview-menu">
                             <li class="treeview">
                                 <a href="#"><i class="fas fa-th-list"></i>&nbsp;
                                     <span>ETL Extract Data</span>
                                     <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="{{ route('Etl.index') }}"><i class="fas fa-database"></i>&nbsp; DataBase</a></li>
                                     <li><a href="{{ route('etl.file.index') }}"><i class="fas fa-file-archive"></i>&nbsp; File</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#"></a>
                             </li>
                             <li>
                                 <a href="{{ route('trnf.index') }}"><i class="fab fa-buromobelexperte"></i>&nbsp; ETL Transformation</a>
                             </li>
                             <li>
                                 <a href="{{ route('load.index') }} "><i class="fas fa-hdd"></i>&nbsp; ETL Load</a>
                             </li>
                             <li>
                                 <a href="{{ route('etl.collection.index') }}"><i class="far fa-folder-open"></i>&nbsp; ETL Collection</a>
                             </li>
                         </ul>
                     </li>
                      <li class="treeview">
                         <a href="#">
                             <i class="fas fa-poll"></i>                             &nbsp;
                             <span>Graphic</span>
                             <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                         </a>
                         <ul class="treeview-menu">
                             <li>
                                 <a href=" {{ route('graphic.index') }} "><i class="fas fa-plus"></i> &nbsp;Crear</a>
                             </li>
                             <li>
                                 <a href="{{ route('graphic.getList.index') }}"><i class="fas fa-folder-open"></i>&nbsp;Listar</a>
                             </li>
                         </ul>
                     </li>
                     <li class="treeview">
                             <a href="#">
                                 <i class="fas fa-briefcase"></i>                           &nbsp;
                                 <span>Workspace</span>
                                 <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                             </a>
                             <ul class="treeview-menu">
                                 <li>
                                     <a href="{{ route('dashboard.index') }}"><i class="fas fa-folder-open"></i> &nbsp; Dashboard</a>
                                 </li>
                             </ul>
                         </li>

                      <li class="treeview">
                         <a href="#">
                             <i class="fas fa-wrench"></i>                          &nbsp;
                             <span>Administration</span>
                             <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                             </span>
                         </a>
                         <ul class="treeview-menu">
                             <li>
                                 <a href="{{ route('users.index') }}"><i class="fas fa-users"></i>&nbsp;Usuarios </a>
                             </li>
                             <li>
                                 <a href="{{ route('permissions.users.index') }}"><i class="fas fa-user-shield"></i>&nbsp;Roles-Usuarios</a>
                             </li>
                             <li>
                                 <a href="{{ route('roles.index') }}"><i class="fas fa-fingerprint"></i>&nbsp; Roles</a>
                             </li>
                             <li>
                                 <a href="{{ route('permission.index') }}"><i class="fas fa-shield-alt"></i>&nbsp; Permisos</a>
                             </li>
                             <li>
                                 <a href="{{ route('profile.index') }}"><i class="fas fa-address-card"></i>&nbsp; Perfil </a>
                             </li>
                         </ul>
                     </li>
                  </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" id="content_header">
            @yield('title_header')

        </section>
        <!-- Main content -->
        <section class="content container-fluid" id="content_main">
            @yield('content_dashboard')
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            @yield('info_footer')

        </div>
        <!-- Default to the left -->
         @yield('creditos_footer')
            <strong>Copyright &copy; 2019 <a href="http://www.andeantrade.com/">Andean Trade </a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- REQUIRED JS SCRIPTS -->
<script type="text/javascript"  src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script type="text/javascript"  src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script type="text/javascript"  src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript"  src="{{ asset('AdminLTE-2.4.3/dist/js/adminlte.js')}}"></script>
<script type="text/javascript"  src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript"  src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/button-data-tables/buttons.html5.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/button-data-tables/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/button-data-tables/jszip.min.js') }}"></script>
<script src="{{ asset('js/app/home.js') }}"></script>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')
@yield('scripts')

</body>
</html>