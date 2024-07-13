@component("layouts.app")
@slot("module") Carian @endslot
@slot("submodule") Allocation @endslot
@section('custom-css')
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        ALLOCATION
    </h2>
</div>
<div class="g-col-12 d-flex d-lg-block flex-column-reverse">
    <form id="search_form" action="{{ route('dana-ru.carian.allocation') }}" method="get">
        <div class="intro-y box mt-5">
            <div class="p-5 border-top border-gray-200 dark-border-dark-5">
                <div class="intro-y align-items-center">
                    <div class="w-full w-md-auto grid columns-12 gap-4 mb-4">
                        <div class="g-col-12 g-col-xl-6">
                            <div class="input-group me-2 me-sm-2">
                                <div class="input-group-text bg-theme-1 text-white">TITLE</div> <input id="title" name="title" type="text" value="{{ $search_params->title }}" class="form-control" placeholder="Title" aria-describedby="title">
                            </div>
                        </div>
                        <div class="g-col-6 g-col-xl-3">
                            <div class="input-group me-2 me-sm-2">
                                <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
                                <select id="start_year" name="start_year" class="form-select bg-white">
                                    <option value="">Please choose</option>
                                    @for ($i = date('Y') - 12; $i <= date('Y'); $i++)
                                    <option value="{{$i}}" @if((int)$search_params->start_year===(int)$i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="g-col-6 g-col-xl-3">
                            <div class="input-group me-2 me-sm-2">
                                <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
                                <select id="end_year" name="end_year" class="form-select bg-white">
                                    <option value="">Please choose</option>
                                    @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                                    <option value="{{$i}}" @if((int)$search_params->end_year===(int)$i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-full w-md-auto grid columns-12 gap-4">
                        <div class="g-col-12 g-col-xl-6">
                            <div class="input-group me-2 me-sm-2">
                                <div class="input-group-text bg-theme-1 text-white">PROGRAM</div>
                                <select id="program" name="program" class="form-select bg-white">
                                    <option value="">All</option>
                                    @foreach (getMrunList() ?? [] as $program)
                                    <option value="{{ $program->code }}" @if($search_params->faculty==$program->code) selected @endif>{{ $program->parameter_name }} - {{ $program->description_1 }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="g-col-12 g-col-xl-6">
                            <div class="input-group me-2 me-sm-2">
                                <div class="input-group-text bg-theme-1 text-white">Code</div> 
                                <input id="code" name="code" type="text" class="form-control" aria-describedby="code" value="{{ $search_params->code }}" placeholder="cth: 21A1">
                                <div class="input-group-text">.</div> 
                                <input id="code2" name="code2" type="text" class="form-control" aria-describedby="code2" value="{{ $search_params->code2 }}" placeholder="cth: 00A00">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-top border-gray-200 dark-border-dark-5 d-flex">
                <button type="submit" form="search_form" class="btn btn-dark w-full">Search</button>
            </div>
        </div>
    </form>
</div>
<div class="g-col-12 d-flex d-lg-block flex-column-reverse">
    <div class="intro-y box mt-5">
        <div class="p-5" id="hoverable-table">
            <div class="preview">
                <div class="overflow-x-auto table-responsive">
                    <table class="table table-bordered table-hover compact" id="datatable">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-center"><input type="checkbox" id="select-all"></th>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">YEAR</th>
                                <th class="whitespace-nowrap">TABUNG INDUK</th>
                                <th class="whitespace-nowrap">PROGRAM</th>
                                <th class="whitespace-nowrap">BPKI</th>
                                <th class="whitespace-nowrap">PTJ</th>
                                <th class="whitespace-nowrap">KOD PTJ</th>
                                <th class="whitespace-nowrap">PROJECT</th>
                                <th class="whitespace-nowrap">SUB PROJECT</th>
                                <th class="whitespace-nowrap">JENIS AGIHAN</th>
                                <th class="whitespace-nowrap">EXPENDITURE TYPE</th>
                                <th class="whitespace-nowrap">AMOUNT (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    let queryString = "{!! http_build_query($search_params->toArray()) !!}";
    var selectedProjects = [];
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": '/dana-ru/carian/allocation/?'+queryString,
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'year',name: 'year'},
            {data: 'dmf_code',name: 'tabung_induk'},
            {data: 'program',name: 'program'},
            {data: 'bpki',name: 'bpki'},
            {data: 'faculty_short',name: 'ptj'},
            {data: 'faculty_code',name: 'f_original_code'},
            {data: 'project',name: 'project'},
            {data: 'sub_project',name: 'sub_project'},
            {data: 'jenis_agihan',name: 'jenis_agihan'},
            {data: 'expenditure_type',name: 'expenditure_type'},
            {data: 'mda_amount',name: 'amount'},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,2,3,4,5,6,7,8,9,10,11,12]}
        ],
        // layout: {
        //     topEnd: function () {
        //     let toolbar = document.createElement('div');
        //     toolbar.innerHTML = '<button id="add_selection" type="button" onclick="addToAgihan()" class="btn btn-primary d-none">Add to Tabung Agihan <i>&nbsp; (<span id="selectedProjects"></span> selected)</i></button>';
        //     return toolbar;
        // }
        // }
    });
    
    $('#select-all').on('click', function(){
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        if(this.checked){
            // Add checked projects to the selectedProjects array
            table.rows().data().each(function (data) {
                if($.inArray(data.dp_id, selectedProjects) === -1) {
                    selectedProjects.push(data.dp_id);
                }
            });
        } else {
            // Remove all projects from the selectedProjects array
            table.rows().data().each(function (data) {
                var index = $.inArray(data.dp_id, selectedProjects);
                if (index !== -1) {
                    selectedProjects.splice(index, 1);
                }
            });
        }
        handleButtonAddSelection();
    });

    $('#datatable tbody').on('change', 'input[type="checkbox"]', function(){
        var data = table.row($(this).closest('tr')).data();
        var id = data.dp_id;

        if(this.checked){
            if($.inArray(id, selectedProjects) === -1) {
                selectedProjects.push(id);
            }
        } else {
            var index = $.inArray(id, selectedProjects);
            if(index !== -1) {
                selectedProjects.splice(index, 1);
            }

            // If unchecking this box and "Select all" box is checked, we need to uncheck the "Select all" box
            if($('#select-all').prop('checked')){
                $('#select-all').prop('checked', false);
            }
        }
        handleButtonAddSelection();
    });

    // When table is redrawn (pagination, filter, etc.)
    table.on('draw', function() {
        // Check if "Select all" checkbox should be checked
        var allChecked = true;
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).each(function() {
            if(!this.checked) {
                allChecked = false;
            }
        });

        if(allChecked){
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }

        // Iterate over all checkboxes to set their state
        table.rows().data().each(function (data) {
            if($.inArray(data.dp_id, selectedProjects) !== -1) {
                $('input[type="checkbox"]', rows).filter(function(){
                    return $(this).val() == data.dp_id;
                }).prop('checked', true);
            }
        });
    });

    function handleButtonAddSelection(){
        if(selectedProjects.length > 0) $('#add_selection').removeClass('d-none');
        else $('#add_selection').addClass('d-none');
        $('#selectedProjects').html(selectedProjects.length);
    }

    function addToAgihan() {
        swal({
            title: 'Please wait...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        swal.showLoading();
        var formData = new FormData();
        for (var i = 0; i < selectedProjects.length; i++) {
            formData.append('project_id[]', selectedProjects[i]);
        }
        $.ajax({
            url: "/ajax/add-dist-fund/",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                swal.close();
                toastr_alert('success', 'Project has been successfully stored.');
            },
            error: function(data) {
                swal.close();
                toastr_alert('error', 'Something went wrong.');
            }
        });
        // if (faculty) {
        //     $.ajax({
        //         url: "/ajax/getSchool/" + faculty,
        //         type: "GET",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(res) {
        //             $("#school_select").children().remove();
        //             $("#school_select").append("<option value=''>All</option>")
        //             if (res.result.length > 0) {
        //                 console.log(res);
        //                 $.each(res.result, function(i, val) {
        //                     if(oldSchool == val.code) $("#school_select").append("<option value='" + val.code + "' selected>" + val.parameter_name + ' - ' + val.description_1 + "</option>");
        //                     else $("#school_select").append("<option value='" + val.code + "'>" + val.parameter_name + ' - ' + val.description_1 + "</option>");
        //                 });
        //             }
        //         },
        //     });
        // } else {
        //     // alert("no value");
        // }
    }
</script>
@endsection
@endcomponent