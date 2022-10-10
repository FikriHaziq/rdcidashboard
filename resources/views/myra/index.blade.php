@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submoduleLink") myra.index @endslot
@slot("submodule") eMyRA Overview @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        eMyRA Overview
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
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
<div class="intro-y row mt-5">
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5"><b>TOTAL MARKS</b><br><canvas id="line1"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT B - <b>RESEARCHERS</b><br><canvas id="line2"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT C - <b>RESEARCH</b><br><canvas id="line3"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT D - <b>POSTGRADUATES</b><br><canvas id="line4"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT E - <b>INNOVATION</b><br><canvas id="line5"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT F - <b>PROFESSIONAL SERVICES & GIFTS</b><br><canvas id="line6"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT G - <b>NETWORKING & LINKAGES</b><br><canvas id="line7"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECT H - <b>SUPPORT FACILITIES</b><br><canvas id="line8"></canvas></div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    function getList(start, end) {
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        window.location = window.location.origin + '/myra/overview?search=1&start_year=' + start_year + '&end_year=' + end_year;
    }

    var data = {!! json_encode($data) !!};

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line2 = document.getElementById('line2');
    var lineChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line3 = document.getElementById('line3');
    var lineChart3 = new Chart(line3, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line4 = document.getElementById('line4');
    var lineChart4 = new Chart(line4, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line5 = document.getElementById('line5');
    var lineChart5 = new Chart(line5, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line6 = document.getElementById('line6');
    var lineChart6 = new Chart(line6, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line7 = document.getElementById('line7');
    var lineChart7 = new Chart(line7, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line8 = document.getElementById('line8');
    var lineChart8 = new Chart(line8, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: ['78', '80', '92', '94', '94', '93'],
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: ['101', '110', '115', '117', '117', '117'],
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
                    tension: 0.1,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
</script>
@endsection
@endcomponent