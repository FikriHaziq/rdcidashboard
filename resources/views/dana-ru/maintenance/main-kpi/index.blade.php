@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Asas Agihan @endslot
@push('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endpush
@slot("content")
<x-title >Asas Agihan</x-title>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <a href="{{ route('dana-ru.maintenance.asas-agihan.create') }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>Asas Agihan</a>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto table-responsive">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">TITLE</th>
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
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/maintenance/asas-agihan",
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'title',name: 'title'},
            {data: 'status_label',name: 'active'},
            {data: 'created_at',name: 'created_at'},
            {data: 'updated_at',name: 'updated_at'},
            {data: 'action',name: 'action', searchable: false},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,2,5]}
        ],
        drawCallback: function(settings) {
            // Re-initialize tooltip after table redraw
            tippy('[data-toggle="tooltip"]');
        }
    });

    function copyToKPI(title) {
        var data = new FormData();
        data.append("title", title);
        $.ajax({
            url: "/ajax/copy-to-kpi/",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                toastr_alert('success', 'KPI telah berjaya disimpan.')
            },
            error: function(data) {
                toastr_alert('error', 'Something went wrong.')
            }
        });
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/asas-agihan/delete/'+id;
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