@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pengesahan Agihan @endslot
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.senarai-agihan.index')">Senarai Agihan {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            @if (!$plan)
            <div class="g-col-12 mt-6 mb-n6 intro-y">
                <div class="alert alert-secondary-soft alert-dismissible fade show d-flex align-items-center mb-6" role="alert">
                    <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
                    <span>No Record..</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
                </div>
            </div>
            @else
            <div class="g-col-12 mt-6 box p-5">
                <div class="intro-y d-block d-sm-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        Senarai Agihan
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
                                <th class="text-nowrap">PERUNTUKAN AGIHAN {{ $year }}</th>
                                <th class="text-nowrap">PERBELANJAAN {{ $year }}</th>
                                <th class="text-nowrap">KOMITMEN {{ $year }}</th>
                                <th class="text-nowrap">BAKI PERUNTUKAN {{ $year }}</th>
                                <th class="text-nowrap">PIC SUBMISSION STATUS</th>

                                {{-- <th class="text-nowrap">CATATAN</th> --}}
                                {{-- @if (in_array($plan->status,[1, 4, 5, 6])) --}}
                                <th class="text-nowrap"></th>
                                {{-- @endif --}}
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
                                <td class="text-nowrap">{{ strtoupper($plan_form->pro_title) }} </td>
                                <td class="text-nowrap">
                                    @if($plan_form->pro_status == 'active')
                                    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->pro_code }}.{{ getProjectSecondCode($plan_form->pro_code_2) }}
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    {!! $plan_form->main_kpi_details !!}
                                    <br />
                                    {!! $plan_form->kpi_details !!}
                                </td>
                                <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                @php
                                    $total_expenses = $plan_form->plan_form_pic_submission_status == 10 ? $plan_form->total_expenses : 0;
                                    $commitment = $plan_form->plan_form_pic_submission_status == 10 ? $plan_form->plan_form_commitment : 0;
                                    $balance = $plan_form->plan_form_amount - $total_expenses;
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
                                    @if(!$plan_form->plan_form_pic_submission_status)<div class="bg-gray-500 rounded-pill justify-content-center text-white d-flex align-items-center p-1">N/A</div>
                                    @elseif($plan_form->plan_form_pic_submission_status == 8)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                    @elseif($plan_form->plan_form_pic_submission_status == 9)<div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                    @elseif($plan_form->plan_form_pic_submission_status == 10)<div class="bg-theme-9 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                    @elseif($plan_form->plan_form_pic_submission_status == 11)<div class="bg-theme-12 rounded-pill justify-content-center text-white d-flex align-items-center p-1">{{ strtoupper($plan_form->pic_submission_status_label) }}</div>
                                    @endif
                                </td>
                                <td class="text-nowrap text-center">
                                    <div class="d-flex">
                                        <a href="{{ $plan_form->plan_form_declaration_date ? route('dana-ru.senarai-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) : route('dana-ru.senarai-agihan.show', $plan_form->plan_form_id) }}" class="btn btn-sm btn-rounded-primary ms-2"><i class="p-1" data-feather="eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="intro-x bg-gray-300">
                                <td class="text-center" colspan="13">No record.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    
</script>
@endsection
@endcomponent