@component("layouts.app")
@slot("module") Masterlist @endslot
@slot("submodule") Expenses @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        MASTERLIST (EXPENSES)
    </h2>
</div>
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto" style="font-size: 20px"><b>Upload Masterlist</b></h2>
    </div>
       
    <form action="{{ route('data.store') }}" method="post" id="form">
        @csrf
        <div class="p-5">
            <input class="filepond" name="file_upload" id="file_upload" type="file" />
        </div> 
        <input type="hidden" name="module" value="expenses">
        <input type="hidden" name="year" value="{{ date('Y') }}">
        <input type="hidden" name="migration" value="{{ date('ymdhms') }}">
        <div class="p-5" id="fileStatus" style="display: none">
            <div class="p-5" style="background-color: rgb(186, 243, 179); border-radius: 10px; border: solid 1px rgb(61, 136, 0)">
                <p>File Format is OK. </p>
            </div>
        </div>
    </form>

    <div class="p-5">                         
        <button type="submit" form="form" class="btn btn-primary">Upload</button>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-hover" id="file-table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">FileName</th>
                            <th class="whitespace-nowrap">Uploaded At</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $file->filename }}</td>
                            <td>{{ date('d/m/Y h:m:s', strtotime($file->created_at)) }}</td>
                            <td>
                                @if($file->status == 'selected')
                                <a class="btn btn-sm btn-success" id="file_{{$file->id}}">Imported</a>
                                @else
                                <a onclick="selectData({{$file->id}})" class="btn btn-sm btn-info" id="file_{{$file->id}}">Import Now</a>
                                @endif
                                <a onclick="deleteData({{$file->id}})" class="btn btn-sm btn-danger">
                                    <i data-feather="trash" class="w-4 h-4"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
    <div class="text-gray-800 fw-medium">Migration Data</div>
</div>
<div class="pos intro-y grid columns-12 gap-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y g-col-12 g-col-lg-12 mb-5">
        <div class="grid grid-cols-12 gap-5">
            @foreach ($migration_years as $migration_year)
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                @if ($migration_year->main_fund_status)
                <a href="{{ route('dana-ru.masterlist.expenses.year', $migration_year->year) }}" class="btn btn-success-soft h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $migration_year->year }}</div>
                    </div>
                    <div class="@if($migration_year->main_fund_status) text-theme-9 @else text-theme-6 @endif tooltip" title="Tabung Induk"><i data-feather="archive" class="w-6 h-6"></i></div>
                </a>
                @else
                <a href="{{ route('dana-ru.masterlist.expenses.year', $migration_year->year) }}" class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                        <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $migration_year->year }}</div>
                    </div>
                    <div class="@if($migration_year->main_fund_status) text-theme-9 @else text-theme-6 @endif tooltip" title="Tabung Induk"><i data-feather="archive" class="w-6 h-6"></i></div>
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="file_upload"]');

    // Create a FilePond instance
    const options = {
        labelIdle: `Drag & Drop masterlist or <span class="filepond--label-action">Browse</span>`,
        allowFileTypeValidation: true,
        maxFileSize: '30MB'
      };
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    const pond = FilePond.create(inputElement, options);
    
    FilePond.setOptions({
        server: {
            url: '/data/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            // process: {
            //     url: './process',
            //     method: 'POST',
            //     headers: {
            //         'x-customheader': 'Hello World',
            //     },
            //     withCredentials: false,
            //     onload: (response) => response.key,
            //     onerror: (response) => response.data,
            //     ondata: (formData) => {
            //         formData.append('Hello', 'World');
            //         return formData;
            //     },
            // },
            // revert: './revert',
            // restore: './restore/',
            // load: './load/',
            // fetch: './fetch/',
        },
    });

    function selectData(id) {
        swal({
            title: 'Are you sure to import?',
            text: "Old data from previous masterlist will be replaced.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, import it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/masterlist/expenses/import/' + id;
                    swal({
                        title: 'Importing',
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
            title: 'Are you sure to delete?',
            text: "all migrated datas from this file will be removed.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/masterlist/expenses/delete/' + id;
                    swal({
                        title: 'Deleting',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                    swal.showLoading();
                }
        })
    }

    $('#file-table').DataTable();

    function checkFile() {
        $('#fileStatus').show();
    }
</script>
@endsection
@endcomponent