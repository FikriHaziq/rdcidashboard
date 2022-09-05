@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Project Management Division @endslot
@slot("trimoduleLink") research.management.activity @endslot
@slot("trimodule") Grant Activity Management @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-md-3 col-sm-4">
    {{-- <div class="col-md-3 col-sm-4 d-flex align-items-stretch"> --}}
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-12 box p-5 cursor-pointer zoom-in text-center" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">Total Active Grant</div>
                <div class="fw-bold fs-lg text-white">521</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>RM</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>ACTIVITY TYPE</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>GRANT TYPE</option>
                <option>TEMP</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-12">
        <div class="box p-3">
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="5" class="text-right">ARM / Total Application</th>
                    </tr>
                    <tr>
                        <th>ARM DATE APPROVAL</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
@endsection
@endcomponent