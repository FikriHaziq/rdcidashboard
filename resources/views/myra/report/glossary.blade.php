@component("layouts.app")
@slot('module') Masterlist @endslot
@slot("submodule") Glossary @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        Download Glossary
    </h2>
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">YEAR</div>
            <select class="form-select me-sm-2" onchange="getList($(this))">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
<div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
    {{-- <button id="" class="btn btn-sm btn-primary me-5">Download All</button> --}}
    <div class="text-gray-800 fw-medium">Glossary</div>
</div>
<div class="pos intro-y grid columns-12 gap-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y g-col-12 g-col-lg-12 mb-5">
        <div class="grid grid-cols-12 gap-5">
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                <a class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center" href="{{ route('myra.glossary', [ 'item' => 'MyRAI']) }}" target="_blank"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">Myra I (Pindaan 2018)</div>
                    </div>

                    <div class="ms-3 me-2 text-theme-6"><button class="btn btn-primary"> <i data-feather="download" class="w-5 h-5"></i> </button></div>
                </a>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                <a class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center" href="{{ route('myra.glossary', [ 'item' => 'MyRAII']) }}" target="_blank"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">Myra II (Pindaan 2018)</div>
                    </div>

                    <div class="ms-3 me-2 text-theme-6"><button class="btn btn-primary"> <i data-feather="download" class="w-5 h-5"></i> </button></div>
                </a>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                <a class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center" href="{{ route('myra.glossary', [ 'item' => 'EM']) }}" target="_blank"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">Evidence Material</div>
                    </div>

                    <div class="ms-3 me-2 text-theme-6"><button class="btn btn-primary"> <i data-feather="download" class="w-5 h-5"></i> </button></div>
                </a>
            </div>
        </div>
    </div>
</div>
@endslot
@endcomponent