@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") Project @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<x-title hasYear :year="$year" route="{{ route('dana-ru.maintenance.project') }}" :yearOptions="$yearOptions">Project {{ $year }}</x-title>
<div class="intro-y box mt-6">
    <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
        <a href="{{ route('dana-ru.maintenance.project.create', $year) }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>Project</a>
        <button class="btn btn-warning me-4" onclick="activate()"><i data-feather="target" class="d-none d-sm-block w-4 h-4 me-2"></i>Activate All</button>
        {{-- @if($year != date('Y'))<button class="btn btn-primary-soft me-4" onclick="duplicate({{ date('Y') }})">Duplicate to {{ date('Y') }}</button>@endif --}}
    </div>
    <div class="mb-n6 intro-y p-5">
        <div class="alert alert-secondary-soft text-gray-800 alert-dismissible fade show d-flex align-items-center" role="alert">
            <div class="bg-theme-6 bg-opacity-20 w-12 h-4 align-items-center px-2 me-2"></div>
            <span><a class="btn-link text-theme-10" href="{{ route('dana-ru.maintenance.tabung-induk') }}">Tabung induk</a> perlu dikemaskini.</span>
            <div class="bg-warning bg-opacity-20 w-12 h-4 align-items-center px-2 me-2 ms-8"></div>
            <span>Projek masih berstatus draft.</span>
        </div>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto table-responsive">
                <table class="table table-bordered table-hover compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">YEAR</th>
                            <th class="whitespace-nowrap">TABUNG INDUK</th>
                            <th class="whitespace-nowrap">TITLE</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">PROJECT</th>
                            <th class="whitespace-nowrap">SUBPROJECT</th>
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
    let year = {!! $year !!};
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/maintenance/project/index/"+year,
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'dp_year',name: 'dp_year'},
            {data: 'tabung_induk',name: 'dmf_code'},
            {data: 'title',name: 'title'},
            {data: 'program',name: 'program'},
            {data: 'dp_code',name: 'dp_code'},
            {data: 'dp_code_2',name: 'dp_code_2'},
            {data: 'draft',name: 'dp_is_draft'},
            {data: 'status_label',name: 'dp_status'},
            {data: 'dp_created_at',name: 'dp_created_at'},
            {data: 'dp_updated_at',name: 'dp_updated_at'},
            {data: 'action',name: 'action', searchable: false},
            //hidden column
            {data: 'dp_is_draft',name: 'dp_is_draft', visible: false},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,2,4,5,6,7,8,9,10]}
        ],
        createdRow: function (row, data, dataIndex) {
            if (!data.program || data.dmf_is_draft == 1 || data.dmf_status != "active"){
                $(row).addClass('bg-theme-6 bg-opacity-20');
            }
            else if (data.dp_is_draft == 1) {
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/project/activate-all/'+year;
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

    function duplicate(current_year) {
        swal({
            title: 'Confirm?',
            text: "Are you sure to duplicate this set of data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/maintenance/project/duplicate/'+year+'/'+current_year;
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
                    window.location.href = window.location.origin + '/dana-ru/maintenance/project/delete/'+id;
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