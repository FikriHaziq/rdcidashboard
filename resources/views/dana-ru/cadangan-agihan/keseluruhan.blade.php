@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@push('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endpush
@slot('content')
<x-title hasYear :year="$year" :route="route('dana-ru.cadangan-agihan.index')">Borang Cadangan Agihan {{ $year }}</x-title>
@if (count($plans) > 0)<x-dru.plan :year="$year" :plans="$plans" :type="$request->type" />@endif
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            @if (count($plans) == 0)
            <x-dru.setFund :year="$year" />
            @else
            <x-dru.infography :year="$year" :plan="$plans" :type="$request->type" page="summary" />
            <div class="g-col-12 box">
                <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                    <ul class="nav nav-pills w-full w-lg-1/2  bg-theme-8 bg-opacity-50 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
                        <li class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-1.5 px-2 active" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Senarai Cadangan Agihan</button>
                        </li>
                        @if(count($agihan_semula_lists) > 0)
                        <li class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-1.5 px-2" id="agihan-semula-tab" data-bs-toggle="pill" data-bs-target="#agihan-semula" type="button" role="tab" aria-controls="agihan-semula" aria-selected="true">Senarai Cadangan Agihan Semula</button>
                        </li>
                        @endif
                        @if(count($pindahan_lists) > 0)
                        <li class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-1.5 px-2" id="pindahan-tab" data-bs-toggle="pill" data-bs-target="#pindahanList" type="button" role="tab" aria-controls="pindahan" aria-selected="true">Senarai Pindahan</button>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="p-5 tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                        <div class="intro-y d-block d-sm-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Cadangan Agihan
                            </h2>
                        </div>
                        <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                            <table class="table table-bordered mt-6 ">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">No.</th>
                                        <th class="text-nowrap">MRUN</th>
                                        <th class="text-nowrap">BPKI</th>
                                        <th class="text-nowrap">KETUA PROGRAM</th>
                                        <th class="text-nowrap">PEGAWAI BERTANGGUNGJAWAB</th>
                                        <th class="text-nowrap">PTJ PIC</th>
                                        <th class="text-nowrap">JENIS AGIHAN</th>
                                        <th class="text-nowrap">CHARGELINE</th>
                                        <th class="text-nowrap">KPI {{ $year }}</th>
                                        <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                        <th class="text-nowrap">CATATAN</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse ($plan_forms as $i=>$plan_form)
                                    <tr class="intro-x">
                                        <td class="text-nowrap">{{ $i+1 }}</td>
                                        <td class="text-nowrap">{{ $plan_form->mrun_code }}</td>
                                        <td class="text-nowrap">{{ $plan_form->bpki_code }}</td>
                                        <td class="text-nowrap">{{ $plan_form->pic_name }}</td>
                                        <td class="text-nowrap">{{ $plan_form->member_name }}</td>
                                        <td class="text-nowrap">{{ $plan_form->ptj }}</td>
                                        <td class="text-nowrap">{{ strtoupper($plan_form->ddf_title) }} </td>
                                        <td class="text-nowrap">
                                            @if($plan_form->ddf_status == 'active')
                                            Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            {!! $plan_form->main_kpi_details !!}
                                            <br />
                                            {!! $plan_form->kpi_details !!}
                                        </td>
                                        <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                        <td style="min-width: 300px">
                                            @if($plan_form->main_kpi_remarks || $plan_form->kpi_remarks)
                                            {!! $plan_form->main_kpi_remarks !!}
                                            {!! $plan_form->kpi_remarks !!}
                                            <br /><br />
                                            @endif
                                            @if($plan_form->notes)
                                            <b><u>Catatan Umum: </u></b><br />
                                            {!! $plan_form->notes !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="11">No record.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(count($agihan_semula_lists) > 0)
                    <div class="p-5 tab-pane fade show" id="agihan-semula" role="tabpanel" aria-labelledby="agihan-semula-tab">
                        <div class="intro-y d-block d-sm-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Cadangan Agihan Semula
                            </h2>
                            <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                                @if (count($agihan_semula_lists) > 0)
                                <div class="input-group me-2 me-sm-2">
                                    <div class="input-group-text bg-theme-1 text-white">SENARAI AGIHAN</div>
                                    <select id="agihan_semula_list" class="form-select bg-white" onchange="changeAgihanSemula($(this).val())">
                                        @foreach ($agihan_semula_lists as $key => $list)
                                            <option value="{{ $list->plan_id }}" @if($key == 0) selected @endif>{{ $list->plan_date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                            <table class="table table-bordered mt-6 ">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">No.</th>
                                        <th class="text-nowrap">MRUN</th>
                                        <th class="text-nowrap">BPKI</th>
                                        <th class="text-nowrap">KETUA PROGRAM</th>
                                        <th class="text-nowrap">PEGAWAI BERTANGGUNGJAWAB</th>
                                        <th class="text-nowrap">PTJ PIC</th>
                                        <th class="text-nowrap">JENIS AGIHAN</th>
                                        <th class="text-nowrap">CHARGELINE</th>
                                        <th class="text-nowrap">KPI {{ $year }}</th>
                                        <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                        <th class="text-nowrap">CATATAN</th>
                                    </tr>
                                </thead>
                                @foreach ($agihan_semula_lists as $i=>$list)
                                <tbody id="as_list_{{ $list->plan_id }}" class="as-list-body bg-white d-none">
                                    @forelse ($list->plan_forms as $i=>$agihan_semula)
                                    <tr class="intro-x">
                                        <td class="text-nowrap">{{ $i+1 }}</td>
                                        <td class="text-nowrap">{{ $agihan_semula->mrun_code }}</td>
                                        <td class="text-nowrap">{{ $agihan_semula->bpki_code }}</td>
                                        <td class="text-nowrap">{{ $agihan_semula->pic_name }}</td>
                                        <td class="text-nowrap">{{ $agihan_semula->member_name }}</td>
                                        <td class="text-nowrap">{{ $agihan_semula->ptj }}</td>
                                        <td class="text-nowrap">{{ strtoupper($agihan_semula->ddf_title) }} </td>
                                        <td class="text-nowrap">
                                            @if($agihan_semula->ddf_status == 'active')
                                            Q.{{ getAppendedPtjCode($agihan_semula->ptj_code, 7) }}.{{ $agihan_semula->ddf_code }}.{{ getProjectSecondCode($agihan_semula->ddf_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            {!! $agihan_semula->main_kpi_details !!}
                                            <br />
                                            {!! $agihan_semula->kpi_details !!}
                                        </td>
                                        <td class="text-nowrap">RM {{ number_format($agihan_semula->plan_form_amount, 2, '.', ',') }}</td>
                                        <td style="min-width: 300px">
                                            @if($agihan_semula->main_kpi_remarks || $agihan_semula->kpi_remarks)
                                            {!! $agihan_semula->main_kpi_remarks !!}
                                            {!! $agihan_semula->kpi_remarks !!}
                                            <br /><br />
                                            @endif
                                            @if($agihan_semula->notes)
                                            <b><u>Catatan Umum: </u></b><br />
                                            {!! $agihan_semula->notes !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="11">No record.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($pindahan_lists) > 0)
                    <div class="p-5 tab-pane fade show" id="pindahanList" role="tabpanel" aria-labelledby="pindahan-tab">
                        <div class="intro-y d-block d-sm-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Pindahan
                            </h2>
                            <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                                @if (count($pindahan_lists) > 0)
                                <div class="input-group me-2 me-sm-2">
                                    <div class="input-group-text bg-theme-1 text-white">SENARAI PINDAHAN</div>
                                    <select id="pindahan_list" class="form-select bg-white" onchange="changePindahan($(this).val())">
                                        @foreach ($pindahan_lists as $key => $list)
                                            <option value="{{ $list->plan_id }}" @if($key == 0) selected @endif>{{ $list->plan_date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                            <table class="table table-bordered mt-6 ">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">No.</th>
                                        <th class="text-nowrap">PTJ (FROM)</th>
                                        <th class="text-nowrap">JENIS AGIHAN (FROM)</th>
                                        <th class="text-nowrap">CHARGELINE (FROM)</th>
                                        <th class="text-nowrap">PTJ (TO)</th>
                                        <th class="text-nowrap">JENIS AGIHAN (TO)</th>
                                        <th class="text-nowrap">CHARGELINE (TO)</th>
                                        <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                        <th class="text-nowrap">CATATAN</th>
                                    </tr>
                                </thead>
                                @foreach ($pindahan_lists as $i=>$list)
                                <tbody id="p_list_{{ $list->plan_id }}" class="p-list-body bg-white d-none">
                                    @forelse ($list->plan_forms as $i=>$plan_form)
                                    <tr class="intro-x">
                                        <td class="text-nowrap">{{ $i+1 }}</td>
                                        <td class="text-nowrap">{{ $plan_form->ptjf }}</td>
                                        <td class="text-nowrap">{{ strtoupper($plan_form->ddff_title) }} </td>
                                        <td class="text-nowrap">
                                            @if($plan_form->ddff_status == 'active')
                                            Q.{{ getAppendedPtjCode($plan_form->ptjf_code, 7) }}.{{ $plan_form->ddff_code }}.{{ getProjectSecondCode($plan_form->ddff_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-nowrap">{{ $plan_form->ptjt }}</td>
                                        <td class="text-nowrap">{{ strtoupper($plan_form->ddft_title) }} </td>
                                        <td class="text-nowrap">
                                            @if($plan_form->ddft_status == 'active')
                                            Q.{{ getAppendedPtjCode($plan_form->ptjt_code, 7) }}.{{ $plan_form->ddft_code }}.{{ getProjectSecondCode($plan_form->ddft_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                        <td style="min-width: 300px">
                                            @if($plan_form->notes)
                                            <b><u>Catatan Umum: </u></b><br />
                                            {!! $plan_form->notes !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="11">No record.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- END: Weekly Top Products -->
        </div>
    </div>
</div>

@endslot
@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script>
    $(".input-mask").inputmask(); 

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
    
    function deleteData(id) {
        swal({
            title: 'Are you sure to delete?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/cadangan-agihan/delete-plan/' + id;
                    swal({
                        title: 'Deleting',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                    swal.showLoading();
                }
        })
    }

    $('#agihan_semula_list').trigger('change');
    $('#pindahan_list').trigger('change');

    function changeAgihanSemula(plan_id) {
        $(".as-list-body").addClass('d-none');
        $("#as_list_"+plan_id).removeClass('d-none');
    }

    function changePindahan(plan_id) {
        $(".p-list-body").addClass('d-none');
        $("#p_list_"+plan_id).removeClass('d-none');
    }
</script>   
@endpush
@endcomponent