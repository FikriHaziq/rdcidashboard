@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submoduleLink") myra.index @endslot
@slot("submodule") eMyRA Overview @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        eMyRA Overview
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <div class="w-full w-md-auto d-flex">
        <div class="input-group ms-2 ms-sm-2 me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                {{-- @foreach ($data->faculties ?? [] as $faculty)
                <option value="{{ $faculty->faculty }}">{{ $faculty->faculty }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
            <select class="form-select bg-white">
                <option value="">2016</option>
                {{-- @foreach ($data->schools ?? [] as $school)
                <option value="{{ $school->school }}">{{ $school->school }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
            <select class="form-select bg-white">
                <option value="">2021</option>
                {{-- @foreach ($data->schools ?? [] as $school)
                <option value="{{ $school->school }}">{{ $school->school }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
</div>
<div class="intro-y box py-10 sm:py-20 mt-5">
    {{-- @include('myra.self-assessment.tabs', compact('year')) --}}
    <div class="d-flex justify-content-center">
        <a href="{{ route('myra.self-assessment.section-a', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-a')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">A</a>
        <a href="{{ route('myra.self-assessment.section-b', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-b')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">B</a>
        <a href="{{ route('myra.self-assessment.section-c', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-c')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">C</a>
        <a href="{{ route('myra.self-assessment.section-d', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-d')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">D</a>
        <a href="{{ route('myra.self-assessment.section-e', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-e')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">E</a>
        <a href="{{ route('myra.self-assessment.section-f', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-f')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">F</a>
        <a href="{{ route('myra.self-assessment.section-g', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-g')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">G</a>
        <a href="{{ route('myra.self-assessment.section-h', 2022) }}" class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.section-h')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">H</a>
        <a href="{{ route('myra.self-assessment.summary', 2022) }}"   class="intro-y w-10 h-10 rounded-circle btn @if(is_active('myra.self-assessment.summary'))   btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2"><i data-feather="file"></i></a>
    </div>
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg text-uppercase">SECTION A: GENERAL INFORMATION</div>
    </div>
</div>
{{-- <div class="intro-y box g-col-12 g-col-xxl-6 my-4">
    <div class="d-flex align-items-center px-5 py-5 py-sm-0 border-bottom border-gray-200 dark-border-dark-5">
        <ul class="nav nav-link-tabs ms-auto d-none d-sm-flex" role="tablist">
            <li class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-5 px-0 ms-6 active" data-bs-toggle="pill" data-bs-target="#criteria" role="tab" aria-controls="criteria-tab" aria-selected="true">Criteria</a> </li>
        </ul>
    </div>
</div> --}}
@endslot
@section('custom-js')
@endsection
@endcomponent