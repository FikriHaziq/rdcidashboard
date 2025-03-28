@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Project Management Division @endslot
@slot("trimoduleLink") research.management.grasra-appointment @endslot
@slot("trimodule") Grant Appointment Management (GRA/SPB) @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-md-3 col-sm-4">
    {{-- <div class="col-md-3 col-sm-4 d-flex align-items-stretch"> --}}
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-12 box p-5 cursor-pointer zoom-in text-center" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">GRA/SPB Appointment</div>
                <div class="fw-bold fs-lg text-white">1,095</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
        <div class="mb-2"> 
            <select class="tom-select w-full">
                <option>VOT NUMBER</option>
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
                <option>RM NAME</option>
                <option>TEMP</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-md-6 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="4" class="text-right">APP TYPE / APP REF NO</th>
                    </tr>
                    <tr>
                        <th>OFFICER PROCESS STATUS</th>
                        <th>SPB</th>
                        <th>RSG</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="4" class="text-right">APP TYPE / APP REF NO</th>
                    </tr>
                    <tr>
                        <th>CLERK PROCESS STATUS</th>
                        <th>SPB</th>
                        <th>RSG</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                        <th colspan="4" class="text-right">APP TYPE / Record Count</th>
                    </tr>
                    <tr>
                        <th>OFFICER DATE APPROVAL</th>
                        <th>SPB</th>
                        <th>RSG</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                        <th colspan="4" class="text-right">RM NAME / Record Count</th>
                    </tr>
                    <tr>
                        <th>OFFICER DATE APPROVAL</th>
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
@push('custom-js')
@endpush
@endcomponent