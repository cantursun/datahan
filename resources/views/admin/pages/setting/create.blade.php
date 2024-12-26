@extends('admin.layouts.panel')
@section('title')Ayar Oluştur @endsection
@section('custom_css') @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ayar Oluştur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.setting.index') }}">Ayar</a></li>
                            <li class="breadcrumb-item active">Oluştur</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card d-none">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Oluşturuluyor</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="settingForm" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Tipi
                                            <span>(Ayar değerinin alacağı değere göre belirtiniz)</span></label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="string">Metin</option>
                                            <option value="phone">Telefon</option>
                                            <option value="numeric">Tam Sayı</option>
                                            <option value="float">Ondalıklı Sayı</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Başlık <span>(Ayar başlığının açıklamasını 255 karatere kadar açıklayabilirsiniz)</span></label>
                                        <textarea class="form-control" name="title" id="title" cols="30" rows="2"
                                                  maxlength="255" placeholder="Başlık"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="key">Ayar Anahtarı</label>
                                        <input type="text" name="key" maxlength="255" id="key" required
                                               class="form-control" placeholder="Ayar Anahtarı">
                                    </div>
                                    <div class="form-group valueBox">
                                        <label for="value">Ayar Değeri</label>

                                        <input type="number" disabled min="0" step="1" name="value" id="value"
                                               class="form-control numericInput d-none">

                                        <input type="number" disabled min="0" step="0.1" name="value" id="value"
                                               class="form-control floatInput d-none">

                                        <input type="text" name="value" maxlength="255" id="value"
                                               class="form-control stringInput">

                                        <input type="text" disabled class="form-control phoneInput d-none" name="value" id="value"
                                               data-inputmask='"mask": "0(999) 999-9999"' data-mask>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
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

            $('[data-mask]').inputmask()

            $(document).on('change', '#type', function () {
                let seletedClass = this.value + 'Input';
                $('.valueBox input').removeAttr('disabled');
                $('.valueBox input').attr('disabled', 'true');
                $('.valueBox input.' + seletedClass).removeAttr('disabled');

                $('.valueBox input').removeClass('d-none');
                $('.valueBox input').addClass('d-none');
                $('.valueBox input.' + seletedClass).removeClass('d-none');
            })

            $(document).on('submit', '#settingForm', function (e) {
                e.preventDefault();
                var form = $('form')[0];
                var formData = new FormData(form);

                let icon = 'error', title = 'HATA';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                }),
                    $.ajax({
                        method: 'POST',
                        url: '/panel/setting/create',
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
                            form.reset();
                        },
                        error: function (res) {
                            if (res.responseJSON.message == 'The key has already been taken.') {
                                res.message = 'Ayar anahtarı benzersiz olmalı!'
                            }

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
