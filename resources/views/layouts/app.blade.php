<!doctype html>
<html lang="en" class="light">
    <head>
        <meta charset="utf-8">
        <link href="theme/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RDCI Dashboard with Rubick admin.">
        <meta name="keywords" content="RDCI Dashboard">
        <meta name="author" content="LEFT4CODE & UJILARI">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $module ?? 'RDCI Dashboard' }} | {{ $submodule ?? '' }}</title>
        <!-- BEGIN: CSS Assets-->
        <link href="{{ asset('theme/css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet" />
        
        @include('layouts.css')
        @stack('custom-css')
        <!-- END: CSS Assets-->
    </head>
    <body class="main">
        <div class="wrapper">

        @include('layouts.mobile-menu')

        <div class="d-flex">
            @include('layouts.menu')
            <div class="content">
                @include('layouts.header')
                {{ $content }}
            </div>
        </div>
        @include('alert')
    </body>
    @include('layouts.js')
    @stack('custom-js')
</html>