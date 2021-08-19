<!doctype html>
<html lang="en">
    <head>
        <title>Dashboard - Grant > {{ $title ?? '' }}</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        @include('dashboard.layouts.css')
        @yield('custom-css')
    </head>
    <body>
        <div class="wrapper">

        @include('dashboard.layouts.menu')

        <div class="main-panel">
            @include('dashboard.layouts.header')

            <div class="content">
            {{ $content }}      
            </div>
            @include('dashboard.layouts.footer')
        </div>
        </div>
    </body>
    @include('dashboard.layouts.js')
    @yield('custom-js')
</html>