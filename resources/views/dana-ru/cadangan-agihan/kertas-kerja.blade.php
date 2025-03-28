@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@push('custom-css')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
<style>
.ts-control {
    -moz-padding-start: calc(.75rem - 3px);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%232d3748' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E);
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 16px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    color: #2d3748;
    display: block;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.429;
    padding: 0.5rem 2.25rem 0.5rem 0.75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
}
.ts-control input::placeholder{font-size: .875rem; color: #A0AEC0;opacity: 1; /* Firefox */}
.ts-control input::-ms-input-placeholderr{font-size: .875rem; color: #A0AEC0;}
.ts-dropdown {z-index: 100;}
</style>

@endpush
@slot('content')
<x-title>Kertas Kerja Dana RU {{ $year }}</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.cadangan-agihan.kertas-kerja.store', $plan->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('doc-generator.kertas-kerja', $plan->id) }}" class="btn btn-primary">Jana Kertas Kerja</a>
                </div>
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-10 align-items-center">
                    <div class="text-gray-800 fw-medium">NO. RUJUKAN</div>
                </div>
                <input type="text" name="no_rujukan" class="form-control w-100" placeholder="KERTAS KERJA UTM/JPU/11111/2023" value="{{ $no_rujukan->value ?? '' }}">

                <div class="alert alert-dark d-flex py-2 pl-5 mt-5 justify-content-center align-items-center">
                    <div class="fw-medium">TERPERINCI</div>
                </div>
                @foreach ($parameters as $parameter)
                @php
                    $data = [["key" => 'year', "value" => $year], ["key" => 'amount', "value" => 'RM ' . number_format($plan->amount, 2, '.', ',')]];
                    $doc = $doc_templates->where('type',$parameter->code)->first();
                    $content = $doc ? $doc->reviseContent('value', $data) : $parameter->reviseContent('description_2', $data);
                    $item = $parameter->reviseContent('parameter_name', $data);
                @endphp
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-5 align-items-center">
                    <input type="text" class="form-control" value="{{ strtoupper($item) }}" style="background: white">
                    {{-- <div class="text-gray-800 fw-medium">{{ strtoupper($item) }}</div> --}}
                </div>
                @if($parameter->description_1 == "optional")
                <div class="d-flex">
                    <input id="{{ $parameter->code }}_default" type="hidden" value="{{ $content }}">
                    <input id="{{ $parameter->code }}_check" type="checkbox" class="form-check-input border mb-2" @if($doc) checked @endif onchange="checkCheckbox('{{ $parameter->code }}')">
                    <label class="cursor-pointer select-none" for="{{ $parameter->code }}_check">Tanda Jika Perlu.</label>
                </div>
                <textarea id="{{ $parameter->code }}" name="{{ $parameter->code }}"></textarea>
                @else
                <textarea id="{{ $parameter->code }}" name="{{ $parameter->code }}">{!! $content !!}</textarea>
                @endif
                @endforeach
                <div class="alert alert-dark d-flex py-2 pl-5 mt-10 justify-content-center align-items-center">
                    <div class="fw-medium">RINGKASAN</div>
                </div>
                @foreach ($parameters as $parameter)
                @php
                    $data = [["key" => 'year', "value" => $year], ["key" => 'amount', "value" => 'RM ' . number_format($plan->amount, 2, '.', ',')]];
                    $doc = $doc_templates->where('type',$parameter->code.'_details')->first();
                    $content = $doc ? $doc->reviseContent('value', $data) : null;
                    $item = $parameter->reviseContent('parameter_name', $data);
                @endphp
                <div id="{{ $parameter->code }}_details_container">
                    <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-5 align-items-center">
                        <div class="text-gray-800 fw-medium">{{ strtoupper($item) }}</div>
                    </div>
                    <button type="button" onclick="copyContent('{{ $parameter->code }}')" class="btn btn-sm btn-rounded-dark mb-2">Salin dari ringkasan</button>
                    <textarea id="{{ $parameter->code }}_details" name="{{ $parameter->code }}_details">{!! $content !!}</textarea>
                </div>
                @endforeach
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-5 align-items-center">
                    <div class="text-gray-800 fw-medium">DISEDIAKAN OLEH</div>
                </div>
                <div id="prepared_by_container">
                    @php
                        $preparedByName = $doc_templates->where('type', 'prepared_by_name');
                    @endphp
                    @forelse ($preparedByName as $key => $item)
                    @php
                        $preparedByRole = $doc_templates->where('type', 'prepared_by_role')->where('order', $item->order)->first();
                    @endphp
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center prepared_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="@if($key == 0) prepared_by_name @else prepared_by_name_{{$key+1}} @endif" name="prepared_by_name[]" type="text" value="{{ $item->value }}" class="form-control bg-white" placeholder="NAMA" aria-describedby="@if($key == 0) prepared_by_name @else prepared_by_name_{{$key+1}} @endif">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="@if($key == 0) prepared_by_role @else prepared_by_role_{{$key+1}} @endif" name="prepared_by_role[]" type="text" value="{{ $preparedByRole->value ?? null }}" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="@if($key == 0) prepared_by_role @else prepared_by_role_{{$key+1}} @endif">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'prepared_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center prepared_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="prepared_by_name" name="prepared_by_name[]" type="text" value="" class="form-control bg-white" placeholder="NAMA" aria-describedby="prepared_by_name">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="prepared_by_role" name="prepared_by_role[]" type="text" value="" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="prepared_by_role">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'prepared_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addPerson('prepared_by')" class="btn btn-outline-dark w-full">ADD</button>
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-10 align-items-center">
                    <div class="text-gray-800 fw-medium">DISAHKAN OLEH</div>
                </div>
                <div id="verified_by_container">
                    @php
                        $verifiedByName = $doc_templates->where('type', 'verified_by_name');
                    @endphp
                    @forelse ($verifiedByName as $key => $item)
                    @php
                        $verifiedByRole = $doc_templates->where('type', 'verified_by_role')->where('order', $item->order)->first();
                    @endphp
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center verified_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="@if($key == 0) verified_by_name @else verified_by_name_{{$key+1}} @endif" name="verified_by_name[]" type="text" value="{{ $item->value }}" class="form-control bg-white" placeholder="NAMA" aria-describedby="@if($key == 0) verified_by_name @else verified_by_name_{{$key+1}} @endif">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="@if($key == 0) verified_by_role @else verified_by_role_{{$key+1}} @endif" name="verified_by_role[]" type="text" value="{{ $verifiedByRole->value ?? null }}" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="@if($key == 0) verified_by_role @else verified_by_role_{{$key+1}} @endif">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'verified_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center verified_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="verified_by_name" name="verified_by_name[]" type="text" value="" class="form-control bg-white" placeholder="NAMA" aria-describedby="verified_by_name">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="verified_by_role" name="verified_by_role[]" type="text" value="" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="verified_by_role">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'verified_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addPerson('verified_by')" class="btn btn-outline-dark w-full">ADD</button>
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-5 align-items-center">
                    <div class="text-gray-800 fw-medium">DIPERAKUKAN OLEH</div>
                </div>
                <div id="confirmed_by_container">
                    @php
                        $confirmedByName = $doc_templates->where('type', 'confirmed_by_name');
                    @endphp
                    @forelse ($confirmedByName as $key => $item)
                    @php
                        $confirmedByRole = $doc_templates->where('type', 'confirmed_by_role')->where('order', $item->order)->first();
                    @endphp
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center confirmed_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="@if($key == 0) confirmed_by_name @else confirmed_by_name_{{$key+1}} @endif" name="confirmed_by_name[]" type="text" value="{{ $item->value }}" class="form-control bg-white" placeholder="NAMA" aria-describedby="@if($key == 0) confirmed_by_name @else confirmed_by_name_{{$key+1}} @endif">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="@if($key == 0) confirmed_by_role @else confirmed_by_role_{{$key+1}} @endif" name="confirmed_by_role[]" type="text" value="{{ $confirmedByRole->value ?? null }}" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="@if($key == 0) confirmed_by_role @else confirmed_by_role_{{$key+1}} @endif">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'confirmed_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-secondary-soft d-flex py-2 pl-5 mt-5 align-items-center confirmed_by_entry">
                        <div class="grid columns-12 gap-6 mt-2 pb-2 w-full">
                            <div class="g-col-11 d-flex flex-column">
                                <div class="input-group">
                                    <div class="input-group-text bg-theme-1 text-white">NAMA</div> <input id="confirmed_by_name" name="confirmed_by_name[]" type="text" value="" class="form-control bg-white" placeholder="NAMA" aria-describedby="confirmed_by_name">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-text bg-theme-1 text-white">JAWATAN</div> <input id="confirmed_by_role" name="confirmed_by_role[]" type="text" value="" class="form-control bg-white" placeholder="JAWATAN" aria-describedby="confirmed_by_role">
                                </div>
                            </div>
                            <div class="g-col-1 d-flex align-items-center justify-content-end">
                                <button type="button" onclick="removePerson(this, 'confirmed_by')" class="btn btn-danger del-button">DEL</button>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addPerson('confirmed_by')" class="btn btn-outline-dark w-full">ADD</button>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.cadangan-agihan.index', $year) }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" form="form_1" class="btn btn-primary">Hantar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endslot
@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        List,
        Indent, 
        IndentBlock,
        Alignment,
        SourceEditing
    } from 'ckeditor5';
    
    let parameters = {!! $parameters !!};
    let plugins = [ Essentials, Bold, Italic, Font, Paragraph, List, Indent, IndentBlock, Alignment, SourceEditing ];
    let fontSize = {options: [9,11,13,'default',17,19,21]};
    let toolbar = {
        items: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor','|',
            'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
            'bulletedList', 'numberedList', 'outdent', 'indent', '|',
            'sourceEditing'
        ]
    };
    let editors = {};
    let preparedByRawCount = {!! $doc_templates->where('type', 'prepared_by_name')->count() !!};
    let verifiedByRawCount = {!! $doc_templates->where('type', 'verified_by_name')->count() !!};
    let confirmedByRawCount = {!! $doc_templates->where('type', 'confirmed_by_name')->count() !!};
    let preparedByCount = preparedByRawCount > 0 ?  preparedByRawCount : 1;
    console.log(preparedByCount);
    let verifiedByCount = verifiedByRawCount > 0 ?  verifiedByRawCount : 1;;
    let confirmedByCount = confirmedByRawCount > 0 ?  confirmedByRawCount : 1;;
    parameters.forEach(parameter => {
        let editorInstance;
        ClassicEditor
            .create( document.querySelector( `#${parameter.code}`), {
                plugins: plugins,
                fontSize: fontSize,
                toolbar: toolbar
            } )
            .then(editor => {
                    editors[`#${parameter.code}`] = editor;
                    if ($(`#${parameter.code}_check`).length) {
                        editor.enableReadOnlyMode('manual'); // Start in read-only mode
                    }
                })
            .catch( /* ... */ );
        ClassicEditor
            .create( document.querySelector( `#${parameter.code}_details`), {
                plugins: plugins,
                fontSize: fontSize,
                toolbar: toolbar
            } )
            .then(editor => {
                    editors[`#${parameter.code}_details`] = editor;
                    if ($(`#${parameter.code}_check`).length) {
                        editor.enableReadOnlyMode('manual'); // Start in read-only mode
                    }
                })
            .catch( /* ... */ );
    });
    window.checkCheckbox = function(id) {
        if ($(`#${id}_check`).is(':checked')) {
            // Set specific content when checkbox is checked
            editors[`#${id}`].disableReadOnlyMode('manual');
            editors[`#${id}`].setData($(`#${id}_default`).val());
            editors[`#${id}_details`].disableReadOnlyMode('manual');
            $(`#${id}_details_container`).removeClass('d-none');

        } else {
            // Clear content if needed when unchecked (optional)
            editors[`#${id}`].enableReadOnlyMode('manual');
            editors[`#${id}`].setData('');
            editors[`#${id}_details`].enableReadOnlyMode('manual');
            editors[`#${id}_details`].setData('');
            $(`#${id}_details_container`).addClass('d-none');
        }
    }
    window.copyContent = function(id) {
        const content = editors[`#${id}`].getData();
        editors[`#${id}_details`].setData(content);
    }

    window.updateDelButtonVisibility = function(type) {
        const personEntries = $(`.${type}_entry`);
        if (personEntries.length === 1) {
            personEntries.find('.del-button').hide();
        } else {
            personEntries.find('.del-button').show();
        }
    }

    window.addPerson = function(type) {
        let personCount = 1;
        if(type == "prepared_by"){
            preparedByCount++;
            personCount = preparedByCount;
        }
        else if(type == "verified_by"){
            verifiedByCount++;
            personCount = verifiedByCount;
        }
        else if(type == "confirmed_by"){
            confirmedByCount++;
            personCount = confirmedByCount;
        }

        // Clone the first person entry
        let originalPerson = $(`.${type}_entry`).first();
        let newPerson = originalPerson.clone();

        // Update the IDs and placeholders of the new person fields
        newPerson.find('input').each(function(index, input) {
            if ($(input).attr('id').includes('name')) {
                $(input).attr('id', `${type}_name_${personCount}`);
                $(input).attr('aria-describedby', `${type}_name_${personCount}`);
                $(input).val(''); // Clear the input value
            } else if ($(input).attr('id').includes('role')) {
                $(input).attr('id', `${type}_role_${personCount}`);
                $(input).attr('aria-describedby', `${type}_role_${personCount}`);
                $(input).val(''); // Clear the input value
            }
        });

        // Append the new person entry to the container
        $(`#${type}_container`).append(newPerson);

        // Update the visibility of the DEL button
        updateDelButtonVisibility(type);
    }

    window.removePerson = function(button, type) {
        $(button).closest(`.${type}_entry`).remove();
        updateDelButtonVisibility(type);
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateDelButtonVisibility('prepared_by');
        updateDelButtonVisibility('verified_by');
        updateDelButtonVisibility('confirmed_by');
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            const id = checkbox.id.replace('_check', '');
            checkCheckbox(id);
        });
    });
</script>
@endpush
@endcomponent