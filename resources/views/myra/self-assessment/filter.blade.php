<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <div class="w-full w-md-auto d-flex">
        <div class="input-group ms-2 ms-sm-2 me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                @foreach ($data->faculties ?? [] as $faculty)
                <option value="{{ $faculty->faculty }}">{{ $faculty->faculty }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">SCHOOL</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                @foreach ($data->schools ?? [] as $school)
                <option value="{{ $school->school }}">{{ $school->school }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">INSTITUTE/COE</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                @foreach ($data->institute ?? [] as $institution)
                <option value="{{ $institution->institute }}">{{ $institution->institute }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">RC</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                @foreach ($data->rc ?? [] as $info)
                <option value="{{ $info->rc }}">{{ $info->rc }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">YEAR</div>
            <select class="form-select bg-white" onchange="getList($(this))">
            </select>
        </div>
    </div> --}}
</div>