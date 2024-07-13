@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Faculty @endslot
@section('custom-css')
@endsection
@slot('content')
<x-title>Faculty</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.maintenance.faculty.update', $faculty->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="code">CODE</label>
                    </div>
                    <div class="g-col-9">
                        <input id="code" name="code" type="text" value="{{ $faculty->code }}" class="form-control @error('code') border-theme-6 @enderror" placeholder="Code" aria-describedby="code">
                        @error('code')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="original_code">ORIGINAL CODE</label>
                    </div>
                    <div class="g-col-9">
                        <input id="original_code" name="original_code" type="text" value="{{ $faculty->original_code }}" class="form-control @error('original_code') border-theme-6 @enderror" placeholder="Original Code" aria-describedby="original_code">
                        @error('original_code')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="parameter_name">NAME (SHORT)</label>
                    </div>
                    <div class="g-col-9">
                        <input id="parameter_name" name="parameter_name" type="text" value="{{ $faculty->parameter_name }}" class="form-control @error('parameter_name') border-theme-6 @enderror" placeholder="Name (short)" aria-describedby="parameter_name">
                        @error('parameter_name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="description_1">NAME (LONG)</label>
                    </div>
                    <div class="g-col-9">
                        <input id="description_1" name="description_1" type="text" value="{{ $faculty->description_1 }}" class="form-control @error('description_1') border-theme-6 @enderror" placeholder="Name (long)" aria-describedby="description_1">
                        @error('description_1')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="parent_id">PARENT FACULTY (If Required)</label>
                    </div>
                    <div class="g-col-9">
                        <select id="parent_id" name="parent_id" class="form-select @error('parent_id') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            @foreach (getFaculty2() as $p_faculty)
                                <option value="{{ $p_faculty->id }}" @if($faculty->parent_id == $p_faculty->id) selected @endif>[{{ $p_faculty->code }}] {{ $p_faculty->description_1 }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="active">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="active" name="active" class="form-select @error('active') border-theme-6 @enderror">
                            <option value="Y" @if($faculty->active == "Y") selected @endif selected>Active</option>
                            <option value="N" @if($faculty->active == "N") selected @endif>Not Active</option>
                        </select>
                        @error('active')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.maintenance.faculty') }}" class="btn btn-light me-3">Cancel</a>
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