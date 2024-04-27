@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Projek @endslot
@section('custom-css')
@endsection
@slot('content')
<x-title>Projek : [{{ $project->code }}.{{ $project->code_2 }}]</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.maintenance.project.update', $project->id) }}" method="post">
        @csrf
            <input type="hidden" name="year" value="{{ $project->year }}">
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="code">KOD PROJEK</label>
                    </div>
                    <div class="g-col-9">
                        <input id="code" name="code" type="text" value="{{ $project->code }}" class="form-control @error('code') border-theme-6 @enderror" placeholder="Kod" aria-describedby="code">
                        @error('code')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="code_2">KOD SUBPROJEK</label>
                    </div>
                    <div class="g-col-9">
                        <input id="code_2" name="code_2" type="text" value="{{ $project->code_2 }}" class="form-control @error('code_2') border-theme-6 @enderror" placeholder="Kod" aria-describedby="code_2">
                        @error('code_2')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="title">NAMA PROJEK</label>
                    </div>
                    <div class="g-col-9">
                        <input id="title" name="title" type="text" value="{{ $project->title }}" class="form-control @error('title') border-theme-6 @enderror" placeholder="Nama Projek" aria-describedby="title">
                        @error('title')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="status">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="status" name="status" class="form-select @error('status') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            <option value="active" @if($project->status == "active") selected @endif selected>Active</option>
                            <option value="not-active" @if($project->status == "not-active") selected @endif>Not Active</option>
                        </select>
                        @error('status')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.maintenance.project', $project->year) }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" form="form_1" class="btn btn-primary-soft me-3" name="submit_btn" value="1"> Save as Draft</button>
                    <button type="submit" form="form_1" class="btn btn-primary" name="submit_btn" value="0">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endslot
@section('custom-js')
@endsection
@endcomponent