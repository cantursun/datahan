<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    
    @vite(['resources/css/admin/app.scss', 'resources/js/admin/app.js'])

    <title>@yield('title')</title>
    @yield('css')
</head>

@yield('body')

@yield('js')
<div id="overlay">
    <div class="cv-spinner d-flex justify-content-center align-items-center flex-column">
        <span class="spinner"></span>
        <span class="percentage" style="font-size: 30px; color:#fff; margin-top: 15px;"></span>
    </div>
</div>
<script>
    $(document).on({
        ajaxStart: function(){
            $("#overlay").show();
            $("#overlay").fadeIn(300);
        },
        ajaxStop: function(){
            $("#overlay").hide();
            $("#overlay").fadeOut(300);
        }
    });
</script>
</html>
