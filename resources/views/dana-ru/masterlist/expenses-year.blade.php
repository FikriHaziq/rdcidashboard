@component("layouts.app")
@slot("module") Masterlist @endslot
@slot("submodule") Expenses @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.masterlist.expenses.year')" :yearOptions="$yearOptions">Perbelanjaan Tahun {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    @if(!$expenses_year->main_fund_status)
    <div class="g-col-12 mb-n6 intro-y">
        <div class="alert alert-warning-soft alert-dismissible fade show d-flex align-items-center" role="alert">
            <i data-feather="archive" class="w-6 h-6 me-2"></i>
            <span>Terdapat beberapa data untuk tabung induk yang belum diproses.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
    </div>
    @endif
    @if(!$expenses_year->project_status)
    <div class="g-col-12 mb-n6 intro-y">
        <div class="alert alert-primary-soft alert-dismissible fade show d-flex align-items-center" role="alert">
            <i data-feather="briefcase" class="w-6 h-6 me-2"></i>
            <span>Terdapat beberapa data untuk projek yang belum diproses.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
    </div>
    @endif
    @if(!$expenses_year->amount_status)
    <div class="g-col-12 mb-n6 intro-y">
        <div class="alert alert-dark-soft alert-dismissible fade show d-flex align-items-center" role="alert">
            <i data-feather="dollar-sign" class="w-6 h-6 me-2"></i>
            <span>Terdapat beberapa data untuk jumlah perbelanjaan yang belum diproses.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
    </div>
    @endif
</div>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <button class="btn btn-warning-soft me-4" onclick="processData('main_fund', {{ $year }})"><i data-feather="upload" class="d-none d-sm-block w-4 h-4 me-2"></i>Tabung Induk</button>
        <button class="btn btn-primary-soft me-4" onclick="processData('project', {{ $year }})"><i data-feather="upload" class="d-none d-sm-block w-4 h-4 me-2"></i>Projek</button>
        <button class="btn btn-dark-soft me-4" onclick="processData('expenses', {{ $year }})"><i data-feather="upload" class="d-none d-sm-block w-4 h-4 me-2"></i>Perbelanjaan</button>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">PUSAT KOS</th>
                            <th class="whitespace-nowrap">JENIS AGIHAN</th>
                            <th class="whitespace-nowrap">PTJ</th>
                            <th class="whitespace-nowrap">PROJECT</th>
                            <th class="whitespace-nowrap">SUB PROJECT</th>
                            <th class="whitespace-nowrap">SODO</th>
                            <th class="whitespace-nowrap">MONTH</th>
                            <th class="whitespace-nowrap">AMOUNT (RM)</th>
                            <th class="whitespace-nowrap">TABUNG INDUK</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    let year = {!! $year !!};
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/masterlist/expenses/year/"+year,
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'pusat_kos',name: 'pusat_kos'},
            {data: 'jenis_agihan',name: 'jenis_agihan'},
            {data: 'ptj',name: 'ptj'},
            {data: 'project',name: 'project'},
            {data: 'sub_project',name: 'sub_project'},
            {data: 'sodo',name: 'sodo'},
            {data: 'month',name: 'month'},
            {data: 'mde_amount',name: 'amount'},
            {data: 'tabung_induk',name: 'tabung_induk'},
        ],
    });

    function processData(type, year) {
        swal({
            title: 'Confirm?',
            text: "Are you sure to process the data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/masterlist/expenses/process/'+ type +'/' + year;
                    swal({
                        title: 'Processing',
                        text: "It might take a few minutes to process.",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                    swal.showLoading();
                }
        })
    }
</script>
@endsection
@endcomponent