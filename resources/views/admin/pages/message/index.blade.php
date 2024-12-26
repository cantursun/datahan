@extends('admin.layouts.panel')
@section('title')Mesaj Listesi @endsection
@section('custom_css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mesaj Listesi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.message.index') }}">Mesaj</a></li>
                            <li class="breadcrumb-item active">Liste</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="card-title">Mesajlar</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="d-none">id</th>
                                        <th>İsim</th>
                                        <th>Mail</th>
                                        <th>Mesaj</th>
                                        <th>Tarih/Saat</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom_js')

    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function () {

            let currentDraw = 1;

            $("#example1").DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                /*ajax: {
                    url: "",
                    type: "GET",
                    data: function (data) {
                        data.search = $('input[type="search"]').val();
                    }
                },*/

                ajax: {
                    url: "{{ route('panel.message.dataList') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: function (d) {
                        d.page = d.start / d.length + 1;
                    },
                    dataSrc: function (response) {
                        let data = {
                            draw: currentDraw,
                            recordsTotal: response.total,
                            recordsFiltered: response.total,
                            data: response.data,
                        };

                        currentDraw++;

                        return data.data;
                    },
                },
                pageLength: 10,
                searching: false,
                language: {
                    url:'/admin/plugins/datatable-lang/tr.json'
                },
                columns: [
                    {'data': 'id', visible: false},
                    {'data': 'name', orderable: false},
                    {'data': 'email', orderable: false},
                    {'data': 'message', orderable: false},
                    {'data': 'created_at'},
                    {'data': 'process', orderable: false, searchable: false},
                ],
                order: [[0, 'desc']],
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [''],
                /* columnDefs: [{
                     targets: -1,
                     visible: false
                 }]*/
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('submit', '.deleteForm', function (e) {
                e.preventDefault();
                let id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Silmek istediğinize emin misiniz?',
                    showDenyButton: true,
                    confirmButtonText: 'Sil',
                    denyButtonText: `İptal`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                        }),
                            $.ajax({
                                'type': 'POST',
                                'url': '/panel/message/destroy/' + id,
                                'data': $(this).serialize(),
                                success: function (res) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'BAŞARILI',
                                        text: res.message,
                                    })
                                    $("#example1").DataTable().ajax.reload();
                                },
                                error: function (res) {
                                    if (res.status == 419)
                                        window.location.reload();//csrf token süresi doldu
                                    else if (res.status == 403)
                                        res.message = 'Erişim yetkiniz bulunmamaktadır!';

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'HATA',
                                        text: res.message,
                                    })
                                }
                            });
                    } else if (result.isDenied) {
                        Swal.fire('Silme işlemi iptal edildi!', '', 'info')
                    }
                });
            })
        });
    </script>
@endsection

