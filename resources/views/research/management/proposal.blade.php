@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Project Management Division @endslot
@slot("trimoduleLink") research.management.proposal @endslot
@slot("trimodule") Proposal Management @endslot
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-md-3 col-sm-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-12 box p-5 cursor-pointer zoom-in text-center" style="background-color: rgb(249, 206, 63)">
                <div class="fw-medium fs-xs text-white">Total Proposals</div>
                <div class="fw-bold fs-lg text-white">1,256</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
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
    </div>
    <div class="col-md-3 col-sm-4">
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
<div class="intro-y row mt-3">
    <div class="col-md-7 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Grant Name</th>
                    <th>No. of Proposal</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Grand Total</td>
                    <td>1,256</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-5 col-sm-12">
        <div class="box p-3">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Staff Name</th>
                    <th>No. of Applicant</th>
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
@endslot
@push('custom-js')
@endpush
@endcomponent