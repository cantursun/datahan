@extends('admin.layouts.login')
@section('title')Datahan APP @endsection
@section('custom_css')
    <style>
    </style>
@endsection
@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <h1 class="login-box-msg"><b>DATAHAN APP</b><br></h1>
                <form id="loginForm" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" required name="email" placeholder="E-Posta">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" required minlength="6" name="password" placeholder="Parola">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('status'))
                                <div class="alert alert-danger">
                                    <span>{{ session('status') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-between align-items-center">
                        <div class="form-group col-md-6">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" name="rememberMe" class="form-check-input mt-0" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Beni Hatırla</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <button class="btn btn-primary btn-block"
                                    type="submit">
                                Oturum Aç
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
           $('#loginForm').on('submit',function (e){
               e.preventDefault();

               let icon='error';
               let title='HATA';

               $.ajaxSetup({
                   headers:{
                       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   },
               }),
               $.ajax({
                   type:'POST',
                   url:'/panel-login',
                   data:$('#loginForm').serialize(),
                   success: function (res) {
                       if(res.status){
                           icon='success';
                           title='BAŞARILI';
                           window.location.href=res.url;
                       }
                       Swal.fire({
                           icon: icon,
                           title: title,
                           text: res.message,
                       })
                   },
                   error: function (res) {
                       if(res.status==419)
                           window.location.reload();//csrf token süresi doldu

                       Swal.fire({
                           icon: icon,
                           title: title,
                           text: res.message,
                       })
                   },
               })
           });
        });
    </script>
@endsection
