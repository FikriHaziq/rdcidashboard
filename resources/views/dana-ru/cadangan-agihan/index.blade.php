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
@if ($plan && $request->type != "pengumpulan_dana")<x-dru.plan :year="$year" :plans="$planList" :type="$request->type" />@endif
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
            <x-dru.setFund :year="$year" />
            @else
                <x-dru.infography :year="$year" :plan="$plan" :plans="$planList" :type="$request->type" />
                @if(!($request->type == "agihan_semula" && $planList->where('parent_id', $plan->id)->where('status', '!=', 6)->count() > 0))
                <div class="g-col-12 box">
                    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                        <ul class="nav nav-pills w-full w-lg-1/2  bg-theme-8 bg-opacity-50 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
                            <li class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, [null,'list'])) active @endif" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Senarai Cadangan Agihan</button>
                            </li>
                            @if ((getAccessControl('dru_pca_1') && in_array($plan->status,[2, 3])) || (getAccessControl('dru_pca_2') && in_array($plan->status,[4])))
                            <li class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['verification'])) active @endif" id="verification-tab" data-bs-toggle="pill" data-bs-target="#verification" type="button" role="tab" aria-controls="verification" aria-selected="false">{{ $plan->getStatus->next_level_desc }}</button>
                            </li>
                            @endif
                            <li class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['timeline'])) active @endif" id="timeline-tab" data-bs-toggle="pill" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">Timeline</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="p-5 tab-pane fade @if(in_array($tab, [null,'list'])) show active @endif" id="list" role="tabpanel" aria-labelledby="list-tab">
                            @if($plan->type == 4)
                            <div class="intro-y d-block d-sm-flex align-items-center h-10">
                                <h2 class="fs-lg fw-medium truncate me-5">
                                    Pindahan
                                </h2>
                                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                                    @if (in_array($plan->status,[1, 5]))
                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year, 'plan_id'=>$plan->id]) }}" class="btn btn-primary-soft me-4"> <i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i> Add New </a>
                                    @endif
                                    @if (in_array($plan->status,[1, 5]) && count($plan_forms) > 0)<form id="submission-form" action="{{ route('dana-ru.cadangan-agihan.verification', ['id'=>$plan->id, 'type'=>'submit']) }}" method="POST">@csrf<button type="submit" form="submission-form" class="btn btn-primary"> Submit </button></form>@endif
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
                                            <th class="text-nowrap">PERUNTUKAN AGIHAN {{ $year }}</th>
                                            <th class="text-nowrap">CATATAN</th>
                                            <th class="text-nowrap"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($plan_forms as $i=>$plan_form)
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
                                            @if (getAccessControl('dru_bca') && in_array($plan->status,[1, 5]))
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                                    <a class="d-flex align-items-center text-theme-6" onclick="deleteData({{$plan_form->plan_form_id}})"> <i data-feather="trash-2" class="w-4 h-4 me-1"></i> Delete </a>
                                                </div>
                                            </td>
                                            @elseif(getAccessControl('dru_bca') && in_array($plan->status, [4]))
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                                </div>
                                            </td>
                                            @else
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id, 'view'=> true]) }}" class="d-flex align-items-center text-theme-2"> <i data-feather="eye" class="w-4 h-4 me-1"></i> View </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr class="intro-x bg-gray-300">
                                            <td class="text-center" colspan="11">No record.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @elseif($plan->type == 5)
                            <div class="intro-y d-block d-sm-flex align-items-center h-10">
                                <h2 class="fs-lg fw-medium truncate me-5">
                                    Pengumpulan Data
                                </h2>
                                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                                    @if (in_array($plan->status,[1, 5]))
                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year, 'plan_id'=>$plan->id]) }}" class="btn btn-primary-soft me-4"> <i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i> Add New </a>
                                    @endif
                                    @if (in_array($plan->status,[1, 5]) && count($plan_forms) > 0)<form id="submission-form" action="{{ route('dana-ru.cadangan-agihan.verification', ['id'=>$plan->id, 'type'=>'submit']) }}" method="POST">@csrf<button type="submit" form="submission-form" class="btn btn-primary"> Submit </button></form>@endif
                                </div>
                            </div>
                            <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                                <table class="table table-bordered mt-6 ">
                                    <thead class="table-dark border-b-0">
                                        <tr>
                                            <th class="text-nowrap">No.</th>
                                            <th class="text-nowrap">PTJ</th>
                                            <th class="text-nowrap">JENIS AGIHAN</th>
                                            <th class="text-nowrap">CHARGELINE</th>
                                            <th class="text-nowrap">JUMLAH DANA YANG DIAMBIL</th>
                                            <th class="text-nowrap">CATATAN</th>
                                            <th class="text-nowrap"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($plan_forms as $i=>$plan_form)
                                        <tr class="intro-x">
                                            <td class="text-nowrap">{{ $i+1 }}</td>
                                            <td class="text-nowrap">{{ $plan_form->ptj }}</td>
                                            <td class="text-nowrap">{{ strtoupper($plan_form->ddf_title) }} </td>
                                            <td class="text-nowrap">
                                                @if($plan_form->ddf_status == 'active')
                                                Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }}
                                                @endif
                                            </td>
                                            <td class="text-nowrap">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                            <td style="min-width: 300px">
                                                @if($plan_form->notes)
                                                <b><u>Catatan Umum: </u></b><br />
                                                {!! $plan_form->notes !!}
                                                @endif
                                            </td>
                                            @if (getAccessControl('dru_bca') && in_array($plan->status,[1, 5]))
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                                    <a class="d-flex align-items-center text-theme-6" onclick="deleteData({{$plan_form->plan_form_id}})"> <i data-feather="trash-2" class="w-4 h-4 me-1"></i> Delete </a>
                                                </div>
                                            </td>
                                            @elseif(getAccessControl('dru_bca') && in_array($plan->status, [4]))
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id]) }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                                </div>
                                            </td>
                                            @else
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id, 'view'=> true]) }}" class="d-flex align-items-center text-theme-2"> <i data-feather="eye" class="w-4 h-4 me-1"></i> View </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr class="intro-x bg-gray-300">
                                            <td class="text-center" colspan="11">No record.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="intro-y d-block d-sm-flex align-items-center h-10">
                                <h2 class="fs-lg fw-medium truncate me-5">
                                    Cadangan Agihan
                                </h2>
                                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                                    @if (in_array($plan->status,[1, 5]))
                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year, 'plan_id'=>$plan->id]) }}" class="btn btn-primary-soft me-4"> <i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i> Add New </a>
                                    @endif
                                    @if (count($plan_forms) > 0)
                                    <a href="{{ route('dana-ru.cadangan-agihan.kertas-kerja', $plan->id) }}" class="btn btn-outline-secondary w-56 position-relative justify-content-start rounded-pill me-4">
                                        Jana Kertas Kerja
                                        <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="edit" class="w-4 h-4"></i> </span>
                                    </a>
                                    @endif
                                    @if (in_array($plan->status,[1, 5]) && count($plan_forms) > 0)<form id="submission-form" action="{{ route('dana-ru.cadangan-agihan.verification', ['id'=>$plan->id, 'type'=>'submit']) }}" method="POST">@csrf<button type="submit" form="submission-form" class="btn btn-primary"> Submit </button></form>@endif
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
                                            <th class="text-nowrap"></th>
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
                                            @if (getAccessControl('dru_bca') && in_array($plan->status,[1, 5]))
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
                                            @else
                                            <td class="table-report__action text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('dana-ru.cadangan-agihan.form', ['year'=>$year,'id'=>$plan_form->plan_form_id, 'view'=> true]) }}" class="d-flex align-items-center text-theme-2"> <i data-feather="eye" class="w-4 h-4 me-1"></i> View </a>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr class="intro-x bg-gray-300">
                                            <td class="text-center" colspan="11">No record.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                        @if (in_array($plan->status,[2, 3, 4]))
                        <div class="p-5 tab-pane fade @if(in_array($tab, ['verification'])) show active @endif" id="verification" role="tabpanel" aria-labelledby="verification-tab">
                            <div class="intro-y box mt-5">
                                <form action="{{ route('dana-ru.cadangan-agihan.verification.post') }}" method="post" id="verification-form">
                                    @csrf
                                    <div class="px-5 pt-5"> <label for="vertical-form-1" class="form-label">Cabutan Minit </label> <span class="text-theme-6">*</span> </div>
                                    <div class="px-5 pb-5">
                                        <input class="filepond" name="file_upload" id="file_upload" type="file" />
                                        @error('file_upload')<div class="text-theme-6 mt-2 status-error">{{ $message }}</div>@enderror
                                    </div> 
                                    <input type="hidden" name="year" value="{{ $plan->year }}">
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <div class="px-5">
                                        <label for="status" class="form-label">Status <span class="text-theme-6">*</span></label>
                                        <select id="status" name="status" class="form-select w-1/2 @error('status') border-theme-6 @enderror"> 
                                            <option value="" selected>--Sila pilih--</option>
                                            @foreach (getStatusOptions($plan->status, $plan->type) as $status)
                                            <option value="{{ $status->id }}" @if(old('status') == $status->id) selected @endif>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')<div class="text-theme-6 mt-2 status-error">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="px-5 mt-5">
                                        <label for="comment" class="form-label">Catatan</label>
                                        <textarea class="form-control" name="comment" id="" rows="10" placeholder="Catatan..."></textarea>
                                    </div>
                                </form>
                                <div class="p-5">                         
                                    <button type="submit" form="verification-form" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="p-5 tab-pane fade @if(in_array($tab, ['timeline'])) show active @endif" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="intro-y d-block d-sm-flex align-items-center h-10">
                                <h2 class="fs-lg fw-medium truncate me-5">
                                    Timeline
                                </h2>
                            </div>
                            <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                                <table class="table table-bordered mt-6">
                                    <thead class="table-dark border-b-0">
                                        <tr>
                                            <th class="text-nowrap">NO.</th>
                                            <th class="text-nowrap">STATUS</th>
                                            <th class="text-nowrap">SUPPORTING DOCUMENT</th>
                                            <th class="text-nowrap">CATATAN</th>
                                            <th class="text-nowrap">DISAHKAN OLEH</th>
                                            <th class="text-nowrap">TARIKH</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse ($plan->log as $i=>$log)
                                        <tr class="intro-x">
                                            <td class="text-nowrap">{{ $i+1 }}</td>
                                            <td class="text-nowrap">{{ strtoupper($log->getStatus->description ?? $log->getStatus->name) }}</td>
                                            <td class="text-nowrap">
                                                @foreach ($log->files as $file)
                                                    <a href="{{ route('dana-ru.cadangan-agihan.file.download', $file->id) }}" style="color:blue">{{ $file->filename }}</a>
                                                @endforeach
                                            </td>
                                            <td class="text-nowrap">{{ $log->comment }}</td>
                                            <td class="text-nowrap">{{ strtoupper($log->user->name) }}</td>
                                            <td class="text-nowrap">{{ date($log->created_at) }} <button class="btn btn-sm btn-rounded-primary ms-3">View Log</button></td>
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
                    </div>
                </div>
                @endif
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
</script>   
@endpush
@endcomponent