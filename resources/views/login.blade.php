<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="theme/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RDCI Dashboard with Rubick admin.">
        <meta name="keywords" content="RDCI Dashboard">
        <meta name="author" content="LEFT4CODE & UJILARI">
        <title>RDCI Dashboard</title>
        <!-- BEGIN: CSS Assets-->
        <link href="{{ asset('theme/css/app.css') }}" rel="stylesheet" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="bg-white">
        <div class="container px-sm-10">
            <div class="grid columns-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column min-vh-screen">
                    <div class="my-auto">
                        <img class="-intro-x w-full mt-n16" src="{{ asset('images/insight-login.png') }}">
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                    <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-96 w-xl-auto">
                        <form action="{{ route('login.post') }}" method="post">
                            @csrf
                            <h2 class="intro-x fw-bold fs-2xl fs-xl-3xl text-center text-xl-start">
                                Sign In
                            </h2>
                            <div class="intro-x mt-2 text-gray-500 d-xl-none text-center">A few more clicks to sign in to your account.<br> Welcome to UTM Insight@MyRA.</div>
                            <div class="intro-x mt-2 text-gray-500 text-center text-xl-start"><small>(Use the same ID as used for my.utm.my)</small></div>
                            <div class="intro-x mt-8 mt-xl-2">
                                <input type="text" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block" placeholder="Email">
                                <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" placeholder="Password">
                            </div>
                            <div class="intro-x d-flex text-gray-700 dark-text-gray-600 fs-xs fs-sm-sm mt-4">
                                <div class="d-flex align-items-center me-auto">
                                    <input id="remember-me" type="checkbox" class="form-check-input border me-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                                <a href="">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Forgot Password?</a> 
                            </div>
                            <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full w-xl-32 me-xl-3 align-top">Login</button>
                                {{-- <button class="btn btn-outline-secondary py-3 px-4 w-full w-xl-32 mt-3 mt-xl-0 align-top">Sign up</button> --}}
                            </div>
                            <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                                <small><b><span style="color:#ff0000;">*</span>Recommended to use Mozilla Firefox* 16.x or higher, Chrome 23 or higher</b></small>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('theme/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
    @include('alert')
</html>