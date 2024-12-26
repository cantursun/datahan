@extends('admin._base')

@section('css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2.min.css"/>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"/>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"/>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/bs-stepper/css/bs-stepper.min.css"/>
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/cdn/cropper/cropper.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/adminlte.min.css">

    @yield('custom_css')

@endsection

@section('body')
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    @include('admin.sections.header')


    @yield('content')



    @include('admin.sections.footer')

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    @section('js')

        <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bs-stepper/js/bs-stepper.min.js"></script>
        <script src="{{ asset('admin') }}/js/adminlte.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/cropper/cropper.min.js"></script>

        <script src="{{ asset('admin') }}/plugins/chart.js/Chart.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/sparklines/sparkline.js"></script>
        <script src="{{ asset('admin') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="{{ asset('admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/fancybox/jquery.fancybox.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/cdn/font-awesome/js/all.min.js"></script>


        <script src="{{ asset('admin') }}/js/custom.js?v=1"></script>

        @yield('custom_js')
    @endsection

    </body>
@endsection

