@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pindahan @endslot
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
        <form id="form_1" action="{{ route('dana-ru.cadangan-agihan.store-transfer-form', $year) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <input type="hidden" name="plan_id" value="{{ $plan->id ?? '' }}">
                <input type="hidden" name="plan_form_id" value="{{ $plan_form->id ?? '' }}">
                <input type="hidden" name="plan_type" id="plan_type" value="{{ $plan->type }}">
                <input type="hidden" name="bpki_id" id="bpki_id" value="{{ $plan_form->bpki ?? '' }}">
                <input type="hidden" name="fund_balance_f" id="fund_balance_f" value="">
                <input type="hidden" name="fund_balance_t" id="fund_balance_t" value="">
                <div class="intro-x w-full">
                    <div class="alert border border-theme-3 fade show d-flex align-items-center d-block" role="alert">
                        <div class="w-full grid columns-12">
                            <div class="d-flex g-col-1 align-items-center justify-content-center">
                                <div class="alert alert-danger mx-1 px-2 my-1 py-1 text-center">From</div>
                            </div>
                            <div class="g-col-11">
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="ptj_f">PTJ</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="ptj_f" name="ptj_f" class="form-select @error('ptj_f') border-theme-6 @enderror" @if($view_mode) disabled @endif onchange="getProjectList('_f')">
                                            <option value="">--Sila pilih--</option>
                                            @foreach (getAvailableFacultyFromPlan($year) as $faculty)
                                                <option value="{{ $faculty->id }}_{{ $faculty->original_code }}" @if((old('ptj_f') ?? ($plan_form->ptjInputData ?? '')) == ($faculty->id.'_'.$faculty->original_code)) selected @endif>[{{$faculty->original_code}}] {{ $faculty->parameter_name }} - {{ $faculty->description_1 }}</option>
                                            @endforeach
                                        </select>
                                        @error('ptj_f')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="project_f">JENIS AGIHAN</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="project_f" class="@error('project_f') border-theme-6 @enderror" name="project_f" @if($view_mode) disabled @endif placeholder="JENIS AGIHAN" @if(($plan->status ?? 0) == 6) disabled @endif autocomplete="off">
                                        </select>
                                        @error('project_f')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="cl_sub_f">CHARGELINE</label>
                                    </div>
                                    <div class="g-col-10">
                                        <div class="input-group">
                                            <div class="input-group-text">Q.</div> 
                                            <input id="cl_ptj_f" name="cl_ptj_f" type="text" readonly class="form-control" aria-describedby="cl_ptj_f">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_pro_f" name="cl_pro_f" type="text" readonly class="form-control" aria-describedby="cl_pro_f">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_sub_f" name="cl_sub_f" type="text" readonly class="form-control" aria-describedby="cl_sub_f">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-x w-full">
                    <div class="alert border border-theme-3 fade show d-flex align-items-center d-block" role="alert">
                        <div class="w-full grid columns-12">
                            <div class="d-flex g-col-1 align-items-center justify-content-center">
                                <div class="alert alert-success mx-1 px-2 my-1 py-1 text-center">To</div>
                            </div>
                            <div class="g-col-11">
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="ptj_t">PTJ</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="ptj_t" name="ptj_t" class="form-select @error('ptj_t') border-theme-6 @enderror" disabled>
                                            <option value="">--Autofilled--</option>
                                            @foreach (getAvailableFacultyFromPlan($year) as $faculty)
                                                <option value="{{ $faculty->id }}_{{ $faculty->original_code }}" @if((old('ptj') ?? ($plan_form->ptjTransferInputData ?? '')) == ($faculty->id.'_'.$faculty->original_code)) selected @endif>[{{$faculty->original_code}}] {{ $faculty->parameter_name }} - {{ $faculty->description_1 }}</option>
                                            @endforeach
                                        </select>
                                        @error('ptj_t')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="project_t">JENIS AGIHAN</label>
                                    </div>
                                    <div class="g-col-10">
                                        <select id="project_t" class="@error('project_t') border-theme-6 @enderror" name="project_t" @if($view_mode) disabled @endif placeholder="JENIS AGIHAN" @if(($plan->status ?? 0) == 6) disabled @endif autocomplete="off">
                                        </select>
                                        @error('project_t')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="grid columns-12 gap-6 mt-2 pb-2">
                                    <div class="g-col-2 d-flex align-items-center justify-content-end">
                                        <label for="cl_sub_t">CHARGELINE</label>
                                    </div>
                                    <div class="g-col-10">
                                        <div class="input-group">
                                            <div class="input-group-text">Q.</div> 
                                            <input id="cl_ptj_t" name="cl_ptj_t" type="text" readonly class="form-control" aria-describedby="cl_ptj_t">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_pro_t" name="cl_pro_t" type="text" readonly class="form-control" aria-describedby="cl_pro_t">
                                            <div class="input-group-text">.</div> 
                                            <input id="cl_sub_t" name="cl_sub_t" type="text" readonly class="form-control" aria-describedby="cl_sub_t">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group w-full mb-4">
                    <div class="input-group-text">JUMLAH PINDAHAN</div>
                    <input id="total_transfer" name="total_transfer" @if($view_mode) disabled @endif value="{{ old('total_transfer') ?? ($plan_form->amount ?? 0) }}" type="text" class="form-control @error('total_transfer') border-theme-6 @enderror input-mask" onchange="chargelineBalanceCheck()" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                </div>
                @error('total_transfer')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                <div class="alert alert-secondary-soft fade show d-flex align-items-center" role="alert">
                    <div class="grid grid-cols-12 gap-3 w-full">
                        <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #ecd0d0;">
                            <div class="fw-medium fs-base text-gray-700">Baki <span id="chargeline_label_f"></span></div>
                            <div class="fw-bold fs-2xl text-gray-700" id="chargeline_balance_f"></div>
                            <div class="fw-bold fs-md text-theme-6" id="transfer_f"></div>
                        </div>
                        <div class="g-col-2 d-flex justify-content-center align-items-center">
                            <i class="w-full h-16" data-feather="arrow-right"></i>
                        </div>
                        <div class="g-col-5 box p-5 cursor-pointer zoom-in" style="background-color: #c8f7d2">
                            <div class="fw-medium fs-base text-gray-700">Baki <span id="chargeline_label_t"></span></div>
                            <div class="fw-bold fs-2xl text-gray-700" id="chargeline_balance_t"></div>
                            <div class="fw-bold fs-md text-theme-10" id="transfer_t"></div>
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
    var selected_f_value = '{!! old("project_f") ?? ($plan_form->projectInputData ?? '') !!}';
    var selected_t_value = '{!! old("project_t") ?? ($plan_form->projectTransferInputData ?? '') !!}';
    getProjectList('_f', selected_f_value);
    getProjectList('_t', selected_t_value);
    var eventHandler = function(name, postfix) {
        return function() {
            getChargeline(arguments[0], 'pro', postfix);
        };
    };
    var project_select_f = new TomSelect("#project_f",{
        onChange: eventHandler('onChange', '_f'),
        sortField: {
            field: "text",
            direction: "asc"
        },
        valueField: 'id',
	    labelField: 'title',
    });

    var project_select_t = new TomSelect("#project_t",{
        onChange: eventHandler('onChange', '_t'),
        sortField: {
            field: "text",
            direction: "asc"
        },
        valueField: 'id',
	    labelField: 'title',
    });

    function getProjectList(id_postfix, selectedValue = null) {
        var program = 0;
        var faculty = $("#ptj"+id_postfix).val();
        // console.log(selectedValue)
        var oldProject = '';
        if (faculty) {
            const faculty_arr = faculty.split('_');
            const faculty_id = faculty_arr[0];
            var url = "/ajax/getProjectList/"+ program +"/" + bpki +"/" + faculty_id + "/" + {!! $year !!};
            if(id_postfix == '_t') {
                url = "/ajax/getProjectList/"+ program +"/" + bpki +"/" + faculty_id;
                // console.log(faculty);
                // console.log(url);
            }
            $.ajax({
                url: url,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if(id_postfix == "_f"){
                        project_select_f.clear();
                        project_select_f.clearOptions();
                        project_select_f.destroy();
                    }
                    else{
                        project_select_t.clear();
                        project_select_t.clearOptions();
                        project_select_t.destroy();
                    }
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
                    console.log(selectedValue);

                    if(id_postfix == "_f"){
                        project_select_f = new TomSelect("#project"+id_postfix,{
                            create: true,
                            onChange: eventHandler('onChange', id_postfix),
                            options: optionsData,
                            searchField: "title",
                            sortField: {
                                field: "text",
                                direction: "asc"
                            },
                            valueField: 'id',
                            labelField: 'title',
                        });
                        project_select_f.addItem(selectedValue);
                    }
                    else {
                        project_select_t = new TomSelect("#project"+id_postfix,{
                            create: true,
                            onChange: eventHandler('onChange', id_postfix),
                            options: optionsData,
                            searchField: "title",
                            sortField: {
                                field: "text",
                                direction: "asc"
                            },
                            valueField: 'id',
                            labelField: 'title',
                        });
                        project_select_t.addItem(selectedValue);
                    }
                },
            });
        } else {
        }
    }

    function getChargeline(value, type, postfix) {
        if(type == 'ptj'){
            data = value.split('_');
            if(data.length > 1){
                ptj = prependCode(data[1], 7);
                $('#cl_ptj'+postfix).val(ptj);
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
                    $('#cl_ptj'+postfix).val(ptj);
                    $('#cl_pro'+postfix).val(pro);
                    $('#cl_sub'+postfix).val(sub);
                    $('#bpki_id').val(bpki);
                    $('#cl_ptj'+postfix).prop('readonly', true);
                    $('#cl_pro'+postfix).prop('readonly', true);
                    $('#cl_sub'+postfix).prop('readonly', true);
                    $('#chargeline_label'+postfix).html("[Q."+ptj+"."+pro+"."+sub+"]");
                    if(postfix == '_f'){
                        $('#ptj_t').val($('#ptj_f').val());
                        if(selected_t_value == '')getProjectList('_t');
                    }

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
                            displayChargelineInfo(balance, postfix);
                            chargelineBalanceCheck();
                        },
                        error: function(err) {
                            
                        }
                    });
                }
                else{
                    data = $('#ptj'+postfix).val().split('_');
                    $('#cl_ptj'+postfix).val('');
                    if(data.length > 1){
                        ptj = prependCode(data[1], 7);
                        $('#cl_ptj'+postfix).val(ptj);
                    }
                    $('#cl_pro'+postfix).val('');
                    $('#cl_sub'+postfix).val('');
                    $('#cl_ptj'+postfix).prop('readonly', true);
                    $('#cl_pro'+postfix).prop('readonly', true);
                    $('#cl_sub'+postfix).prop('readonly', true);
                    $('#chargeline_label'+postfix).html("");
                }
            }
            else{
                $('#cl_ptj'+postfix).val('');
                $('#cl_pro'+postfix).val('');
                $('#cl_sub'+postfix).val('');
                $('#cl_ptj'+postfix).prop('readonly', true);
                $('#cl_pro'+postfix).prop('readonly', true);
                $('#cl_sub'+postfix).prop('readonly', true);
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
        let chargeline_balance_f = parseFloat($('#fund_balance_f').val().replaceAll(',', '')) || 0;
        let chargeline_balance_t = parseFloat($('#fund_balance_t').val().replaceAll(',', '')) || 0;
        let total = parseFloat($('#total_transfer').val().replaceAll(',', '')) || 0;
        let balance_f = chargeline_balance_f-total;
        let sign_f = '-';
        let color_f = 'text-theme-6';
        if(balance_f >= 0) {
            sign_f = '';
            color_f = 'text-gray-700';
        }
        let balance_t = chargeline_balance_t + total;
        let sign_t = '-';
        let color_t = 'text-theme-6';
        if(balance_t >= 0) {
            sign_t = '';
            color_t = 'text-gray-700';
        }
        $('#chargeline_balance_f').html(sign_f + ' RM ' + new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(Math.abs(balance_f)  ));
        $('#chargeline_balance_t').html(sign_t + ' RM ' + new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(Math.abs(balance_t)  ));
        $('#chargeline_balance_f').removeClass('text-gray-700 text-theme-6');
        $('#chargeline_balance_t').removeClass('text-gray-700 text-theme-6');
        $('#chargeline_balance_f').addClass(color_f);
        $('#chargeline_balance_t').addClass(color_t);
        $('#transfer_f').html('( - ' + formatCurrency(total) + ')');
        $('#transfer_t').html('( + ' + formatCurrency(total) + ')');
    }

    function displayChargelineInfo(balance, postfix){
        $('#chargeline_balance'+postfix).html(formatCurrency(balance));
        $('#fund_balance'+postfix).val(balance);
        // if(postfix == "_f"){
        //     $('#chargeline_balance'+postfix).html('( - ' + formatCurrency(balance) + ')');
        // }
        // else{
        //     $('#chargeline_balance'+postfix).html('( + ' + formatCurrency(balance) + ')');
        // }

    }

    function formatCurrency(value){
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'MYR'
        }).format(value).replace('MYR', 'RM');
    }

    $('form').bind('submit', function () {
        $('#project_f, #project_t').prop('disabled', false);
    });
</script>
@endpush
@endcomponent