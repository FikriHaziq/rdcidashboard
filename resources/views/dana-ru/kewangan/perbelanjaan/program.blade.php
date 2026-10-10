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
<x-title hasYear :year="$year" :route="route('dana-ru.kewangan.perbelanjaan.program.index')">Perincian Perbelanjaan Mengikut Program Tahun {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            <input type="hidden" id="agihan_id" value="">
            <input type="hidden" id="agihan_semula_id" value="">
            <div class="g-col-12 box">
                <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                    <ul class="nav nav-pills w-full w-lg-1/2  bg-theme-8 bg-opacity-50 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
                        <li class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-1.5 px-2 active" id="agihan-tab" data-bs-toggle="pill" data-bs-target="#agihan" type="button" role="tab" aria-controls="agihan" aria-selected="true">Senarai Agihan</button>
                        </li>
                        <li class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-1.5 px-2" id="agihan-semula-tab" data-bs-toggle="pill" data-bs-target="#agihan-semula" type="button" role="tab" aria-controls="agihan-semula" aria-selected="true">Senarai Agihan Semula</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="p-5 tab-pane fade show active" id="agihan" role="tabpanel" aria-labelledby="agihan-tab">
                        <div class="intro-y d-flex d-sm-flex align-items-center justify-content-between h-10">
                            @if (count($agihan_lists) > 0)
                            <div class="input-group w-2/5">
                                <div class="input-group-text bg-theme-1 text-white">SENARAI AGIHAN</div>
                                <select id="agihan_list" class="form-select bg-white" onchange="changeAgihan($(this).val())">
                                    @foreach ($agihan_lists as $key => $list)
                                        <option value="{{ $list->plan_id }}" @if($key == 0) selected @endif>{{ $list->plan_date }}</option>
                                    @endforeach
                                </select>
                                <btn class="btn btn-primary-soft" onclick="penggal($('#agihan_id').val())"><i data-feather="edit" class="d-none d-sm-block w-4 h-4 me-2"></i> SENARAI PENGGAL</btn>
                            </div>
                            @forelse ($agihan_lists as $i=>$list)
                            <x-dru.term-selection-report-generation :planId="$list->plan_id" :terms="$list->terms" elemId="agihan_id" report_type="a" />
                            @empty
                            @endforelse
                            @endif
                        </div>
                        <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                            <table class="table table-bordered mt-6 ">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">No.</th>
                                        <th class="text-nowrap">PROGRAM UTAMA</th>
                                        <th class="text-nowrap">BPKI</th>
                                        <th class="text-nowrap">KOD PROGRAM</th>
                                        <th class="text-nowrap">TITLE</th>
                                        <th class="text-nowrap">ALLOCATION (RM)</th>
                                        <th class="text-nowrap">EXPENSES (RM)</th>
                                        <th class="text-nowrap">COMMITMENT (RM)</th>
                                        <th class="text-nowrap">BALANCES (RM)</th>
                                        <th class="text-center" style="min-width:200px!important">REPORT STATUS</th>
                                        <th class="text-nowrap"></th>
                                    </tr>
                                </thead>
                                @forelse ($agihan_lists as $i=>$list)
                                <tbody id="list_{{ $list->plan_id }}" class="list-body bg-white d-none">
                                    @forelse ($list->plan_forms as $i=>$plan_form)
                                    <tr class="intro-x">
                                        <td class="text-center">{{$i}}</td>
                                        <td class="text-center">{{ $plan_form->mrun_code }}</td>
                                        <td class="text-center">{{ $plan_form->bpki_code }}</td>
                                        <td class="text-center">
                                            @if($plan_form->ddf_status == 'active')
                                            Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $plan_form->ddf_title }}</td>
                                        <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                        @php
                                            $total_expenses = $plan_form->total_expenses ?? 0;
                                            $commitment = $plan_form->plan_form_commitment ?? 0;
                                            $balance = $plan_form->plan_form_amount - $total_expenses - $commitment;
                                            $total_expenses_percent = $total_expenses/$plan_form->plan_form_amount*100;
                                            $commitment_percent = $commitment/$plan_form->plan_form_amount*100;
                                            $balance_percent = $balance/$plan_form->plan_form_amount*100;
                                        @endphp
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="text-theme-10">RM {{ number_format(($total_expenses), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $total_expenses_percent > 100 ? '6': '10' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($total_expenses_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="text-theme-10">RM {{ number_format(($commitment), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $commitment_percent > 100 ? '6': '10' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($commitment_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="{{ $balance < 0 ? 'text-theme-6' : 'text-theme-9' }}">RM {{ number_format(($balance), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $balance_percent > 100 ? '6': '9' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($balance_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($plan_form->plan_form_pic_submission_status == 7)<div class="bg-gray-600 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 8)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 9)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 10)<div class="bg-theme-18 rounded-pill justify-content-center text-black d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 12)<div class="bg-theme-9 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 11)<div class="bg-theme-12 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @else <div class="bg-theme-8 rounded-pill justify-content-center text-white d-flex align-items-center p-1">N/A</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.show', $plan_form->plan_form_id) }}" class="btn btn-sm btn-rounded-primary ms-2"><i class="p-1" data-feather="eye"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="10">No record.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @empty
                                <tbody class="bg-white">
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="10">No record.</td>
                                    </tr>
                                </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>
                    <div class="p-5 tab-pane fade show" id="agihan-semula" role="tabpanel" aria-labelledby="agihan-semula-tab">
                        <div class="intro-y d-flex d-sm-flex align-items-center justify-content-between h-10">
                            @if (count($agihan_semula_lists) > 0)
                            <div class="input-group w-2/5">
                                <div class="input-group-text bg-theme-1 text-white">SENARAI AGIHAN SEMULA</div>
                                <select id="agihan_semula_list" class="form-select bg-white" onchange="changeAgihanSemula($(this).val())">
                                    @foreach ($agihan_semula_lists as $key => $list)
                                        <option value="{{ $list->plan_id }}" @if($key == 0) selected @endif>{{ $list->plan_date }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @forelse ($agihan_semula_lists as $i=>$list)
                            <x-dru.term-selection-report-generation :planId="$list->plan_id" :terms="$list->terms" elemId="agihan_semula_id" report_type="as" />
                            @empty
                            @endforelse
                            <div class="input-group w-2/5">
                                <div class="input-group-text bg-theme-1 fs-xs text-white">LAPORAN PERBELANJAAN</div>
                                <select id="jana_laporan" class="form-select bg-white w-64">
                                    <option value="1" selected>PENGGAL 1</option>
                                    <option value="2">PENGGAL 2</option>
                                </select>
                                <button type="button" form="submission-form" class="btn btn-primary" onclick="generateReport($('#agihan_semula_id').val())"> JANA </button>
                            </div>
                            @endif
                        </div>
                        <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                            <table class="table table-bordered mt-6 ">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">No.</th>
                                        <th class="text-nowrap">PROGRAM UTAMA</th>
                                        <th class="text-nowrap">BPKI</th>
                                        <th class="text-nowrap">KOD PROGRAM</th>
                                        <th class="text-nowrap">TITLE</th>
                                        <th class="text-nowrap">ALLOCATION (RM)</th>
                                        <th class="text-nowrap">EXPENSES (RM)</th>
                                        <th class="text-nowrap">COMMITMENT (RM)</th>
                                        <th class="text-nowrap">BALANCES (RM)</th>
                                        <th class="text-center" style="min-width:200px!important">REPORT STATUS</th>
                                        <th class="text-nowrap"></th>
                                    </tr>
                                </thead>
                                @forelse ($agihan_semula_lists as $i=>$list)
                                <tbody id="as_list_{{ $list->plan_id }}" class="as_list-body bg-white d-none">
                                    @forelse ($list->plan_forms as $i=>$plan_form)
                                    <tr class="intro-x">
                                        <td class="text-center">{{$i}}</td>
                                        <td class="text-center">{{ $plan_form->mrun_code }}</td>
                                        <td class="text-center">{{ $plan_form->bpki_code }}</td>
                                        <td class="text-center">
                                            @if($plan_form->ddf_status == 'active')
                                            Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $plan_form->ddf_title }}</td>
                                        <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                        @php
                                            $total_expenses = $plan_form->total_expenses ?? 0;
                                            $commitment = $plan_form->plan_form_commitment ?? 0;
                                            $balance = $plan_form->plan_form_amount - $total_expenses - $commitment;
                                            $total_expenses_percent = $total_expenses/$plan_form->plan_form_amount*100;
                                            $commitment_percent = $commitment/$plan_form->plan_form_amount*100;
                                            $balance_percent = $balance/$plan_form->plan_form_amount*100;
                                        @endphp
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="text-theme-10">RM {{ number_format(($total_expenses), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $total_expenses_percent > 100 ? '6': '10' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($total_expenses_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="text-theme-10">RM {{ number_format(($commitment), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $commitment_percent > 100 ? '6': '10' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($commitment_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-item-center justify-content-center">
                                                <div class="{{ $balance < 0 ? 'text-theme-6' : 'text-theme-9' }}">RM {{ number_format(($balance), 2, '.', ',') }}</div>
                                                <div class="bg-theme-{{ $balance_percent > 100 ? '6': '9' }} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($balance_percent, 2, '.', ',') }} %</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($plan_form->plan_form_pic_submission_status == 7)<div class="bg-gray-600 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 8)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 9)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 10)<div class="bg-theme-18 rounded-pill justify-content-center text-black d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 12)<div class="bg-theme-9 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @elseif($plan_form->plan_form_pic_submission_status == 11)<div class="bg-theme-12 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                            @else <div class="bg-theme-8 rounded-pill justify-content-center text-white d-flex align-items-center p-1">N/A</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.show', $plan_form->plan_form_id) }}" class="btn btn-sm btn-rounded-primary ms-2"><i class="p-1" data-feather="eye"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="10">No record.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @empty
                                <tbody class="bg-white">
                                    <tr class="intro-x bg-gray-300">
                                        <td class="text-center" colspan="10">No record.</td>
                                    </tr>
                                </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="g-col-12 mt-6 box">
                <div class="p-5">
                    
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endslot
@push('custom-js')
<script>

    $('#agihan_semula_list').trigger('change');
    $('#agihan_list').trigger('change');

    function penggal(plan_id) {
        window.location = window.location.origin + '/dana-ru/kewangan/perbelanjaan/program/term/' + plan_id + '/';
    }

    function changeAgihan(plan_id) {
        $(".list-body").addClass('d-none');
        $("#term_"+plan_id).removeClass('d-none');
        $("#list_"+plan_id).removeClass('d-none');
        $("#agihan_id").val(plan_id);
    }

    function changeAgihanSemula(plan_id) {
        $(".as-list-body").addClass('d-none');
        $("#as_list_"+plan_id).removeClass('d-none');
        $("#agihan_semula_id").val(plan_id);
    }
</script>
@endpush
@endcomponent