@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") KPI @endslot
@push('custom-css')
@endpush
@slot('content')
<x-title>KPI</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.maintenance.kpi.update', $kpi->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="title">TITLE</label>
                    </div>
                    <div class="g-col-9">
                        <input id="title" name="title" type="text" value="{{ $kpi->title }}" class="form-control @error('title') border-theme-6 @enderror" placeholder="TITLE" aria-describedby="title">
                        @error('title')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="active">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="active" name="active" class="form-select @error('active') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            <option value="Y" @if($kpi->active == "Y") selected @endif selected>Active</option>
                            <option value="N" @if($kpi->active == "N") selected @endif>Not Active</option>
                        </select>
                        @error('active')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.maintenance.kpi') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" form="form_1" class="btn btn-primary" name="submit_btn" value="0">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endslot
@push('custom-js')
@endpush
@endcomponent