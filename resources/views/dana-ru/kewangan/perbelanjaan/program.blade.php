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
                            {{-- <button class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill">
                                Jana Borang Lampiran A
                                <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="upload" class="w-4 h-4"></i> </span>
                            </button> --}}
                        </div>
                        <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                            {{-- <a href="{{ route('dana-ru.kewangan.perbelanjaan.sub-projek') }}" class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill">
                                Pergi ke Sub Projek
                                <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="arrow-right" class="w-4 h-4"></i> </span>
                            </a> --}}
                            {{-- @if (in_array($plan->status,['draft', 'amendment']))
                            <a href="{{ route('dana-ru.cadangan-agihan.form') }}" class="btn btn-primary-soft me-4"> <i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i> Add New </a>
                            <button class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill me-4">
                                Jana Kertas Kerja
                                <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="edit" class="w-4 h-4"></i> </span>
                            </button>
                            <form id="submission-form" action="{{ route('dana-ru.cadangan-agihan.verification', ['id'=>$plan->id, 'type'=>'submit']) }}" method="POST">@csrf<button type="submit" form="submission-form" class="btn btn-primary"> Submit </button></form>
                            @else
                            <button class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill me-4">
                                Muat Turun Kertas Kerja
                                <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="download" class="w-4 h-4"></i> </span>
                            </button>
                            @endif --}}
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
                                    <th class="text-nowrap">BALANCES (RM)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($plan_forms as $i=>$plan_form)
                                <td class="text-center">{{$i}}</td>
                                    <td class="text-center">{{ $plan_form->mrun_code }}</td>
                                    <td class="text-center">{{ $plan_form->bpki_code }}</td>
                                    <td class="text-center">
                                        @if($plan_form->pro_status == 'active')
                                        Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->pro_code }}.{{ getProjectSecondCode($plan_form->pro_code_2) }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $plan_form->pro_title }}</td>
                                    <td class="text-nowrap">{{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                    <td class="text-nowrap text-theme-10">{{ number_format($plan_form->total_expenses, 2, '.', ',') }}</td>
                                    @php
                                        $balance = $plan_form->plan_form_amount - $plan_form->total_expenses;
                                    @endphp
                                    <td class="text-nowrap {{ $balance < 0 ? 'text-theme-6' : 'text-theme-9' }}">{{ number_format($balance, 2, '.', ',') }}</td>
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