@extends('admin.layouts.panel')
@section('title')Portfolyo @endsection
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
                        <h1>{{ $portfolio->title.' Güncelle' ?? 'Güncelle' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.portfolio.index') }}">Portfolyo</a></li>
                            <li class="breadcrumb-item active">Güncelle</li>
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
                            <form id="portfolioForm" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Başlık</label>
                                        <input type="text" class="form-control" name="title"
                                               id="title"
                                               value="{{ $portfolio->title ?? '' }}"
                                               required
                                               placeholder="Başlık">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Açıklama</label>
                                        <textarea name="description" maxlength="2000" id="description"
                                                  cols="30" rows="10"
                                                  class="form-control">{{ $portfolio->description ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="isPublished">Yayınlanma</label>
                                        <select name="is_published" id="isPublished" class="form-control" required>
                                            <option value="1" {{ $portfolio->is_published ? "selected" : "" }}>Göster</option>
                                            <option value="0" {{ !$portfolio->is_published ? "selected" : "" }}>Gizle</option>
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



            $('#portfolioForm').on('submit', function (e) {
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
                        url: '/panel/portfolio/edit/' + {{ $portfolio->id ?? '' }},
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
