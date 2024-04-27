<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5 mb-6">
    <h2 class="fs-lg fw-medium me-auto">
        {{ $slot }}
    </h2>
    @if($hasButton)
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0 ms-sm-2">
        <a href="{{ $buttonRoute }}" class="btn btn-sm btn-dark" target="_blank"><i class="p-1" data-feather="download"></i> {{ $buttonLabel }} </a>
    </div>
    @endif
    @if($hasYear)
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0 ms-sm-2">
        <div class="input-group">
            <div class="input-group-text">TAHUN</div>
            <select class="form-select" onchange="getYearList($(this), '{{ $route }}')">
                @foreach ($yearOptions as $i)
                <option value="{{$i}}" @if((int)$year===(int)$i) selected @endif>{{$i}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
</div>