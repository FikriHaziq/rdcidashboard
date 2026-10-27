@component("layouts.app")
@slot("module") Carian @endslot
@slot("submodule") Expenses @endslot
@push('custom-css')
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('theme/css/dashboard.css') }}?v=5" rel="stylesheet" />
@endpush
@slot("content")
<div class="intro-y d-flex align-items-center h-10 mt-5">
    <a href="{{ route('dana-ru.carian.index') }}" class="btn btn-filter-back me-3" title="Back to Carian"><i data-feather="arrow-left" class="w-4 h-4"></i></a>
    <h2 class="fs-lg fw-medium truncate me-5">
        EXPENSES
    </h2>
</div>

<form id="search_form" action="{{ route('dana-ru.carian.expenses') }}" method="get">
    <div class="intro-y box dashboard-filter mt-5">
        <div class="filter-header d-flex align-items-center px-5 py-3">
            <i data-feather="filter" class="w-4 h-4 me-2"></i>
            <span class="fw-medium">FILTER</span>
            <span class="range-badge ms-auto">{{ $active_filters ? $active_filters.' active filter'.($active_filters > 1 ? 's' : '') : 'All records' }}</span>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-12 gap-4">
                <div class="g-col-12 g-col-xl-6">
                    <div class="input-group">
                        <div class="input-group-text">TITLE</div>
                        <input id="title" name="title" type="text" value="{{ $search_params->title }}" class="form-control" placeholder="Jenis agihan, e.g. Pengukuhan">
                    </div>
                </div>
                <div class="g-col-6 g-col-xl-2">
                    <div class="input-group">
                        <div class="input-group-text">START YEAR</div>
                        <select id="start_year" name="start_year" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach ($options->years as $year)
                            <option value="{{ $year }}" @if((int)$search_params->start_year === (int)$year) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-6 g-col-xl-2">
                    <div class="input-group">
                        <div class="input-group-text">END YEAR</div>
                        <select id="end_year" name="end_year" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach ($options->years as $year)
                            <option value="{{ $year }}" @if((int)$search_params->end_year === (int)$year) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-xl-2">
                    <div class="input-group">
                        <div class="input-group-text">MONTH</div>
                        <select id="month" name="month" class="form-select bg-white">
                            <option value="">All</option>
                            @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" @if((int)$search_params->month === $m) selected @endif>{{ date('M', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-md-6 g-col-xl-3">
                    <div class="input-group">
                        <div class="input-group-text">PROGRAM</div>
                        <select id="program" name="program" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach (getMrunList() ?? [] as $program)
                            <option value="{{ $program->code }}" @if($search_params->program == $program->code) selected @endif>{{ $program->code }} - {{ $program->description_1 }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-md-6 g-col-xl-3">
                    <div class="input-group">
                        <div class="input-group-text">BPKI</div>
                        <select id="bpki" name="bpki" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach (getBpkiList() ?? [] as $bpki)
                            <option value="{{ $bpki->code }}" @if($search_params->bpki == $bpki->code) selected @endif>{{ $bpki->code }} - {{ $bpki->description_1 }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-md-6 g-col-xl-3">
                    <div class="input-group">
                        <div class="input-group-text">PTJ</div>
                        <select id="ptj" name="ptj" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach ($options->ptj as $ptj)
                            <option value="{{ $ptj->ptj }}" @if($search_params->ptj == $ptj->ptj) selected @endif>{{ $ptj->ptj }}{{ $ptj->name ? ' - '.$ptj->name : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-md-6 g-col-xl-3">
                    <div class="input-group">
                        <div class="input-group-text">SODO</div>
                        <select id="sodo" name="sodo" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach ($options->sodo as $sodo)
                            <option value="{{ $sodo }}" @if($search_params->sodo == $sodo) selected @endif>{{ $sodo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12">
                    <div class="input-group">
                        <div class="input-group-text">CODE</div>
                        <input id="code" name="code" type="text" class="form-control" value="{{ $search_params->code }}" placeholder="Project, e.g. 21A1">
                        <div class="input-group-text input-group-dot">.</div>
                        <input id="code2" name="code2" type="text" class="form-control" value="{{ $search_params->code2 }}" placeholder="Sub project, e.g. 00A00">
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-footer p-4 border-top border-gray-200 dark-border-dark-5 d-flex align-items-center">
            <a href="{{ route('dana-ru.carian.expenses') }}" class="btn btn-filter-reset me-3"><i data-feather="rotate-ccw" class="w-4 h-4 me-1"></i> Reset</a>
            <button type="submit" form="search_form" class="btn btn-filter flex-1"><i data-feather="search" class="w-4 h-4 me-1"></i> Search</button>
        </div>
    </div>
</form>

@include('dana-ru.search.summary', ['total_label' => 'TOTAL EXPENSES', 'records_sub' => 'transactions', 'ptj_sub' => 'with expenses', 'split_title' => 'EXPENSES SPLIT BY BPKI', 'programmes_label' => 'TABUNG INDUK', 'programmes_sub' => 'funds with expenses'])

<div class="intro-y box mt-5">
    <div class="p-5">
        <div class="overflow-x-auto table-responsive">
            <table class="table table-hover compact allocation-table w-full" id="datatable">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">PERIOD</th>
                        <th class="whitespace-nowrap">PUSAT KOS</th>
                        <th class="whitespace-nowrap">TABUNG INDUK</th>
                        <th>JENIS AGIHAN</th>
                        <th class="whitespace-nowrap">PTJ</th>
                        <th class="whitespace-nowrap">SODO</th>
                        <th class="whitespace-nowrap text-end">AMOUNT (RM)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endslot
@push('custom-js')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    var searchParams = @json($search_params);
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [[1, 'desc']],
        pageLength: 25,
        ajax: {
            url: @json(route('dana-ru.carian.expenses')),
            type: 'GET',
            data: function(d) {
                return $.extend(d, searchParams);
            },
            dataSrc: function(json) {
                renderSummary(json.summary);
                return json.data;
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'period', name: 'period', searchable: false},
            {data: 'pusat_kos', name: 'pusat_kos'},
            {data: 'tabung_induk_label', name: 'mde.tabung_induk'},
            {data: 'jenis_agihan', name: 'mde.jenis_agihan'},
            {data: 'faculty_short', name: 'mde.ptj'},
            {data: 'sodo_long', name: 'mde.sodo_long'},
            {data: 'mde_amount', name: 'mde.amount', searchable: false},
        ],
        columnDefs: [
            {className: 'text-center', targets: [0, 1, 2, 3, 5, 6]},
            {className: 'text-end fw-medium whitespace-nowrap', targets: [7]},
        ],
        language: {
            search: '',
            searchPlaceholder: 'Quick search in results...',
        },
    });
</script>
@endpush
@endcomponent
