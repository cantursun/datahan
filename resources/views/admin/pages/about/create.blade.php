@extends('admin.layouts.panel')
@section('title')Hakkımızda @endsection
@section('custom_css')
    <style>
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hakkımızda Oluştur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.about.index') }}">Hakkımızda</a></li>
                            <li class="breadcrumb-item active">Oluştur</li>
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
                                <h3 class="card-title">Oluşturuluyor</h3>
                            </div>
                            <form id="aboutForm" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Başlık</label>
                                        <input type="text" class="form-control" name="title"
                                               id="title"
                                               required
                                               placeholder="Başlık">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Açıklama</label>
                                        <textarea name="description" maxlength="2000" id="description"
                                                  cols="30" rows="10"
                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="isPublished">Yayınlanma</label>
                                        <select name="is_published" id="isPublished" class="form-control" required>
                                            <option value="1">Göster</option>
                                            <option value="0">Gizle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {

            $('#description').summernote({
                height: 250,
            })

            $('#aboutForm').on('submit', function (e) {
                e.preventDefault();
                let form = $('form')[0];
                let formData = new FormData(form);
                let icon = 'error', title = 'HATA';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                }),
                $.ajax({
                    method: 'POST',
                    url: '/panel/about/create',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status) {
                            icon = 'success';
                            title = 'BAŞARILI';
                        }

                        Swal.fire({
                            icon: icon,
                            title: title,
                            text: res.message,
                        })
                        form.reset()
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
            });
        });
    </script>

@endsection
