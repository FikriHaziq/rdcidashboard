@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section G: Networking and Linkages @endslot
@slot("submoduleLink") myra.section-g @endslot
@section('custom-css')
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
    .bg-whitesmoke {
        background-color: whitesmoke;
    }
    
    .active-tab {
        background-color:white;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    .inactive-tab {
        opacity: 0.5;
        background-color:rgb(193, 193, 193);
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }
</style>
@endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section G: Networking and Linkages
    </h2>
</div>
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                {{-- @foreach ($data->faculties ?? [] as $faculty)
                <option value="{{ $faculty->faculty }}">{{ $faculty->faculty }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
            <select id="start_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$start_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group">
            <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
            <select id="end_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$end_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-g', ['tabs'=>'STAFFOVERALL','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Staff Participation Overall</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-g', ['tabs'=>'STAFFFACULTY','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Staff Participation by Faculty</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-g', ['tabs'=>'PROJECTOVERALL','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Project Overall</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-g', ['tabs'=>'PROJECTFACULTY','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Project by Faculty</a>
    </li>
</ul>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">STAFF INVOLVED IN INTERNATIONAL MOA</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">STAFF SENT ABROAD</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">INTERNATIONAL MEMBERSHIP - STAFF AS MEMBER</span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">INTERNATIONAL MEMBERSHIP - STAFF APOINTED AS COMMITTEE</span><br><canvas id="bar4"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">STAFF INVOLVED IN NATIONAL MOA</span><br><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NATIONAL MEMBERSHIP - STAFF AS MEMBER</span><br><canvas id="bar6"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NATIONAL MEMBERSHIP - STAFF APOINTED AS COMMITTEE</span><br><canvas id="bar7"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    function getList(start, end) {
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        window.location = window.location.origin + '/myra/section-f/COMMUNITY?search=1&start_year=' + start_year + '&end_year=' + end_year;
    }
    var data = {!! json_encode($data) !!};

    const customOptions = {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                }
            },
            datalabels: {
                formatter: (value, ctx) => {
                    let sum = 0;
                    let i = ctx.dataIndex;
                    let total = ctx.chart.data.datasets[0].data[i];
                    let percentage = (value*100 / total).toFixed(2)+"%";
                    return percentage;
                },
            }
        },
        scales: {
            x: {
                grid: {
                display: false
                },
                stacked: true,
            },
            y: {
                grid: {
                display: false
                },
                beginAtZero: true,
            },
        }
    };

    const facultyLabels = [
        ['AHIBS', 2019], ['AHIBS', 2020], ['AHIBS', 2021],
        ['FABU', 2019], ['FABU', 2020], ['FABU', 2021],
    ];
    
    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar7 = document.getElementById('bar7');
    var barChart7 = new Chart(bar7, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [9500, 9500, 10000, 9500, 9500, 10000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [2775, 2638, 2593, 2775, 2638, 2593],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });
</script>
@endsection
@endcomponent