@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") {{ $module_name }} @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")

<!-- BEGIN: Hoverable Table -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto" style="font-size: 20px"><b>Master List ({{ $module_name }}) [{{ $year }}]</b></h2>
    </div>
       
    <form action="{{ route('data.store') }}" method="post" id="form">
        @csrf
        <div class="p-5">
            <input class="filepond" name="file_upload" id="file_upload" type="file" />
        </div> 
        <input type="hidden" name="module" value="{{ $module }}">
        <input type="hidden" name="year" value="{{ $year }}">
        <div class="p-5" id="fileStatus" style="display: none">
            <div class="p-5" style="background-color: rgb(186, 243, 179); border-radius: 10px; border: solid 1px rgb(61, 136, 0)">
                <p>File Format is OK. </p>
            </div>
        </div>
    </form>

    <div class="p-5">                         
        {{-- <button class="btn btn-warning" onclick="checkFile()">Check</button> --}}
        <button type="submit" form="form" class="btn btn-primary">Upload</button>
    </div>


</div>
<!-- END: Hoverable Table -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto" style="font-size: 20px"><b>File History</b></h2>
    </div>
    <div class="p-5" id="hoverable-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-hover" id="file-table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">FileName</th>
                            <th class="whitespace-nowrap">Year</th>
                            <th class="whitespace-nowrap">Uploaded At</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $file->filename }}</td>
                            <td>{{ $file->year }}</td>
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
<br>
<a class="btn btn-primary" href="{{ route('masterlist.index', $year) }}">Back</a>
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
                    window.location.href = window.location.origin + '/masterlist/import/' + id;
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
            text: "Old data from this masterlist will be removed.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/masterlist/delete/' + id;
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