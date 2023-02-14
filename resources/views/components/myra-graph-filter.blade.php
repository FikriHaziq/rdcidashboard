<div class="g-col-12 d-flex d-lg-block flex-column-reverse">
    <div class="intro-y box mt-5">
        <div class="p-5 border-top border-gray-200 dark-border-dark-5">
            <div class="intro-y d-flex flex-column flex-sm-row align-items-center">
                <div class="w-full w-md-auto d-flex @if(!in_array(user()->role, ['super_admin', 'admin'])) d-none @endif">
                    <div class="input-group me-2 me-sm-2">
                        <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
                        <select id="faculty_select" class="form-select bg-white" onchange="getSchool()">
                            <option value="">All</option>
                            @foreach (getFaculty2() ?? [] as $faculty_data)
                            <option value="{{ $faculty_data->code }}" @if($faculty==$faculty_data->code) selected @endif>{{ $faculty_data->parameter_name }} - {{ $faculty_data->description_1 }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="w-full w-md-auto d-flex @if(user()->school_code) d-none @endif">
                    <div class="input-group me-2 me-sm-2">
                        <div class="input-group-text bg-theme-1 text-white">SCHOOL</div>
                        <select id="school_select" class="form-select bg-white">
                            <option value="">All</option>
                        </select>
                    </div>
                </div>
                <div class="w-full w-md-auto d-flex">
                    <div class="input-group me-2 me-sm-2">
                        <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
                        <select id="start_year" class="form-select bg-white">
                            @for ($i = date('Y') - 12; $i <= date('Y'); $i++)
                            <option value="{{$i}}" @if((int)$start_year===(int)$i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="w-full w-md-auto d-flex">
                    <div class="input-group">
                        <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
                        <select id="end_year" class="form-select bg-white">
                            @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                            <option value="{{$i}}" @if((int)$end_year===(int)$i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-top border-gray-200 dark-border-dark-5 d-flex">
            <button type="button" onclick="getList('start_year', 'end_year')" class="btn btn-dark w-full">Search</button>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var endpoint = {!! json_encode($endpoint) !!};
    var oldSchool = {!! json_encode($school) !!};
    getSchool();
    function getList(start, end) {
        swal({
            title: 'Processing...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        swal.showLoading();
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        var faculty = $('#faculty_select').val();
        var school = $('#school_select').val();
        var searching = '';
        if(faculty != '') searching += '&faculty=' + faculty;
        if(school != '') searching += '&school=' + school;
        window.location = window.location.origin + '/' + endpoint + '?search=1&start_year=' + start_year + '&end_year=' + end_year + searching;
    }

    function getSchool() {
        var faculty = $("#faculty_select").val();
        if (faculty) {
            $.ajax({
                url: "/ajax/getSchool/" + faculty,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $("#school_select").children().remove();
                    $("#school_select").append("<option value=''>All</option>")
                    if (res.result.length > 0) {
                        console.log(res);
                        $.each(res.result, function(i, val) {
                            if(oldSchool == val.code) $("#school_select").append("<option value='" + val.code + "' selected>" + val.parameter_name + ' - ' + val.description_1 + "</option>");
                            else $("#school_select").append("<option value='" + val.code + "'>" + val.parameter_name + ' - ' + val.description_1 + "</option>");
                        });
                    }
                },
            });
        } else {
            // alert("no value");
        }
    }
</script>