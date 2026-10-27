<form id="year_filter_form" method="GET" action="{{ route($route) }}">
    <div class="intro-y box dashboard-filter mt-5">
        <div class="filter-header d-flex align-items-center px-5 py-3">
            <i data-feather="filter" class="w-4 h-4 me-2"></i>
            <span class="fw-medium">FILTER</span>
            <span class="range-badge ms-auto">{{ $year_from }} – {{ $year_to }} · {{ $year_to - $year_from + 1 }} years</span>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-12 gap-4">
                <div class="g-col-12 g-col-md-6">
                    <div class="input-group">
                        <div class="input-group-text">START YEAR</div>
                        <select id="year_from" name="year_from" class="form-select bg-white">
                            @foreach ($year_list as $year)
                                <option value="{{ $year }}" @if((int)$year === (int)$year_from) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="g-col-12 g-col-md-6">
                    <div class="input-group">
                        <div class="input-group-text">END YEAR</div>
                        <select id="year_to" name="year_to" class="form-select bg-white">
                            @foreach ($year_list as $year)
                                <option value="{{ $year }}" @if((int)$year === (int)$year_to) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-footer p-4 border-top border-gray-200 dark-border-dark-5 d-flex align-items-center">
            <a href="{{ route($route) }}" class="btn btn-filter-reset me-3"><i data-feather="rotate-ccw" class="w-4 h-4 me-1"></i> Reset</a>
            <button type="submit" form="year_filter_form" class="btn btn-filter flex-1"><i data-feather="search" class="w-4 h-4 me-1"></i> Search</button>
        </div>
    </div>
</form>
