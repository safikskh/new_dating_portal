<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dating Portalen') }}</title>
    <!-- Fonts -->
    @include('backend.partial.adminCss')
    @yield('style')
</head>
<body id="page-top">
    {{-- Navbar --}}
    @include('backend.partial.navbar')
    <div id="wrapper">
       {{-- Sidebar  --}}
      @include('backend.partial.sidebar')
      <div id="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        {{-- .container-fluid --}}
        {{-- @include('backend.partial.footer') --}}
      </div>
      {{-- .content-wrapper --}}
    </div>
    {{-- #wrapper --}}

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    @include('backend.partial.adminJs')
    @yield('script')
  </body>
</html>
