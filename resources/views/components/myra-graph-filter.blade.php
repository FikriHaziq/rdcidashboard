<div class="g-col-12 d-flex d-lg-block flex-column-reverse">
    <div class="intro-y box mt-5">
        <div class="p-5 border-top border-gray-200 dark-border-dark-5">
            <div class="intro-y d-flex flex-column flex-sm-row align-items-center">
                @if(in_array(user()->role, ['super_admin', 'admin']))
                <div class="w-full w-md-auto d-flex">
                    <div class="input-group me-2 me-sm-2">
                        <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
                        <select id="faculty_select" class="form-select bg-white">
                            <option value="">All</option>
                            @foreach (getFacultyByYear($end_year) ?? [] as $faculty_data)
                            <option value="{{ $faculty_data->short_overall }}" @if($faculty==$faculty_data->short_overall) selected @endif>{{ $faculty_data->short_overall }} - {{ $faculty_data->long }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
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
            <button type="button" onclick="getList('start_year', 'end_year', 'faculty_select')" class="btn btn-dark w-full">Search</button>
        </div>
    </div>
</div>

<script>
    var endpoint = {!! json_encode($endpoint) !!};
    function getList(start, end, faculty_select) {
        swal({
            title: 'Processing...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        swal.showLoading();
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        var faculty = $('#'+faculty_select).val();
        if(faculty == '')
            window.location = window.location.origin + '/' + endpoint + '?search=1&start_year=' + start_year + '&end_year=' + end_year;
        else
            window.location = window.location.origin + '/' + endpoint + '?search=1&start_year=' + start_year + '&end_year=' + end_year + '&faculty=' + faculty;
    }
</script>