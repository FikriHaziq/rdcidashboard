@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Borang Agihan Perbelanjaan @endslot
@section('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="{{ asset('theme/css/borang-agihan.css') }}" rel="stylesheet">

@endsection
@slot('content')
<x-title hasButton buttonLabel="Lampiran A" :buttonRoute="route('dana-ru.senarai-agihan.show', $plan_form->id)">Borang Agihan {{ $year }}</x-title>
<div class="grid columns-12 gap-6 mt-5 justify-content-center">
    <div class="intro-y box g-col-12">
        <x-dru.tab :tab="$tab" />
        <div class="tab-content" id="pills-tabContent">
            <div class="p-5 tab-pane fade @if(in_array($tab, [null,'list'])) show active @endif" id="list" role="tabpanel" aria-labelledby="list-tab">
                <x-dru.pic-form :year="$year" :plan="$plan" :planform="$plan_form" :edit="$edit" />
            </div>
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