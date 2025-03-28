@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Tabung Induk @endslot
@push('custom-css')
@endpush
@slot('content')
<x-title>Tabung Induk</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.maintenance.tabung-induk.update', $main_fund->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="program_id">PROGRAM UTAMA</label>
                    </div>
                    <div class="g-col-9">
                        <select id="program_id" name="program_id" class="form-select @error('program_id') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            @foreach (getMrunList() as $program)
                                <option value="{{ $program->id }}" @if($main_fund->program_id == $program->id) selected @endif>{{ $program->code }} - {{ $program->description_1 }}</option>
                            @endforeach
                        </select>
                        @error('program_id')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="code">KOD</label>
                    </div>
                    <div class="g-col-9">
                        <input id="code" name="code" type="text" value="{{ $main_fund->code }}" class="form-control @error('code') border-theme-6 @enderror" placeholder="Kod" aria-describedby="code">
                        @error('code')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="name">DESKRIPSI</label>
                    </div>
                    <div class="g-col-9">
                        <input id="name" name="name" type="text" value="{{ $main_fund->name }}" class="form-control @error('name') border-theme-6 @enderror" placeholder="Deskripsi" aria-describedby="name">
                        @error('name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="status">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="status" name="status" class="form-select @error('status') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            <option value="active" @if($main_fund->status == "active") selected @endif selected>Active</option>
                            <option value="not-active" @if($main_fund->status == "not-active") selected @endif>Not Active</option>
                        </select>
                        @error('status')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.maintenance.tabung-induk') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" form="form_1" class="btn btn-primary-soft me-3" name="submit_btn" value="1"> Save as Draft</button>
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