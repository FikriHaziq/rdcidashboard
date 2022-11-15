<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    @if(user()->role == 'admin')
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white" onchange="getList('start_year', 'end_year', $(this).val())">
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
            <select id="start_year" class="form-select bg-white" onchange="getList('start_year', 'end_year', '{{ $faculty ?? '' }}')">
                @for ($i = date('Y') - 12; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$start_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group">
            <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
            <select id="end_year" class="form-select bg-white" onchange="getList('start_year', 'end_year', '{{ $faculty ?? '' }}')">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$end_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>

<script>
    var endpoint = {!! json_encode($endpoint) !!};
    function getList(start, end, faculty = '') {
        swal({
            title: 'Processing...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        swal.showLoading();
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        if(faculty == '')
            window.location = window.location.origin + '/' + endpoint + '?search=1&start_year=' + start_year + '&end_year=' + end_year;
        else
            window.location = window.location.origin + '/' + endpoint + '?search=1&start_year=' + start_year + '&end_year=' + end_year + '&faculty=' + faculty;
    }
</script>