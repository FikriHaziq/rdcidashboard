@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") eMyRA General Info @endslot
@slot("trimoduleLink") myra.info.student @endslot
@slot("trimodule") Student @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
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
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        General Info
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/student-info"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.info.staff', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.staff')) active @else  @endif" role="tab">Academic Staff</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.info.student', ['search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 @if(is_active('myra.info.student')) active @else  @endif" role="tab">Student</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>POSTGRADUATES STUDY MODE</b></span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>POSTGRADUATES BY RESEARCH</b></span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>POSTGRADUATES AREA OF STUDY</b></span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>STUDENT: UNDERGRADUATE VS POSTGRADUATE</b></span><br><canvas id="bar3"></canvas></div>
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
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
                    borderWidth: 1
                },
                {
                    label: 'MASTER RESEARCH (LOCAL)',
                    data: data.bar_1.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    borderWidth: 1
                },
                {
                    label: 'PhD (FOREIGN)',
                    data: data.bar_1.data_3,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    borderWidth: 1
                },
                {
                    label: 'PhD (LOCAL)',
                    data: data.bar_1.data_4,
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
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
                        pointStyle: 'rectRot',
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    min: 0,
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'No. of Student'
                    }
                },
            }
        }
    });

    // sort data from highest to lowest for bar2
    const datapoints = data.bar_2.data_1;
    const labels = data.study_area;
    let merged = datapoints.map((datapoint, i) => {
        return { "datapoint": datapoints[i], "label": labels[i] }
    });

    const dataSort = merged.sort(function (a, b) {
        return b.datapoint - a.datapoint
    });
    const sortedData = [];
    const sortedLabel = [];

    for (i = 0; i < dataSort.length; i++) {
        if (dataSort[i].datapoint != 0) {
            sortedData.push(dataSort[i].datapoint);
            sortedLabel.push(dataSort[i].label);
        }
    }
    // end sort
    // console.log(dataSort);

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: sortedLabel,
            datasets: [
                {
                    data: sortedData,
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
                    min: 0,
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'No. of Student'
                    }
                },
                y: {
                    ticks: {
                        autoSkip: false,
                        beginAtZero: true
                    },
                    grid: {
                        display: false
                    }
                }
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
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
                    borderWidth: 1
                },
                {
                    label: 'UNDERGRADUATE',
                    data: data.bar_3.data_1,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
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
                        pointStyle: 'rectRot',
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 30000,
                    min: 0,
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'No. of Student'
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
                    data: data.line_1.data_1,
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'MASTER COURSEWORK',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'PHD',
                    data: data.line_1.data_3,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'DOCTORAL COURSEWORK',
                    data: data.line_1.data_4,
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
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
                        pointStyle: 'rectRot',
                    }
                }
            },
            stacked: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    min: 0,
                    title: {
                        display: true,
                        text: 'No. of Student'
                    }
                },
            }
        },
    });
</script>
@endsection
@endcomponent