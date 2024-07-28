@component("layouts.app")
@slot("module") Agihan Program @endslot
@section('custom-css')
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        AGIHAN PROGRAM
    </h2>
</div>
<div class="intro-y row mt-5">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="form-select bg-white w-full" onchange="searchCategory($(this))">
                        @foreach ($categories as $category_options)
                        <option value="{{ $category_options->value }}" @if($category == $category_options->value) selected @endif>{{ strtoupper($category_options->name) }}</option>
                        @endforeach
                    </select>
                </div>     
            </div>
        </div>
    </div>
</div>
<div class="intro-y row mt-5">
    <div class="g-col-12 d-flex d-lg-block flex-column-reverse">
        <form id="search_form" action="{{ route('dana-ru.kewangan.agihan-program.index', $category) }}" method="get">
            <div class="intro-y box mt-5">
                <div class="p-5 border-top border-gray-200 dark-border-dark-5">
                    <div class="intro-y align-items-center">
                        <div class="w-full w-md-auto grid columns-12 gap-4 mb-4">
                            <div class="g-col-12 g-col-xl-6">
                                <div class="input-group me-2 me-sm-2">
                                    <div class="input-group-text bg-theme-1 text-white">TITLE</div> 
                                    <select id="title" name="title" class="form-select bg-white">
                                        <option value="">Please choose</option>
                                        @foreach ($title_options as $title)
                                        <option value="{{$title->code}}" @if($search_params->title===$title->code) selected @endif>{{$title->jenis_agihan}}</option>\
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="g-col-6 g-col-xl-3">
                                <div class="input-group me-2 me-sm-2">
                                    <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
                                    <select id="start_year" name="start_year" class="form-select bg-white">
                                        <option value="">Please choose</option>
                                        @for ($i = date('Y') - 13; $i <= date('Y'); $i++)
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
                                        @for ($i = date('Y') - 13; $i <= date('Y'); $i++)
                                        <option value="{{$i}}" @if((int)$search_params->end_year===(int)$i) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
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
</div>
<div class="intro-y row mt-5">
    <div class="col-12">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: #8430CE;">
                <div class="fw-medium fs-base text-white">Agihan</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_allocation'], 2, '.', ',') }}</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: #4AC4D2">
                <div class="fw-medium fs-base text-white">Belanja</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_expenses'], 2, '.', ',') }}</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: #d1ce27">
                <div class="fw-medium fs-base text-white">Baki</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_balance'], 2, '.', ',') }}</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: #6e6567;">
                <div class="fw-medium fs-base text-white">Peratus Belanja</div>
                <div class="fw-bold fs-lg text-white">{{ number_format($chart_data['total_expenses_percent'], 2, '.', ',') }} %</div>
            </div>
        </div>
    </div>
</div>
@if ($category == 1)
<x-dru.infographic.tncpi-bpki-program :chartdata="$chart_data" />
@elseif ($category == 2)
<x-dru.infographic.tncpi-ptj :chartdata="$chart_data" />
@elseif ($category == 3)
<x-dru.infographic.tncpi-project :chartdata="$chart_data" />
@elseif ($category == 4)
<x-dru.infographic.tncpi-sodo :chartdata="$chart_data" />
@else
<x-dru.infographic.tncpi-overall :chartdata="$chart_data" />
@endif
@endslot
@section('custom-js')
@parent
<script>
    function searchCategory(that) {
        if(that.val())window.location.href = window.location.origin + '/dana-ru/kewangan/agihan-program/'+ that.val();
        else window.location.href = window.location.origin + '/dana-ru/kewangan/agihan-program';

    }
</script>
@endsection
@endcomponent