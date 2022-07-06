@component("layouts.app")
@slot('module') Master List @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Master List
    </h2>
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">YEAR</div>
            <select class="form-select me-sm-2" aria-label="Default select example">
                @for ($i = date('Y') - 5; $i <= date('Y'); $i++)
                <option>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
<div class="pos intro-y grid columns-12 gap-5 mt-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y g-col-12 g-col-lg-12">
        <div class="grid grid-cols-12 gap-5 mt-5">
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="intro-y d-flex flex-column flex-sm-row align-items-center">
                    <div class="me-auto">
                        <div class="fs-lg fw-medium">Under Graduate Student</div>
                        <div class="text-gray-600">5 Items</div>
                    </div>
                    <div class="text-gray-600">5 Items</div>
                </div>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                {{-- <div class="fw-medium fs-base text-black">Under Graduate Student</div>
                <div class="text-theme-22 dark-text-gray-400">8 Items</div> --}}
                <button class="btn btn-primary intro-y d-flex flex-column flex-sm-row align-items-center"> 
                    {{-- <i data-feather="activity" class="w-4 h-4 me-2"></i>
                     Activity  --}}
                     <div class="me-auto">
                        <div class="fs-lg fw-medium">Under Graduate Student</div>
                        <div class="text-gray-600">5 Items</div>
                    </div>
                    <div class="text-gray-600">5 Items</div>
                </button>

            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="fw-medium fs-base">Pasta</div>
                <div class="text-gray-600">4 Items</div>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="fw-medium fs-base">Waffle</div>
                <div class="text-gray-600">3 Items</div>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="fw-medium fs-base">Snacks</div>
                <div class="text-gray-600">8 Items</div>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="fw-medium fs-base">Deserts</div>
                <div class="text-gray-600">8 Items</div>
            </div>
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-5 cursor-pointer zoom-in">
                <div class="fw-medium fs-base">Beverage</div>
                <div class="text-gray-600">9 Items</div>
            </div>
        </div>
        
    </div>
</div>
@endslot
@section('custom-js')
<script>
</script>
@endsection
@endcomponent