@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") eMyRA General Info @endslot
@slot("trimoduleLink") myra.info.staff @endslot
@slot("trimodule") Academic Staff @endslot
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
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/staff-info"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.info.staff', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.staff')) active @else  @endif" role="tab">Academic Staff</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.info.student', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.student')) active @else  @endif" role="tab">Student</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">GRADE DISTRIBUTION</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">COHORT DISTRIBUTION</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">ACTIVE ACADEMIC STAFF</span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">FOREIGN STAFF</span><br><canvas id="line2"></canvas></div>
            </div>
            <div class="col-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">FOREIGN STAFF BY COUNTRY OF ORIGIN</span><br><canvas id="bar3"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'PROFESSOR',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'ASSOCIATE PROFESSOR',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgb(72, 138, 153)',
                    borderColor: 'rgb(72, 138, 153)',
                    borderWidth: 1
                },
                {
                    label: 'SENIOR LECTURER',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
                    borderWidth: 1
                },
                {
                    label: 'LECTURER',
                    data: data.bar_1.data_4,
                    backgroundColor: 'rgba(218, 218, 218)',
                    borderColor: 'rgba(218, 218, 218)',
                    borderWidth: 1
                },
                {
                    label: 'RESEARCH FELLOW',
                    data: data.bar_1.data_5,
                    backgroundColor: 'rgba(32, 40, 62)',
                    borderColor: 'rgba(32, 40, 62)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 1200,
                    min: 0,
                    // ticks: {
                    //     stepSize: 400
                    // }
                },
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'A (> 50 years old)',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'B (40 - 50 years old)',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgb(72, 138, 153)',
                    borderColor: 'rgb(72, 138, 153)',
                    borderWidth: 1
                },
                {
                    label: 'C (< 40 years old)',
                    data: data.bar_2.data_3,
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
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
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 800,
                    min: 0,
                    // ticks: {
                    //     stepSize: 200
                    // }
                },
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: data.country,
            datasets: [
                {
                    data: data.bar_3.data_1,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 50,
                    min: 0,
                    // ticks: {
                    //     stepSize: 10
                    // }
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
                    label: 'DATA',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(72, 72, 72)'],
                    backgroundColor: ['rgb(72, 72, 72)'],
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
                    display: false,
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 2000,
                    min: 0,
                    // ticks: {
                    //     stepSize: 500
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
                    label: 'DATA',
                    data: data.line_2.data_1,
                    borderColor: ['rgb(72, 72, 72)'],
                    backgroundColor: ['rgb(72, 72, 72)'],
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
                    display: false,
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 200,
                    min: 0,
                    // ticks: {
                    //     stepSize: 50
                    // }
                },
            }
        },
    });
</script>
@endsection
@endcomponent