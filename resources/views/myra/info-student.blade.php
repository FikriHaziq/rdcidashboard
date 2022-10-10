@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") eMyRA General Info @endslot
@slot("trimoduleLink") myra.info.student @endslot
@slot("trimodule") Student @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
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
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        eMyRA General Info
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
<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.info.staff', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.staff')) active-tab @else inactive-tab @endif" role="tab">Academic Staff</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.info.student', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.student')) active-tab @else inactive-tab @endif" role="tab">Student</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">POSTGRADUATES STUDY MODE</span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">POSTGRADUATES BY RESEARCH</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">POSTGRADUATES AREA OF STUDY</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">STUDENT: UNDERGRADUATE VS POSTGRADUATE</span><br><canvas id="bar3"></canvas></div>
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
        window.location = window.location.origin + '/myra/student-info?search=1&start_year=' + start_year + '&end_year=' + end_year;
    }

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MASTER RESEARCH (FOREIGN)',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(40, 82, 135)',
                    borderColor: 'rgb(40, 82, 135)',
                    borderWidth: 1
                },
                {
                    label: 'MASTER RESEARCH (LOCAL)',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(252, 135, 6)',
                    borderColor: 'rgba(252, 135, 6)',
                    borderWidth: 1
                },
                {
                    label: 'PhD (FOREIGN)',
                    data: ['1957', '1854', '1713', '1876', '2104', '2482'],
                    backgroundColor: 'rgba(132, 0, 192)',
                    borderColor: 'rgba(132, 0, 192)',
                    borderWidth: 1
                },
                {
                    label: 'PhD (LOCAL)',
                    data: ['3267', '3286', '3243', '3263', '3027', '2915'],
                    backgroundColor: 'rgba(251, 0, 84)',
                    borderColor: 'rgba(251, 0, 84)',
                    borderWidth: 1
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
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 10000,
                    min: 0,
                    // ticks: {
                    //     stepSize: 5000
                    // }
                },
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['ENGINEERING', 'FINANCE/BUSINESS', 'EDUCATION', 'COMPUTER SCIENCE', 'ARCHITECTURE', 'SOCIAL SCIENCE', 'SCIENCE', 'TECHNOLOGY', 'ISLAMIC STUDY', 'LANGUAGE', 'TECHNICAL STUDY', 'SCIENCE EDUCATION', 'SCIENCE MANAGEMENT', 'TECHNICAL', 'COMMUNICATION', 'ENVIRONMENT', 'INFORMATION TECHNOLOGY'],
            datasets: [
                {
                    data: ['4100', '1400', '1300', '1350', '1200', '1100', '1000', '700', '700', '600', '300', '250', '200', '100', '100', '100', '80'],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                x: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 4500,
                    min: 0,
                    ticks: {
                        stepSize: 1500
                    }
                },
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'POSTGRADUATE',
                    data: ['12000', '13000', '14000', '16000', '15500', '15000'],
                    backgroundColor: 'rgb(25, 196, 135)',
                    borderColor: 'rgb(25, 196, 135)',
                    borderWidth: 1
                },
                {
                    label: 'UNDERGRADUATE',
                    data: ['12000', '13000', '14000', '16000', '15500', '15000'],
                    backgroundColor: 'rgba(252, 71, 193)',
                    borderColor: 'rgba(252, 71, 193)',
                    borderWidth: 1
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
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 30000,
                    min: 0,
                    ticks: {
                        stepSize: 5000
                    }
                },
            }
        }
    });

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MASTER RESEARCH',
                    data: ['5000', '4800', '5200', '4900', '5500', '5550'],
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
                    tension: 0.1,
                },
                {
                    label: 'MASTER COURSEWORK',
                    data: ['5000', '4500', '4300', '4600', '4700', '4800'],
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                },
                {
                    label: 'PHD',
                    data: ['2000', '3100', '2100', '2000', '1800', '1700'],
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                },
                {
                    label: 'DOCTORAL COURSEWORK',
                    data: ['100', '100', '200', '200', '250', '260'],
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
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
                    // max: 6000,
                    min: 0,
                    ticks: {
                        stepSize: 2000
                    }
                },
            }
        },
    });
</script>
@endsection
@endcomponent