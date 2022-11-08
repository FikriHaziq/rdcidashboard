@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C: Quantity and Quality of Research @endslot
@slot("trimodule") Funding by Faculty @endslot
@slot("trimoduleLink") myra.section-c @endslot
@section('custom-css')
<style>
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
        Section C: Quantity and Quality of Research
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
        <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 inactive-tab" role="tab">Publication</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-FACULTY', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 inactive-tab" role="tab">Publication by Faculty</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 inactive-tab" role="tab">Funding</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-FACULTY', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active-tab" role="tab">Funding by Faculty</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PUBLIC FUND (UNIVERSITY) APPROVED</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PUBLIC FUND (NATIONAL) APPROVED</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PRIVATE FUND APPROVED</span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW INTERNATIONAL FUND APPROVED</span><br><canvas id="bar4"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR PUBLIC FUND</span><br><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR PRIVATE FUND</span><br><canvas id="bar6"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR INTERNATIONAL FUND</span><br><canvas id="bar7"></canvas></div>
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
        window.location = window.location.origin + '/myra/section-c?search=1&start_year=' + start_year + '&end_year=' + end_year;
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
                    return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                },
                color: 'rgb(0, 0, 0)',
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
                ticks: {
                    callback: (value, index, values) => {
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                    }
                }
            },
        }
    };

    // no legend
    const basicOptions = {
        plugins: {
            legend: {
                display: false
            },
            datalabels: {
                formatter: (value, ctx) => {
                    return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                },
                color: 'rgb(0, 0, 0)',
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
                ticks: {
                    callback: (value, index, values) => {
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                    }
                }
            },
        }
    }

    // update year range and faculty here; labels
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
                    label: 'ACHIEVEMENT',
                    data: [60000, 51000, 45000, 818000, 2280000, 843000],
                    backgroundColor: 'rgb(253, 180, 7)',
                    borderColor: 'rgb(253, 180, 7)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: [455000, 146000, 229000, 2110000, 1200000, 1750000],
                    backgroundColor: 'rgb(21, 164, 63)',
                    borderColor: 'rgb(21, 164, 63)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: [0, 15000, 80000, 329000, 96000, 40000],
                    backgroundColor: 'rgb(19, 160, 236)',
                    borderColor: 'rgb(19, 160, 236)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: [0, 0, 4600000, 100000, 0, 523000],
                    backgroundColor: 'rgb(230, 104, 38)',
                    borderColor: 'rgb(230, 104, 38)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: [160000000, 160000000, 160000000, 160000000, 160000000, 160000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [80000000, 80000000, 80000000, 80000000, 80000000, 80000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                },
                {
                    label: 'UNIVERSITY',
                    data: [19820000, 28340000, 22040000, 19820000, 28340000, 22040000],
                    backgroundColor: 'rgb(67, 113, 40)',
                    borderColor: 'rgb(67, 113, 40)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                },
                {
                    label: 'NATIONAL',
                    data: [46060000, 58600000, 40890000, 46060000, 58600000, 40890000],
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            locale: 'en-MY',
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
                    ticks: {
                        callback: (value, index, values) => {
                            return new Intl.NumberFormat('en-MY', {
                                style: 'currency',
                                currency: 'MYR',
                                notation: 'compact',
                            }).format(value);
                        }
                    }
                },
            }
        }
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: [1500000, 1500000, 1500000, 7000000, 7000000, 7000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [1000000, 1000000, 1000000, 4000000, 4000000, 4000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        display: false,
                    },
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [97000, 1910000, 2390000, 111000, 22000, 436000],
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
                    label: 'MyRA II TARGET (200%)',
                    data: [1500000, 1500000, 1500000, 7000000, 7000000, 7000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: [1000000, 1000000, 1000000, 4000000, 4000000, 4000000],
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        display: false,
                    },
                },
                {
                    label: 'ACHIEVEMENT',
                    data: [97000, 1910000, 2390000, 111000, 22000, 436000],
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