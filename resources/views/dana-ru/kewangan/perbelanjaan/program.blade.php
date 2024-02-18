@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<x-title hasYear :year="$year" :route="route('dana-ru.kewangan.perbelanjaan.program')">Perincian Perbelanjaan Mengikut Program Tahun {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            <div class="g-col-12 mt-6 box">
                <div class="p-5">
                    <div class="intro-y d-block d-sm-flex align-items-center h-10">
                        <div class="d-flex align-items-center mt-3 mt-sm-0">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Program
                            </h2>
                        </div>
                        <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                        </div>
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
                            <tbody class="bg-white">
                                @forelse ($plan_forms as $i=>$plan_form)
                                <tr class="intro-x">
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">{{ $plan_form->mrun_code }}</td>
                                    <td class="text-center">{{ $plan_form->bpki_code }}</td>
                                    <td class="text-center">
                                        @if($plan_form->pro_status == 'active')
                                        Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->pro_code }}.{{ getProjectSecondCode($plan_form->pro_code_2) }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $plan_form->pro_title }}</td>
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
                                    <td class="text-center" colspan="8">No record.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
@endsection
@endcomponent