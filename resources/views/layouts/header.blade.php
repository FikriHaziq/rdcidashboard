<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <x-breadcrumb module="{{ $module ?? '' }}" moduleLink="{{ $moduleLink ?? '' }}" submodule="{{ $submodule ?? '' }}" submoduleLink="{{ $submoduleLink ?? '' }}" trimodule="{{ $trimodule ?? '' }}" trimoduleLink="{{ $trimoduleLink ?? '' }}"></x-breadcrumb>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown me-auto me-sm-6">
            Admin MC
        </div>
        <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-pill overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            <img alt="Profile Pic" src="{{ asset('theme/images/profile-5.jpg') }}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-theme-26 dark-bg-dark-6 text-white">
                <li class="p-2">
                    <div class="fw-medium text-white">Admin MC</div>
                    <div class="fs-xs text-theme-28 mt-0.5 dark-text-gray-600">Software Engineer</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="user" class="w-4 h-4 me-2"></i> Profile </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="lock" class="w-4 h-4 me-2"></i> Reset Password </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="help-circle" class="w-4 h-4 me-2"></i> Help </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                </li>
                <li>
                    <a href="{{ route('login') }}" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="toggle-right" class="w-4 h-4 me-2"></i> Logout </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>