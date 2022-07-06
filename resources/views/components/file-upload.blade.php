@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") {{ $module }} @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="http://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")

<!-- BEGIN: Hoverable Table -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto" style="font-size: 20px"><b>Data Management ({{ $module }})</b></h2>
    </div>
       
    <form action="{{ route('data.store') }}" method="post" id="form">
        @csrf
        <div class="p-5">
            <input class="filepond" name="file_upload" id="file_upload" type="file" />
        </div> 
        <input type="hidden" name="module" value="{{ $module_code }}">
        <div class="p-5" id="fileStatus" style="display: none">
            <div class="p-5" style="background-color: rgb(186, 243, 179); border-radius: 10px; border: solid 1px rgb(61, 136, 0)">
                <p>File Format is OK. </p>
            </div>
        </div>
    </form>

    <div class="p-5">                         
        <button class="btn btn-warning" onclick="checkFile()">Check</button>
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
                                <button class="btn btn-sm btn-success" id="file_{{$file->id}}">Selected</button>
                                @else
                                <button class="btn btn-sm btn-info" id="file_{{$file->id}}" onclick="selectData({{$file->id}})">Select</button>
                                @endif
                                <button class="btn btn-sm btn-danger">
                                    <i data-feather="trash" class="w-4 h-4"></i>
                                </button>
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
<a class="btn btn-primary" href="{{ route($path) }}">Back</a>
@endslot
@section('custom-js')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="file_upload"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);

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
        alert(id);
        $.ajax({
            url: "/ajax/select/data/"+id,
            cache: false,
            contentType: false,
            processData: false,
            type: "get",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if(res.status == true) {
                    location.reload();
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    $('#file-table').DataTable();

    function checkFile() {
        $('#fileStatus').show();
    }
</script>
@endsection
@endcomponent