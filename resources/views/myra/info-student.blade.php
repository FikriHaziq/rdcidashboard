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
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/student-info"/>

<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.info.staff', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.staff')) active-tab @else inactive-tab @endif" role="tab">Academic Staff</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.info.student', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.student')) active-tab @else inactive-tab @endif" role="tab">Student</a>
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

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MASTER RESEARCH (FOREIGN)',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(40, 82, 135)',
                    borderColor: 'rgb(40, 82, 135)',
                    borderWidth: 1
                },
                {
                    label: 'MASTER RESEARCH (LOCAL)',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(252, 135, 6)',
                    borderColor: 'rgba(252, 135, 6)',
                    borderWidth: 1
                },
                {
                    label: 'PhD (FOREIGN)',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgba(132, 0, 192)',
                    borderColor: 'rgba(132, 0, 192)',
                    borderWidth: 1
                },
                {
                    label: 'PhD (LOCAL)',
                    data: data.bar_1.data_4,
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
            labels: data.study_area,
            datasets: [
                {
                    data: data.bar_2.data_1,
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
                    // ticks: {
                    //     stepSize: 1500
                    // }
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
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgb(25, 196, 135)',
                    borderColor: 'rgb(25, 196, 135)',
                    borderWidth: 1
                },
                {
                    label: 'UNDERGRADUATE',
                    data: data.bar_3.data_1,
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
                    // ticks: {
                    //     stepSize: 5000
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
                    label: 'MASTER RESEARCH',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
                    tension: 0.1,
                },
                {
                    label: 'MASTER COURSEWORK',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                },
                {
                    label: 'PHD',
                    data: data.line_1.data_3,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                },
                {
                    label: 'DOCTORAL COURSEWORK',
                    data: data.line_1.data_4,
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
                    // ticks: {
                    //     stepSize: 2000
                    // }
                },
            }
        },
    });
</script>
@endsection
@endcomponent