@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") User @endslot
@push('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endpush
@slot("content")
<x-title >User</x-title>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        {{-- <a href="{{ route('dana-ru.maintenance.tabung-induk.create') }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>User</a> --}}
    </div>
    <div class="mb-n6 intro-y p-5">
        <div class="alert alert-secondary-soft text-gray-800 alert-dismissible fade show d-flex align-items-center" role="alert">
            <div class="bg-warning bg-opacity-20 w-12 h-4 align-items-center px-2 me-2"></div>
            <span>User yang masih belum disahkan.</span>
        </div>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto table-responsive">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">NAME</th>
                            <th class="whitespace-nowrap">EMAIL</th>
                            <th class="whitespace-nowrap">STAFF ID</th>
                            <th class="whitespace-nowrap">FACULTY</th>
                            <th class="whitespace-nowrap">ROLE</th>
                            <th class="whitespace-nowrap">SYSTEM ROLE</th>
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
@push('custom-js')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/maintenance/user",
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'name',name: 'name'},
            {data: 'email',name: 'email'},
            {data: 'staff_id',name: 'staff_id'},
            {data: 'faculty_code',name: 'faculty_code'},
            {data: 'role_label',name: 'role_radis'},
            {data: 'system_role_label',name: 'role'},
            {data: 'status_label',name: 'status'},
            {data: 'created_at',name: 'created_at'},
            {data: 'updated_at',name: 'updated_at'},
            {data: 'action',name: 'action', searchable: false},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,2,4,5,6,7,8]}
        ],
        createdRow: function (row, data, dataIndex) {
            if (data.status != 'verified'){
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
@endpush
@endcomponent