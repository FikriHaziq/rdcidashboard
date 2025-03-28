@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Project Management Division @endslot
@slot("trimoduleLink") research.management.grant @endslot
@slot("trimodule") Grant Management @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-md-3 col-sm-4">
    {{-- <div class="col-md-3 col-sm-4 d-flex align-items-stretch"> --}}
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-12 box p-5 cursor-pointer zoom-in text-center" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">Total Active Grant</div>
                <div class="fw-bold fs-lg text-white">1,256</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>SPONSOR CATEGORY</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>SUBMIT STATUS</option>
                <option>TEMP</option>
            </select>
        </div>
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>RM NAME</option>
                <option>TEMP</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-md-7 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="5" class="text-right">DATE_GENERATE_CC (Year Month) / Reference No</th>
                    </tr>
                    <tr>
                        <th>RM Name</th>
                        <th>Jan 2022</th>
                        <th>Feb 2022</th>
                        <th>Mac 2022</th>
                        <th>Apr 2022</th>
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
    <div class="col-md-5 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Status Proposal</th>
                    <th>Reference No</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-md-7 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="5" class="text-right">DATE_GENERATE_CC (Year Month) / Record Count</th>
                    </tr>
                    <tr>
                        <th>Grant Name</th>
                        <th>Jan 2022</th>
                        <th>Feb 2022</th>
                        <th>Mac 2022</th>
                        <th>Apr 2022</th>
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
    <div class="col-md-5 col-sm-12">
        <div class="box p-3">
            {{-- graph --}}
        </div>
    </div>
</div>
@endslot
@push('custom-js')
@endpush
@endcomponent