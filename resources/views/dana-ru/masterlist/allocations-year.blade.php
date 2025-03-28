@component("layouts.app")
@slot("module") Masterlist @endslot
@slot("submodule") Allocation @endslot
@push('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endpush
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.masterlist.allocation.year')" :yearOptions="$yearOptions">Allocation {{ $year }}</x-title>
<div class="grid columns-12 gap-6">
    @if(!$allocations_year->allocation_main_fund_status)
    <div class="g-col-12 mb-n6 intro-y">
        <div class="alert alert-warning-soft alert-dismissible fade show d-flex align-items-center" role="alert">
            <i data-feather="archive" class="w-6 h-6 me-2"></i>
            <span>Terdapat beberapa data untuk tabung induk yang belum diproses.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
    </div>
    @endif
    @if(!$allocations_year->allocation_dist_fund_status)
    <div class="g-col-12 mb-n6 intro-y">
        <div class="alert alert-primary-soft alert-dismissible fade show d-flex align-items-center" role="alert">
            <i data-feather="briefcase" class="w-6 h-6 me-2"></i>
            <span>Terdapat beberapa tabung agihan yang belum diproses.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
    </div>
    @endif
</div>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <button class="btn btn-warning-soft me-4" onclick="processData('main_fund', 'allocation', {{ $year }})"><i data-feather="upload" class="d-none d-sm-block w-4 h-4 me-2"></i>Tabung Induk</button>
        <button class="btn btn-primary-soft me-4" onclick="processData('dist_fund', 'allocation', {{ $year }})"><i data-feather="upload" class="d-none d-sm-block w-4 h-4 me-2"></i>Tabung Agihan</button>
    </div>
    <div class="mb-n6 intro-y p-5">
        <div class="alert alert-secondary-soft text-gray-800 alert-dismissible fade show d-flex align-items-center" role="alert">
            <div class="bg-warning bg-opacity-20 w-12 h-4 align-items-center px-2 me-2"></div>
            <span>Terdapat beberapa data yang masih belum dikemaskini.</span>
        </div>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">YEAR</th>
                            <th class="whitespace-nowrap">TABUNG INDUK</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">BPKI</th>
                            <th class="whitespace-nowrap">PTJ</th>
                            <th class="whitespace-nowrap">KOD PTJ</th>
                            <th class="whitespace-nowrap">PROJECT</th>
                            <th class="whitespace-nowrap">SUB PROJECT</th>
                            <th class="whitespace-nowrap">JENIS AGIHAN</th>
                            <th class="whitespace-nowrap">EXPENDITURE TYPE</th>
                            <th class="whitespace-nowrap">AMOUNT (RM)</th>
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
@push('custom-js')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    let year = {!! $year !!};
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/masterlist/allocation/year/"+year,
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'year',name: 'year'},
            {data: 'dmf_code',name: 'tabung_induk'},
            {data: 'program',name: 'program'},
            {data: 'bpki',name: 'bpki'},
            {data: 'faculty_short',name: 'ptj'},
            {data: 'faculty_code',name: 'f_original_code'},
            {data: 'project',name: 'project'},
            {data: 'sub_project',name: 'sub_project'},
            {data: 'jenis_agihan',name: 'jenis_agihan'},
            {data: 'expenditure_type',name: 'expenditure_type'},
            {data: 'mda_amount',name: 'amount'},
        ],
        createdRow: function (row, data, dataIndex) {
            if (data.dmf_id && data.dmf_is_draft != 1 && data.dmf_status && data.f_id) {}
            else $(row).addClass('bg-warning bg-opacity-20');          
        }
    });

    function processData(fund_type, type, year) {
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
                    window.location.href = window.location.origin + '/dana-ru/masterlist/process/'+ fund_type +'/' + type +'/' + year;
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
@endpush
@endcomponent