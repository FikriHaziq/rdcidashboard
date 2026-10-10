@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pengumpulan Dana @endslot
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<style>
.ts-control {
    -moz-padding-start: calc(.75rem - 3px);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%232d3748' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E);
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 16px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    color: #2d3748;
    display: block;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.429;
    padding: 0.5rem 2.25rem 0.5rem 0.75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
}
.ts-control input::placeholder{font-size: .875rem; color: #A0AEC0;opacity: 1; /* Firefox */}
.ts-control input::-ms-input-placeholderr{font-size: .875rem; color: #A0AEC0;}
.ts-dropdown {z-index: 100;}
</style>

@endpush
@slot('content')
<x-title>Borang Pindahan {{ $year }}</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-11">
        <form id="form_1" action="{{ route('dana-ru.cadangan-agihan.store-fund-collection-form', $year) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <input type="hidden" name="plan_id" value="{{ $plan->id ?? '' }}">
                <input type="hidden" name="plan_form_id" value="{{ $plan_form->id ?? '' }}">
                <input type="hidden" name="plan_type" id="plan_type" value="{{ $plan->type }}">
                <input type="hidden" name="bpki_id" id="bpki_id" value="{{ $plan_form->bpki ?? '' }}">
                <input type="hidden" name="fund_balance" id="fund_balance" value="">
                <div class="intro-x w-full">
                    <div class="alert border border-theme-3 fade show d-flex align-items-center d-block" role="alert">
                        <div class="w-full grid columns-12">
                            <div class="g-col-12">
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="ptj">PTJ</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="ptj" name="ptj" class="form-select @error('ptj') border-theme-6 @enderror" @if($view_mode) disabled @endif onchange="getProjectList()">
                                            <option value="">--Sila pilih--</option>
                                            @foreach (getFaculty2(true) as $faculty)
                                                <option value="{{ $faculty->id }}_{{ $faculty->original_code }}" @if((old('ptj') ?? ($plan_form->ptjInputData ?? '')) == ($faculty->id.'_'.$faculty->original_code)) selected @endif>[{{$faculty->original_code}}] {{ $faculty->parameter_name }} - {{ $faculty->description_1 }}</option>
                                            @endforeach
                                        </select>
                                        @error('ptj')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="project">JENIS AGIHAN</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="project" class="@error('project') border-theme-6 @enderror" name="project" @if($view_mode) disabled @endif placeholder="JENIS AGIHAN" @if(($plan->status ?? 0) == 6) disabled @endif autocomplete="off">
                                        </select>
                                        @error('project')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="cl_sub">CHARGELINE</label>
                                    </div>
                                    <div class="g-col-10">
                                        <div class="input-group">
                                            <div class="input-group-text">Q.</div> 
                                            <input id="cl_ptj" name="cl_ptj" type="text" readonly class="form-control" aria-describedby="cl_ptj">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_pro" name="cl_pro" type="text" readonly class="form-control" aria-describedby="cl_pro">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_sub" name="cl_sub" type="text" readonly class="form-control" aria-describedby="cl_sub">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-dru.chargeline-balance />
                <div class="input-group w-full mb-4">
                    <div class="input-group-text">JUMLAH PINDAHAN</div>
                    <input id="total_transfer" name="total_transfer" @if($view_mode) disabled @endif value="{{ old('total_transfer') ?? ($plan_form->amount ?? 0) }}" type="text" class="form-control @error('total_transfer') border-theme-6 @enderror input-mask" onchange="chargelineBalanceCheck()" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                </div>
                @error('total_transfer')<div class="text-theme-6 text-end">{{ $message }}</div>@enderror
                <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                    <div class="grid grid-cols-12 gap-3 w-full">
                        <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #fdf9c3;">
                            <div class="fw-medium fs-base text-gray-700">Baki <strong>(Sebelum)</strong></div>
                            <div class="fw-bold fs-2xl text-gray-700 chargeline_balance"></div>
                        </div>
                        <div class="g-col-2 d-flex justify-content-center align-items-center">
                            <i class="w-full h-16" data-feather="arrow-right"></i>
                        </div>
                        <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #c8dff7">
                            <div class="fw-medium fs-base text-gray-700">Baki <strong>(Selepas)</strong> <span id="chargeline_label_t"></span></div>
                            <div class="fw-bold fs-2xl text-gray-700" id="chargeline_balance_t"></div>
                            <div class="fw-bold fs-md text-theme-6" id="transfer_t"></div>
                        </div>
                    </div>
                </div>
                <div class="w-full d-flex my-4">
                    <label for="note">CATATAN</label>
                </div>
                <div class="w-full">
                    <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="CATATAN" @if($view_mode) disabled @endif>{{ old('note') ?? ($plan_form->notes ?? '')  }}</textarea>
                </div>
                @if(!$view_mode && in_array($plan->status, [1,4,5,6]))
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.cadangan-agihan.index', ["year"=>$year,"type"=>getPlanType($plan->type),"plan_id"=>$plan->id]) }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" form="form_1" class="btn btn-primary">Hantar</button>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>

<x-dru.set-kpi />
@endslot
@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>
{{-- <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> --}}
<script>
    var plan_status = {!! ($plan->status ?? 0) !!};
    var plan_type = {!! ($plan->type ?? 0) !!};
    var view_mode = {!! ($view_mode ?? 0) !!};
    var bpki =  {!! ($plan_form->bpki ?? 0) !!};
    getProjectList('{!! old("project") ?? ($plan_form->projectInputData ?? '') !!}');
    var eventHandler = function(name) {
        return function() {
            getChargeline(arguments[0], 'pro');
        };
    };
    var project_select = new TomSelect("#project",{
        create: true,
        onChange: eventHandler('onChange', ''),
        sortField: {
            field: "text",
            direction: "asc"
        },
        valueField: 'id',
	    labelField: 'title',
    });

    function getProjectList(selectedValue = null) {
        var program = 0;
        var faculty = $("#ptj").val();
        var oldProject = '';
        if (faculty) {
            const faculty_arr = faculty.split('_');
            const faculty_id = faculty_arr[0];
            $.ajax({
                url: "/ajax/getProjectList/"+ program +"/" + bpki +"/" + faculty_id,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    project_select.clear();
                    project_select.clearOptions();
                    project_select.destroy();
                    optionsData = [];
                    if (res.result.length > 0) {
                        $.each(res.result, function(i, val) {
                            optionsData.push({
                                id: val.id + '_' + val.code + '_' + val.code_2 + '_' + val.f_original_code + '_' + val.bpki_id ,
                                title: val.title
                            });
                            if(selectedValue){
                                var selectedValueArr = selectedValue.split('_');
                                if(selectedValueArr.length != 5)optionsData.push({id: selectedValue ,title: selectedValue});
                            }
                        });
                    }
                    project_select = new TomSelect("#project",{
                        create: true,
                        onChange: eventHandler('onChange'),
                        options: optionsData,
                        searchField: "title",
                        sortField: {
                            field: "text",
                            direction: "asc"
                        },
                        valueField: 'id',
                        labelField: 'title',
                    });
                    project_select.addItem(selectedValue);
                },
            });
        } else {
        }
    }

    function getChargeline(value, type) {
        if(type == 'ptj'){
            data = value.split('_');
            if(data.length > 1){
                ptj = prependCode(data[1], 7);
                $('#cl_ptj').val(ptj);
            }
        }
        else if(type == 'pro'){
            if(value.length > 0){
                data = value.split('_');
                if(data.length == 5){
                    pro = data[1];
                    sub = data[2];
                    ptj = prependCode(data[3], 7);
                    bpki = data[4];
                    $('#cl_ptj').val(ptj);
                    $('#cl_pro').val(pro);
                    $('#cl_sub').val(sub);
                    $('#bpki_id').val(bpki);
                    $('#cl_ptj').prop('readonly', true);
                    $('#cl_pro').prop('readonly', true);
                    $('#cl_sub').prop('readonly', true);
                    $('#chargeline_label').html("[Q."+ptj+"."+pro+"."+sub+"]");
                    let formData = new FormData();
                    formData.append("main_fund_id", data[0]);
                    formData.append("ptj_code", data[3]);
                    $.ajax({
                        url: "/ajax/get-balance-by-chargeline/",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            let balance = res.total_allocation - res.total_expenses;
                            displayChargelineInfo(balance, res.total_allocation, res.total_expenses);
                            displayBalanceBefore(balance);
                            chargelineBalanceCheck();
                        },
                        error: function(err) {
                            
                        }
                    });
                }
                else{
                    data = $('#ptj').val().split('_');
                    $('#cl_ptj').val('');
                    if(data.length > 1){
                        ptj = prependCode(data[1], 7);
                        $('#cl_ptj').val(ptj);
                    }
                    $('#cl_pro').val('');
                    $('#cl_sub').val('');
                    $('#cl_ptj').prop('readonly', true);
                    $('#cl_pro').prop('readonly', true);
                    $('#cl_sub').prop('readonly', true);
                    $('#chargeline_label').html("");
                }
            }
            else{
                $('#cl_ptj').val('');
                $('#cl_pro').val('');
                $('#cl_sub').val('');
                $('#cl_ptj').prop('readonly', true);
                $('#cl_pro').prop('readonly', true);
                $('#cl_sub').prop('readonly', true);
            }
        }
    }

    function prependCode(str,length){
        res = str;
        for (let i = 0; i < length - str.length; i++) {
            res += '0';
        }
        return res;
    }

    $(".input-mask").inputmask(); 

    function chargelineBalanceCheck() {
        let chargeline_balance = parseFloat($('#fund_balance').val().replaceAll(',', '')) || 0;
        let total = parseFloat($('#total_transfer').val().replaceAll(',', '')) || 0;
        let balance = chargeline_balance-total;
        let sign = '-';
        let color = 'text-theme-6';
        if(balance >= 0) {
            sign = '';
            color = 'text-gray-700';
        }
        $('#chargeline_balance_t').html(sign + ' RM ' + new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(Math.abs(balance)  ));
        $('#chargeline_balance_t').removeClass('text-gray-700 text-theme-6');
        $('#chargeline_balance_t').addClass(color);
        $('#transfer_t').html('( - ' + formatCurrency(total) + ')');
    }

    function displayBalanceBefore(balance){
        $('.chargeline_balance').html(formatCurrency(balance));
    }

    $('form').bind('submit', function () {
        $('#project').prop('disabled', false);
    });
</script>
@endpush
@endcomponent