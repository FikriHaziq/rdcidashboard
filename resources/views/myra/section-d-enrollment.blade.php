@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section D: Quantity and Quality of Postgraduates @endslot
@slot("trimoduleLink") myra.section-d @endslot
@slot("trimodule") Enrollment @endslot
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
        Section D: Quantity and Quality of Postgraduates - Enrollment
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-d/ENROLLMENT"/>
                                    
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-d', ['tabs'=>'ABSORPTION','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Postgraduates</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-d', ['tabs'=>'ABSORPTION','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Enrollment</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D5 - <b>% OF INTERNATIONAL POSTGRADUATES ENROLLED</b></span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D6 - <b>% OF POSTGRADUATES ENROLLED WITH CGPA ≥ 3.00</b></span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D7 - <b>% OF POSTGRADUATES ENROLLED WITH FELLOWSHIP/GRANTS</b></span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D8 - <b>POSTDOCTORAL APPOINTMENT</b></span><br><canvas id="bar4"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};

    const customOptions = {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                reverse: 'true',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'rectRot',
                }
            },
            datalabels: {
                formatter: (value, ctx) => {
                    return Math.round(value) + '%';
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Year'
                },
                stacked: true,
            },
            y: {
                grace: '5%',
                grid: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Percentage (%)'
                },
                ticks: {
                    stepSize: 50,
                    callback: ((value, index, ticks) => {
                        return value + '%';
                    })
                },
                beginAtZero: true,
            },
        }
    };

    function doubleTarget(arg) {
        dataValue = [];
        for (i = 0; i < arg.length; i++) {
            value = arg[i] * 2;
            dataValue.push(value);
        }
        return dataValue;
    }

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '200% TARGET',
                    data: doubleTarget(data.bar_1.data_2),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#5200C0'
                    }
                },
                {
                    label: '100% TARGET',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '200% TARGET',
                    data: doubleTarget(data.bar_2.data_2),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#5200C0'
                    }
                },
                {
                    label: '100% TARGET',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '200% TARGET',
                    data: doubleTarget(data.bar_3.data_2),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#5200C0'
                    }
                },
                {
                    label: '100% TARGET',
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_3.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_4.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_4.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    reverse: 'true',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    stacked: true,
                },
                y: {
                    grace: '5%',
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Postdoctoral Appointment'
                    },
                    beginAtZero: true,
                },
            }
        },
    });
</script>
@endsection
@endcomponent