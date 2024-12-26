@extends('admin.layouts.panel')
@section('title')Panel | Datahan @endsection

@section('custom_css') @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Panel</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard') }}">Panel</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Merhaba, hoşgeldiniz!</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    Hakkımızda ve alt sayfaları ile ilgili düzenleme yapmak istediğinizde <a href="{{ route('panel.about.index') }}">Hakkımızda</a> üzerinden işlem yapabilirsiniz.
                                </p>
                                <hr>
                                <p>
                                    Portfolyo ve alt sayfaları ile ilgili düzenleme yapmak istediğinizde <a href="{{ route('panel.portfolio.index') }}">Portfolyo</a> üzerinden işlem yapabilirsiniz.
                                </p>
                                <hr>
                                <p>
                                    Site ayarlarını ve sabit değerleri (telefon, adres vb.) ile ilgili düzenleme yapmak istediğinizde <a href="{{ route('panel.setting.index') }}">Ayarlar</a> üzerinden işlem yapabilirsiniz.
                                </p>
                                <hr>
                                <p>
                                    Site üzerinden gönderilen mesajları incelemek istediğinizde <a href="{{ route('panel.message.index') }}">Mesajlar</a> üzerinden işlem yapabilirsiniz.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('custom_js')


@endsection
