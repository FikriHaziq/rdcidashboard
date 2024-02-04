@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Borang Agihan Perbelanjaan @endslot
@section('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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

@endsection
@slot('content')
<x-title hasButton buttonLabel="Lampiran A" :buttonRoute="route('dana-ru.senarai-agihan.show', $plan_form->id)">Borang Agihan {{ $year }}</x-title>
<div class="grid columns-12 gap-6 mt-5 justify-content-center">
    <div class="intro-y box g-col-12">
        <x-dru.tab :tab="$tab" :verificationtab="in_array($plan_form->pic_submission_status, [8,9])" :verificationlabel="$plan_form->pic_status->next_level_desc"/>
        <div class="tab-content" id="pills-tabContent">
            <div class="p-5 tab-pane fade @if(in_array($tab, [null,'list'])) show active @endif" id="list" role="tabpanel" aria-labelledby="list-tab">
                <x-dru.pic-form :year="$year" :plan="$plan" :planform="$plan_form" :edit="$edit" />
            </div>
            @if (in_array($plan_form->pic_submission_status, [8,9]))
            <div class="p-5 tab-pane fade @if(in_array($tab, ['verification'])) show active @endif" id="verification" role="tabpanel" aria-labelledby="verification-tab">
                <div class="intro-y box mt-5">
                    <form action="{{ route('dana-ru.kewangan.perbelanjaan.program.verification.post', $plan_form->id) }}" method="post" id="verification-form">
                        @csrf
                        <div class="px-5 pt-5"> <label for="vertical-form-1" class="form-label">Supporting Document </label> </div>
                        <div class="px-5 pb-5">
                            <input class="filepond" name="file_upload" id="file_upload" type="file" />
                            @error('file_upload')<div class="text-theme-6 mt-2 status-error">{{ $message }}</div>@enderror
                        </div> 
                        <input type="hidden" name="year" value="{{ $plan->year }}">
                        <div class="px-5">
                            <label for="status" class="form-label">Status <span class="text-theme-6">*</span></label>
                            <select id="status" name="status" class="form-select w-1/2 @error('status') border-theme-6 @enderror"> 
                                <option value="" selected>--Sila pilih--</option>
                                @foreach (getStatusOptions($plan_form->pic_submission_status) as $status)
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
                    <table class="table table-bordered mt-6 ">
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
                            @forelse ($plan_form->pic_logs as $i=>$log)
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
</div>

@endslot
@section('custom-js')
@endsection
@endcomponent