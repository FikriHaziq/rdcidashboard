@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Principal Investigators @endslot
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
        Section B: Quantity and Quality of Researchers - Principal Investigators
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-b/INVESTIGATOR"/>
                                    
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Principal Investigator</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Qualification & Cohort</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'AWARD', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Award</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">STAFF INVOLVED AS PRINCIPAL INVESTIGATOR</span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">PRINCIPAL INVESTIGATORS</span><br><canvas id="line2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">PI-INTERNATIONAL: ACHIEVEMENT VS TARGET</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">PI-NATIONAL: ACHIEVEMENT VS TARGET</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">PI-UNIVERSITY: ACHIEVEMENT VS TARGET</span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">PI-PRIVATE: ACHIEVEMENT VS TARGET</span><br><canvas id="bar4"></canvas></div>
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
                    text: 'No. of PI'
                },
                beginAtZero: true,
            },
        }
    };

    const lineOptions = {
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
                        text: 'No. of Staff'
                    }
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
                    label: 'MyRA II TARGET (200%)',
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
                    label: 'MyRA II TARGET (100%)',
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
                    label: 'MyRA II TARGET (200%)',
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
                    label: 'MyRA II TARGET (100%)',
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
                    label: 'MyRA II TARGET (200%)',
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
                    label: 'MyRA II TARGET (100%)',
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
                    label: 'MyRA II TARGET (200%)',
                    data: doubleTarget(data.bar_4.data_2),
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
                    label: 'MyRA II TARGET (100%)',
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
        options: customOptions,
    });

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'PI',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'NON-PI',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
            ]
        },
        options: lineOptions,
    });

    var line2 = document.getElementById('line2');
    var lineChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'UNIVERSITY',
                    data: data.line_2.data_3,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'NATIONAL',
                    data: data.line_2.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'PRIVATE',
                    data: data.line_2.data_4,
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'INTERNATIONAL',
                    data: data.line_2.data_1,
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
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
                    title: {
                        display: true,
                        text: 'No. of PI'
                    }
                },
            }
        },
    });
</script>
@endsection
@endcomponent