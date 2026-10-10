@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Senarai Agihan @endslot
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="{{ asset('theme/css/borang-agihan.css') }}" rel="stylesheet">
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
<x-title>
    @if($plan_form->ddf_status == 'active')
    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }} - {{ strtoupper($plan_form->ddf_title) }}
    @else
    {{ strtoupper($plan_form->ddf_title) }}
    @endif
</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <div class="intro-y box">
            <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                <h2 class="fs-lg fw-medium truncate me-5">Lampiran A</h2>
                @if(!$plan_form_model->signed_doc_declaration)
                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                    <a href="{{ route('doc-generator.lampiran-a', $plan_form->plan_form_id) }}" class="btn btn-sm btn-dark" onclick=""><i class="p-1" data-feather="download"></i> Download PDF</a>
                </div>
                @endif
            </div>
            <div class="p-5">
                <h2 class="mx-auto mb-5 text-center fs-base fw-bold">MAKLUMAT KEWANGAN AGIHAN DANA UNIVERSITI PENYELIDIKAN</h2>
                <h2 class="mx-auto mb-5 text-center fs-sm fw-bold text-decoration-underline">BUTIRAN KEWANGAN TERPERINCI</h2>
                <div class="intro-y mb-5">
                    <table class="table table-bordered">
                        <thead class="table-dark border-b-0">
                            <tr>
                                <th class="text-center w-1">BIL.</th>
                                <th class="text-center w-2">PERKARA</th>
                                <th class="text-center">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">1.</td>
                                <td class="fw-bold">PTJ Bertanggungjawab</td>
                                <td class="fw-bold">{{ $plan_form->ptj }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">2.</td>
                                <td class="fw-bold">Program KPM</td>
                                <td class="fw-bold">{{ $plan_form->mrun_desc }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">3.</td>
                                <td class="fw-bold">Projek/Program</td>
                                <td class="fw-bold">{{ strtoupper($plan_form->ddf_title) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">4.</td>
                                <td class="fw-bold">Pusat Kos / Chargeline</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #f7e4df;">
                                            <tr>
                                                <th class="text-center">No. Chargeline</th>
                                                <th class="text-center">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="fw-bold">
                                                    @if($plan_form->ddf_status == 'active')
                                                    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }}
                                                    @else
                                                    TIADA
                                                    @endif
                                                </td>
                                                <td class="fw-bold">{{ strtoupper($plan_form->ddf_title) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">5.</td>
                                <td class="fw-bold">Agihan Tahun {{ $plan_form->plan_year }}</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #f7e4df;">
                                            <tr>
                                                <th class="text-center">No. Ruj. Pindahan UTMFin</th>
                                                <th class="text-center">Jumlah Pindahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="fw-bold">{{ $plan_form->plan_form_ref_no }}</td>
                                                <td class="fw-bold">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">6.</td>
                                <td class="fw-bold">Sasaran / Key Performance Indicators</td>
                                <td class="fw-bold text-nowrap">
                                    {!! $plan_form->main_kpi_details !!}
                                    <br />
                                    {!! $plan_form->kpi_details !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">7.</td>
                                <td class="fw-bold">Nama Pegawai Bertanggungjawab</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #c4dfeb;">
                                            <tr>
                                                <th class="text-center" colspan="2">Butiran Pegawai Bertanggungjawab</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold">Ketua Program</td>
                                                <td class="fw-bold">{{ strtoupper($plan_form->pic_name) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Pegawai Bertanggungjawab</td>
                                                <td class="fw-bold">{!! strtoupper($plan_form->member_name) !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">8.</td>
                                <td class="fw-bold">Tugas dan Tanggungjawab Ketua PTJ</td>
                                <td>
                                    <ol class="mt-4">
                                        <li>Ketua PTJ hendaklah memastikan semua perbelanjaan dibuat secara berhemah dan mematuhi semua peraturan kewangan yang telah ditetapkan oleh universiti.</li>
                                        <li>Ketua PTJ hendaklah sentiasa memantau prestasi penggunaan dana selaras dengan perancangan pelaksanaan program dalam tahun semasa.</li>
                                        <li>Ketua PTJ hendaklah memastikan laporan penggunaan dana disediakan setiap TIGA bulan dan dihantar kepada pihak Urusetia RU UTM.</li>
                                        <li>Selaras dengan Prosedur Pemantauan Prestasi Projek/Program Di Bawah Dana RU Tahun 2019, Jabatan TNCPI berhak untuk menarik semula peruntukan program yang tidak mencapai prestasi perbelanjaan dan tahap kemajuan yang disasarkan.</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">9.</td>
                                <td class="fw-bold">Perakuan Penerimaan Agihan Tahun {{ $plan_form->plan_year }}</td>
                                <td>
                                    <form id="approve-form" action="{{ route('dana-ru.senarai-agihan.declare', $plan_form->plan_form_id) }}" method="POST">
                                    @csrf
                                        <div class="border border-dark rounded p-5 mt-4" @if($plan_form->plan_form_declaration_date) style="background-color: #dbfff1" @endif>
                                            <div class="d-flex">
                                                <input id="declaration" type="checkbox" style="width: 50px" class="form-check-input border me-2" @if($plan_form->plan_form_declaration_date) checked disabled  @endif>
                                                <label class="cursor-pointer select-none" for="declaration"><p class="text-justify">Saya dengan ini berjanji akan memastikan peruntukan yang diterima digunakan selaras dengan perancangan projek/program ini bagi mencapai sasaran KPI Tahun 2023. Saya juga akan mematuhi semua syarat-syarat agihan yang ditetapkan oleh Urusetia dan juga memastikan perbelanjaan dilaksanakan dengan mematuhi semua peraturan kewangan yang ditetapkan.</p></label>
                                            </div>
                                            <div class="grid columns-12 gap-6 mt-4">
                                                <div class="g-col-3">
                                                    Nama:
                                                </div>
                                                <div class="g-col-9 fw-bold">
                                                    {{ strtoupper($plan_form->pic_name) }}
                                                </div>
                                            </div>
                                            <div class="grid columns-12 gap-6 mt-4">
                                                <div class="g-col-3">
                                                    Tarikh:
                                                </div>
                                                <div class="g-col-9">
                                                    @if($plan_form->plan_form_declaration_date){{ date('j/n/Y', strtotime($plan_form->plan_form_declaration_date)) }}@endif
                                                </div>
                                            </div>
                                        </div>
                                        <div id="signed_lampiran_a" class="border border-dark rounded p-5 mt-4">
                                            <h4 class="fw-bold mb-4">Lampiran A yang telah ditandatangan : </h4>
                                            @if(!$plan_form->plan_form_declaration_date)
                                            <input class="filepond" name="file_upload" id="file_upload" type="file" />
                                            @endif
                                            @if($plan_form_model->signed_doc_declaration)
                                            <div class="existing-file-container">
                                                @php
                                                    $evidence = $plan_form_model->signed_doc_declaration;
                                                    $media = $evidence->getFirstMedia('druDataAttachment');
                                                @endphp
                                                @if($media)
                                                <div class="file-btn">
                                                    <a href="{{ route('dana-ru.cadangan-agihan.file.download', $evidence->id) }}" class="file-action-btn"><i class="file-icon-padding" data-feather="download"></i></a>
                                                    <div class="file-info">
                                                        <span class="file-info-main">{{ $media->file_name }}</span>
                                                        <span class="file-info-sub">{{ number_format(($media->size/1000000), 2, '.', ',') ?? 0 }} MB</span>
                                                    </div>
                                                    @if(!$plan_form->plan_form_declaration_date)<button type="button" onclick="deleteExistingFile($(this))" class="file-action-btn remove-btn"><i class="file-icon-padding" data-feather="x"></i></button>@endif
                                                </div>
                                                @endif
                                            </div>
                                            @endif
                                            @error('file_upload')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="mt-5 text-center"></p>
                </div>
            </div>
            <div class="d-flex p-5 align-item-center border-top border-gray-200 dark-border-dark-5">
                <a class="btn btn-light" href="{{ route('dana-ru.senarai-agihan.index') }}">Back</a>
                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                    @if(!$plan_form->plan_form_declaration_date)
                    <button id="declaration_btn" form="approve-form" type="submit" disabled class="btn btn-primary"> Submit</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endslot
@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
            process: '/data/upload/',
            revert: '/data/revert/',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
    });

    $('#declaration').change(function()
    {
        if($(this).is(':checked')) $('#declaration_btn').prop('disabled', false);
        else $('#declaration_btn').prop('disabled', true);
    });

    function deleteExistingFile(that){
        let parent_class = that.parent().prop('class');
        that.parent().remove();
        if($('.'+parent_class).length <= 0)$('.existing-file-container').remove();
    }

    // $('#declaration_btn').click(function(){
    //     swal({
    //         title: "Sila isi NRIC anda. (Tanpa '-')",
    //         input: "text",
    //         inputAttributes: {
    //             autocapitalize: "off"
    //         },
    //         showCancelButton: true,
    //         confirmButtonText: "Submit",
    //         showLoaderOnConfirm: true,
    //         preConfirm: async (nric) => {
    //             if (!nric) {
    //                 swal.showValidationError("Sila masukkan NRIC.");
    //                 return false; // Keeps the modal open
    //             }
    //             try {
    //                 const data = new FormData();
    //                 data.append("plan_id", {!! $plan_form->plan_form_id !!});
    //                 data.append("nric", nric);

    //                 const response = await fetch("/ajax/validate-nric/", {
    //                     method: "POST",
    //                     body: data,
    //                     headers: {
    //                         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    //                     }
    //                 });

    //                 if (!response.ok) {
    //                     const errorResponse = await response.json();
    //                     return swal.showValidationError(`Pengesahan gagal: ${JSON.stringify(errorResponse)}`);
    //                 }

    //                 const result = await response.json();
    //                 if (result.result !== 1) {
    //                     return swal.showValidationError("Pengesahan gagal: NRIC tidak sah.");
    //                 }

    //                 return result; // Proceed with the resolved value
    //             } catch (error) {
    //                 swal.showValidationError(`Request failed: ${error.message}`);
    //             }
    //         },
    //         allowOutsideClick: false,
    //     }).then((result) => {
    //         if(result.value.result == 1) {
    //             $('#approve-form').submit();
    //         }
    //     });
    // });
</script>
@endpush
@endcomponent