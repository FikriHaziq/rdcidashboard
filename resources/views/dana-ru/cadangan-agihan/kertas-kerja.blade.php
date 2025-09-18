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

.ck.ck-editor {
    width: 100%
}
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
                <div class="alert alert-primary-soft d-flex py-2 pl-5 mt-10 align-items-center">
                    <div class="text-gray-800 fw-medium">TAJUK KERTAS KERJA</div>
                </div>
                <input type="text" name="tajuk_kertas_kerja" class="form-control w-100" value="{{ $tajuk_kertas_kerja->value ?? (\App\Models\Parameter::where('code', 'tajuk_kertas_kerja')->first()->parameter_name ?? '') }}">
                <div class="report-box-2 intro-y mt-12 mt-sm-5">
                    <div class="box d-sm-flex">
                        <div class="d-flex flex-column justify-content-center flex-1 border-2 border-dotted rounded-2 bg-theme-14">
                            <div class="d-flex p-5 align-item-center border-bottom border-gray-400 dark-border-dark-5">
                                <ul class="nav nav-pills w-full w-lg-1/2 bg-theme-8 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
                                    <li class="nav-item flex-1" role="presentation">
                                        <button class="nav-link w-full py-1.5 px-2 active" id="terperinci-tab" data-bs-toggle="pill" data-bs-target="#terperinci" type="button" role="tab" aria-controls="terperinci" aria-selected="true">Terperinci</button>
                                    </li>
                                    <li class="nav-item flex-1" role="presentation">
                                        <button class="nav-link w-full py-1.5 px-2" id="ringkasan-tab" data-bs-toggle="pill" data-bs-target="#ringkasan" type="button" role="tab" aria-controls="ringkasan" aria-selected="true">Ringkasan Eksekutif</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="px-5 tab-pane fade show active" id="terperinci" role="tabpanel" aria-labelledby="terperinci-tab">
                                    <div id="terperinci_container" class="intro-y d-flex flex-column">
                                        @php $doc_numbering = $doc_templates->where('type', 'terperinci')->first(); @endphp
                                        <label class="alert alert-primary-soft w-1/4 py-2 pl-5 my-5" for="terperinci_numbering_check">
                                            <div class="d-flex">
                                                <input id="terperinci_numbering_check" name="terperinci_numbering_check" type="checkbox" class="form-check-input border border-black" @if(($doc_numbering->numbering_check ?? 0) == 1) checked @endif onchange="toggleNumbering('terperinci')">
                                                <label class="text-gray-700 cursor-pointer select-none" for="terperinci_numbering_check">Custom numbering</label>
                                            </div>
                                        </label>
                                    </div>
                                    <button type="button" onclick="addContent()" class="btn btn-dark w-full mb-5">ADD</button>
                                </div>
                                <div class="p-5 tab-pane fade" id="ringkasan" role="tabpanel" aria-labelledby="ringkasan-tab">
                                    <div id="ringkasan_container" class="intro-y d-flex flex-column">
                                        @php $r_doc_numbering = $doc_templates->where('type', 'ringkasan')->first(); @endphp
                                        <label class="alert alert-primary-soft w-1/4 py-2 pl-5 my-5" for="ringkasan_numbering_check">
                                            <div class="d-flex">
                                                <input id="ringkasan_numbering_check" name="ringkasan_numbering_check" type="checkbox" class="form-check-input border border-black" @if(($r_doc_numbering->numbering_check ?? 0) == 1) checked @endif onchange="toggleNumbering('ringkasan')">
                                                <label class="text-gray-700 cursor-pointer select-none" for="ringkasan_numbering_check">Custom numbering</label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<div class="d-none">
    <div id="clone_terperinci">
        <div class="d-flex flex-column mb-5 terperinci_entry">
            <div class="alert alert-primary-soft grid columns-12 gap-6 py-2 pl-5 mb-5 align-items-center w-full">
                <div class="g-col-1 terperinci-numbering-col d-none">
                    <input type="text" id="terperinci_numbering" name="terperinci_numbering[]" class="form-control" value="" style="background: white">
                </div>
                <div class="g-col-11 terperinci-title-col">
                    <input type="text" id="terperinci_title" name="terperinci_title[]" class="form-control" value="" style="background: white">
                </div>
                <div class="g-col-1 d-flex align-items-center justify-content-end">
                    <button type="button" onclick="removeContent(this, 'terperinci')" class="btn btn-danger del-button">DEL</button>
                </div>
            </div>
            <div class="d-flex">
                <input id="terperinci_default" type="hidden" value="">
                <input type="hidden" id="terperinci_check" name="terperinci_check[]" value='1'>
                <input type="checkbox" class="form-check-input border mb-2">
                <label class="text-gray-700 cursor-pointer select-none" for="terperinci_check">Tanda Jika Perlu.</label>
            </div>
            <textarea class="terperinci-desc" id="terperinci_desc" name="terperinci_desc[]"></textarea>
        </div>
    </div>
    <div id="clone_ringkasan">
        <div class="d-flex flex-column mb-5 ringkasan_entry">
            <div class="alert alert-primary-soft grid columns-12 gap-6 py-2 pl-5 mb-5 align-items-center w-full">
                <div class="g-col-1 ringkasan-numbering-col d-none">
                    <input type="text" id="ringkasan_numbering" name="ringkasan_numbering[]" class="form-control" value="" style="background: white">
                </div>
                <div class="g-col-12 ringkasan-title-col">
                    <input type="text" id="ringkasan_title" name="ringkasan_title[]" class="form-control" value="" style="background: white">
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex me-auto">
                    <input id="ringkasan_default" type="hidden" value="">
                    <input type="hidden" id="ringkasan_check" name="ringkasan_check[]" value='1'>
                    <input type="checkbox" class="form-check-input border mb-2" checked>
                    <label class="text-gray-700 cursor-pointer select-none" for="ringkasan_check">Tanda Jika Perlu.</label>
                </div>
                <div class="d-flex">
                    <button type="button" class="btn btn-sm btn-rounded-dark mb-2 copy-content">Salin dari konten terperinci</button>
                </div>
            </div>
            <textarea class="ringkasan-desc" id="ringkasan_desc" name="ringkasan_desc[]"></textarea>
        </div>
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
    let terperinci_lists = {!! $content_details !!};
    let ringkasan_lists = {!! $content_summaries !!};
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
    let plan_data = [
        {key : 'year', value: {!! $year !!}},
        {key : 'amount', value: {!! json_encode('RM '.number_format($plan->amount, 2, '.', ',')) !!}},
    ];
    let terperinciRawCount = terperinci_lists.length;
    let ringkasanRawCount = ringkasan_lists.length;
    let preparedByRawCount = {!! $doc_templates->where('type', 'prepared_by_name')->count() !!};
    let verifiedByRawCount = {!! $doc_templates->where('type', 'verified_by_name')->count() !!};
    let confirmedByRawCount = {!! $doc_templates->where('type', 'confirmed_by_name')->count() !!};
    let terperinciCount = terperinciRawCount > 0 ?  terperinciRawCount : 0;
    let preparedByCount = preparedByRawCount > 0 ?  preparedByRawCount : 1;
    let verifiedByCount = verifiedByRawCount > 0 ?  verifiedByRawCount : 1;
    let confirmedByCount = confirmedByRawCount > 0 ?  confirmedByRawCount : 1;
    
    window.checkCheckbox = function(checkbox, id) {
        if (checkbox.is(':checked')) {
            // Set specific content when checkbox is checked
            // editors[`#${id}`].disableReadOnlyMode('manual');
            // editors[`#${id}`].setData($(`#${id}_default`).val());
            $(`#${id}_check`).val(1);
            editors[`#${id}_desc`].setData($(`#${id}_default`).val());
            editors[`#${id}_desc`].disableReadOnlyMode('manual');
            // $(`#${id}_details_container`).removeClass('d-none');

        } else {
            // Clear content if needed when unchecked (optional)
            // if(Object.keys(editors).length != 0){
                $(`#${id}_check`).val(0);
                $(`#${id}_default`).val(editors[`#${id}_desc`].getData());
                editors[`#${id}_desc`].enableReadOnlyMode('manual');
                editors[`#${id}_desc`].setData('');
            // }
        }
    }
    window.reviseContent = function(content, data = []) {
        // data example: [{ key: "year", value: "2013" }]
        data.forEach(item => {
            content = content.replace(`\{\{`+item.key+`\}\}`, item.value);
        });
        return content;
    }

    window.copyContent = function(id_number) {
        const content = editors[`#terperinci_${id_number}_desc`].getData();
        editors[`#ringkasan_${id_number}_desc`].setData(content);
    }

    window.updateDelButtonVisibility = function(type) {
        const personEntries = $(`.${type}_entry`);
        if (personEntries.length === 1) {
            personEntries.find('.del-button').hide();
        } else {
            personEntries.find('.del-button').show();
        }
    }

    window.toggleNumbering = function(type) {
        let container = $(`#${type}_container`);
        let numbering_check = $(`#${type}_numbering_check`).is(':checked');
        let title_col_num = type == 'terperinci' ? 0 : 1
        if(numbering_check){
            container.find(`.${type}-numbering-col`).removeClass('d-none');
            container.find(`.${type}-title-col`).removeClass(`g-col-${11+title_col_num}`).addClass(`g-col-${10+title_col_num}`);
        }
        else{
            container.find(`.${type}-numbering-col`).addClass('d-none');
            container.find(`.${type}-title-col`).removeClass(`g-col-${10+title_col_num}`).addClass(`g-col-${11+title_col_num}`);
        }
    }

    window.addContent = function(title = null, content = null, numbering = null, display_check = true, r_title = null, r_content = null, r_numbering = null, r_display_check = true) {
        let contentCount = 1;
        let numbering_check = $(`#terperinci_numbering_check`).is(':checked');
        let r_numbering_check = $(`#ringkasan_numbering_check`).is(':checked');

        // Clone the content entry
        let originalContent = $(`#clone_terperinci`).children();
        let r_originalContent = $(`#clone_ringkasan`).children();
        let newContent = originalContent.clone();
        let r_newContent = r_originalContent.clone();

        terperinciCount++;
        contentCount = terperinciCount;
        

        if(numbering_check){
            newContent.find(".terperinci-numbering-col").removeClass('d-none');
            newContent.find(".terperinci-title-col").removeClass('g-col-11').addClass('g-col-10');
        }
        if(r_numbering_check){
            r_newContent.find(".ringkasan-numbering-col").removeClass('d-none');
            r_newContent.find(".ringkasan-title-col").removeClass('g-col-12').addClass('g-col-11');
        }

        // Update the IDs and placeholders of the new person fields
        newContent.find("#terperinci_numbering").attr("id", `terperinci_${contentCount}_numbering`).val(numbering);
        newContent.find("#terperinci_title").attr("id", `terperinci_${contentCount}_title`).val(reviseContent(title ?? '', plan_data));
        newContent.find("#terperinci_default").attr("id", `terperinci_${contentCount}_default`).val(reviseContent(content ?? '', plan_data));
        newContent.find('input[type="checkbox"]').attr({
            onchange: `checkCheckbox($(this), 'terperinci_${contentCount}')`
        }).prop("checked", display_check);
        newContent.find("#terperinci_check").attr("id", `terperinci_${contentCount}_check`).val(display_check ? 1 : 0);
        newContent.find("label[for='terperinci_check']").attr("for", `terperinci_${contentCount}_check`);
        newContent.find("#terperinci_desc").attr("id", `terperinci_${contentCount}_desc`).html(reviseContent(content ?? '', plan_data));

        r_newContent.find("#ringkasan_numbering").attr("id", `ringkasan_${contentCount}_numbering`).val(r_numbering);
        r_newContent.find("#ringkasan_title").attr("id", `ringkasan_${contentCount}_title`).val(reviseContent(r_title ?? '', plan_data));
        r_newContent.find("#ringkasan_default").attr("id", `ringkasan_${contentCount}_default`).val(reviseContent(r_content ?? '', plan_data));
        r_newContent.find('input[type="checkbox"]').attr({
            onchange: `checkCheckbox($(this), 'ringkasan_${contentCount}')`
        }).prop("checked", r_display_check);
        r_newContent.find("#ringkasan_check").attr("id", `ringkasan_${contentCount}_check`).val(r_display_check ? 1 : 0);
        r_newContent.find('.copy-content').attr("onclick", `copyContent(${contentCount})`);
        r_newContent.find("label[for='ringkasan_check']").attr("for", `ringkasan_${contentCount}_check`);
        r_newContent.find("#ringkasan_desc").attr("id", `ringkasan_${contentCount}_desc`).html(reviseContent(r_content ?? '', plan_data));

        // Append the new person entry to the container
        $(`#terperinci_container`).append(newContent);
        $(`#ringkasan_container`).append(r_newContent);
        
        ClassicEditor
            .create( document.querySelector( `#terperinci_${contentCount}_desc`), {
                plugins: plugins,
                fontSize: fontSize,
                toolbar: toolbar
            } )
            .then(editor => {
                    editors[`#terperinci_${contentCount}_desc`] = editor;
                    if ($(`#terperinci_${contentCount}_check`).length) {
                        editor.disableReadOnlyMode('manual'); // Start in read-only mode
                    }
                })
            .catch( /* ... */ );
        ClassicEditor
            .create( document.querySelector( `#ringkasan_${contentCount}_desc`), {
                plugins: plugins,
                fontSize: fontSize,
                toolbar: toolbar
            } )
            .then(editor => {
                    editors[`#ringkasan_${contentCount}_desc`] = editor;
                    if ($(`#ringkasan_${contentCount}_check`).length) {
                        editor.disableReadOnlyMode('manual'); // Start in read-only mode
                    }
                })
            .catch( /* ... */ );
    }

    window.removeContent = function(button) {
        let container = $(button).closest(`.terperinci_entry`);
        let textEditor = container.find(`.terperinci-desc`).attr('id');
        let r_textEditor_id = textEditor.replace('terperinci', 'ringkasan');
        let r_textEditor = $(`#`+r_textEditor_id);
        let r_container = $(r_textEditor).closest(`.ringkasan_entry`);

        editors[`#${textEditor}`].destroy()
            .then(() => {
                delete editors[`#${textEditor}`];
            });
        container.remove();

        editors[`#${r_textEditor_id}`].destroy()
            .then(() => {
                delete editors[`#${r_textEditor_id}`];
            });
        r_container.remove();
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

    if(terperinciRawCount > 0){
        terperinci_lists.forEach((terperinci_list, index) => {
            addContent(terperinci_list.title, terperinci_list.value, terperinci_list.numbering, terperinci_list.display==1 ?true:false, ringkasan_lists[index].title, ringkasan_lists[index].value, ringkasan_lists[index].numbering, ringkasan_lists[index].display==1 ?true:false);
        });
    }
    else {
        parameters.forEach(parameter => {
            addContent(parameter.parameter_name, parameter.description_2, null, true, parameter.parameter_name, parameter.description_2);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateDelButtonVisibility('prepared_by');
        updateDelButtonVisibility('verified_by');
        updateDelButtonVisibility('confirmed_by');
    });
</script>
@endpush
@endcomponent