@component("layouts.app")
@slot("module") Search @endslot
@push('custom-css')
@endpush
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        CARIAN
    </h2>
</div>
<div class="intro-y row mt-5">
    <div class="col-3">
        <div class="grid grid-cols-12 gap-3">
            <a href="{{ route('dana-ru.carian.allocation') }}" class="g-col-12 box p-5 cursor-pointer zoom-in" style="background-color: #1C3FAA;">
                <div class="fw-medium fs-base text-white">Allocation</div>
            </a>
        </div>
    </div>
    <div class="col-3">
        <div class="grid grid-cols-12 gap-3">
            <a href="{{ route('dana-ru.carian.expenses') }}" class="g-col-12 box p-5 cursor-pointer zoom-in" style="background-color: #1C3FAA;">
                <div class="fw-medium fs-base text-white">Expenses</div>
            </a>
        </div>
    </div>
</div>
@endslot
@endcomponent