@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Tabung Agihan @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<x-title >Tabung Agihan</x-title>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <a href="{{ route('dana-ru.maintenance.tabung-agihan.create') }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>Tabung Agihan</a>
        <button class="btn btn-warning me-4" onclick="activate()"><i data-feather="target" class="d-none d-sm-block w-4 h-4 me-2"></i>Activate All</button>
    </div>
    <div class="mb-n6 intro-y p-5">
        <div class="alert alert-secondary-soft text-gray-800 alert-dismissible fade show d-flex align-items-center" role="alert">
            <div class="bg-theme-6 bg-opacity-20 w-12 h-4 align-items-center px-2 me-2"></div>
            <span>Tabung agihan masih belum mempunyai fakulti atau tabung induk.</span>
            <div class="bg-warning bg-opacity-20 w-12 h-4 align-items-center px-2 me-2 ms-8"></div>
            <span>Tabung agihan masih berstatus draft.</span>
        </div>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto table-responsive">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">TITLE</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">FAKULTY</th>
                            <th class="whitespace-nowrap">PROJECT</th>
                            <th class="whitespace-nowrap">SUBPROJECT</th>
                            <th class="whitespace-nowrap">TABUNG INDUK</th>
                            <th class="whitespace-nowrap">MIGRATION STATUS</th>
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
            "url": "/dana-ru/maintenance/tabung-agihan",
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'title',name: 'title'},
            {data: 'program',name: 'program'},
            {data: 'faculty',name: 'f_original_code'},
            {data: 'ddf_code',name: 'ddf_code'},
            {data: 'ddf_code_2',name: 'ddf_code_2'},
            {data: 'tabung_induk',name: 'dmf_code'},
            {data: 'draft',name: 'ddf_is_draft'},
            {data: 'status_label',name: 'ddf_status'},
            {data: 'ddf_created_at',name: 'ddf_created_at'},
            {data: 'ddf_updated_at',name: 'ddf_updated_at'},
            {data: 'action',name: 'action', searchable: false},
            //hidden column
            {data: 'ddf_is_draft',name: 'ddf_is_draft', visible: false},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,3,4,5,6,7,8,9]}
        ],
        createdRow: function (row, data, dataIndex) {
            if (!data.f_code || !data.dmf_code){
                $(row).addClass('bg-theme-6 bg-opacity-20');
            }
            else if (data.ddf_is_draft == 1) {
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/tabung-agihan/activate-all';
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/tabung-agihan/delete/'+id;
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