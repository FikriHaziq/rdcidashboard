@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pengesahan Agihan @endslot
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.kewangan.pengesahan-agihan.index')">Pengesahan Agihan {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            <!-- BEGIN: Notification -->
            {{-- <div class="g-col-12 mt-6 mb-n6 intro-y">
                <div class="alert alert-warning-soft alert-dismissible fade show d-flex align-items-center mb-6" role="alert">
                    <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
                    <span>Sila hantar sebelum 30 Mac {{ $year }}.</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
                </div>
            </div> --}}
            <!-- BEGIN: Notification -->
            @if (!$plan)
            <div class="g-col-12 mt-6 mb-n6 intro-y">
                <div class="alert alert-secondary-soft alert-dismissible fade show d-flex align-items-center mb-6" role="alert">
                    <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
                    <span>No Record..</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
                </div>
            </div>
            @else
            @if($plan_forms_count > 0)
            <div class="g-col-12 mt-6 mb-n6 intro-y">
                <div class="alert alert-warning-soft alert-dismissible fade show d-flex align-items-center mb-6" role="alert">
                    <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
                    <span>Terdapat {{ $plan_forms_count }} agihan yang masih belum disahkan.</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
                </div>
            </div>
            @endif
            <x-dru.infography :year="$year" :plan="$plan" />
            <div class="g-col-12 mt-6 box p-5">
                <div class="intro-y d-block d-sm-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        Senarai Agihan
                    </h2>
                    <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                        <a href="" class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill me-4">
                            Borang Lampiran A
                            <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="download" class="w-4 h-4"></i> </span>
                        </a>
                        <form id="submission-form" action="#" method="POST">@csrf<button type="submit" form="submission-form" class="btn btn-primary"> Broadcast </button></form>
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
                                <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                <th class="text-nowrap">ACTION</th>
                                <th class="text-nowrap">LAMPIRAN A</th>
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
                                {{-- <td class="text-nowrap">
                                    {!! $plan_form->main_kpi_details !!}
                                    <br />
                                    {!! $plan_form->kpi_details !!}
                                </td> --}}
                                <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                
                                <td class="text-nowrap text-center" style="min-width: 440px">
                                    <div class="grid columns-12 gap-2 align-items-center justify-content-center w-full">
                                        <div class="g-col-9"><input id="ref_no_{{ $plan_form->plan_form_id }}" type="text" value="{{ $plan_form->plan_form_ref_no }}" class="form-control form-control-sm" placeholder="NO. RUJUKAN"></div>
                                        <div class="g-col-3">
                                            <button id="approve_{{ $plan_form->plan_form_id }}" class="btn btn-sm btn-primary" onclick="approve({{ $plan_form->plan_form_id }})">{{ $plan_form->plan_form_ref_no ? 'Update' : 'Approve' }}</button>
                                            <button id="processing_{{ $plan_form->plan_form_id }}" class="btn btn-sm btn-primary" style="display: none">Approving <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ms-2"></i></button>
                                            <button id="approved_{{ $plan_form->plan_form_id }}" class="btn btn-sm btn-success" style="display: none"><i data-feather="thumbs-up" class="w-4 h-4 me-2"></i> {{ $plan_form->plan_form_ref_no ? 'Updated' : 'Approved' }}</button>
                                            <button id="error_{{ $plan_form->plan_form_id }}" class="btn btn-sm btn-danger" style="display: none" onclick="approve({{ $plan_form->plan_form_id }})"><i data-feather="alert-circle" class="w-4 h-4 me-2"></i> Try Again</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-nowrap text-center">
                                    <a href="{{ route('doc-generator.lampiran-a', $plan_form->plan_form_id) }}" class="btn btn-sm btn-dark" onclick=""><i class="p-1" data-feather="download"></i></a>
                                </td>
                                {{-- @if (getAccessControl('dru_bca') && in_array($plan->status,[1, 5]))
                                <td class="table-report__action text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                        <a class="d-flex align-items-center text-theme-6" onclick="deleteData({{$plan_form->plan_form_id}})"> <i data-feather="trash-2" class="w-4 h-4 me-1"></i> Delete </a>
                                    </div>
                                </td>
                                @elseif(getAccessControl('dru_bca') && in_array($plan->status, [4,6]))
                                <td class="table-report__action text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                    </div>
                                </td>
                                @endif --}}
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
            @endif
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    function approve(id){
        if($('#ref_no_'+id).val() != ''){
            $('#ref_no_'+id).removeClass('border-theme-6');
            $('#approve_'+id).hide();
            $('#approved_'+id).hide();
            $('#error_'+id).hide();
            $('#processing_'+id).show();
            var data = new FormData();
            data.append("plan_id", id);
            data.append("ref_no", $('#ref_no_'+id).val());
            console.log(data);
            $.ajax({
                url: "/ajax/approve-distribution-plan/",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $('#processing_'+id).hide();
                    $('#approved_'+id).show();
                },
                error: function(data) {
                    $('#processing_'+id).hide();
                    $('#error_'+id).show();
                }
            });
        }
        else {
            $('#ref_no_'+id).addClass('border-theme-6');
        }
    }
</script>
@endsection
@endcomponent