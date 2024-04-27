@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Tabung Induk @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<x-title >Tabung Induk</x-title>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <a href="{{ route('dana-ru.maintenance.tabung-induk.create') }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>Tabung Induk</a>
        <button class="btn btn-warning me-4" onclick="activate()"><i data-feather="target" class="d-none d-sm-block w-4 h-4 me-2"></i>Activate All</button>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto table-responsive">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">CODE</th>
                            <th class="whitespace-nowrap">NAME</th>
                            <th class="whitespace-nowrap">YEAR</th>
                            <th class="whitespace-nowrap">IS DRAFT?</th>
                            <th class="whitespace-nowrap">STATUS</th>
                            <th class="whitespace-nowrap">CREATED AT</th>
                            <th class="whitespace-nowrap">UPDATED AT</th>
                            <th class="whitespace-nowrap"></th>
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
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/maintenance/tabung-induk",
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'program',name: 'program'},
            {data: 'dmf_code',name: 'dmf_code'},
            {data: 'dmf_name',name: 'dmf_name'},
            {data: 'applied_year',name: 'year'},
            {data: 'draft',name: 'is_draft'},
            {data: 'status_label',name: 'status'},
            {data: 'dmf_created_at',name: 'dmf_created_at'},
            {data: 'dmf_updated_at',name: 'dmf_updated_at'},
            {data: 'action',name: 'action', searchable: false},
            //hidden column
            {data: 'is_draft',name: 'is_draft', visible: false},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,2,4,5,6,7,8]}
        ],
        createdRow: function (row, data, dataIndex) {
            if (!data.program){
                $(row).addClass('bg-theme-6 bg-opacity-20');
            }
            else if (data.is_draft == 1) {
                $(row).addClass('bg-warning bg-opacity-20');
            }
        }
    });

    function activate() {
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/tabung-induk/activate-all';
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

    function deleteData(id) {
        swal({
            title: 'Confirm?',
            text: "Are you sure to delete this data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/maintenance/tabung-induk/delete/'+id;
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