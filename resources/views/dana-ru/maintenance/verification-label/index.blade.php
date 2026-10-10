@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Status @endslot
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

@endpush
@slot('content')
<x-title>Status</x-title>
<div class="intro-ymt-5 w-full justify-content-center">
    <div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
        <div class="text-gray-800 fw-medium">Borang Cadangan Agihan</div>
    </div>
    <div class="intro-y box p-5">
        <form id="form_1" action="{{ route('dana-ru.maintenance.verification-label.update') }}" method="post">
        @csrf
            <input type="hidden" name="type" value="cadangan_agihan">
            <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                <div class="grid grid-cols-12 gap-3 w-full">
                    <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #a5d6ec;">
                        <div class="fw-bold fs-lg text-gray-700">Level 1</div>
                        <input type="text" name="level1" class="form-control bg-white mt-4" placeholder="Masukkan label level 1" value="{{ $cadangan_agihan->level1 }}">
                        @error('level1', 'cadangan_agihan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div class="g-col-2 d-flex justify-content-center align-items-center">
                        <i class="w-full h-16" data-feather="arrow-right"></i>
                    </div>
                    <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #94bfd3">
                        <div class="fw-bold fs-lg text-gray-700">Level 2</div>
                        <input type="text" name="level2" class="form-control bg-white mt-4" placeholder="Masukkan label level 2" value="{{ $cadangan_agihan->level2 }}">
                        @error('level2', 'cadangan_agihan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-end">
                <button type="submit" form="form_1" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
        <div class="text-gray-800 fw-medium">Laporan Perbelanjaan</div>
    </div>
    <div class="intro-y box p-5">
        <form id="form_2" action="{{ route('dana-ru.maintenance.verification-label.update') }}" method="post">
        @csrf
            <input type="hidden" name="type" value="laporan_perbelanjaan">
            <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                <div class="grid grid-cols-12 gap-3 w-full">
                    <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #a5d6ec;">
                        <div class="fw-bold fs-lg text-gray-700">Level 1</div>
                        <input type="text" name="level1" class="form-control bg-white mt-4" placeholder="Masukkan label level 1" value="{{ $laporan_perbelanjaan->level1 }}">
                        @error('level1', 'laporan_perbelanjaan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-end">
                <button type="submit" form="form_2" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<x-dru.set-kpi />
@endslot
@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>

</script>
@endpush
@endcomponent