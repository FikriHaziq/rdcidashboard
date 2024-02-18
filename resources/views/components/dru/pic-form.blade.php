<form id="form_1" action="{{ route('dana-ru.senarai-agihan.kpi-update', $plan_form->id) }}" method="post">
@csrf
    <div class="row gap-y-6 mt-5 justify-content-center">
        <div class="intro-y col-12 col-xl-8">
            <div class="intro-y p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="mrun">PROGRAM UTAMA</label>
                    </div>
                    <input type="hidden" name="plan_form_id" value="{{ $plan_form->id ?? '' }}">
                    <div class="g-col-9">
                        <select id="mrun" name="mrun" class="form-select @error('mrun') border-theme-6 @enderror" disabled onchange="getProjectList()">
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
                        <select id="bpki" name="bpki" class="form-select @error('bpki') border-theme-6 @enderror" disabled>
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
                            <div class="input-group-text">NAMA</div> <input id="kp_name" name="kp_name" type="text" value="{{ old('kp_name') ?? ($plan_form->pic->name ?? '') }}" class="form-control @error('kp_name') border-theme-6 @enderror" readonly placeholder="NAMA KETUA PROGRAM" aria-describedby="kp_name">
                        </div>
                        @error('kp_name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="grid columns-2 gap-3">
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">EMEL</div> <input id="kp_email" name="kp_email" type="text" value="{{ old('kp_email') ?? ($plan_form->pic->email ?? '')  }}" class="form-control @error('kp_email') border-theme-6 @enderror" readonly placeholder="EMEL KETUA PROGRAM" aria-describedby="kp_email">
                                </div>
                                @error('kp_email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">IC</div> <input id="kp_ic" name="kp_ic" type="text" value="{{ old('kp_ic')?? ($plan_form->pic->nric ?? '') }}" class="form-control @error('kp_ic') border-theme-6 @enderror" readonly placeholder="NO. IC KETUA PROGRAM" aria-describedby="kp_ic">
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
                            <div class="input-group-text">NAMA</div> <input id="pb_name" name="pb_name" type="text" value="{{ old('pb_name') ?? ($plan_form->member->name ?? '') }}" class="form-control @error('pb_name') border-theme-6 @enderror" readonly placeholder="NAMA PEGAWAI" aria-describedby="pb_name">
                        </div>
                        @error('pb_name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        <div class="grid columns-2 gap-3">
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">EMEL</div> <input id="pb_email" name="pb_email" type="text" value="{{ old('pb_email') ?? ($plan_form->member->email ?? '') }}" class="form-control @error('pb_email') border-theme-6 @enderror" readonly placeholder="EMEL PEGAWAI" aria-describedby="pb_email">
                                </div>
                                @error('pb_email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                            </div>
                            <div class="g-col-1">
                                <div class="input-group">
                                    <div class="input-group-text">IC</div> <input id="pb_ic" name="pb_ic" type="text" value="{{ old('pb_ic') ?? ($plan_form->member->nric ?? '') }}" class="form-control @error('pb_ic') border-theme-6 @enderror" readonly placeholder="NO. IC PEGAWAI" aria-describedby="pb_ic">
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
                        <select id="ptj" name="ptj" class="form-select @error('ptj') border-theme-6 @enderror" onchange="getChargeline($(this).val(),'ptj')" disabled>
                            <option value="">--Sila pilih--</option>
                            @foreach (getFaculty2(true) as $faculty)
                                <option value="{{ $faculty->id }}_{{ $faculty->original_code }}" @if((old('ptj') ?? ($plan_form->ptjInputData ?? '')) == ($faculty->id.'_'.$faculty->original_code)) selected @endif>{{ $faculty->parameter_name }} - {{ $faculty->description_1 }}</option>
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
                        <select id="project" class="@error('project') border-theme-6 @enderror" name="project" placeholder="JENIS AGIHAN" disabled autocomplete="off">
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
                                            No Record
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
                                            No Record
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="total_dist">JUMLAH KESELURUHAN AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="total_dist" name="total_dist" type="text" class="form-control input-mask" readonly data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
                <div class="grid columns-12 gap-6 mt-3 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="mykpi">KPI YANG TELAH DICAPAI</label>
                    </div>
                    <div class="g-col-9">
                        <div class="intro-y overflow-x-auto">
                            <table id="mykpi" class="table table-bordered">
                                <thead class="table-primary border-b-0">
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
                                    <tr class="mykpi-footer-add-button intro-x text-center">
                                        <td colspan="5">
                                            @if($edit)<button class="btn btn-outline-primary btn-sm me-1 mb-2" onclick="manageKpiItem('mykpi', 'add')"><i data-feather="plus" class="w-6 h-6 me-1"></i> Tambah</button>
                                            @else No Record
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @error('mykpi')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="total_fund">JUMLAH KESELURUHAN AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="total_fund" name="total_fund" type="text" class="form-control input-mask" readonly data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="total_expenses" class="text-end">JUMLAH KESELURUHAN PERBELANJAAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="total_expenses" name="total_expenses" type="text" class="form-control input-mask text-theme-10" readonly data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                            <div class="input-group-text percent">%</div>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="commitment" class="text-end">KOMITMEN</label>
                    </div>
                    <div class="g-col-9">
                        <p class="text-theme-1 "><i>*Adakah baki dana mempunyai komitmen? Jika ya, sila isi ruang ini.</i></p>
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="commitment" name="commitment" value="{{ old('commitment') ?? $plan_form->commitment }}" oninput="calculate('mykpi')" type="text" class="form-control input-mask text-theme-2" @if(!$edit) readonly @endif data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                            <div class="input-group-text percent">%</div>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="balance">BAKI AGIHAN</label>
                    </div>
                    <div class="g-col-9">
                        <div class="input-group">
                            <div class="input-group-text">RM</div> <input id="balance" name="balance" type="text" class="form-control input-mask" readonly data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                            <div class="input-group-text percent">%</div>
                        </div>
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="justification">JUSTIFIKASI PERBELANJAAN</label>
                    </div>
                    <div class="g-col-9">
                        <textarea class="form-control @error('justification') border-theme-6 @enderror" @if(!$edit) readonly @endif name="justification" id="justification" cols="30" rows="10" placeholder="Justifikasi perbelanjaan">{{ old('justification') ?? ($plan_form->pic_justification ?? '')  }}</textarea>
                        @error('justification')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 mt-2 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="file_upload">BUKTI PERBELANJAAN</label>
                    </div>
                    <div class="g-col-9">
                        @if($edit)
                        <input class="filepond" name="file_upload[]" id="file_upload" type="file" multiple />
                        @error('file_upload')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                        @endif
                        @if($plan_form->pic_evidences)
                        <div class="existing-file-container">
                            @foreach ($plan_form->pic_evidences as $evidence)
                            @php
                                $media = $evidence->getFirstMedia('druDataAttachment');
                            @endphp
                            @if($media)
                            <div class="file-btn">
                                <input type="hidden" name="existing_files[]" value="{{ $evidence->id }}">
                                <a href="{{ route('dana-ru.cadangan-agihan.file.download', $evidence->id) }}" class="file-action-btn"><i class="file-icon-padding" data-feather="download"></i></a>
                                <div class="file-info">
                                    <span class="file-info-main">{{ $media->file_name }}</span>
                                    <span class="file-info-sub">{{ number_format(($media->size/1000000), 2, '.', ',') ?? 0 }} MB</span>
                                </div>
                                @if($edit)<button type="button" onclick="deleteExistingFile($(this))" class="file-action-btn remove-btn"><i class="file-icon-padding" data-feather="x"></i></button>@endif
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @if($edit)
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.senarai-agihan.index', $year) }}" class="btn btn-light me-3">Batal</a>
                    @if(in_array($plan_form->pic_submission_status, [null, 7]))<button type="submit" name="submit_btn" form="form_1" value="7" class="btn btn-info text-white me-3">Simpan</button>@endif
                    <button type="submit" name="submit_btn" form="form_1" value="8" class="btn btn-primary">Hantar</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</form>

@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script>
    var edit = {!! json_encode($edit) !!};
    var multiple = edit ? 'multiple' : '';
    var mainTemplates = {!! json_encode(getKpiTemplate('main')) !!};
    var kpiTemplates = {!! json_encode(getKpiTemplate('kpi')) !!};
    var oldInput = {!! json_encode(($plan_form->kpiInputData ?? null)) !!};
    var plan_status = {!! $plan->status !!};
    var main_dist = oldInput.main_dist;
    var kpi = oldInput.kpi;
    var mykpi = {!! json_encode((session()->getOldInput()['mykpi'] ?? $plan_form->kpiInputData['mykpi'])) !!};
    if (typeof main_dist !== 'undefined') {
        main_dist.forEach(function(value, index) {
            manageKpiItem('main_dist', 'add', null, value, plan_status);
        });
    }
    if (typeof kpi !== 'undefined') {
        kpi.forEach(function(value, index) {
            manageKpiItem('kpi', 'add', null, value, plan_status);
        });
    }
    if (typeof mykpi !== 'undefined') {
        mykpi.forEach(function(value, index) {
            manageKpiItem('mykpi', 'add', null, value, plan_status);
        });
    }
    // console.log('{!! old('project') ?? ($plan_form->projectInputData ?? '') !!}');
    getProjectList('{!! old('project') ?? ($plan_form->projectInputData ?? '') !!}');
    getChargeline($('#ptj').val(),'ptj');
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

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="file_upload"]');

    // Create a FilePond instance
    const options = {
        labelIdle: `Drag & Drop supporting document or <span class="filepond--label-action">Browse</span>`,
        allowFileTypeValidation: true,
        maxFileSize: '30MB'
      };
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    const pond = FilePond.create(inputElement, options);
    
    FilePond.setOptions({
        server: {
            process: '/data/upload/'+multiple,
            revert: '/data/revert/',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
    });

    function getProjectList(selectedValue = null) {
        var program = $("#mrun").val();
        var year = {!! $year !!};
        var oldProject = '';
        if (program) {
            $.ajax({
                url: "/ajax/getProjectList/" + program + "/" + year,
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
                                id: val.id + '_' + val.code + '_' + val.code_2 + '_' + val.fixed_subproject ,
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
                    fixed_subproject = data[3];
                    $('#cl_pro').val(pro);
                    $('#cl_sub').val(sub);
                    if(fixed_subproject == 'Y'){
                        $('#cl_pro').prop('readonly', true);
                        $('#cl_sub').prop('readonly', true);
                    }
                    else{
                        $('#cl_pro').prop('readonly', true);
                        $('#cl_sub').prop('readonly', true);
                        // $('#cl_sub').prop('readonly', false);
                    }
                }
                else{
                    $('#cl_pro').val('');
                    $('#cl_sub').val('');
                    $('#cl_pro').prop('readonly', true);
                    $('#cl_sub').prop('readonly', true);
                }
            }
            else{
                $('#cl_pro').val('');
                $('#cl_sub').val('');
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
            view_only_main_dist = ((table == 'main_dist' || table == 'kpi') && plan_status == 6) || !edit;
            disabled_prop = view_only_main_dist ? 'disabled' : '';
            readonly_prop = view_only_main_dist ? 'readonly' : '';
            d_none_prop = view_only_main_dist ? 'd-none' : '';
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
            else if(table == 'mykpi'){
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
                                    '<td class="text-end" colspan="3">JUMLAH KESELURUHAN '+(table == 'mykpi' ? 'PERBELANJAAN' : 'AGIHAN')+'(RM)</td>'+
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
            });-
            calculate(table); 
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
        if(table == 'main_dist')$("#total_dist, #total_fund").val(grand_total);
        else if(table == 'mykpi'){
            var total_fund = parseFloat($("#total_fund").val().replaceAll(',',''));
            var commitment = parseFloat($("#commitment").val().replaceAll(',','')) || 0;
            grand_total = grand_total || 0;
            var grand_total_percent = total_fund > 0 ? grand_total/total_fund*100 : 0;
            var commitment_percent = total_fund > 0 ? commitment/total_fund*100 : 0;
            $("#total_expenses").val(grand_total);
            if(commitment > total_fund){
                $('#commitment').siblings('.percent').html(commitment_percent.toFixed(2)+' %');
                $('#commitment').siblings('.percent').removeClass('text-theme-9');
                $('#commitment').siblings('.percent').addClass('text-theme-6');
            }
            else{
                $('#commitment').siblings('.percent').html(commitment_percent.toFixed(2)+' %');
                $('#commitment').siblings('.percent').addClass('text-theme-9');
                $('#commitment').siblings('.percent').removeClass('text-theme-6');
            }
            if(grand_total > total_fund){
                $('#total_expenses').siblings('.percent').html(grand_total_percent.toFixed(2)+' %');
                $('#total_expenses').siblings('.percent').removeClass('text-theme-9');
                $('#total_expenses').siblings('.percent').addClass('text-theme-6');
            }
            else{
                $('#total_expenses').siblings('.percent').html(grand_total_percent.toFixed(2)+' %');
                $('#total_expenses').siblings('.percent').addClass('text-theme-9');
                $('#total_expenses').siblings('.percent').removeClass('text-theme-6');
            }
            var balance = total_fund - grand_total - commitment;
            var balance_percent = total_fund > 0 ? balance/total_fund*100 : 0;
            $("#balance").val(balance);
            if(balance >= 0){
                $('#balance').siblings('.percent').html(balance_percent.toFixed(2)+' %');
                $('#balance').siblings('.percent').addClass('text-theme-9');
                $('#balance').siblings('.percent').removeClass('text-theme-6');
                $("#balance").addClass('text-theme-9');
                $("#balance").removeClass('text-theme-6');
            }
            else {
                $('#balance').siblings('.percent').html(balance_percent.toFixed(2)+' %');
                $('#balance').siblings('.percent').removeClass('text-theme-9');
                $('#balance').siblings('.percent').addClass('text-theme-6');
                $("#balance").removeClass('text-theme-9');
                $("#balance").addClass('text-theme-6');
            }
        }
    }

    function deleteExistingFile(that){
        let parent_class = that.parent().prop('class');
        that.parent().remove();
        if($('.'+parent_class).length <= 0)$('.existing-file-container').remove();
    }

    $('form').bind('submit', function () {
        $('#mrun, #bpki, #project, #main_dist select').prop('disabled', false);
    });
</script>
@endsection