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
    <body class="login">
        <div class="container px-sm-10">
            <div class="grid columns-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column min-vh-screen">
                    <div class="my-auto">
                        <img class="-intro-x w-full mt-n16" src="{{ asset('images/insight-login.png') }}">
                    </div>
                </div>
                
                <!-- END: Login Info -->
                <!-- BEGIN: Request Form -->
                @if($staff->staff_id ?? false)
                <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">
                    <div class="intro-x fs-8xl fw-medium"><i data-feather="thumbs-up" class="w-20 h-20" style="color: lime"></i></div>
                    <div class="intro-x fs-xl fs-lg-3xl fw-medium mt-5">Your Access Request has been sent. </div>
                    <div class="intro-x fs-lg mt-3">You can only login to system after the administrator approve your account.</div>
                    <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                        <a href="{{ route('login') }}" class="btn btn-primary py-3 px-4 w-full w-xl-32 me-xl-3 align-top">Back to Login Page</a>
                    </div>
                </div>
                @elseif($staff->employeeNumber ?? false)
                <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                    <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">
                        <form action="{{ route('request-access.post') }}" method="post">
                            @csrf
                            <h2 class="intro-x fw-bold fs-2xl fs-xl-3xl text-center text-xl-start">
                                Request Access
                            </h2>
                            <div class="intro-x mt-8">
                                <div class="mt-3"> 
                                    <label for="regular-form-5" class="form-label">Name</label>
                                    <input type="text" name="name" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block" disabled value="{{ $staff->fullname }}" placeholder="Name">
                                 </div>
                                <div class="mt-3">
                                    <label for="regular-form-5" class="form-label">Email</label>
                                    <input type="text" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block" disabled value="{{ $staff->email }}" placeholder="Email">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-5" class="form-label">Faculty</label>
                                    <select name="faculty_code" class="intro-x login__input form-control py-3 px-4 d-block border-gray-300" @error('faculty_code') style="border-color: red!important" @enderror aria-label="Default select example">
                                        <option value="">--Choose faculty--</option>
                                        @foreach (getFacultyByYear((int)date('Y')) ?? [] as $faculty_data)
                                        <option value="{{ $faculty_data->code }}">{{ $faculty_data->short_overall }} - {{ $faculty_data->long }}</option>
                                        @endforeach
                                    </select>
                                    @error('faculty_code')<div class="mt-2" style="color: red">This field is required</div>@enderror
                                </div>
                            </div>
                            <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full me-xl-3 align-top">Request Access</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
                @endif
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('theme/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
    @include('alert')
</html>