@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Status @endslot
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

@endpush
@slot('content')
<x-title>Label Pengesahan</x-title>
<div class="intro-ymt-5 w-full justify-content-center">
    <div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
        <div class="text-gray-800 fw-medium">Borang Cadangan Agihan</div>
    </div>
    <div class="intro-y box p-5">
        <form id="form_1" action="{{ route('dana-ru.maintenance.status.update') }}" method="post">
        @csrf
            <input type="hidden" name="type" value="cadangan_agihan">
            <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                <div class="grid grid-cols-12 w-full">
                    @foreach ($cadangan_agihan as $key => $status)
                    <input type="hidden" name="sort[]" value="{{ $status->sort }}">
                    <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: #a5d6ec;">
                        <div class="fw-bold fs-lg text-gray-700">{{ getStatusBySort('cadangan_agihan', $status->sort) }}</div>
                        <div class="input-group mt-4">
                            <div class="input-group-text bg-theme-1 fs-xs text-white">NAMA</div>
                            <input type="text" name="name[]" class="form-control bg-white" placeholder="Masukkan nama status" value="{{ $status->name }}">
                        </div>
                        @error('name.' . $key, 'cadangan_agihan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="input-group mt-4">
                            <div class="input-group-text bg-theme-1 fs-xs text-white">LABEL</div>
                            <input type="text" name="label[]" class="form-control bg-white" placeholder="Masukkan label status" value="{{ $status->description }}">
                        </div>
                        @error('label.' . $key, 'cadangan_agihan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                    @endforeach
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
        <form id="form_2" action="{{ route('dana-ru.maintenance.status.update') }}" method="post">
        @csrf
            <input type="hidden" name="type" value="laporan_perbelanjaan">
            <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                <div class="grid grid-cols-12 w-full">
                    @foreach ($laporan_perbelanjaan as $key => $status)
                    <input type="hidden" name="sort[]" value="{{ $status->sort }}">
                    <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: #a5d6ec;">
                        <div class="fw-bold fs-lg text-gray-700">{{ getStatusBySort('laporan_perbelanjaan', $status->sort) }}</div>
                        <div class="input-group mt-4">
                            <div class="input-group-text bg-theme-1 fs-xs text-white">NAMA</div>
                            <input type="text" name="name[]" class="form-control bg-white" placeholder="Masukkan nama status" value="{{ $status->name }}">
                        </div>
                        @error('name.' . $key, 'laporan_perbelanjaan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="input-group mt-4">
                            <div class="input-group-text bg-theme-1 fs-xs text-white">LABEL</div>
                            <input type="text" name="label[]" class="form-control bg-white" placeholder="Masukkan label status" value="{{ $status->description }}">
                        </div>
                        @error('label.' . $key, 'laporan_perbelanjaan')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                    @endforeach
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