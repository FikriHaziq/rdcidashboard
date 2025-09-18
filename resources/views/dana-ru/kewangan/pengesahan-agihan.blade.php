@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pengesahan Agihan @endslot
@push('custom-css')
<style>
    .upload-mail {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
    .download-mail {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        right: 35px !important;
    }
</style>

@endpush
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.kewangan.pengesahan-agihan.index')">Pengesahan Agihan {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            @if (!$plans)
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
            <x-dru.infography :year="$year" :plan="$plans" page="summary" />
            @php
                $admin_access = getAccessControl('dru_pa');
                $staff_access = getAccessControl('dru_pa_s');
            @endphp
            <div class="g-col-12 mt-6 box p-5">
                <div class="intro-y d-block d-sm-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        Senarai Agihan
                    </h2>
                    <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                        @if($admin_access)
                        {{-- <a href="" class="btn btn-outline-secondary w-64 position-relative justify-content-start rounded-pill me-4">
                            Template Borang Lampiran A
                            <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="edit" class="w-4 h-4"></i> </span>
                        </a> --}}
                        @if($mail_template)
                        <button class="btn btn-outline-secondary w-72 position-relative justify-content-start rounded-pill me-4">
                            <a href="{{ route('dana-ru.kewangan.mail-template.download', $mail_template->id) }}">{{ $mail_template->filename }}</a>
                            <a href="{{ route('dana-ru.kewangan.mail-template.index', $year) }}" class="w-8 h-8 upload-mail position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5" data-toggle="tooltip" data-tippy-content="Muat naik surat baharu"> <i data-feather="upload" class="w-4 h-4"></i> </a>
                            <a href="{{ route('dana-ru.kewangan.mail-template.download', $mail_template->id) }}" class="w-8 h-8 download-mail position-absolute d-flex justify-content-center align-items-center bg-theme-9 text-white rounded-pill end-0 top-0 bottom-0 my-auto me-0.5" data-toggle="tooltip" data-tippy-content="Muat turun surat"> <i data-feather="download" class="w-4 h-4"></i> </a>
                        </button>
                        @else
                        <a href="{{ route('dana-ru.kewangan.mail-template.index', $year) }}" class="btn btn-outline-secondary w-64 position-relative justify-content-start rounded-pill me-4">
                            Muat Naik Template Surat
                            <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="upload" class="w-4 h-4"></i> </span>
                        </a>
                        @endif
                        @endif
                        @if($plan_forms_count > 0)
                        <button type="submit" form="update-plan-form" class="btn btn-primary me-4" name="type" value="update"> Save ALL UTMFIN Ref. No. </button>
                        @if($admin_access)<button type="submit" form="update-plan-form" class="btn btn-primary" name="type" value="approve"> Approve ALL </button>@endif
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
                                <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                <th class="text-nowrap">PIC DECLARATION STATUS</th>
                                <th class="text-nowrap">DECLARATION REMINDER</th>
                                <th class="text-nowrap">ACTION</th>
                                <th class="text-nowrap">LAMPIRAN A</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <form id="update-plan-form" action="{{ route('dana-ru.kewangan.pengesahan-agihan.post') }}" method="POST">
                                @csrf
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
                                    <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                    <td class="text-nowrap">
                                        @if($plan_form->plan_form_declaration_date)
                                        <div class="bg-theme-10 rounded-pill justify-content-center text-white d-flex align-items-center p-1">DECLARED</div>
                                        @else
                                        <div class="bg-gray-400 rounded-pill justify-content-center text-white d-flex align-items-center p-1">NOT DECLARED</div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <button type="button" onclick="broadcast({{ $plan_form->plan_form_id }})" id="reminder_{{ $plan_form->plan_form_id }}" class="btn btn-sm btn-primary @if($plan_form->plan_form_declaration_date || $plan_form->plan_form_approved == 'N') disabled @endif" data-toggle="tooltip" data-tippy-content="Hantar Emel" onclick=""><i class="p-1" data-feather="mail"></i></button>
                                    </td>
                                    <td class="text-nowrap text-center" style="min-width: 450px">
                                        <div class="grid columns-12 gap-2 align-items-center justify-content-center w-full">
                                            <div class="g-col-9">
                                                <div class="input-group">
                                                    <input type="hidden" name="plan_form_id[]" value="{{ $plan_form->plan_form_id }}">
                                                    <input name="ref_no[]" @if($plan_form->plan_form_approved == 'Y') readonly @endif id="ref_no_{{ $plan_form->plan_form_id }}" type="text" value="{{ $plan_form->plan_form_ref_no }}" class="form-control" placeholder="NO. RUJUKAN PINDAHAN UTMFIN">
                                                    @if($plan_form->plan_form_approved != 'Y')<button type="button" class="input-group-text btn btn-primary" onclick="setRefNo({{ $plan_form->plan_form_id }})">Save</button>@endif
                                                </div>
                                            </div>
                                            <div class="g-col-3">
                                                @if($plan_form->plan_form_approved == 'Y')
                                                <a href="javascript:void(0)" id="approved_{{ $plan_form->plan_form_id }}" class="btn btn-success"><i data-feather="thumbs-up" class="w-4 h-4 me-2"></i> Approved</a>
                                                @else
                                                @if($admin_access)<button type="button" id="approve_{{ $plan_form->plan_form_id }}" class="btn btn-primary @if(!$mail_template) disabled @endif" onclick="approve({{ $plan_form->plan_form_id }})">Approve</button>@endif
                                                <button type="button" id="processing_{{ $plan_form->plan_form_id }}" class="btn btn-primary" style="display: none">Approving <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ms-2"></i></button>
                                                <button type="button" id="approved_{{ $plan_form->plan_form_id }}" class="btn btn-success" style="display: none"><i data-feather="thumbs-up" class="w-4 h-4 me-2"></i> Approved</button>
                                                <button type="button" id="error_{{ $plan_form->plan_form_id }}" class="btn btn-danger" style="display: none" onclick="approve({{ $plan_form->plan_form_id }})"><i data-feather="alert-circle" class="w-4 h-4 me-2"></i> Try Again</button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <a href="{{ route('dana-ru.kewangan.pengesahan-agihan.show', $plan_form->plan_form_id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-tippy-content="Lihat borang" onclick=""><i class="p-1" data-feather="eye"></i></a>
                                        <a href="{{ route('doc-generator.lampiran-a', $plan_form->plan_form_id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-tippy-content="Muat Turun Lampiran A" onclick=""><i class="p-1" data-feather="download"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="intro-x bg-gray-300">
                                    <td class="text-center" colspan="11">No record.</td>
                                </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endslot
@push('custom-js')
<script>
    function setRefNo(id){
        if($('#ref_no_'+id).val() != ''){
            var data = new FormData();
            data.append("plan_id", id);
            data.append("ref_no", $('#ref_no_'+id).val());
            $.ajax({
                url: "/ajax/update-utmfin-refno/",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    toastr_alert('success', 'UTMFIN Ref. No. is successfully update.')
                },
                error: function(data) {
                    toastr_alert('error', 'Something went wrong.')
                }
            });
        }
    }

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
                    $('#reminder_'+id).removeClass('disabled');
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

    function broadcast(id){
        var data = new FormData();
        data.append("plan_id", id);
        $.ajax({
            url: "/ajax/broadcast-email/",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                toastr_alert('success', 'Email has been sent.')
            },
            error: function(data) {
                toastr_alert('error', 'Something went wrong.')
            }
        });
    }
</script>
@endpush
@endcomponent