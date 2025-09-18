@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@push('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

@endpush
@slot('content')
<x-title>Template Surat Pengesahan Agihan {{ $year }}</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-11">
        <form action="{{ route('dana-ru.kewangan.mail-template.post') }}" method="post" id="form_1">
            @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-12">
                        <input type="hidden" name="year" value="{{ $year }}">
                        <input class="filepond" name="file_upload" id="file_upload" type="file" />
                        @error('file_upload')<div class="text-theme-6 mt-2 status-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <input type="hidden" name="year" value="{{ $year }}">
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.kewangan.pengesahan-agihan.index') }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" form="form_1" class="btn btn-primary">Muat Naik</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endslot
@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script>

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="file_upload"]');

    // Create a FilePond instance
    const options = {
        labelIdle: `Drag & Drop supporting document or <span class="filepond--label-action">Browse</span>`,
        allowFileTypeValidation: true,
        maxFileSize: '30MB'
      };
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    const pond = FilePond.create(inputElement, options);
    
    FilePond.setOptions({
        server: {
            url: '/data/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
</script>
@endpush
@endcomponent