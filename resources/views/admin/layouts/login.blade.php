@extends('admin._base')

@section('css')

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/font-awesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/css/adminlte.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/css/custom.css">

    @yield('custom_css')
@endsection

@section('body')
    <body class="hold-transition login-page">


    @yield('content')



    @section('js')
        <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('admin') }}/js/adminlte.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/font-awesome/js/all.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/sweetalert2/sweetalert2.all.min.js"></script>

        @yield('custom_js')
    @endsection

    </body>
@endsection

