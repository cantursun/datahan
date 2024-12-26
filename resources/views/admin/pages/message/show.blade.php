@extends('admin.layouts.panel')
@section('title')Mesaj Görüntüle @endsection
@section('custom_css') @endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mesaj Görüntüle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.message.index') }}">Mesaj</a></li>
                            <li class="breadcrumb-item active">Görüntüle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card d-none">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Görüntüleniyor</h3>
                            </div>
                            <form id="messageForm" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">İsim</label>
                                        <input type="text" disabled name="name" value="{{ $message->name ?? '' }}"
                                               placeholder="İsim" required id="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" disabled name="email" value="{{ $message->email ?? '' }}"
                                               placeholder="Email" required id="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Mesaj</label>
                                        <textarea name="message" disabled class="form-control" id="message" cols="30"
                                                  rows="5">{{ $message->message ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="createdAt">Mesaj Tarihi</label>
                                        <input type="text" disabled name="created_at"
                                               value="{{  date(date($message->created_at)) ?? '' }}"
                                               placeholder="Gönderim Tarihi" required id="createdAt"
                                               class="form-control">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">Sil</button>
                                </div>
                            </form>
                        </div>

                        <!-- /.card -->
                    </div>

                    <!-- /.col -->
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom_js')

    <script>
        $(document).ready(function () {

            $('#messageForm').on('submit', function (e) {
                e.preventDefault();

                let icon = 'error', title = 'HATA';

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
                                method: 'POST',
                                url: '{{ route('panel.message.destroy',['message'=>$message]) }}',
                                contentType: false,
                                processData: false,
                                success: function (res) {
                                    if (res.status) {
                                        icon = 'success';
                                        title = 'BAŞARILI';
                                        window.location.href = '{{ route('panel.message.index') }}'
                                    }

                                    Swal.fire({
                                        icon: icon,
                                        title: title,
                                        text: res.message,
                                    })
                                },
                                error: function (res) {
                                    if (res.status == 419)
                                        window.location.reload();//csrf token süresi doldu
                                    else if (res.status == 403)
                                        res.message = 'Erişim yetkiniz bulunmamaktadır!';

                                    Swal.fire({
                                        icon: icon,
                                        title: title,
                                        text: res.message,
                                    })
                                }
                            });
                    } else if (result.isDenied) {
                        Swal.fire('Silme işlemi iptal edildi!', '', 'info')
                    }
                });
            });

        });
    </script>

@endsection
