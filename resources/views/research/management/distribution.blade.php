@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Project Management Division @endslot
@slot("trimoduleLink") research.management.rmarm-distribution @endslot
@slot("trimodule") Project Management Report @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-md-3 col-sm-4">
    {{-- <div class="col-md-3 col-sm-4 d-flex align-items-stretch"> --}}
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-12 box p-5 cursor-pointer zoom-in text-center" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">Total Active Grant</div>
                <div class="fw-bold fs-lg text-white">2,656</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>RM NAME</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>GRANT TYPE</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>FACULTY</option>
                <option>TEMP</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="6" class="text-right">RM NAME / PROJECT REF NO</th>
                    </tr>
                    <tr>
                        <th>DATE GENERATE CC</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>Grant Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="6" class="text-right">RM NAME / PROJECT REF NO</th>
                    </tr>
                    <tr>
                        <th>GRANT TYPE</th>
                        <th>-</th>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td></td>
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