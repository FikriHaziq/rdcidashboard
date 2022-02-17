@component("dashboard.layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") {{ $module }} @endslot
@section('custom-css')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection
@slot("content")

<!-- BEGIN: Hoverable Table -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto" style="font-size: 20px"><b>Data Management ({{ $module }})</b></h2>
    </div>
    <div class="p-5">
        <form data-single="true" action="/file-upload" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" />
            </div>
            <div class="dz-message" data-dz-message>
                <div class="text-lg font-medium"><b>Drop files here or click to upload.</b></div>
                <div class="text-slate-500">
                    This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded.
                </div>
            </div>
        </form>
    </div>    
    
    <div class="p-5" id="fileStatus" style="display: none">
        <div class="p-5" style="background-color: rgb(186, 243, 179); border-radius: 10px; border: solid 1px rgb(61, 136, 0)">
            <p>File Format is OK. <i</p>
        </div>
    </div>


    <div class="p-5">                         
        <button class="btn btn-warning" onclick="checkFile()">Check</button>
        <button class="btn btn-primary">Upload</button>
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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">FileName</th>
                            <th class="whitespace-nowrap">Uploaded At</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>File_1.xlsx</td>
                            <td>2022-01-31 09:55:28</td>
                            <td>
                                <button class="btn btn-sm btn-success">Selected</button>
                                <button class="btn btn-sm btn-danger">
                                    <i data-feather="trash" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>File_2.xlsx</td>
                            <td>2022-01-30 09:55:28</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Select</button>
                                <button class="btn btn-sm btn-danger">
                                    <i data-feather="trash" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>File_3.xlsx</td>
                            <td>2022-01-29 09:55:28</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Select</button>
                                <button class="btn btn-sm btn-danger">
                                    <i data-feather="trash" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
@endslot
@section('custom-js')
<script>
    function checkFile() {
        $('#fileStatus').show();
    }
</script>
@endsection
@endcomponent