@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Research Overview @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">Total Proposals</div>
                <div class="fw-bold fs-lg text-white">1,256</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>DIVISION</option>
                        <option>TEMP</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>STAFF NAME</option>
                        <option>TEMP</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>FACULTY</option>
                        <option>TEMP</option>
                    </select>
                </div>      
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>GRANT NAME</option>
                        <option>TEMP</option>
                    </select>
                </div>      
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
@endsection
@endcomponent