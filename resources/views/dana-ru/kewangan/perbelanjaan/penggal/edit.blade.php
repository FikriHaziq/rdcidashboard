@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Perincian Perbelanjaan @endslot
@push('custom-css')
@endpush
@slot('content')
<x-title>Maklumat Penggal untuk Agihan Tahun {{ $plan->year }} [{{ $plan->created_at }}]</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.kewangan.perbelanjaan.program.term.update', $term->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="code">Label</label>
                    </div>
                    <div class="g-col-9">
                        <input id="label" name="label" type="text" value="{{ old('label') ?? $term->label }}" class="form-control @error('label') border-theme-6 @enderror" placeholder="Cth: Jan {{ $plan->year }} - Jun {{ $plan->year }}" aria-describedby="label">
                        @error('label')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="term">Penggal</label>
                    </div>
                    <div class="g-col-9">
                        <select id="term" name="term" class="form-select @error('term') border-theme-6 @enderror">
                            @for($i = 1; $i <= 4; $i++)
                                @if (!in_array($i, $usedTerms))
                                    <option value="{{ $i }}" @if(old('term') == $i || $term->term == $i) selected @endif>
                                        {{ $i }}
                                    </option>
                                @endif
                            @endfor
                        </select>
                        @error('term')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="active">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="active" name="active" class="form-select @error('active') border-theme-6 @enderror">
                            <option value="Y" @if(old('active') ?? $term->active == "Y") selected @endif selected>Active</option>
                            <option value="N" @if(old('active') ?? $term->active == "N") selected @endif>Disabled</option>
                        </select>
                        @error('active')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.term.index', $plan->id) }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" form="form_1" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endslot
@push('custom-js')
@endpush
@endcomponent