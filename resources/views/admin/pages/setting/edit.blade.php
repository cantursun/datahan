@extends('admin.layouts.panel')
@section('title')Ayar Güncelle @endsection
@section('custom_css') @endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ayar Güncelle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.setting.index') }}">Ayar</a></li>
                            <li class="breadcrumb-item active">Güncelle</li>
                        </ol>
                    </div>
                </div>
            </div>
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
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Güncelleniyor</h3>
                            </div>
                            <form id="settingForm" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Tipi
                                            <span>(Ayar değerinin alacağı değere göre belirtiniz)</span></label>
                                        <select name="type" id="type" class="form-control">
                                            <option {{ $setting->type=='numeric'? 'selected' : '' }} value="numeric">Tam
                                                Sayı
                                            </option>
                                            <option {{ $setting->type=='float'? 'selected' : '' }} value="float">
                                                Ondalıklı Sayı
                                            </option>
                                            <option {{ $setting->type=='string'? 'selected' : '' }} value="string">
                                                Metin
                                            </option>
                                            <option {{ $setting->type=='phone'? 'selected' : '' }} value="phone">
                                                Telefon
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Açıklama <span>(Ayar başlığının açıklamasını 255 karatere kadar açıklayabilirsiniz)</span></label>
                                        <textarea class="form-control" name="title" id="title" cols="30" rows="2"
                                                  maxlength="255"
                                                  placeholder="Açıklama">{{ $setting->title }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="key">Ayar Anahtarı</label>
                                        <input type="text" name="key" maxlength="255" id="key" class="form-control"
                                               disabled
                                               value="{{ $setting->key }}">
                                    </div>
                                    <div class="form-group valueBox">
                                        <label for="value">Ayar Değeri</label>

                                        <input type="number" {{ $setting->type!='numeric' ? 'disabled':'' }} min="0"
                                               step="1" name="value" id="value"
                                               class="form-control numericInput {{ $setting->type!='numeric' ? 'd-none':'' }}"
                                               value="{{ $setting->value }}">

                                        <input type="number" {{ $setting->type!='float' ? 'disabled':'' }} min="0"
                                               step="0.01" name="value" id="value"
                                               class="form-control floatInput {{ $setting->type!='float' ? 'd-none':'' }}"
                                               value="{{ $setting->value }}">

                                        <input type="text"
                                               {{ $setting->type!='string' ? 'disabled':'' }} name="value"
                                               maxlength="255" id="value"
                                               class="form-control stringInput {{ $setting->type!='string' ? 'd-none':'' }}"
                                               value="{{ $setting->value }}">

                                        <input type="text" {{ $setting->type!='phone' ? 'disabled':'' }} class="form-control phoneInput {{ $setting->type!='phone' ? 'd-none':'' }}"
                                               name="value" maxlength="255" id="value"
                                               data-inputmask='"mask": "0(999) 999-9999"' data-mask value="{{ $setting->value }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
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
                        url: '{{ route('panel.setting.update',['setting'=>$setting]) }}',
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
