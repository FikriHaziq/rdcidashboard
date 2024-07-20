@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@section('custom-css')
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

@endsection
@slot('content')
<x-title>Borang Cadangan Agihan {{ $year }}</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.cadangan-agihan.store', $year) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="mrun">PROGRAM UTAMA</label>
                    </div>
                    <input type="hidden" name="plan_form_id" value="{{ $plan_form->id ?? '' }}">
                    <div class="g-col-9">
                        <select id="mrun" name="mrun" class="form-select @error('mrun') border-theme-6 @enderror" @if(($plan->status ?? 0) == 6) disabled @endif onchange="getProjectList()">
                            <option value="">--Sila pilih--</option>
                            @foreach (getMrunList() as $mrun)
                                <option value="{{ $mrun->id }}" @if((old('mrun') ?? ($plan_form->mrun ?? '')) == $mrun->id) selected @endif>{{ $mrun->code }} - {{ $mrun->description_1 }}</option>
                            @endforeach
                        </select>
                        @error('mrun')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="bpki, #project">SKOP PERBELANJAAN</label>
                    </div>
                    <div class="g-col-9">
                        <select id="bpki" name="bpki" class="form-select @error('bpki') border-theme-6 @enderror" @if(($plan->status ?? 0) == 6) disabled @endif>
                            <option value="">--Sila pilih--</option>
                            @foreach (getBpkiList() as $bpki)
                                <option value="{{ $bpki->id }}" @if((old('bpki') ?? ($plan_form->bpki ?? '')) == $bpki->id) selected @endif>{{ $bpki->code }} - {{ $bpki->description_1 }}</option>
                            @endforeach
                        </select>
                        @error('bpki')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="kp_name">KETUA PROGRAM</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group mb-2 @error('kp_name') border-theme-6 @enderror">
                            <div class="input-group-text">NAMA</div> <input id="kp_name" name="kp_name" type="text" value="{{ old('kp_name') ?? ($plan_form->pic->name ?? '') }}" class="form-control @error('kp_name') border-theme-6 @enderror" placeholder="NAMA KETUA PROGRAM" aria-describedby="kp_name">
                        </div>
                        @error('kp_name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="grid columns-2 gap-3">
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">EMEL</div> <input id="kp_email" name="kp_email" type="text" value="{{ old('kp_email') ?? ($plan_form->pic->email ?? '')  }}" class="form-control @error('kp_email') border-theme-6 @enderror" placeholder="EMEL KETUA PROGRAM" aria-describedby="kp_email">
                                </div>
                                @error('kp_email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">IC</div> <input id="kp_ic" name="kp_ic" type="text" value="{{ old('kp_ic')?? ($plan_form->pic->nric ?? '') }}" class="form-control @error('kp_ic') border-theme-6 @enderror" placeholder="NO. IC KETUA PROGRAM" aria-describedby="kp_ic">
                                </div>
                                @error('kp_ic')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="horizontal-form-1">PEGAWAI BERTANGGUNGJAWAB</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group mb-2">
                            <div class="input-group-text">NAMA</div> <input id="pb_name" name="pb_name" type="text" value="{{ old('pb_name') ?? ($plan_form->member->name ?? '') }}" class="form-control @error('pb_name') border-theme-6 @enderror" placeholder="NAMA PEGAWAI" aria-describedby="pb_name">
                        </div>
                        @error('pb_name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="grid columns-2 gap-3">
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">EMEL</div> <input id="pb_email" name="pb_email" type="text" value="{{ old('pb_email') ?? ($plan_form->member->email ?? '') }}" class="form-control @error('pb_email') border-theme-6 @enderror" placeholder="EMEL PEGAWAI" aria-describedby="pb_email">
                                </div>
                                @error('pb_email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">IC</div> <input id="pb_ic" name="pb_ic" type="text" value="{{ old('pb_ic') ?? ($plan_form->member->nric ?? '') }}" class="form-control @error('pb_ic') border-theme-6 @enderror" placeholder="NO. IC PEGAWAI" aria-describedby="pb_ic">
                                </div>
                                @error('pb_ic')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="ptj">PTJ PIC</label>
                    </div>
                    <div class="g-col-9">
                        <select id="ptj" name="ptj" class="form-select @error('ptj') border-theme-6 @enderror" onchange="getProjectList()">
                            <option value="">--Sila pilih--</option>
                            @foreach (getFaculty2(true) as $faculty)
                                <option value="{{ $faculty->id }}_{{ $faculty->original_code }}" @if((old('ptj') ?? ($plan_form->ptjInputData ?? '')) == ($faculty->id.'_'.$faculty->original_code)) selected @endif>[{{$faculty->original_code}}] {{ $faculty->parameter_name }} - {{ $faculty->description_1 }}</option>
                            @endforeach
                        </select>
                        @error('ptj')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="project">JENIS AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <select id="project" class="@error('project') border-theme-6 @enderror" name="project" placeholder="JENIS AGIHAN" @if(($plan->status ?? 0) == 6) disabled @endif autocomplete="off">
                        </select>
                        @error('project')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="cl_sub">CHARGELINE</label>
                    </div>
                    <div class="g-col-9">
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
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="main_dist">ASAS AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="intro-y overflow-x-auto">
                            <table id="main_dist" class="table table-bordered">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap w-50">ITEM</th>
                                        <th class="text-nowrap">BIL</th>
                                        <th class="text-nowrap">AMAUN (RM)</th>
                                        <th class="text-nowrap">JUMLAH</th>
                                        <th class="text-nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                </tbody>
                                <tfoot class="bg-white">
                                    <tr class="main_dist-footer-add-button intro-x text-center">
                                        <td colspan="5">
                                            <button class="btn btn-outline-primary btn-sm me-1 mb-2" onclick="manageKpiItem('main_dist', 'add')"><i data-feather="plus" class="w-6 h-6 me-1"></i> Tambah</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="kpi">KPI</label>
                    </div>
                    <div class="g-col-9">
                        <div class="intro-y overflow-x-auto">
                            <table id="kpi" class="table table-bordered">
                                <thead class="table-dark border-b-0">
                                    <tr>
                                        <th class="text-nowrap">ITEM</th>
                                        <th class="text-nowrap">BIL</th>
                                        <th class="text-nowrap">AMAUN (RM)</th>
                                        <th class="text-nowrap">TOTAL</th>
                                        <th class="text-nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                </tbody>
                                <tfoot class="bg-white">
                                    <tr class="kpi-footer-add-button intro-x text-center">
                                        <td colspan="5">
                                            <button class="btn btn-outline-primary btn-sm me-1 mb-2" onclick="manageKpiItem('kpi', 'add')"><i data-feather="plus" class="w-6 h-6 me-1"></i> Tambah</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="total_dist">PERUNTUKAN AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="total_dist" name="total_dist" type="text" class="form-control input-mask" readonly data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="note">CATATAN</label>
                    </div>
                    <div class="g-col-9">
                        <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="CATATAN">{{ old('note') ?? ($plan_form->notes ?? '')  }}</textarea>
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.cadangan-agihan.index', $year) }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" form="form_1" class="btn btn-primary">Hantar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    var mainTemplates = {!! json_encode(getKpiTemplate('main')) !!};
    var kpiTemplates = {!! json_encode(getKpiTemplate('kpi')) !!};
    var oldInput = {!! json_encode(($plan_form->kpiInputData ?? null) ?? session()->getOldInput()) !!};
    var plan_status = {!! ($plan->status ?? 0) !!};
    var main_dist = oldInput.main_dist;
    var kpi = oldInput.kpi;
    if (typeof main_dist !== 'undefined') {
        main_dist.forEach(function(value, index) {
            manageKpiItem('main_dist', 'add', null, value, plan_status);
        });
    }
    if (typeof kpi !== 'undefined') {
        kpi.forEach(function(value, index) {
            manageKpiItem('kpi', 'add', null, value);
        });
    }
    // console.log('{!! old('project') ?? ($plan_form->projectInputData ?? '') !!}');
    getProjectList('{!! old('project') ?? ($plan_form->projectInputData ?? '') !!}');
    // getChargeline($('#ptj').val(),'ptj');
    var eventHandler = function(name) {
        return function() {
            getChargeline(arguments[0], 'pro');
        };
    };
    var project_select = new TomSelect("#project",{
        create: true,
        onChange: eventHandler('onChange'),
        sortField: {
            field: "text",
            direction: "asc"
        },
        valueField: 'id',
	    labelField: 'title',
    });

    function getProjectList(selectedValue = null) {
        var program = $("#mrun").val();
        var faculty = $("#ptj").val();
        var oldProject = '';
        if (program && faculty) {
            const faculty_arr = faculty.split('_');
            const faculty_id = faculty_arr[0];
            $.ajax({
                url: "/ajax/getProjectList/" + program + "/" + faculty_id,
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
                                id: val.id + '_' + val.code + '_' + val.code_2 + '_' + val.f_original_code ,
                                title: val.title
                            });
                            if(selectedValue){
                                var selectedValueArr = selectedValue.split('_');
                                if(selectedValueArr.length != 4)optionsData.push({id: selectedValue ,title: selectedValue});
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
        console.log(value)
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
                if(data.length == 4){
                    pro = data[1];
                    sub = data[2];
                    ptj = prependCode(data[3], 7);
                    $('#cl_ptj').val(ptj);
                    $('#cl_pro').val(pro);
                    $('#cl_sub').val(sub);
                    $('#cl_ptj').prop('readonly', true);
                    $('#cl_pro').prop('readonly', true);
                    $('#cl_sub').prop('readonly', true);
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
    function manageKpiItem(table, type, that = null, rawData = null, plan_status = null) {
        add_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square w-6 h-6 me-1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>';
        remove_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-square w-6 h-6 me-1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>';
        big_add_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-6 h-6 me-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>';
        if(type == 'add'){
            var rowCount = $('#'+table+' >tbody >tr:not(".grand-total")').length;
            index = rowCount;
            kpiOptions = '<option value="">--Sila Pilih--</option>';
            edit_main_dist = table == 'main_dist' && plan_status == 6;
            disabled_prop = edit_main_dist ? 'disabled' : '';
            readonly_prop = edit_main_dist ? 'readonly' : '';
            d_none_prop = edit_main_dist ? 'd-none' : '';
            if(table == 'main_dist'){
                mainTemplates.forEach(element => {
                    var _selected = '';
                    if(rawData){
                        if(typeof rawData.item !== 'undefined'){
                            _selected = element.id == rawData.item ? 'selected': '';
                        }
                    }
                    kpiOptions += '<option value="'+element.id+'" '+_selected+'>'+element.title+'</option>';
                });
            }
            else if(table == 'kpi'){
                kpiTemplates.forEach(element => {
                    var _selected = '';
                    if(rawData){
                        if(typeof rawData.item !== 'undefined'){
                            _selected = element.id == rawData.item ? 'selected': '';
                        }
                    }
                    kpiOptions += '<option value="'+element.id+'" '+_selected+'>'+element.title+'</option>';
                });
            }
            var bil_data = '';
            var amount_data = '';
            var total_data = '';
            var id_input = '<input type="hidden" name="'+table+'['+index+'][id]" class="'+table+'_id">';
            if(rawData){
                if(rawData.id) id_input = '<input type="hidden" name="'+table+'['+index+'][id]" class="'+table+'_id" value="'+rawData.id+'">';
                bil_data = typeof rawData.bil !== 'undefined' ? rawData.bil : '';
                amount_data = typeof rawData.amount !== 'undefined' ? rawData.amount : '';
                total_data = typeof rawData.total !== 'undefined' ? rawData.total : '';
            }
            newRowContent = '<tr class="intro-x">'+ id_input +
                                '<td class="text-nowrap"><select name="'+table+'['+index+'][item]" '+disabled_prop+' class="form-select '+table+'_item" placeholder="ASAS AGIHAN">'+kpiOptions+'</select></td>'+
                                '<td class="text-nowrap"><input name="'+table+'['+index+'][bil]" '+readonly_prop+' value="'+bil_data+'" type="number" min="0" class="form-control '+table+'_bil" onchange="calculate(\''+table+'\')"></td>'+
                                '<td class="text-nowrap"><input name="'+table+'['+index+'][amount]" '+readonly_prop+' value="'+amount_data+'" type="text" class="form-control '+table+'_amount input-mask" onchange="calculate(\''+table+'\')" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': false, \'placeholder\': \'0\'"></td>'+
                                '<td class="text-nowrap"><input name="'+table+'['+index+'][total]" value="'+total_data+'" type="text" readonly class="form-control '+table+'_total input-mask" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': false, \'placeholder\': \'0\'"></td>'+
                                '<td class="text-nowrap">'+
                                '<div class="d-flex justify-content-center align-items-center">'+
                                '<a class="d-flex align-items-center text-theme-10 '+d_none_prop+'" style="background-color:white " onclick="manageKpiItem(\''+table+'\', \'add\')">'+add_icon+'</a>'+
                                '<a class="d-flex align-items-center text-theme-6 '+d_none_prop+'" style="background-color:white" onclick="manageKpiItem(\''+table+'\', \'remove\',$(this))">'+remove_icon+'</a>'+
                                '</div></td></tr>';
            if(rowCount == 0){
                $('#'+table+' >tfoot >tr').remove();
                newRowContent += '<tr class="grand-total bg-gray-400 border-b-0">'+
                                    '<td class="text-end" colspan="3">JUMLAH KESELURUHAN (RM)</td>'+
                                    '<td class="text-end">'+
                                        '<input name="'+table+'_grand_total" type="text" value="" disabled class="form-control '+table+'_grand_total input-mask" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true, \'digits\': 2, \'digitsOptional\': false, \'placeholder\': \'0\'">'+
                                    '</td><td></td></tr>';
                $("#"+table+" tbody").append(newRowContent);            
            } 
            else{
                $("#"+table+" tbody tr:last").before(newRowContent);
            }           
            calculate(table);     
            $(".input-mask").inputmask();        
        }
        else if(type == 'remove'){
            that.closest('tr').remove();
            var rowCount = $('#'+table+' >tbody >tr:not(".grand-total")').length;
            if(rowCount == 0){
                $("#"+table+" tbody tr").remove(); 
                footerContent = '<tr class="'+table+'-footer-add-button text-center">'+
                                '<td colspan="5">'+
                                    '<button class="btn btn-outline-primary btn-sm me-1 mb-2" onclick="manageKpiItem(\''+table+'\', \'add\')">'+big_add_icon+' Tambah</button>'+
                                '</td></tr>';
                $('#'+table+' >tfoot').append(footerContent);
            }
            
            $('#'+table+' >tbody >tr:not(".grand-total")').each(function(index) {
                $(this).find('.'+table+'_id').attr('name', table+'['+index+'][id]');
                $(this).find('.'+table+'_item').attr('name', table+'['+index+'][item]');
                $(this).find('.'+table+'_bil').attr('name', table+'['+index+'][bil]');
                $(this).find('.'+table+'_amount').attr('name', table+'['+index+'][amount]');
                $(this).find('.'+table+'_total').attr('name', table+'['+index+'][total]');
            });
        }
    }

    function calculate(table) {
        len = $("#"+table+" tbody ."+table+"_item").length;
        grand_total = 0;
        $("#"+table+" tbody ."+table+"_item").each(function(index) {
            var bil = $("#"+table+" tbody ."+table+"_bil:eq("+index+")").val();
            var amount = parseFloat($("#"+table+" tbody ."+table+"_amount:eq("+index+")").val().replaceAll(',',''));
            var total = bil > 0 ? amount*bil : 0;
            $("#"+table+" tbody ."+table+"_total:eq("+index+")").val(total);
            grand_total += total;
        });
        $("#"+table+" tbody ."+table+"_grand_total").val(grand_total);
        if(table == 'main_dist')$("#total_dist").val(grand_total);
    }

    $('form').bind('submit', function () {
        $('#mrun, #bpki, #project, #main_dist select').prop('disabled', false);
    });
</script>
@endsection
@endcomponent