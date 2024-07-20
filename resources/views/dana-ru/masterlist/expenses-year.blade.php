@component("layouts.app")
@slot("module") Masterlist @endslot
@slot("submodule") Expenses @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<x-title hasYear :year="$year" :route="route('dana-ru.masterlist.expenses.year')" :yearOptions="$yearOptions">Perbelanjaan Tahun {{ $year }}</x-title>
<div class="intro-y box mt-6">
    <div class="mb-n6 intro-y p-5">
        <div class="alert alert-secondary-soft text-gray-800 alert-dismissible fade show d-flex align-items-center" role="alert">
            <div class="bg-theme-6 bg-opacity-20 w-12 h-4 align-items-center px-2 me-2"></div>
            <span>Tabung induk tidak wujud</span>
            <div class="bg-warning bg-opacity-20 w-12 h-4 align-items-center px-2 me-2 ms-8"></div>
            <span>Terdapat data fakulti atau tabung induk yang masih belum dikemaskini.</span>
        </div>
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
            {data: 'faculty_code',name: 'f_original_code'},
            {data: 'project',name: 'project'},
            {data: 'sub_project',name: 'sub_project'},
            {data: 'sodo',name: 'sodo'},
            {data: 'month',name: 'month'},
            {data: 'mde_amount',name: 'amount'},
            {data: 'tabung_induk',name: 'formula_tabung_induk'},
        ],
        createdRow: function (row, data, dataIndex) {
            if(!data.dmf_id) $(row).addClass('bg-theme-6 bg-opacity-20');
            else if (data.dmf_id && data.dmf_is_draft != 1 && data.dmf_status && data.f_id) {}
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
@endsection
@endcomponent