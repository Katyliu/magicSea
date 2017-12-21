<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('resources/views/admin/style/js/jquery.js')}}"  type="text/javascript"></script>
    <script src="{{asset('resources/views/admin/style/js/ch-ui.admin.js')}}"  type="text/javascript"></script>
</head>
    @yield('content')
</html>